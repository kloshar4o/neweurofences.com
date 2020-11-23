<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerId;
use App\Models\BannerImages;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;



class BannerController extends Controller
{

    private $lang_id;
    private $lang;

    public function __construct()
    {
        $this->lang_id = $this->lang()['lang_id'];
        $this->lang = $this->lang()['lang'];
    }

    public function index()
    {

        $view = 'admin.banner.banners-list';
        $groupSubRelations = $this->menu()['groupSubRelations'];

        $banner_list_ids = BannerId::where('deleted', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $banner_list = [];
        foreach($banner_list_ids as $key => $one_slider_ids){
            $banner_list[$key] = Banner::where('banner_id' ,$one_slider_ids->id)
                ->first();
        }
        $banner_list = array_filter( $banner_list, 'strlen' );

        return view($view, get_defined_vars());
    }

    public function cartItems()
    {
        $view = 'admin.banner.banner-cart';

        $deleted_banner_id = BannerId::where('deleted', 1)
            ->where('active', 0)
            ->get();

        $deleted_banner_list = [];

        foreach($deleted_banner_id as $key => $one_deleted_banner_id){
            $deleted_banner_list[$key] = Banner::where('banner_id', $one_deleted_banner_id->id)
                ->first();
        }

        $deleted_banner_list = array_filter( $deleted_banner_list, 'strlen' );
        return view($view, get_defined_vars());
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = BannerId::findOrFail($id);

        if(!is_null($element_id))
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Banner', 'banner_id');
        else
            return response()->json([
                'status' => false,
                'type' => 'error',
                'messages' => [controllerTrans('variables.something_wrong', $this->lang)]
            ]);

        if($active == 1) {
            $change_active = 0;
            $msg = controllerTrans('variables.element_is_inactive', $this->lang, ['name' => $element_name]);
        }
        else{
            $change_active = 1;
            $msg = controllerTrans('variables.element_is_active', $this->lang, ['name' => $element_name]);
        }

        BannerId::where('id', $id)->update(['active' => $change_active]);

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);
    }

