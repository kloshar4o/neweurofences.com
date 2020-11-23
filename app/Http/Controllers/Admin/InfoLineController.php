<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\InfoItem;
use App\Models\InfoLineImages;
use App\Models\InfoLine;
use App\Models\InfoLineId;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\InfoItemId;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class InfoLineController extends Controller
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
        $view = 'admin.infoline.infoline-list';

        $lang_id = $this->lang_id;

        $info_line_id = InfoLineId::where('deleted', 0)
            ->orderBy('position', 'asc')
            ->paginate(20);

        $info_line = [];
        foreach($info_line_id as $key => $one_info_line_id){
            $info_line[$key] = InfoLine::where('info_line_id', $one_info_line_id->id)
                ->first();
        }

        //Remove all null values --start
        $info_line = array_filter( $info_line, 'strlen' );
        //Remove all null values --end

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
                InfoLineId::where('id', $id)->update(['position' => $i]);
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
                InfoLineImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');
        $action = Input::get('action');

        if($action != '')
            $element_id = InfoItemId::findOrFail($id);
        else
            $element_id = InfoLineId::findOrFail($id);

        if(!is_null($element_id)) {
            if($action != '')
                $element_name = GetNameByLang($element_id->id, $this->lang_id, 'InfoItem', 'info_item_id');
            else
                $element_name = GetNameByLang($element_id->id, $this->lang_id, 'InfoLine', 'info_line_id');
        }
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

        if($action != ''){
            InfoItemId::where('id', $id)->update(['active' => $change_active]);
        }
        else{
            InfoLineId::where('id', $id)->update(['active' => $change_active]);
        }

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);
    }

    public function createInfoLine()
    {
        $view = 'admin.infoline.create-infoline';

        return view($view, get_defined_vars());
    }

    public function editInfoLine($id, $edited_lang_id)
    {
        $view = 'admin.infoline.edit-infoline';

        $info_line_without_lang = InfoLine::where('info_line_id', $id)->first();

        if(is_null($info_line_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $info_line = InfoLine::where('lang_id', $edited_lang_id)
            ->where('info_line_id', $info_line_without_lang->info_line_id)
            ->first();

        if(!is_null($info_line_without_lang)){
            $info_line_id = InfoLineId::where('id', $info_line_without_lang->info_line_id)
                ->first();
        }
        elseif(!is_null($info_line)){
            $info_line_id = InfoLineId::where('id', $info_line->info_line_id)
                ->first();
        }

        return view($view, get_defined_vars());
    }

    public function infoLineCart()
    {
        $view = 'admin.infoline.infoline-cart';

        $lang_id = $this->lang_id;

        $deleted_info_line_id = InfoLineId::where('deleted', 1)
            ->where('active', 0)
            ->get();

        $deleted_info_line = [];

        foreach($deleted_info_line_id as $key => $one_deleted_info_line_id){
            $deleted_info_line[$key] = InfoLine::where('info_line_id', $one_deleted_info_line_id->id)
                ->first();
        }

        $deleted_info_line = array_filter( $deleted_info_line, 'strlen' );

        return view($view, get_defined_vars());
    }

    public function saveInfoLine($id, $updated_lang_id)
    {
        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:info_line_id',
            ]);
        }
        else {
            $item = Validator::make(Input::all(), [
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

        $maxPosition = GetMaxPosition('info_line_id');

//        Check if lang exist
        if(checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if(is_null($id)){
            $data = [
                'position' => $maxPosition + 1,
                'active' => 1,
                'deleted' => 0,
                'alias' => Input::get('alias'),
            ];

            $info_line_id = InfoLineId::create($data);

            $data = array_filter([
                'info_line_id' => $info_line_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'descr' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ]);

            InfoLine::create($data);
        }
        else {
            $exist_info_line = InfoLine::where('info_line_id', $id)->first();

            if(is_null($exist_info_line)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($exist_info_line->info_line_id, Input::get('alias'), 'info_line_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_info_line_by_lang = InfoLine::where('info_line_id', $exist_info_line->info_line_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = array_filter([
                'alias' => Input::get('alias')
            ]);

            InfoLineId::where('id', $exist_info_line->info_line_id)
                ->update($data);

            $data = array_filter([
                'name' => Input::get('name'),
                'descr' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ]);

            if(!is_null($exist_info_line_by_lang)){
                InfoLine::where('info_line_id', $exist_info_line->info_line_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'info_line_id' => $exist_info_line->info_line_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                InfoLine::create($data);
            }
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
            'redirect' => urlForLanguage($this->lang, 'editinfoline/'.$id.'/'.$updated_lang_id)
        ]);

    }

    public function destroyInfoLineFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $info_line_elems_id = InfoLineId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$info_line_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($info_line_elems_id as $one_info_line_elems_id) {

                    $info_line_elems = InfoLine::where('info_line_id', $one_info_line_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($info_line_elems)){
                        $info_line_elems = InfoLine::where('info_line_id', $one_info_line_elems_id->id)
                            ->first();
                    }

                    if ($one_info_line_elems_id->deleted == 1 && $one_info_line_elems_id->active == 0) {

                        $del_message .= $info_line_elems->name . ', ';

                        InfoLineId::destroy($one_info_line_elems_id->id);
                        InfoLine::where('info_line_id', $one_info_line_elems_id->id)->delete();

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

    public function destroyInfoLineToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $info_line_elems_id = InfoLineId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$info_line_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($info_line_elems_id as $one_info_line_elems_id) {

                    $info_line_elems = InfoLine::where('info_line_id', $one_info_line_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($info_line_elems)){
                        $info_line_elems = InfoLine::where('info_line_id', $one_info_line_elems_id->id)
                            ->first();
                    }


                    if ($one_info_line_elems_id->deleted == 0) {

                        $cart_message .= $info_line_elems->name . ', ';

                        InfoLineId::where('id', $one_info_line_elems_id->id)
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

    public function restoreInfoLine()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $info_item_elems_id = InfoLineId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$info_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($info_item_elems_id as $one_info_item_elems_id) {

                    $info_name = GetNameByLang($one_info_item_elems_id->id, $this->lang_id, 'InfoLine', 'info_line_id');

                    if ($one_info_item_elems_id->restored == 0) {

                        $cart_message .= $info_name . ', ';

                        InfoLineId::where('id', $one_info_item_elems_id->id)
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

    public function membersList()
    {
        $view = 'admin.infoline.infoitems-list';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;


        $lang_id = $this->lang_id;

        $info_line_id = InfoLineId::where('alias', Request::segment(4))
            ->first();

        if(is_null($info_line_id)){
            return App::abort(503, 'Unauthorized action.');
        }

        $info_items_list = InfoItemId::where('deleted', 0)
            ->where('info_line_id', $info_line_id->id)
            ->orderBy('created_at', 'desc')
            ->paginate(40);

        $info_item = [];
        foreach($info_items_list as $key => $one_info_tem){
            $info_item[$key] = InfoItem::where('info_item_id', $one_info_tem->id)
                ->first();
        }

        //Remove all null values --start
        $info_item = array_filter( $info_item, 'strlen' );
        //Remove all null values --end

        return view($view, get_defined_vars());
    }

    public function createInfoItem()
    {
        $view = 'admin.infoline.create-infoitem';

        $category_list = showSettingBodyByAlias('articles-categories', $this->lang_id);

        if(!empty($category_list))
            $category_list = explode(';', $category_list);
        else
            $category_list = '';

        return view($view, get_defined_vars());
    }

    public function editInfoItem($id, $edited_lang_id)
    {
        $view = 'admin.infoline.edit-infoitem';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $info_item_without_lang = InfoItem::where('info_item_id', $id)->first();

        if(is_null($info_item_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $info_item = InfoItem::where('lang_id', $edited_lang_id)
            ->where('info_item_id', $info_item_without_lang->info_item_id)
            ->first();

        if(!is_null($info_item_without_lang)){
            $info_item_id = InfoItemId::where('id', $info_item_without_lang->info_item_id)
                ->first();
            $info_line_id = InfoLineId::where('id', $info_item_id->info_line_id)->first();
        }
        elseif(!is_null($info_item)){
            $info_item_id = InfoItemId::where('id', $info_item->info_item_id)
                ->first();
            $info_line_id = InfoLineId::where('id', $info_item_id->info_line_id)->first();
        }

        $category_list = showSettingBodyByAlias('articles-categories', $this->lang_id);

        if(!empty($category_list))
            $category_list = explode(';', $category_list);
        else
            $category_list = '';

        return view($view, get_defined_vars());
    }

    public function infoItemsCart()
    {
        $view = 'admin.infoline.infoitems-cart';

        $lang_id = $this->lang_id;

        $deleted_info_item_id = InfoItemId::where('deleted', 1)
            ->where('active', 0)
            ->get();

        $deleted_info_item = [];

        foreach($deleted_info_item_id as $key => $one_deleted_info_item_id){
            $deleted_info_item[$key] = InfoItem::where('info_item_id', $one_deleted_info_item_id->id)
                ->first();
        }

        $deleted_info_item = array_filter( $deleted_info_item, 'strlen' );

        return view($view, get_defined_vars());
    }

    public function saveInfoItem($id, $updated_lang_id)
    {
        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:info_item_id'
            ]);
        }
        else {
            $item = Validator::make(Input::all(), [
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

        $info_line_id = InfoLineId::where('alias', Request::segment(4))
            ->first()->id;

        if(is_null($info_line_id))
            return App::abort(503, 'Unauthorized action.');


        $array_img = [];
        if(!is_null(Input::get('file')) && !empty(Input::get('file'))) {
            foreach (Input::get('file') as $item) {
                if(!is_null($item))
                    $array_img[] = basename($item);
            }
        }

        if(!empty(Input::get('add_date'))){
            $add_date = date('Y-m-d', strtotime(Input::get('add_date')));
        }
        else{
            $add_date = '';
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
                'info_line_id' => $info_line_id,
                'alias' => Input::get('alias'),
                'is_public' => Input::get('is_public') == 'on' ? 1 : 0,
                'active' => 1,
                'deleted' => 0,
                'add_date' => $add_date,
                'show_img' => Input::get('show_img') == 'on' ? 1 : 0,
//                'category' => !is_null(Input::get('category')) ? Input::get('category') : 0

            ];

            $info_item_id = InfoItemId::create($data);

            $data = array_filter([
                'info_item_id' => $info_item_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'author' => !is_null(Input::get('author')) ? Input::get('author') : '',
                'descr' => !is_null(Input::get('descr')) ? Input::get('descr') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ]);

            InfoItem::create($data);

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img)) {
                foreach (array_reverse(Input::get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('info_line_images');
                    $img = basename($item);

                    $data = [
                        'info_item_id' => $info_item_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];


                    InfoLineImages::create($data);
                }
            }
//            Upload images for current menu
        }
        else {
            $exist_info_item = InfoItem::where('info_item_id', $id)->first();

            if(is_null($exist_info_item)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($exist_info_item->info_item_id, Input::get('alias'), 'info_item_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_info_item_by_lang = InfoItem::where('info_item_id', $exist_info_item->info_item_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'alias' => Input::get('alias'),
                'is_public' => Input::get('is_public') == 'on' ? 1 : 0,
                'add_date' => $add_date,
                'show_img' => Input::get('show_img') == 'on' ? 1 : 0,
//                'category' => !is_null(Input::get('category')) ? Input::get('category') : 0
            ];

            InfoItemId::where('id', $exist_info_item->info_item_id)
                ->update($data);

            $data = array_filter([
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'author' => !is_null(Input::get('author')) ? Input::get('author') : '',
                'descr' => !is_null(Input::get('descr')) ? Input::get('descr') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ]);

            if(!is_null($exist_info_item_by_lang)){
                InfoItem::where('info_item_id', $exist_info_item->info_item_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'info_item_id' => $exist_info_item->info_item_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                InfoItem::create($data);
            }

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty($array_img)) {

                $exist_menu_images = InfoLineImages::where('info_item_id', $exist_info_item->info_item_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if(count($array_img) >= count($exist_menu_images)) {
                    foreach ($exist_menu_images as $exist_menu_image) {
                        $pos = array_search($exist_menu_image, $array_img);

                        unset($array_img[$pos]);
                    }

                    if(!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('info_line_images');
                            $img = basename($item);

                            $data = [
                                'info_item_id' => $exist_info_item->info_item_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            InfoLineImages::create($data);
                        }
                    }
                }
                else {
                    foreach (array_reverse(Input::get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('info_line_images');
                        $img = basename($item);

                        $data = [
                            'info_item_id' => $exist_info_item->info_item_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        InfoLineImages::create($data);
                    }
                }
            }
//            Upload images for current menu
        }

        if(is_null($id)){
            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.save', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'memberslist')
            ]);
        }
        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.updated_text', $this->lang)],
            'redirect' => urlForLanguage($this->lang, 'editinfoitem/'.$id.'/'.$updated_lang_id)
        ]);
    }

    public function destroyInfoItemFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $info_item_elems_id = InfoItemId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$info_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($info_item_elems_id as $one_info_item_elems_id) {

                    $info_item_elems = InfoItem::where('info_item_id', $one_info_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($info_item_elems)){
                        $info_item_elems = InfoItem::where('info_item_id', $one_info_item_elems_id->id)
                            ->first();
                    }

                    if ($one_info_item_elems_id->deleted == 1 && $one_info_item_elems_id->active == 0) {

                        $info_item_images = $one_info_item_elems_id->moduleMultipleImg;

                        if(!is_null($info_item_images) && !$info_item_images->isEmpty()) {
                            foreach ($info_item_images as $info_item_image) {
                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$info_item_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$info_item_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$info_item_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$info_item_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$info_item_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$info_item_image->img);
                            }
                        }

                        $del_message .= $info_item_elems->name . ', ';

                        InfoItemId::destroy($one_info_item_elems_id->id);
                        InfoItem::where('info_item_id', $one_info_item_elems_id->id)->delete();

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

    public function destroyInfoItemToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $info_item_elems_id = InfoItemId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$info_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($info_item_elems_id as $one_info_item_elems_id) {

                    $info_item_elems = InfoItem::where('info_item_id', $one_info_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($info_item_elems)){
                        $info_item_elems = InfoItem::where('info_item_id', $one_info_item_elems_id->id)
                            ->first();
                    }


                    if ($one_info_item_elems_id->deleted == 0) {

                        $cart_message .= $info_item_elems->name . ', ';

                        InfoItemId::where('id', $one_info_item_elems_id->id)
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

    public function restoreInfoItem()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $info_item_elems_id = InfoItemId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$info_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($info_item_elems_id as $one_info_item_elems_id) {

                    $info_name = GetNameByLang($one_info_item_elems_id->id, $this->lang_id, 'InfoItem', 'info_item_id');

                    if ($one_info_item_elems_id->restored == 0) {

                        $cart_message .= $info_name . ', ';

                        InfoItemId::where('id', $one_info_item_elems_id->id)
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

}