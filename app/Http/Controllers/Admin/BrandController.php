<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Brand;
use App\Models\BrandImages;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;



class BrandController extends Controller
{

    private $lang;

    public function __construct()
    {
        $this->lang = $this->lang()['lang'];
    }

    public function index()
    {

        $view = 'admin.brand.brand-list';

        $brand_list = Brand::where('deleted', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view($view, get_defined_vars());
    }

    public function cartItems()
    {
        $view = 'admin.brand.brand-cart';

        $deleted_brand_list = Brand::where('deleted', 1)
            ->where('active', 0)
            ->get();

        return view($view, get_defined_vars());
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = Brand::findOrFail($id);

        if(!is_null($element_id))
            $element_name = Brand::where('id', $id)->first()->name;
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

        Brand::where('id', $id)->update(['active' => $change_active]);

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
                BrandImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    public function createItem()
    {
        $view = 'admin.brand.create-brand';


        return view($view, get_defined_vars());
    }

    public function editItem($id)
    {
        $view = 'admin.brand.edit-brand';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $brand = Brand::where('id', $id)
            ->first();

        if(is_null($brand)){
            return App::abort(503, 'Unauthorized action.');
        }

        return view($view, get_defined_vars());
    }

    public function save($id)
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

        if(is_null($id)){
            $data = [
                'active' => 1,
                'deleted' => 0,
                'name' => Input::get('name'),
                'link' => !is_null(Input::get('link')) ? Input::get('link') : '',

            ];

            $brand = Brand::create($data);

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img)) {
                foreach (array_reverse(Input::get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('brand_images');
                    $img = basename($item);

                    $data = [
                        'brand_id' => $brand->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    BrandImages::create($data);
                }
            }
//            Upload images for current menu

        }
        else {
            $exist_brand = Brand::where('id', $id)->first();

            if(is_null($exist_brand)){
                return App::abort(503, 'Unauthorized action.');
            }

            $data = [
                'name' => Input::get('name'),
                'link' => !is_null(Input::get('link')) ? Input::get('link') : '',
            ];

            Brand::where('id', $exist_brand->id)
                ->update($data);

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty($array_img)) {

                $exist_brand_images = BrandImages::where('brand_id', $exist_brand->id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if(count($array_img) >= count($exist_brand_images)) {
                    foreach ($exist_brand_images as $exist_brand_image) {
                        $pos = array_search($exist_brand_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if(!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('brand_images');
                            $img = basename($item);

                            $data = [
                                'brand_id' => $exist_brand->id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            BrandImages::create($data);
                        }
                    }
                }
                else {
                    foreach (array_reverse(Input::get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('brand_images');
                        $img = basename($item);

                        $data = [
                            'brand_id' => $exist_brand->id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        BrandImages::create($data);
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
            'redirect' => urlForLanguage($this->lang, 'edititem/'.$id)
        ]);

    }

    public function destroyBrandToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $brand_item_elems_id = Brand::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$brand_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($brand_item_elems_id as $one_brand_item_elems_id) {

                    if ($one_brand_item_elems_id->deleted == 0) {

                        $cart_message .= $one_brand_item_elems_id->name . ', ';

                        Brand::where('id', $one_brand_item_elems_id->id)
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

    public function destroyBrandFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $brand_item_elems_id = Brand::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$brand_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($brand_item_elems_id as $one_brand_item_elems_id) {

                    if ($one_brand_item_elems_id->deleted == 1 && $one_brand_item_elems_id->active == 0) {

                        $brand_images = $one_brand_item_elems_id->moduleMultipleImg;

                        if(!is_null($brand_images) && !$brand_images->isEmpty()) {
                            foreach ($brand_images as $brand_image) {
                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$brand_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$brand_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$brand_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$brand_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$brand_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$brand_image->img);
                            }
                        }

                        $del_message .= $one_brand_item_elems_id->name . ', ';

                        Brand::destroy($one_brand_item_elems_id->id);

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

    public function restoreBrand()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $brand_item_elems_id = Brand::whereIn('id', $restored_elements_id_arr)->get();

            if (!$brand_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($brand_item_elems_id as $one_brand_item_elems_id) {

                    $brand_name = $one_brand_item_elems_id->name;

                    if ($one_brand_item_elems_id->restored == 0) {

                        $cart_message .= $brand_name . ', ';

                        Brand::where('id', $one_brand_item_elems_id->id)
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