    // ajax response for img position
    public function changeImgPosition()
    {
        $newOrder = Input::get('newOrder');

        $i = 0;
        foreach ($newOrder as $k=>$v) {
            $id = $v;
            $i++;

            if(!empty($id)){
                BannerImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    public function createItem()
    {
        $view = 'admin.banner.create-banner';


        return view($view, get_defined_vars());
    }

    public function editItem($id, $edited_lang_id)
    {
        $view = 'admin.banner.edit-banner';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $banner_without_lang = Banner::where('banner_id', $id)
            ->first();

        if(is_null($banner_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $banner = Banner::where('banner_id', $banner_without_lang->banner_id)
            ->where('lang_id', $edited_lang_id)
            ->first();

        if(!is_null($banner_without_lang)){
            $banner_id = BannerId::where('id', $banner_without_lang->banner_id)
                ->first();
        }
        elseif(!is_null($banner)){
            $banner_id = BannerId::where('id', $banner->banner_id)
                ->first();
        }

        return view($view, get_defined_vars());
    }

    public function save($id, $updated_lang_id)
    {

        $item = Validator::make(Input::all(), [
            'name' => 'required',
        ]);

        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $array_img = [];
        if(!is_null(Input::get('file')) && !empty(Input::get('file'))) {
            foreach (Input::get('file') as $item) {
                if(!is_null($item))
                    $array_img[] = basename($item);
            }
        }

//        Check if lang exist
        if(checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if(is_null($id)){
            $data = [
                'active' => 1,
                'deleted' => 0,
                'link' => !is_null(Input::get('link')) ? Input::get('link') : '',
            ];

            $banner_id = BannerId::create($data);

            $data = [
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'banner_id' => $banner_id->id,
            ];

            Banner::create($data);

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img)) {
                foreach (array_reverse(Input::get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('banners_images');
                    $img = basename($item);

                    $data = [
                        'banner_id' => $banner_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    BannerImages::create($data);
                }
            }
//            Upload images for current menu
        }
        else {
            $exist_banner_top = Banner::where('banner_id', $id)->first();

            if(is_null($exist_banner_top)){
                return App::abort(503, 'Unauthorized action.');
            }

            $exist_banner_top_by_lang = Banner::where('banner_id', $exist_banner_top->banner_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'link' => !is_null(Input::get('link')) ? Input::get('link') : '',
            ];

            BannerId::where('id', $exist_banner_top->banner_id)
                ->update($data);

            $data = [
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
            ];

            if(!is_null($exist_banner_top_by_lang)){
                Banner::where('banner_id', $exist_banner_top->banner_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'banner_id' => $exist_banner_top->banner_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                Banner::create($data);
            }

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty($array_img)) {

                $exist_banners_images = BannerImages::where('banner_id', $exist_banner_top->banner_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if(count($array_img) >= count($exist_banners_images)) {
                    foreach ($exist_banners_images as $exist_menu_image) {
                        $pos = array_search($exist_menu_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if(!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('banners_images');
                            $img = basename($item);

                            $data = [
                                'banner_id' => $exist_banner_top->banner_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            BannerImages::create($data);
                        }
                    }
                }
                else {
                    foreach (array_reverse(Input::get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('banners_images');
                        $img = basename($item);

                        $data = [
                            'banner_id' => $exist_banner_top->banner_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        BannerImages::create($data);
                    }
                }
            }
//            Upload images for current menu

        }

        if(is_null($id)){
            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.save', $this->lang)],
                'redirect' => urlForFunctionLanguage($this->lang, '')
            ]);
        }
        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.updated_text', $this->lang)],
            'redirect' => urlForLanguage($this->lang, 'edititem/'.$id.'/'.$updated_lang_id)
        ]);

    }

    public function destroyBannerToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $banner_item_elems_id = BannerId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$banner_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($banner_item_elems_id as $one_banner_item_elems_id) {

                    $banner_item_elems = Banner::where('banner_id', $one_banner_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($banner_item_elems)){
                        $banner_item_elems = Banner::where('banner_id', $one_banner_item_elems_id->id)
                            ->first();
                    }


                    if ($one_banner_item_elems_id->deleted == 0) {

                        $cart_message .= $banner_item_elems->name . ', ';

                        BannerId::where('id', $one_banner_item_elems_id->id)
                            ->update(['active' => 0, 'deleted' => 1]);
                    }
                }

                if (!empty($cart_message)) {
                    $cart_message = substr($cart_message, 0, -2) . '<br />' . controllerTrans('variables.success_added_cart', $this->lang);
                }

                return response()->json([
                    'status' => true,
                    'cart_messages' => $cart_message,
                    'deleted_elements' => $deleted_elements_id_arr
                ]);
            }

            return response()->json([
                'status' => false
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }

    }

    public function destroyBannerFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $banner_item_elems_id = BannerId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$banner_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($banner_item_elems_id as $one_banner_item_elems_id) {

                    $banner_item_elems = Banner::where('banner_id', $one_banner_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($banner_item_elems)){
                        $banner_item_elems = Banner::where('banner_id', $one_banner_item_elems_id->id)
                            ->first();
                    }

                    if ($one_banner_item_elems_id->deleted == 1 && $one_banner_item_elems_id->active == 0) {

                        $banners_images = $one_banner_item_elems_id->moduleMultipleImg;

                        if(!is_null($banners_images) && !$banners_images->isEmpty()) {
                            foreach ($banners_images as $banner_image) {
                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$banner_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$banner_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$banner_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$banner_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$banner_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$banner_image->img);
                            }
                        }

                        $del_message .= $banner_item_elems->name . ', ';

                        BannerId::destroy($one_banner_item_elems_id->id);
                        Banner::where('banner_id', $one_banner_item_elems_id->id)->delete();

                    }

                }

                if (!empty($del_message)) {
                    $del_message = substr($del_message, 0, -2) . '<br />' . controllerTrans('variables.success_deleted', $this->lang);
                }

                return response()->json([
                    'status' => true,
                    'del_messages' => $del_message,
                    'deleted_elements' => $deleted_elements_id_arr
                ]);
            }

            return response()->json([
                'status' => false
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }

    }

    public function restoreBanner()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $banner_item_elems_id = BannerId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$banner_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($banner_item_elems_id as $one_banner_item_elems_id) {

                    $banner_name = GetNameByLang($one_banner_item_elems_id->id, $this->lang_id, 'Banner', 'banner_id');

                    if ($one_banner_item_elems_id->restored == 0) {

                        $cart_message .= $banner_name . ', ';

                        BannerId::where('id', $one_banner_item_elems_id->id)
                            ->update(['active' => 1, 'deleted' => 0]);
                    }
                }

                if (!empty($cart_message)) {
                    $cart_message = substr($cart_message, 0, -2) . '<br />' . controllerTrans('variables.success_restored', $this->lang);
                }

                return response()->json([
                    'status' => true,
                    'cart_messages' => $cart_message,
                    'restored_elements' => $restored_elements_id_arr
                ]);
            }

            return response()->json([
                'status' => false
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    /**
     * return to another url, if method membersList does not exist
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function membersList()
    {
        return redirect(urlForFunctionLanguage($this->lang, ''));
    }

}


