<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technologies;
use App\Models\TechnologiesId;
use App\Models\TechnologiesImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TechnologiesController extends Controller
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
        $view = 'admin.technologies.elements-list';

        $lang_id = $this->lang_id;

        $technologies_id_elements = TechnologiesId::where('deleted', 0)
            ->orderBy('position', 'asc')
            ->get();

        $technologies_elements = [];
        foreach($technologies_id_elements as $key => $technologies_id_element){
            $technologies_elements[$key] = Technologies::where('technologies_id', $technologies_id_element->id)
                ->first();
        }

        $technologies_elements = array_filter($technologies_elements);

        return view($view, get_defined_vars());
    }

    // ajax response for position
    public function changePosition(Request $request)
    {
        $neworder = $request->get('neworder');

        $i = 0;
        $neworder = explode("&", $neworder);
        foreach ($neworder as $k=>$v) {
            $id = str_replace("tablelistsorter[]=","", $v);
            $i++;

            if(!empty($id)){
                TechnologiesId::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for img position
    public function changeImgPosition(Request $request)
    {
        $newOrder = $request->get('newOrder');

        $i = 0;
        foreach ($newOrder as $k=>$v) {
            $id = $v;
            $i++;

            if(!empty($id)){
                TechnologiesImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive(Request $request)
    {
        $active = $request->get('active');
        $id = $request->get('id');

        $element_id = TechnologiesId::findOrFail($id);

        if(!is_null($element_id))
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Technologies', 'technologies_id');
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

        TechnologiesId::where('id', $id)->update(['active' => $change_active]);

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);

    }

    public function createTechnologies()
    {
        $view = 'admin.technologies.create-technologies';

        return view($view, get_defined_vars());
    }

    public function editTechnologies($id, $edited_lang_id)
    {
        $view = 'admin.technologies.edit-technologies';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $technologies_without_lang = Technologies::where('technologies_id', $id)->first();

        if(is_null($technologies_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $technologies_elems = Technologies::where('lang_id', $edited_lang_id)
            ->where('technologies_id', $technologies_without_lang->technologies_id)
            ->first();

        if(!is_null($technologies_without_lang)){
            $technologies_id = TechnologiesId::where('id', $technologies_without_lang->technologies_id)
                ->first();
        }
        elseif(!is_null($technologies_elems)){
            $technologies_id = TechnologiesId::where('id', $technologies_elems->technologies_id)
                ->first();
        }

        return view($view, get_defined_vars());
    }

    public function saveTechnologies(Request $request, $id, $updated_lang_id)
    {
        if(is_null($id)){
            $item = Validator::make($request->all(), [
                'name' => 'required',
                'alias' => 'required|unique:technologies_id'
            ]);
        }
        else {
            $item = Validator::make($request->all(), [
                'name' => 'required',
                'alias' => 'required'
            ]);
        }

        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }


        $maxPosition = GetMaxPosition('technologies_id');

        $array_img = [];
        if(!is_null($request->get('file')) && !empty($request->get('file'))) {
            foreach ($request->get('file') as $item) {
                if(!is_null($item))
                    $array_img[] = basename($item);
            }
        }

//        Check if lang exist
        if(checkIfLangExist($request->get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if(is_null($id)){
            $data = [
                'alias' => $request->get('alias'),
                'position' => $maxPosition + 1,
                'active' => 1,
                'deleted' => 0
            ];

            $technologies_id = TechnologiesId::create($data);

            $data = [
                'technologies_id' => $technologies_id->id,
                'lang_id' => $request->get('lang'),
                'name' => $request->get('name'),
                'descr' => !is_null($request->get('descr')) ? $request->get('descr') : '',
                'body' => !is_null($request->get('body')) ? $request->get('body') : '',
                'page_title' => !is_null($request->get('title')) ? $request->get('title') : '',
                'h1_title' => !is_null($request->get('h1_title')) ? $request->get('h1_title') : '',
                'meta_title' => !is_null($request->get('meta_title')) ? $request->get('meta_title') : '',
                'meta_keywords' => !is_null($request->get('meta_keywords')) ? $request->get('meta_keywords') : '',
                'meta_description' => !is_null($request->get('meta_description')) ? $request->get('meta_description') : '',
            ];

            Technologies::create($data);

//            Upload images for current technologies
            if(!is_null($request->get('file')) && !empty($request->get('file'))  && !empty($array_img)) {
                foreach (array_reverse($request->get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('technologies_images');
                    $img = basename($item);

                    $data = [
                        'technologies_id' => $technologies_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    TechnologiesImages::create($data);
                }
            }
//            Upload images for current technologies

        }
        else {

            $exist_technologies = Technologies::where('technologies_id', $id)->first();

            if(is_null($exist_technologies)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($exist_technologies->technologies_id, $request->get('alias'), 'technologies_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist


            $exist_technologies_by_lang = Technologies::where('technologies_id', $exist_technologies->technologies_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'alias' => $request->get('alias')
            ];

            $technologies_id = TechnologiesId::where('id', $exist_technologies->technologies_id)
                ->update($data);

            $data = [
                'name' => $request->get('name'),
                'descr' => !is_null($request->get('descr')) ? $request->get('descr') : '',
                'body' => !is_null($request->get('body')) ? $request->get('body') : '',
                'page_title' => !is_null($request->get('title')) ? $request->get('title') : '',
                'h1_title' => !is_null($request->get('h1_title')) ? $request->get('h1_title') : '',
                'meta_title' => !is_null($request->get('meta_title')) ? $request->get('meta_title') : '',
                'meta_keywords' => !is_null($request->get('meta_keywords')) ? $request->get('meta_keywords') : '',
                'meta_description' => !is_null($request->get('meta_description')) ? $request->get('meta_description') : '',
            ];

            if(!is_null($exist_technologies_by_lang)){
                Technologies::where('technologies_id', $exist_technologies->technologies_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'technologies_id' => $exist_technologies->technologies_id,
                    'lang_id' => $request->get('lang'),
                ];

                $data = array_merge($data, $create_data);

                Technologies::create($data);
            }

//            Upload images for current technologies
            if(!is_null($request->get('file')) && !empty($array_img)) {

                $exist_technologies_images = TechnologiesImages::where('technologies_id', $exist_technologies->technologies_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if(count($array_img) >= count($exist_technologies_images)) {
                    foreach ($exist_technologies_images as $exist_technologies_image) {
                        $pos = array_search($exist_technologies_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if(!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('technologies_images');
                            $img = basename($item);

                            $data = [
                                'technologies_id' => $exist_technologies->technologies_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            TechnologiesImages::create($data);
                        }
                    }
                }
                else {
                    foreach (array_reverse($request->get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('technologies_images');
                        $img = basename($item);

                        $data = [
                            'technologies_id' => $exist_technologies->technologies_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        TechnologiesImages::create($data);
                    }
                }
            }
//            Upload images for current technologies
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
            'redirect' => urlForLanguage($this->lang, 'edittechnologies/'.$id.'/'.$updated_lang_id)
        ]);
    }

    public function technologiesCart(Request $request)
    {
        $view = 'admin.technologies.technologies-cart';

        $lang_id = $this->lang_id;

        $deleted_elems_by_alias = TechnologiesId::where('alias', $request->segment(4))
            ->first();

        $deleted_technologies_id_elems = TechnologiesId::where('deleted', 1)
            ->where('active', 0)
            ->get();

        $deleted_technologies_elems = [];

        foreach($deleted_technologies_id_elems as $key => $one_deleted_technologies_elem){
            $deleted_technologies_elems[$key] = Technologies::where('technologies_id', $one_deleted_technologies_elem->id)
                ->first();
        }

        $deleted_technologies_elems = array_filter( $deleted_technologies_elems, 'strlen' );

        return view($view, get_defined_vars());
    }

    public function destroyTechnologiesFromCart(Request $request)
    {

        $deleted_elements_id = substr($request->get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $technologies_item_elems_id = TechnologiesId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$technologies_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($technologies_item_elems_id as $one_technologies_item_elems_id) {

                    $technologies_item_elems = Technologies::where('technologies_id', $one_technologies_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($technologies_item_elems)){
                        $technologies_item_elems = Technologies::where('technologies_id', $one_technologies_item_elems_id->id)
                            ->first();
                    }

                    if ($one_technologies_item_elems_id->deleted == 1 && $one_technologies_item_elems_id->active == 0) {

                        $technologies_images = $one_technologies_item_elems_id->moduleMultipleImg;

                        if(!is_null($technologies_images) && !$technologies_images->isEmpty()) {
                            foreach ($technologies_images as $technologies_image) {
                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$technologies_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$technologies_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$technologies_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$technologies_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$technologies_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$technologies_image->img);
                            }
                        }

                        $del_message .= $technologies_item_elems->name . ', ';

                        TechnologiesId::destroy($one_technologies_item_elems_id->id);
                        Technologies::where('technologies_id', $one_technologies_item_elems_id->id)->delete();

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

    public function destroyTechnologiesToCart(Request $request)
    {

        $deleted_elements_id = substr($request->get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $technologies_item_elems_id = TechnologiesId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$technologies_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($technologies_item_elems_id as $one_technologies_item_elems_id) {

                    $technologies_item_elems = Technologies::where('technologies_id', $one_technologies_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($technologies_item_elems)){
                        $technologies_item_elems = Technologies::where('technologies_id', $one_technologies_item_elems_id->id)
                            ->first();
                    }


                    if ($one_technologies_item_elems_id->deleted == 0) {

                        $cart_message .= $technologies_item_elems->name . ', ';

                        TechnologiesId::where('id', $one_technologies_item_elems_id->id)
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

    public function restoreTechnologies(Request $request)
    {

        $restored_elements_id = substr($request->get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $promotion_item_elems_id = TechnologiesId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$promotion_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($promotion_item_elems_id as $one_promotion_item_elems_id) {

                    $promotion_name = GetNameByLang($one_promotion_item_elems_id->id, $this->lang_id, 'Technologies', 'technologies_id');

                    if ($one_promotion_item_elems_id->restored == 0) {

                        $cart_message .= $promotion_name . ', ';

                        TechnologiesId::where('id', $one_promotion_item_elems_id->id)
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
