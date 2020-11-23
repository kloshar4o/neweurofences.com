<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\GoodsGroups;
use App\Models\GoodsGroupsId;
use App\Models\GalleryItem;
use App\Models\GalleryItemId;
use App\Models\GallerySubject;
use App\Models\GallerySubjectId;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
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

        $view = 'admin.gallery.gallery-list';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $gallery_subject_id_list = GallerySubjectId::where('deleted', 0)
            ->where('level', 1)
            ->orderBy('position', 'asc')
            ->paginate(20);

        $gallery_subject_list = [];
        foreach($gallery_subject_id_list as $key => $one_gallery_subject_id_list){
            $gallery_subject_list[$key] = GallerySubject::where('gallery_subject_id', $one_gallery_subject_id_list->id)
                ->first();

        }

        //Remove all null values --start
        $gallery_subject_list = array_filter( $gallery_subject_list, 'strlen' );
        //Remove all null values --end

        return view($view, get_defined_vars());
    }

    // ajax response for position
    public function changePosition()
    {
        $neworder = Input::get('neworder');
        $action = Input::get('action');
        $i = 0;
        $neworder = explode("&", $neworder);
        foreach ($neworder as $k=>$v) {
            $id = str_replace("tablelistsorter[]=","", $v);
            $i++;

            if(!empty($id)){
                if($action == 'item')
                    GalleryItemId::where('id', $id)->update(['position' => $i]);
                elseif($action == 'subject')
                    GallerySubjectId::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');
        $action = Input::get('action');


        if($action == 'item' || $action == 'show_on_main')
            $element_id = GalleryItemId::findOrFail($id);
        elseif($action == 'subject')
            $element_id = GallerySubjectId::findOrFail($id);
        else
            $element_id = null;

        if(!is_null($element_id)) {
            if ($action == 'item')
                $element_name = GetNameByLang($element_id->id, $this->lang_id, 'GalleryItem', 'gallery_item_id');
            elseif ($action == 'subject')
                $element_name = GetNameByLang($element_id->id, $this->lang_id, 'GallerySubject', 'gallery_subject_id');
            else
                $element_name = '';
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

        if($action == 'item')
            GalleryItemId::where('id', $id)->update(['active' => $change_active]);
        elseif($action == 'subject')
            GallerySubjectId::where('id', $id)->update(['active' => $change_active]);
        elseif($action == 'show_on_main')
            GalleryItemId::where('id', $id)->update(['show_on_main' => $change_active]);

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);


    }

    public function createGallerySubject()
    {
        $view = 'admin.gallery.create-gallery-subject';

        $curr_page_id = GallerySubjectId::where('alias', Request::segment(4))
            ->first();

        if(!is_null($curr_page_id)){
            $curr_page_id = $curr_page_id->id;
        }
        else {
            $curr_page_id = null;
        }

        $used_goods = getTableById('goods_subject','p_id',0,$this->lang_id);


        return view($view, get_defined_vars());
    }

    public function editGallerySubject($id, $edited_lang_id)
    {
        $view = 'admin.gallery.edit-gallery-subject';

        $gallery_without_lang = GallerySubject::where('gallery_subject_id', $id)->first();

        if(is_null($gallery_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $gallery_elems = GallerySubject::where('lang_id', $edited_lang_id)
            ->where('gallery_subject_id', $gallery_without_lang->gallery_subject_id)
            ->first();

        if(!is_null($gallery_without_lang)){
            $gallery_subject_id = GallerySubjectId::where('id', $gallery_without_lang->gallery_subject_id)
                ->first();
        }
        elseif(!is_null($gallery_elems)){
            $gallery_subject_id = GallerySubjectId::where('id', $gallery_elems->gallery_subject_id)
                ->first();
        }

	    $used_goods = GoodsGroupsId::join('goods_groups', 'goods_groups.goods_groups_id', '=', 'goods_groups_id.id')
        ->where('lang_id', $edited_lang_id)
        ->get();


        $used = explode(',',$gallery_subject_id->used);

        return view($view, get_defined_vars());
    }

    public function saveSubject($id, $updated_lang_id)
    {
        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:gallery_subject_id',
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

        if(is_null(Input::get('p_id')))
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables._wrong_message', $this->lang)]
            ]);

        $maxPosition = GetMaxPosition('gallery_subject_id');
        $level = GetLevel(Input::get('p_id'), 'gallery_subject_id');

//        Check if lang exist
        if(checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

	    $used_array = [];
	    if(!empty(Input::get('used'))){
		    foreach (Input::get('used') as $one_used)
			    array_push($used_array,$one_used);
	    }
	    $used_array = implode(',',$used_array);

        if(is_null($id)){
            $data = [
                'p_id' => Input::get('p_id'),
                'level' => $level + 1,
                'alias' => Input::get('alias'),
                'position' => $maxPosition + 1,
                'active' => 1,
                'deleted' => 0,
                'used' => $used_array,
            ];

            $subject_id = GallerySubjectId::create($data);

            $data = [
                'gallery_subject_id' => $subject_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
            ];

            GallerySubject::create($data);

        }
        else {
            $exist_subject = GallerySubject::where('gallery_subject_id', $id)->first();


            if(is_null($exist_subject)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($exist_subject->gallery_subject_id, Input::get('alias'), 'gallery_subject_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_subject_by_lang = GallerySubject::where('gallery_subject_id', $exist_subject->gallery_subject_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'alias' => Input::get('alias'),
                'p_id' => Input::get('p_id'),
                'level' => $level + 1,
                'used' => $used_array,
            ];

            $subject_id = GallerySubjectId::where('id', $exist_subject->gallery_subject_id)
                ->update($data);

            $data = [
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
            ];

            if(!is_null($exist_subject_by_lang)){
                GallerySubject::where('gallery_subject_id', $exist_subject->gallery_subject_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'gallery_subject_id' => $exist_subject->gallery_subject_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                GallerySubject::create($data);
            }
        }

        if(is_null($id)){
            if($subject_id->level == 1){
                return response()->json([
                    'status' => true,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang, '')
                ]);
            }
            else {
                return response()->json([
                    'status' => true,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang, GetParentAlias($subject_id->id, 'gallery_subject_id').'/memberslist')
                ]);
            }

        }
        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.updated_text', $this->lang)],
            'redirect' => urlForLanguage($this->lang, 'editgallerysubject/'.$id.'/'.$updated_lang_id)
        ]);
    }

    public function gallerySubjectCart()
    {
        $view = 'admin.gallery.subject-cart';

        $lang_id = $this->lang_id;

        $deleted_elems_by_alias = GallerySubjectId::where('alias', Request::segment(4))
            ->first();

        if(is_null($deleted_elems_by_alias)){
            $deleted_subject_id_elems = GallerySubjectId::where('deleted', 1)
                ->where('active', 0)
                ->where('p_id', 0)
                ->get();
        }
        else{
            $deleted_subject_id_elems = GallerySubjectId::where('deleted', 1)
                ->where('active', 0)
                ->where('p_id', $deleted_elems_by_alias->id)
                ->get();
        }

        $deleted_subject_elems = [];
        foreach($deleted_subject_id_elems as $key => $one_deleted_subject_elem){
            $deleted_subject_elems[$key] = GallerySubject::where('gallery_subject_id', $one_deleted_subject_elem->id)
                ->first();
        }

        $deleted_subject_elems = array_filter( $deleted_subject_elems, 'strlen' );

        return view($view, get_defined_vars());
    }

    public function destroyGallerySubjectFromCart()
    {
        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $gallery_subject_elems_id = GallerySubjectId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$gallery_subject_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($gallery_subject_elems_id as $one_gallery_subject_elems_id) {

                    $gallery_subject_elems = GallerySubject::where('gallery_subject_id', $one_gallery_subject_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($gallery_subject_elems)){
                        $gallery_subject_elems = GallerySubject::where('gallery_subject_id', $one_gallery_subject_elems_id->id)
                            ->first();
                    }

                    if ($one_gallery_subject_elems_id->deleted == 1 && $one_gallery_subject_elems_id->active == 0) {

                        $gallery_photo = GalleryItemId::where('gallery_subject_id', $one_gallery_subject_elems_id->id)->get();

                        if(!is_null($gallery_photo)){
                            foreach($gallery_photo as $one_gallery_photo){
                                if (File::exists('upfiles/galleryItems/s/' . $one_gallery_photo->img))
                                    File::delete('upfiles/galleryItems/s/' . $one_gallery_photo->img);

                                if (File::exists('upfiles/galleryItems/m/' . $one_gallery_photo->img))
                                    File::delete('upfiles/galleryItems/m/' . $one_gallery_photo->img);

                                if (File::exists('upfiles/galleryItems/' . $one_gallery_photo->img))
                                    File::delete('upfiles/galleryItems/' . $one_gallery_photo->img);
                            }
                        }

                        $del_message .= $gallery_subject_elems->name . ', ';

                        GallerySubjectId::destroy($one_gallery_subject_elems_id->id);
                        GallerySubject::where('gallery_subject_id', $one_gallery_subject_elems_id->id)->delete();

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

    public function destroyGallerySubjectToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $gallery_subject_elems_id = GallerySubjectId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$gallery_subject_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($gallery_subject_elems_id as $one_gallery_subject_elems_id) {

                    $gallery_subject_elems = GallerySubject::where('gallery_subject_id', $one_gallery_subject_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($gallery_subject_elems)){
                        $gallery_subject_elems = GallerySubject::where('gallery_subject_id', $one_gallery_subject_elems_id->id)
                            ->first();
                    }


                    if ($one_gallery_subject_elems_id->deleted == 0) {

                        $cart_message .= $gallery_subject_elems->name . ', ';

                        GallerySubjectId::where('id', $one_gallery_subject_elems_id->id)
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

    public function restoreGallerySubject()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $gallery_item_elems_id = GallerySubjectId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$gallery_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($gallery_item_elems_id as $one_gallery_item_elems_id) {

                    $gallery_name = GetNameByLang($one_gallery_item_elems_id->id, $this->lang_id, 'GallerySubject', 'gallery_subject_id');

                    if ($one_gallery_item_elems_id->restored == 0) {

                        $cart_message .= $gallery_name . ', ';

                        GallerySubjectId::where('id', $one_gallery_item_elems_id->id)
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
        $view = 'admin.gallery.child-list';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $gallery_list_id = GallerySubjectId::where('alias', Request::segment(4))
            ->first();

        if(is_null($gallery_list_id)){
            return App::abort(503, 'Unauthorized action.');
        }

        if(CheckIfSubjectHasItems('gallery', $gallery_list_id->id)->isEmpty()){
            $child_gallery_list_id = GallerySubjectId::where('p_id', $gallery_list_id->id)
                ->where('deleted', 0)
                ->orderBy('position', 'asc')
                ->get();
            $child_gallery_list = [];
            foreach($child_gallery_list_id as $key => $one_gallery_elem){
                $child_gallery_list[$key] = GallerySubject::where('gallery_subject_id', $one_gallery_elem->id)
                    ->first();
            }

            $child_gallery_list = array_filter( $child_gallery_list, 'strlen' );
            $child_gallery_item_list = [];
        }
        else {
            $child_gallery_item_list_id = GalleryItemId::where('gallery_subject_id', $gallery_list_id->id)
                ->where('deleted', 0)
                ->orderBy('position', 'asc')
                ->paginate(40);
            $child_gallery_item_list = [];
            foreach($child_gallery_item_list_id as $key => $one_gallery_elem){
                $child_gallery_item_list[$key] = GalleryItem::where('gallery_item_id', $one_gallery_elem->id)
                    ->first();
            }

            $child_gallery_item_list = array_filter( $child_gallery_item_list, 'strlen' );
            $child_gallery_list = [];
        }

        return view($view, get_defined_vars());
    }

    public function itemsPhoto()
    {
        $view = 'admin.gallery.items-photo';

        $lang = $this->lang;
        $lang_id = $this->lang_id;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $gallery_subject_id = GallerySubjectId::where('alias', Request::segment(4))
            ->first();

        if(is_null($gallery_subject_id)){
            return App::abort(503, 'Unauthorized action.');
        }

        $gallery_subject = GallerySubject::where('gallery_subject_id', $gallery_subject_id->id)
            ->where('lang_id', $lang_id)
            ->first();

        if(!is_null($gallery_subject_id)){

            $gallery_item_id = GalleryItemId::where('gallery_subject_id', $gallery_subject_id->id)
                ->where('type', 'photo')
                ->where('deleted', 0)
                ->orderBy('position', 'asc')
                ->get();

            $gallery_item = [];
            if(!$gallery_item_id->isEmpty()){
                foreach($gallery_item_id as $one_gallery_item_id){
                    $gallery_item[] = GalleryItem::where('gallery_item_id', $one_gallery_item_id->id)
//                        ->where('lang_id', $lang_id)
                        ->first();
                }

                $gallery_item = array_filter($gallery_item);
            }

        }

        return view($view, get_defined_vars());
    }

    public function galleryItemCart()
    {
        $view = 'admin.gallery.item-cart';

        $lang_id = $this->lang_id;

        $deleted_elems_by_alias = GallerySubjectId::where('alias', Request::segment(4))
            ->first();

        $deleted_item_id_elems = GalleryItemId::where('deleted', 1)
            ->where('active', 0)
            ->where('gallery_subject_id', $deleted_elems_by_alias->id)
            ->get();

        $deleted_item_elems = [];
        foreach($deleted_item_id_elems as $key => $one_deleted_item_elem){
            $deleted_item_elems[$key] = GalleryItem::where('gallery_item_id', $one_deleted_item_elem->id)
                ->first();
        }

        $deleted_item_elems = array_filter( $deleted_item_elems, 'strlen' );

        return view($view, get_defined_vars());
    }

    public function destroyGalleryItemFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $gallery_item_elems_id = GalleryItemId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$gallery_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($gallery_item_elems_id as $one_gallery_item_elems_id) {

                    $gallery_item_elems = GalleryItem::where('gallery_item_id', $one_gallery_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($gallery_item_elems)){
                        $gallery_item_elems = GalleryItem::where('gallery_item_id', $one_gallery_item_elems_id->id)
                            ->first();
                    }

                    if ($one_gallery_item_elems_id->deleted == 1 && $one_gallery_item_elems_id->active == 0) {

                        if (File::exists('upfiles/galleryItems/s/' . $one_gallery_item_elems_id->img))
                            File::delete('upfiles/galleryItems/s/' . $one_gallery_item_elems_id->img);

                        if (File::exists('upfiles/galleryItems/m/' . $one_gallery_item_elems_id->img))
                            File::delete('upfiles/galleryItems/m/' . $one_gallery_item_elems_id->img);

                        if (File::exists('upfiles/galleryItems/' . $one_gallery_item_elems_id->img))
                            File::delete('upfiles/galleryItems/' . $one_gallery_item_elems_id->img);

                        $del_message .= $gallery_item_elems->name . ', ';

                        GalleryItemId::destroy($one_gallery_item_elems_id->id);
                        GalleryItem::where('gallery_item_id', $one_gallery_item_elems_id->id)->delete();

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

    public function destroyGalleryItemToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $gallery_item_elems_id = GalleryItemId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$gallery_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($gallery_item_elems_id as $one_gallery_item_elems_id) {

                    $gallery_item_elems = GalleryItem::where('gallery_item_id', $one_gallery_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($gallery_item_elems)){
                        $gallery_item_elems = GalleryItem::where('gallery_item_id', $one_gallery_item_elems_id->id)
                            ->first();
                    }


                    if ($one_gallery_item_elems_id->deleted == 0) {

                        $cart_message .= $gallery_item_elems->name . ', ';

                        GalleryItemId::where('id', $one_gallery_item_elems_id->id)
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

    public function restoreGalleryItem()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $gallery_item_elems_id = GalleryItemId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$gallery_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($gallery_item_elems_id as $one_gallery_item_elems_id) {

                    $gallery_name = GetNameByLang($one_gallery_item_elems_id->id, $this->lang_id, 'GalleryItem', 'gallery_item_id');

                    if ($one_gallery_item_elems_id->restored == 0) {

                        $cart_message .= $gallery_name . ', ';

                        GalleryItemId::where('id', $one_gallery_item_elems_id->id)
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

    public function itemsVideo()
    {
        $view = 'admin.gallery.items-video';

        $lang = $this->lang;
        $lang_id = $this->lang_id;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $gallery_subject_id = GallerySubjectId::where('alias', Request::segment(4))
            ->first();

        if(is_null($gallery_subject_id)){
            return App::abort(503, 'Unauthorized action.');
        }

        $gallery_subject = GallerySubject::where('gallery_subject_id', $gallery_subject_id->id)
            ->where('lang_id', $lang_id)
            ->first();

        if(!is_null($gallery_subject_id)){

            $gallery_item_id = GalleryItemId::where('gallery_subject_id', $gallery_subject_id->id)
                ->where('type', 'video')
                ->where('deleted', 0)
                ->orderBy('position', 'asc')
                ->get();

            $gallery_item = [];
            if(!$gallery_item_id->isEmpty()){
                foreach($gallery_item_id as $one_gallery_item_id){
                    $gallery_item[] = GalleryItem::where('gallery_item_id', $one_gallery_item_id->id)
//                        ->where('lang_id', $lang_id)
                        ->first();
                }

                $gallery_item = array_filter($gallery_item);
            }

        }

        return view($view, get_defined_vars());
    }

    public function createItemsVideo(){

        $lang_id = $this->lang_id;

        if(is_null(Input::get('edit-video')))
            $item = Validator::make(Input::all(), [
                'youtube_link' => 'required',
                'alias' => 'unique:gallery_item_id'
            ]);
        else
            $item = Validator::make(Input::all(), [
                'youtube_link' => 'required',
            ]);

        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $gallery_subject_id = GallerySubjectId::where('alias', Request::segment(4))
            ->first();

        if(is_null($gallery_subject_id)){
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables._wrong_message', $this->lang)],
            ]);
        }

//        Check if lang exist
        if(checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if(!is_null(Input::get('youtube_id')))
            $youtube_id = Input::get('youtube_id');
        elseif(is_null(Input::get('youtube_id')) && !is_null(Input::get('youtube_link')))
            $youtube_id = $this->youtubeId(Input::get('youtube_link'));
        else
            $youtube_id = '';

        $maxPosition = GetMaxPosition('gallery_item_id');

        if(is_null(Input::get('edit-video'))) {

            $data = [
                'gallery_subject_id' => $gallery_subject_id->id,
                'alias' => !is_null(Input::get('name')) ? str_slug(Input::get('name') . '-' . $youtube_id) : str_slug($youtube_id),
                'active' => 1,
                'deleted' => 0,
                'position' => $maxPosition + 1,
                'show_on_main' => 0,
                'img' => '',
                'youtube_id' => $youtube_id,
                'youtube_link' => Input::get('youtube_link'),
                'type' => 'video'

            ];

            $gallery_item_id = GalleryItemId::create($data);

            $data = [
                'gallery_item_id' => $gallery_item_id->id,
                'name' => !is_null(Input::get('name')) ? Input::get('name') : '',
                'lang_id' => $lang_id,
                'body' => !is_null(Input::get('body')) ? Input::get('body') : ''
            ];

            GalleryItem::create($data);

            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.save', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'itemsvideo')
            ]);
        }
        else {

            $exist_video = GalleryItem::where('gallery_item_id', Input::get('current_item'))->first();

            if(is_null($exist_video)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($exist_video->gallery_item_id, str_slug($youtube_id), 'gallery_item_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_video_by_lang = GalleryItem::where('gallery_item_id', $exist_video->gallery_item_id)
                ->where('lang_id', Input::get('lang'))
                ->first();

            $data = [
                'gallery_subject_id' => $gallery_subject_id->id,
                'alias' => !is_null(Input::get('name')) ? str_slug(Input::get('name') . '-' . $youtube_id) : str_slug($youtube_id),
                'youtube_id' => $youtube_id,
                'youtube_link' => Input::get('youtube_link')
            ];

            GalleryItemId::where('id', $exist_video->gallery_item_id)
                ->update($data);

            $data = array_filter([
                'name' => !is_null(Input::get('name')) ? Input::get('name') : '',
                'body' => !is_null(Input::get('body')) ? Input::get('body') : ''

            ]);

            if(!is_null($exist_video_by_lang)){
                GalleryItem::where('gallery_item_id', $exist_video->gallery_item_id)
                    ->where('lang_id', Input::get('lang'))
                    ->update($data);
            }
            else {

                $create_data = [
                    'gallery_item_id' => $exist_video->gallery_item_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                GalleryItem::create($data);
            }

            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.updated_text', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'itemsvideo')
            ]);
        }

    }

    public function changeItemName()
    {
        $item_id = Input::get('id');
        $item_name = Input::get('name');
        $lang_id = Input::get('lang_id');
        $edited_row = Input::get('edited_row');

        if(is_null($item_name) || empty($item_name))
            return response()->json([
                'status' => false,
                'messages' => controllerTrans('variables._wrong_message', $this->lang)
            ]);

        if(!empty($item_id)){
            $gallery_item_id = GalleryItemId::where('id', $item_id)
                ->where('deleted', 0)
                ->first();

            if(!is_null($gallery_item_id)) {
                $gallery_item_by_lang = GalleryItem::where('gallery_item_id', $item_id)
                    ->where('lang_id', $lang_id)
                    ->first();

                if (!is_null($gallery_item_by_lang)) {
                    if($edited_row == 'name')
                        $data = [
                            'name' => $item_name
                        ];
                    else
                        $data = [
                            'body' => $item_name
                        ];

                    GalleryItem::where('gallery_item_id', $item_id)
                        ->where('lang_id', $lang_id)
                        ->update($data);

                    return response()->json([
                        'status' => true,
                        'messages' => controllerTrans('variables.updated_text', $this->lang),
                        'new_name' => $item_name,
                        'new_body' => $item_name
                    ]);
                }
                else {
                    if($edited_row == 'name')
                        $data = [
                            'gallery_item_id' => $gallery_item_id->id,
                            'name' => $item_name,
                            'lang_id' => $lang_id
                        ];
                    else
                        $data = [
                            'gallery_item_id' => $gallery_item_id->id,
                            'body' => $item_name,
                            'lang_id' => $lang_id
                        ];

                    GalleryItem::create($data);

                    return response()->json([
                        'status' => true,
                        'messages' => controllerTrans('variables.save', $this->lang),
                        'new_name' => $item_name,
                        'new_body' => $item_name
                    ]);
                }
            }

            return response()->json([
                'status' => false,
                'messages' => controllerTrans('variables._wrong_message', $this->lang)
            ]);
        }

        return response()->json([
            'status' => false,
            'messages' => controllerTrans('variables._wrong_message', $this->lang)
        ]);
    }

    // ajax response for youtube id
    public function youtubeId($youtube_link = null)
    {
        if(is_null($youtube_link))
            $code = Input::get('code');
        else
            $code = $youtube_link;

        if (!empty($code)){
            if (FindYoutubeImg($code)){
                $youtube_img = FindYoutubeImg($code);
            }
            else {
                $youtube_img = '';
            }
        }
        else {
            $youtube_img = '';
        }

        return $youtube_img;

    }

    public function ajaxVideoContent()
    {
        $id = Input::get('id');
        $lang_id = Input::get('lang_id');

//        Check if lang exist
        if(checkIfLangExist($lang_id) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        $gallery_item_id = GalleryItemId::where('id', $id)
            ->where('deleted', 0)
            ->first();

        if(is_null($gallery_item_id))
            return response()->json([
                'status' => false,
                'messages' => controllerTrans('variables._wrong_message', $this->lang)
            ]);

        $gallery_item = GalleryItem::where('gallery_item_id', $gallery_item_id->id)
            ->where('lang_id', $lang_id)
            ->first();

        return response()->json([
            'status' => true,
            'lang' => $lang_id,
            'name' => !is_null($gallery_item) ? $gallery_item->name : '',
            'body' => !is_null($gallery_item) ? $gallery_item->body : '',
            'link' => $gallery_item_id->youtube_link,
            'youtube_id' => $gallery_item_id->youtube_id
        ]);
    }

    public function ajaxAudioContent()
    {
        $id = Input::get('id');
        $lang_id = Input::get('lang_id');

//        Check if lang exist
        if(checkIfLangExist($lang_id) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        $gallery_item_id = GalleryItemId::where('id', $id)
            ->where('deleted', 0)
            ->first();

        if(is_null($gallery_item_id))
            return response()->json([
                'status' => false,
                'messages' => controllerTrans('variables._wrong_message', $this->lang)
            ]);

        $gallery_item = GalleryItem::where('gallery_item_id', $gallery_item_id->id)
            ->where('lang_id', $lang_id)
            ->first();

        return response()->json([
            'status' => true,
            'lang' => $lang_id,
            'name' => !is_null($gallery_item) ? $gallery_item->name : '',
            'body' => !is_null($gallery_item) ? $gallery_item->body : '',
        ]);
    }
}
