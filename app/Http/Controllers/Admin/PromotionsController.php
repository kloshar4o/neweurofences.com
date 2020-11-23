<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Promotions;
use App\Models\PromotionsId;
use App\Models\PromotionsImages;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;



class PromotionsController extends Controller
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

        $view = 'admin.promotions.promotions-list';

        $promotion_id = PromotionsId::where('deleted', 0)
            ->orderBy('position', 'asc')
            ->paginate(20);

        $promotion_list = [];
        foreach($promotion_id as $key => $one_promotion_id){
            $promotion_list[$key] = Promotions::where('promotions_id' ,$one_promotion_id->id)
                ->first();
        }
        //Remove all null values --start
        $promotion_list = array_filter( $promotion_list, 'strlen' );
        //Remove all null values --end

        return view($view, get_defined_vars());
    }

    public function cartPromotion()
    {
        $view = 'admin.promotions.promotion-cart';

        $lang_id = $this->lang_id;

        $deleted_promotion_id = PromotionsId::where('deleted', 1)
            ->where('active', 0)
            ->get();

        $deleted_promotion_list = [];

        foreach($deleted_promotion_id as $key => $one_deleted_promotion_id){
            $deleted_promotion_list[$key] = Promotions::where('promotions_id', $one_deleted_promotion_id->id)
                ->first();
        }

        $deleted_promotion_list = array_filter( $deleted_promotion_list, 'strlen' );

        return view($view, get_defined_vars());
    }

    // ajax response for position
    public function changePosition()
    {
        $neworder = Input::get('neworder');

        $i = 0;
        $neworder = explode("&", $neworder);
        foreach ($neworder as $k=>$v) {
            $id = str_replace("tablelistsorter[]=","", $v);
            $i++;

            if(!empty($id)){
                PromotionsId::where('id', $id)->update(['position' => $i]);
            }
        }
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
                PromotionsImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = PromotionsId::findOrFail($id);

        if(!is_null($element_id))
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Promotions', 'promotions_id');
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

        PromotionsId::where('id', $id)->update(['active' => $change_active]);

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);
    }

    public function createPromotion()
    {
        $view = 'admin.promotions.create-promotion';

        return view($view, get_defined_vars());
    }

    public function editPromotion($id, $edited_lang_id)
    {
        $view = 'admin.promotions.edit-promotion';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $lang_id = $this->lang_id;

        $promotion_without_lang = Promotions::where('promotions_id', $id)
            ->first();

        if(is_null($promotion_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $promotion = Promotions::where('promotions_id', $promotion_without_lang->promotions_id)
            ->where('lang_id', $edited_lang_id)
            ->first();

        if(!is_null($promotion_without_lang)){
            $promotion_id = PromotionsId::where('id', $promotion_without_lang->promotions_id)
                ->first();
        }
        elseif(!is_null($promotion)){
            $promotion_id = PromotionsId::where('id', $promotion->promotions_id)
                ->first();
        }

        return view($view, get_defined_vars());
    }

    public function save($id, $updated_lang_id)
    {

        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:promotions_id',

            ]);
        }
        else {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required',
            ]);
        }

        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $active = Input::get('active') == 'on' ? 1 : 0;
        $maxPosition = GetMaxPosition('promotions_id');

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
                'alias' => Input::get('alias'),
                'position' => $maxPosition + 1,
                'active' => $active,
                'deleted' => 0,
            ];

            $promotion_id = PromotionsId::create($data);

            $data = array_filter([
                'promotions_id' => $promotion_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
            ]);

            Promotions::create($data);

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img)) {
                foreach (array_reverse(Input::get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('promotions_images');
                    $img = basename($item);

                    $data = [
                        'promotions_id' => $promotion_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    PromotionsImages::create($data);
                }
            }
//            Upload images for current menu
        }
        else {
            $exist_promotion = Promotions::where('promotions_id', $id)->first();

            if(is_null($exist_promotion)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($exist_promotion->promotions_id, Input::get('alias'), 'promotions_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_promotion_by_lang = Promotions::where('promotions_id', $exist_promotion->promotions_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'alias' => Input::get('alias'),
                'active' => $active,
            ];

            PromotionsId::where('id', $exist_promotion->promotions_id)
                ->update($data);

            $data = array_filter([
                'name' => Input::get('name'),
            ]);

            if(!is_null($exist_promotion_by_lang)){
                Promotions::where('promotions_id', $exist_promotion->promotions_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'promotions_id' => $exist_promotion->promotions_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                Promotions::create($data);
            }

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty($array_img)) {

                $exist_promotions_images = PromotionsImages::where('promotions_id', $exist_promotion->promotions_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if(count($array_img) >= count($exist_promotions_images)) {
                    foreach ($exist_promotions_images as $exist_promotions_image) {
                        $pos = array_search($exist_promotions_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if(!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('promotions_images');
                            $img = basename($item);

                            $data = [
                                'promotions_id' => $exist_promotion->promotions_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            PromotionsImages::create($data);
                        }
                    }
                }
                else {
                    foreach (array_reverse(Input::get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('promotions_images');
                        $img = basename($item);

                        $data = [
                            'promotions_id' => $exist_promotion->promotions_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        PromotionsImages::create($data);
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
            'redirect' => urlForLanguage($this->lang, 'editpromotion/'.$id.'/'.$updated_lang_id)
        ]);

    }

    public function destroyPromotionFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $promotion_item_elems_id = PromotionsId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$promotion_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($promotion_item_elems_id as $one_promotion_item_elems_id) {

                    $promotion_item_elems = Promotions::where('promotions_id', $one_promotion_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($promotion_item_elems)){
                        $promotion_item_elems = Promotions::where('promotions_id', $one_promotion_item_elems_id->id)
                            ->first();
                    }

                    if ($one_promotion_item_elems_id->deleted == 1 && $one_promotion_item_elems_id->active == 0) {

                        $promotions_images = $one_promotion_item_elems_id->moduleMultipleImg;

                        if(!is_null($promotions_images) && !$promotions_images->isEmpty()) {
                            foreach ($promotions_images as $promotions_image) {
                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$promotions_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$promotions_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$promotions_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$promotions_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$promotions_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$promotions_image->img);
                            }
                        }

                        $del_message .= $promotion_item_elems->name . ', ';

                        PromotionsId::destroy($one_promotion_item_elems_id->id);
                        Promotions::where('promotions_id', $one_promotion_item_elems_id->id)->delete();

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

    public function destroyPromotionToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $promotion_item_elems_id = PromotionsId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$promotion_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($promotion_item_elems_id as $one_promotion_item_elems_id) {

                    $promotion_item_elems = Promotions::where('promotions_id', $one_promotion_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($promotion_item_elems)){
                        $promotion_item_elems = Promotions::where('promotions_id', $one_promotion_item_elems_id->id)
                            ->first();
                    }


                    if ($one_promotion_item_elems_id->deleted == 0) {

                        $cart_message .= $promotion_item_elems->name . ', ';

                        PromotionsId::where('id', $one_promotion_item_elems_id->id)
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

    public function restorePromotion()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $promotion_item_elems_id = PromotionsId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$promotion_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($promotion_item_elems_id as $one_promotion_item_elems_id) {

                    $promotion_name = GetNameByLang($one_promotion_item_elems_id->id, $this->lang_id, 'Promotions', 'promotions_id');

                    if ($one_promotion_item_elems_id->restored == 0) {

                        $cart_message .= $promotion_name . ', ';

                        PromotionsId::where('id', $one_promotion_item_elems_id->id)
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


