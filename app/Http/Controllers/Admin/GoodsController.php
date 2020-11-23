<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Promotions;
use App\Models\PromotionsId;
use App\Models\GoodsImages;
use App\Models\GoodsItem;
use App\Models\GoodsItemId;
use App\Models\GoodsItemIdSet;
use App\Models\GoodsItemModules;
use App\Models\GoodsItemModulesId;
use App\Models\GoodsMeasure;
use App\Models\GoodsMeasureId;
use App\Models\GoodsMeasureList;
use App\Models\GoodsParametr;
use App\Models\GoodsParametrId;
use App\Models\GoodsParametrItemId;
use App\Models\GoodsParametrItemMeasure;
use App\Models\GoodsParametrItemRsc;
use App\Models\GoodsParametrItemSimple;
use App\Models\GoodsParametrValue;
use App\Models\GoodsParametrValueId;
use App\Models\GoodsSubject;
use App\Models\GoodsSubjectId;
use App\Models\GoodsColorsId;
use App\Models\GoodsColors;
use App\Models\GoodsGroups;
use App\Models\GoodsItemColors;
use App\Models\GoodsSubjectRelated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as Httprequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\GoodsPhoto;
use App\Models\GoodsSize;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class GoodsController extends Controller
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

        $view = 'admin.goods.goods-list';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $goods_subject_id_list = GoodsSubjectId::where('deleted', 0)
            ->where('level', 1)
            ->orderBy('position', 'asc')
            ->paginate(20);

        $goods_subject_list = [];
        foreach ($goods_subject_id_list as $key => $one_goods_subject_id_list) {
            $goods_subject_list[$key] = GoodsSubject::where('goods_subject_id', $one_goods_subject_id_list->id)
                ->first();

        }

        //Remove all null values --start
        $goods_subject_list = array_filter($goods_subject_list, 'strlen');
        //Remove all null values --end

//        Filter
        $search_result = trim(Input::get('search-key'));
//        Filter

        if (!is_null($search_result) && !empty($search_result)) {
            return $this->globalSearchObjects($search_result);
        }

        return view($view, get_defined_vars());
    }

    // ajax response for position
    public function changePosition()
    {
        $neworder = Input::get('neworder');
        $action = Input::get('action');
        $i = 0;
        $neworder = explode("&", $neworder);

        foreach ($neworder as $k => $v) {
            $id = str_replace("tablelistsorter[]=", "", $v);
            $i++;

            if (!empty($id)) {
                if ($action == 'item') {


                    $position = $i;

                    $hasOther = !empty(GoodsItemId::where('id', $id)->first()->p_id_other);

                    if ($hasOther) {
                        $position = $i * 1000;
                    }


                    GoodsItemId::where('id', $id)->update(['position' => $position]);

                } elseif ($action == 'subject')
                    GoodsSubjectId::where('id', $id)->update(['position' => $i]);
                elseif ($action == 'gallery')
                    GoodsPhoto::where('id', $id)->update(['position' => $i]);
                elseif ($action == 'parameter')
                    GoodsParametrId::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for img position
    public function changeImgPosition()
    {
        $newOrder = Input::get('newOrder');

        $i = 0;
        foreach ($newOrder as $k => $v) {
            $id = $v;
            $i++;

            if (!empty($id)) {
                GoodsImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');
        $action = Input::get('action');

        if ($action == 'item')
            $element_id = GoodsItemId::findOrFail($id);
        elseif ($action == 'subject')
            $element_id = GoodsSubjectId::findOrFail($id);


        elseif ($action == 'size') {
            $element_id = GoodsSize::findOrFail($id);
        } elseif ($action == 'gallery' && $action == 'gallery_show')
            $element_id = GoodsPhoto::findOrFail($id);
        elseif ($action == 'parameter')
            $element_id = GoodsParametrId::findOrFail($id);
        else
            $element_id = '';

        if (!is_null($element_id)) {
            if ($action == 'item')
                $element_name = GetNameByLang($element_id->id, $this->lang_id, 'GoodsItem', 'goods_item_id');
            elseif ($action == 'subject' && $action == 'gallery_show')
                $element_name = GetNameByLang($element_id->id, $this->lang_id, 'GoodsSubject', 'goods_subject_id');
            elseif ($action == 'parameter')
                $element_name = GetNameByLang($element_id->id, $this->lang_id, 'GoodsParametr', 'goods_parametr_id');


            elseif ($action == 'size')
                $element_name = $element_id->width . 'x' . $element_id->height . ' (' . $element_id->gap . 'x' . $element_id->thickness . ')';
            else
                $element_name = '';
        } else
            return response()->json([
                'status' => false,
                'type' => 'error',
                'messages' => [controllerTrans('variables.something_wrong', $this->lang)]
            ]);

        if ($active == 1) {
            $change_active = 0;
            $msg = controllerTrans('variables.element_is_inactive', $this->lang, ['name' => $element_name]);
        } else {
            $change_active = 1;
            $msg = controllerTrans('variables.element_is_active', $this->lang, ['name' => $element_name]);
        }

        if ($action == 'item')
            GoodsItemId::where('id', $id)->update(['active' => $change_active]);
        elseif ($action == 'subject')
            GoodsSubjectId::where('id', $id)->update(['active' => $change_active]);
        elseif ($action == 'gallery_show')
            GoodsPhoto::where('id', $id)->update(['show_img' => $change_active]);

        elseif ($action == 'size')
            GoodsSize::where('id', $id)->update(['active' => $change_active]);


        elseif ($action == 'gallery')
            GoodsPhoto::where('id', $id)->update(['active' => $change_active]);
        elseif ($action == 'parameter')
            GoodsParametrId::where('id', $id)->update(['active' => $change_active]);

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);

    }

    public function createGoodsSubject()
    {
        $view = 'admin.goods.create-goods-subject';


        $curr_page_id = GoodsSubjectId::where('alias', Request::segment(4))
            ->first();


        if (!is_null($curr_page_id)) {
            $curr_page_id = $curr_page_id->id;
        } else {
            $curr_page_id = null;
        }

        $group_list = GoodsGroups::
        select('id', 'name', 'created_at', 'updated_at')
            ->get();

        return view($view, get_defined_vars());
    }

    public function editGoodsSubject($id, $edited_lang_id)
    {
        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $goods_without_lang = GoodsSubject::where('goods_subject_id', $id)->first();

        if (is_null($goods_without_lang)) {
            return App::abort(503, 'Unauthorized action.');
        }

        $goods_elems = GoodsSubject::where('lang_id', $edited_lang_id)
            ->where('goods_subject_id', $goods_without_lang->goods_subject_id)
            ->first();

        $group_list = GoodsGroups::
        select('id', 'name', 'created_at', 'updated_at')
            ->get();


//dd($group_list);

        if (!is_null($goods_without_lang)) {
            $goods_subject_id = GoodsSubjectId::where('id', $goods_without_lang->goods_subject_id)
                ->first();
        } elseif (!is_null($goods_elems)) {
            $goods_subject_id = GoodsSubjectId::where('id', $goods_elems->goods_subject_id)
                ->first();
        }

        return view('admin.goods.edit-goods-subject', get_defined_vars());
    }

    public function saveSubject($id, $updated_lang_id)
    {

        if (is_null($id)) {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:goods_subject_id',
            ]);
        } else {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required',
            ]);
        }

        if ($item->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $maxPosition = GetMaxPosition('goods_subject_id');
        $level = GetLevel(Input::get('p_id'), 'goods_subject_id');

        $array_img = [];
        if (!is_null(Input::get('file')) && !empty(Input::get('file'))) {
            foreach (Input::get('file') as $item) {
                if (!is_null($item))
                    $array_img[] = basename($item);
            }
        }

//        Check if lang exist
        if (checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if (is_null($id)) {
            $data = [
                'p_id' => Input::get('p_id'),
                'level' => $level + 1,
                'alias' => Input::get('alias'),
                'position' => $maxPosition + 1,
                'active' => 1,
                'deleted' => 0,
                'good_group' => Input::get('group'),
            ];

            $subject_id = GoodsSubjectId::create($data);

            $data = [
                'goods_subject_id' => $subject_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ];

            GoodsSubject::create($data);

//            Upload images for current menu
            if (!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img)) {
                foreach (array_reverse(Input::get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('goods_images');
                    $img = basename($item);

                    $data = [
                        'goods_subject_id' => $subject_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    GoodsImages::create($data);
                }
            }
//            Upload images for current menu

        } else {

            $exist_subject = GoodsSubject::where('goods_subject_id', $id)->first();

            if (is_null($exist_subject)) {
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if (checkIfAliasExist($exist_subject->goods_subject_id, Input::get('alias'), 'goods_subject_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_subject_by_lang = GoodsSubject::where('goods_subject_id', $exist_subject->goods_subject_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'alias' => Input::get('alias'),
                'p_id' => Input::get('p_id'),
                'level' => $level + 1,
                'good_group' => Input::get('group'),
            ];

            $subject_id = GoodsSubjectId::where('id', $exist_subject->goods_subject_id)
                ->update($data);

            $data = [
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ];

            if (!is_null($exist_subject_by_lang)) {
                GoodsSubject::where('goods_subject_id', $exist_subject->goods_subject_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            } else {

                $create_data = [
                    'goods_subject_id' => $exist_subject->goods_subject_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                GoodsSubject::create($data);
            }

//            Upload images for current menu
            if (!is_null(Input::get('file')) && !empty($array_img)) {

                $exist_goods_images = GoodsImages::where('goods_subject_id', $exist_subject->goods_subject_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if (count($array_img) >= count($exist_goods_images)) {
                    foreach ($exist_goods_images as $exist_menu_image) {
                        $pos = array_search($exist_menu_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if (!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('goods_images');
                            $img = basename($item);

                            $data = [
                                'goods_subject_id' => $exist_subject->goods_subject_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            GoodsImages::create($data);
                        }
                    }
                } else {
                    foreach (array_reverse(Input::get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('goods_images');
                        $img = basename($item);

                        $data = [
                            'goods_subject_id' => $exist_subject->goods_subject_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        GoodsImages::create($data);
                    }
                }
            }
//            Upload images for current menu
        }

        if (is_null($id)) {
            if ($subject_id->level == 1) {
                return response()->json([
                    'status' => true,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang, '')
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang, GetParentAlias($subject_id->id, 'goods_subject_id') . '/memberslist')
                ]);
            }

        }
        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.updated_text', $this->lang)],
            'redirect' => urlForLanguage($this->lang, 'editgoodssubject/' . $id . '/' . $updated_lang_id)
        ]);
    }

    public function goodsSubjectCart()
    {
        $view = 'admin.goods.subject-cart';

        $lang_id = $this->lang_id;

        $deleted_elems_by_alias = GoodsSubjectId::where('alias', Request::segment(4))
            ->first();

        if (is_null($deleted_elems_by_alias)) {
            $deleted_subject_id_elems = GoodsSubjectId::where('deleted', 1)
                ->where('active', 0)
                ->where('p_id', 0)
                ->get();
        } else {
            $deleted_subject_id_elems = GoodsSubjectId::where('deleted', 1)
                ->where('active', 0)
                ->where('p_id', $deleted_elems_by_alias->id)
                ->get();
        }

        $deleted_subject_elems = [];
        foreach ($deleted_subject_id_elems as $key => $one_deleted_subject_elem) {
            $deleted_subject_elems[$key] = GoodsSubject::where('goods_subject_id', $one_deleted_subject_elem->id)
                ->first();
        }

        $deleted_subject_elems = array_filter($deleted_subject_elems, 'strlen');

        return view($view, get_defined_vars());
    }

    public function destroyGoodsSubjectFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $subject_elems_id = GoodsSubjectId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$subject_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($subject_elems_id as $one_subject_elems_id) {

                    $subject_elems = GoodsSubject::where('goods_subject_id', $one_subject_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if (is_null($subject_elems)) {
                        $subject_elems = GoodsSubject::where('goods_subject_id', $one_subject_elems_id->id)
                            ->first();
                    }

                    if ($one_subject_elems_id->deleted == 1 && $one_subject_elems_id->active == 0) {

                        $goods_images = $one_subject_elems_id->moduleMultipleImg;

                        if (!is_null($goods_images) && !$goods_images->isEmpty()) {
                            foreach ($goods_images as $goods_image) {
                                if (File::exists('upfiles/' . $this->menu()['modules_name']->modulesId->alias . '/s/' . $goods_image->img))
                                    File::delete('upfiles/' . $this->menu()['modules_name']->modulesId->alias . '/s/' . $goods_image->img);

                                if (File::exists('upfiles/' . $this->menu()['modules_name']->modulesId->alias . '/m/' . $goods_image->img))
                                    File::delete('upfiles/' . $this->menu()['modules_name']->modulesId->alias . '/m/' . $goods_image->img);

                                if (File::exists('upfiles/' . $this->menu()['modules_name']->modulesId->alias . '/' . $goods_image->img))
                                    File::delete('upfiles/' . $this->menu()['modules_name']->modulesId->alias . '/' . $goods_image->img);
                            }
                        }

                        $del_message .= $subject_elems->name . ', ';

                        GoodsSubjectId::destroy($one_subject_elems_id->id);
                        GoodsSubject::where('goods_subject_id', $one_subject_elems_id->id)->delete();

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

    public function destroyGoodsSubjectToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $subject_elems_id = GoodsSubjectId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$subject_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($subject_elems_id as $one_subject_elems_id) {

                    $subject_elems = GoodsSubject::where('goods_subject_id', $one_subject_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if (is_null($subject_elems)) {
                        $subject_elems = GoodsSubject::where('goods_subject_id', $one_subject_elems_id->id)
                            ->first();
                    }


                    if ($one_subject_elems_id->deleted == 0) {

                        $cart_message .= $subject_elems->name . ', ';

                        GoodsSubjectId::where('id', $one_subject_elems_id->id)
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

    public function restoreGoodsSubject()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $goods_item_elems_id = GoodsSubjectId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$goods_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($goods_item_elems_id as $one_goods_item_elems_id) {

                    $goods_name = GetNameByLang($one_goods_item_elems_id->id, $this->lang_id, 'GoodsSubject', 'goods_subject_id');

                    if ($one_goods_item_elems_id->restored == 0) {

                        $cart_message .= $goods_name . ', ';

                        GoodsSubjectId::where('id', $one_goods_item_elems_id->id)
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
        $view = 'admin.goods.child-list';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

//        Filter
        $search_result = trim(Input::get('search-key'));
//        Filter

        if (!is_null($search_result) && !empty($search_result)) {
            return $this->globalSearchObjects($search_result);
        }
        $goods_list_id = GoodsSubjectId::where('alias', Request::segment(4))
            ->first();

        if (is_null($goods_list_id)) {
            return App::abort(503, 'Unauthorized action.');
        }

        if (CheckIfSubjectHasItems('goods', $goods_list_id->id)->isEmpty()) {
            $child_goods_list_id = GoodsSubjectId::where('p_id', $goods_list_id->id)
                ->where('deleted', 0)
                ->orderBy('position', 'asc')
                ->get();
            $child_goods_list = [];
            foreach ($child_goods_list_id as $key => $one_goods_elem) {
                $child_goods_list[$key] = GoodsSubject::where('goods_subject_id', $one_goods_elem->id)
                    ->first();
            }

            $child_goods_list = array_filter($child_goods_list, 'strlen');
            $child_goods_item_list = [];
        } else {
            if ($goods_list_id->id != 36)
                $child_goods_item_list_id = GoodsItemId::where('goods_subject_id', $goods_list_id->id)
                    ->where('deleted', 0)
                    ->orderBy('position', 'asc')
                    ->get();
            else
                $child_goods_item_list_id = GoodsItemId::where('goods_subject_id', $goods_list_id->id)
                    ->where('deleted', 0)
                    ->orderBy('position', 'asc')
                    ->paginate(150);

            $child_goods_item_list = [];
            foreach ($child_goods_item_list_id as $key => $one_goods_elem) {
                $child_goods_item_list[$key] = GoodsItem::where('goods_item_id', $one_goods_elem->id)
                    ->first();
            }

            $child_goods_item_list = array_filter($child_goods_item_list, 'strlen');
            $child_goods_list = [];
        }

        return view($view, get_defined_vars());
    }

    public function createGoodsItem()
    {

        $view = 'admin.goods.create-goods-item';
        $lang_id = $this->lang_id;

        $goods_subject_id = GoodsSubjectId::where('alias', Request::segment(4))
            ->first();

        if (!is_null($goods_subject_id)) {
            $curr_page_id = $goods_subject_id->id;

            $goods_parameter_id = GoodsParametrId::where('goods_subject_id', $curr_page_id)
                ->where('deleted', 0)
                ->where('active', 1)
                ->orderBy('position', 'asc')
                ->get();

            if (!empty($goods_parameter_id)) {
                $goods_parameter = [];
                foreach ($goods_parameter_id as $key => $one_goods_parametr_id) {
                    $goods_parameter[$key] = GoodsParametr::where('goods_parametr_id', $one_goods_parametr_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();
                }

                $goods_parameter = array_filter($goods_parameter);
            } else {
                $goods_parameter = [];
            }

        } else {
            $curr_page_id = null;
            $goods_parameter = [];
        }

        $brand = Brand::where('active', 1)
            ->where('deleted', 0)
            ->orderBy('created_at', 'desc')
            ->get();

//        $promotions_id = PromotionsId::where('active', 1)
//            ->where('deleted', 0)
//            ->orderBy('position', 'asc')
//            ->get();
//
//        $promotions = [];
//        if(!$promotions_id->isEmpty()){
//            foreach($promotions_id as $key => $one_promotions_id){
//                $promotions[$key] = Promotions::where('promotions_id', $one_promotions_id->id)
//                    ->where('lang_id', $lang_id)
//                    ->first();
//            }
//
//            $promotions = array_filter($promotions);
//        }

        $goods_items_for_set = GoodsItemId::whereRaw('goods_subject_id IN(SELECT id FROM goods_subject_id WHERE active=1 AND deleted=0 AND alias="jaluze")')
            ->where('active', 1)
            ->where('deleted', 0)
            ->where('goods_set', 0)
            ->join('goods_item', 'goods_item.goods_item_id', '=', 'goods_item_id.id')
            ->where('lang_id', $lang_id)
            ->orderBy('position', 'asc')
            ->get();

        $goods_recomendet = GoodsItemId::whereRaw('goods_subject_id IN(SELECT id FROM goods_subject_id WHERE deleted=0)')
            ->where('active', 1)
            ->where('deleted', 0)
            ->join('goods_item', 'goods_item.goods_item_id', '=', 'goods_item_id.id')
            ->where('lang_id', $lang_id)
            ->orderBy('position', 'asc')
            ->get();

        $colors_list = GoodsColorsId::join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->where('lang_id', $lang_id)
            ->get();

        return view($view, get_defined_vars());
    }

    public function editGoodsItem($id, $edited_lang_id)
    {
        $view = 'admin.goods.edit-goods-item';
        $lang_id = $this->lang_id;

        $modules_name = $this->menu()['modules_name'];
        $current_url = '/' . $this->lang . '/back/' . $modules_name->modulesId->alias;

        $goods_without_lang = GoodsItem::where('goods_item_id', $id)->first();

        if (is_null($goods_without_lang)) {
            return App::abort(503, 'Unauthorized action.');
        }

        $goods_elems = GoodsItem::where('lang_id', $edited_lang_id)
            ->where('goods_item_id', $goods_without_lang->goods_item_id)
            ->first();

        if (!is_null($goods_without_lang)) {
            $goods_item_id = GoodsItemId::where('id', $goods_without_lang->goods_item_id)
                ->first();
        } elseif (!is_null($goods_elems)) {
            $goods_item_id = GoodsItemId::where('id', $goods_elems->goods_item_id)
                ->first();
        }

        $goods_subject_id = GoodsSubjectId::where('id', $goods_item_id->goods_subject_id)->first();

        if (!is_null($goods_subject_id)) {
            $goods_subject_id = $goods_subject_id->id;

            $goods_parameter_id = GoodsParametrId::where('goods_subject_id', $goods_subject_id)
                ->where('deleted', 0)
                ->where('active', 1)
                ->orderBy('position', 'asc')
                ->get();

            if (!empty($goods_parameter_id)) {
                $goods_parameter = [];
                foreach ($goods_parameter_id as $key => $one_goods_parametr_id) {
                    $goods_parameter[$key] = GoodsParametr::where('goods_parametr_id', $one_goods_parametr_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();
                }

                $goods_parameter = array_filter($goods_parameter);
            } else {
                $goods_parameter = [];
            }
        } else {
            $goods_subject_id = null;
            $goods_parameter = [];
        }

        $brand = Brand::where('active', 1)
            ->where('deleted', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        $first_goods_modules_id = GoodsItemModulesId::where('goods_item_id', $id)
            ->orderBy('id', 'asc')
            ->first();

        $first_goods_modules = null;
        $first_goods_modules_without_lang = null;

        if (!is_null($first_goods_modules_id)) {
            $first_goods_modules = GoodsItemModules::where('goods_item_modules_id', $first_goods_modules_id->id)
                ->where('lang_id', $edited_lang_id)
                ->first();

            $first_goods_modules_without_lang = GoodsItemModules::where('goods_item_modules_id', $first_goods_modules_id->id)
                ->first();
        }

        $goods_modules_id = GoodsItemModulesId::where('goods_item_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        $goods_modules = [];
        if (!$goods_modules_id->isEmpty()) {
            foreach ($goods_modules_id as $key => $one_goods_modules_id) {
                $goods_modules[$key] = GoodsItemModules::where('goods_item_modules_id', $one_goods_modules_id->id)
                    ->first();
            }

            $goods_modules = array_filter($goods_modules);

        }

        $goods_items_for_set = GoodsItemId::whereRaw('goods_subject_id IN(SELECT id FROM goods_subject_id WHERE active=1 AND deleted=0 AND alias="jaluze")')
            ->where('active', 1)
            ->where('deleted', 0)
            ->where('goods_set', 0)
            ->join('goods_item', 'goods_item.goods_item_id', '=', 'goods_item_id.id')
            ->where('lang_id', $lang_id)
            ->orderBy('position', 'asc')
            ->get();

        //$goods_set = GoodsItemIdSet::where('goods_item_id', $goods_elems->id)->get();

        $colors_list = GoodsColorsId::join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->where('lang_id', $lang_id)
            ->get();

        $colors_checked = GoodsItemColors::where('goods_item_id', $id)
            ->get();
        $check_array = [];
        if (!empty($colors_checked)) {
            foreach ($colors_checked as $one_check) {
                array_push($check_array, $one_check->goods_colors_id);
            }
        }

        $goods_recomendet = GoodsItemId::whereRaw('goods_subject_id IN(SELECT id FROM goods_subject_id WHERE deleted=0)')
            ->where('active', 1)
            ->where('deleted', 0)
            ->where('goods_set', 0)
            ->join('goods_item', 'goods_item.goods_item_id', '=', 'goods_item_id.id')
            ->where('lang_id', $lang_id)
            ->orderBy('position', 'asc')
            ->get();

        return view($view, get_defined_vars());
    }

    public function saveItem($id, $updated_lang_id)
    {

        if (is_null($id)) {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:goods_item_id',
                'sku' => 'required|unique:goods_item_id',
            ]);
        } else {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => ['required', Rule::unique('goods_item_id')->ignore($id)],
                'sku' => ['required', Rule::unique('goods_item_id')->ignore($id)]
            ]);
        }

        if ($item->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $recomend = Input::get('recomend');

        if (!empty($recomend)) {
            $recomend = implode(',', $recomend);
        }

        $maxPosition = GetMaxPosition('goods_item_id');

        if (!empty(Input::get('add_date'))) {
            $add_date = date('Y-m-d', strtotime(Input::get('add_date')));
        } else {
            $add_date = date('Y-m-d');
        }

//        Check if lang exist
        if (checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        $p_id_other = !is_null(Input::get('p_id_other')) ? implode(', ', Input::get('p_id_other')) : '';

        if ($maxPosition > 1000) {
            $maxPosition = $maxPosition / 100;
        }

        if (!empty($p_id_other))
            $maxPosition = $maxPosition * 100;

        if (is_null($id)) {
            $data = [
                'p_id_other' => $p_id_other,
                'goods_subject_id' => Input::get('p_id'),
                'alias' => Input::get('alias'),
                'sku' => Input::get('sku'),
                'position' => $maxPosition + 1,
                'active' => 1,
                'deleted' => 0,
                'show_on_main' => Input::get('show_on_main') == 'on' ? 1 : 0,
                'popular_element' => Input::get('popular_element') == 'on' ? 1 : 0,
                'new_element' => Input::get('new_element') == 'on' ? 1 : 0,
                'goods_set' => Input::get('goods_set') == 'on' ? 1 : 0,
                'price' => Input::get('price'),
                'weight' => Input::get('weight'),
                'complect' => Input::get('complect'),
                'recomend' => !empty($recomend) ? $recomend : '',
//                'brand_id' => Input::get('brand_id'),
//                'one_c_code' => Input::get('one_c_code'),
                'add_date' => $add_date,
            ];

            $item_id = GoodsItemId::create($data);


            $data = [
                'goods_item_id' => $item_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'short_descr' => !is_null(Input::get('short_descr')) ? Input::get('short_descr') : '',
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ];

            GoodsItem::create($data);

//            Modules
            if (!empty(Input::get('module_title')) || !empty(Input::get('content'))) {

                foreach (Input::get('content') as $key => $one_content) {
                    $maxPositionModule = GetMaxPosition('goods_item_modules_id');

                    $data = [
                        'position' => $maxPositionModule + 1,
                        'goods_item_id' => $item_id->id
                    ];

                    $goods_item_modules_id = GoodsItemModulesId::create($data);

                    $data = [
                        'goods_item_modules_id' => $goods_item_modules_id->id,
                        'lang_id' => Input::get('lang'),
                        'name' => !is_null(Input::get('module_title')[$key]) ? Input::get('module_title')[$key] : '',
                        'body' => !is_null($one_content) ? $one_content : '',
                    ];

                    GoodsItemModules::create($data);
                }

            }
//            Modules

            //Goods parameter item id
            $goods_parameter_id = GoodsParametrId::where('goods_subject_id', Input::get('p_id'))
                ->where('deleted', 0)
                ->where('active', 1)
                ->orderBy('position', 'asc')
                ->groupBy('id')
                ->get();

            if (!$goods_parameter_id->isEmpty()) {

                foreach ($goods_parameter_id as $one_parameter_id) {

                    $data = [
                        'goods_item_id' => $item_id->id,
                        'goods_parametr_id' => $one_parameter_id->goods_parametr_id
                    ];


                    $goods_parametr_item_id = GoodsParametrItemId::create($data);

                    switch ($one_parameter_id->parametr_type) {
                        case 'textarea':
                            $data = [
                                'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                'lang_id' => Input::get('lang'),
                                'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                            ];

                            GoodsParametrItemSimple::create($data);
                            break;

                        case 'input':
                            switch ($one_parameter_id->measure_type) {
                                case 'no_measure':
                                    $data = [
                                        'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                        'lang_id' => Input::get('lang'),
                                        'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                    ];

                                    GoodsParametrItemSimple::create($data);
                                    break;

                                case 'with_measure':
                                    $data = [
                                        'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                        'goods_measure_id' => 0,
                                        'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                    ];

                                    GoodsParametrItemMeasure::create($data);
                                    break;

                                case 'measure_list':
                                    $data = [
                                        'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                        'goods_measure_id' => Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_measure_id'],
                                        'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                    ];

                                    GoodsParametrItemMeasure::create($data);
                                    break;

                                default:
                                    break;
                            }
                            break;

                        case 'radio':
                        case 'select':
                            $data = [
                                'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                'goods_parametr_value_id' => Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'],
                            ];

                            GoodsParametrItemRsc::create($data);
                            break;

                        case 'checkbox':
                            if (!is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'])) {
                                foreach (Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'] as $pv) {
                                    $data = [
                                        'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                        'goods_parametr_value_id' => $pv,
                                    ];

                                    GoodsParametrItemRsc::create($data);
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
            }

            //Goods set

            if (Input::get('goods_set') == 'on') {
                for ($i = 1; $i <= 2; $i++) {
                    if (!empty(Input::get('set_item_' . $i)) && !empty(Input::get('set_item_numb_' . $i)) && !empty($item_id)) {
                        $set_data = [
                            'goods_item_id' => $item_id->id,
                            'set_goods_item_id' => Input::get('set_item_' . $i),
                            'set_items_number' => Input::get('set_item_numb_' . $i)
                        ];

                        GoodsItemIdSet::create($set_data);
                    }
                }
            }

            //goods colors
            if (!empty(Input::get('goods_colors_id'))) {

                foreach (Input::get('goods_colors_id') as $one_color) {

                    $maxPositionColors = GetMaxPosition('goods_item_colors');

                    $data = [
                        'goods_item_id' => $item_id->id,
                        'goods_colors_id' => $one_color,
                        'position' => $maxPositionColors + 1,
                    ];

                    GoodsItemColors::create($data);
                }
            }

            //Goods parameter item id


        } else {
            $exist_item = GoodsItem::where('goods_item_id', $id)->first();
            $exist_item_id = GoodsItemId::where('id', $id)->first();

            if (is_null($exist_item)) {
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if (checkIfAliasExist($exist_item->goods_item_id, Input::get('alias'), 'goods_item_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_item_by_lang = GoodsItem::where('goods_item_id', $exist_item->goods_item_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $p_id_other = !is_null(Input::get('p_id_other')) ? implode(', ', Input::get('p_id_other')) : '';


            $addedOthers = !empty($p_id_other);
            $removedOthers = empty($p_id_other);
            $hadOthers = !empty($exist_item_id->p_id_other);
            $didntHadOthers = empty($exist_item_id->p_id_other);

            if ($didntHadOthers && $addedOthers) {

                $changePosition = $exist_item_id->position * 100;

            } else if ($hadOthers && $removedOthers) {

                $changePosition = $exist_item_id->position / 100;

            } else {

                $changePosition = $exist_item_id->position;
            }

            $data = [
                'p_id_other' => $p_id_other,
                'goods_subject_id' => Input::get('p_id'),
                'position' => $changePosition,
                'alias' => Input::get('alias'),
                'sku' => Input::get('sku'),
                'show_on_main' => Input::get('show_on_main') == 'on' ? 1 : 0,
                'popular_element' => Input::get('popular_element') == 'on' ? 1 : 0,
                'new_element' => Input::get('new_element') == 'on' ? 1 : 0,
                'goods_set' => Input::get('goods_set') == 'on' ? 1 : 0,
                'price' => Input::get('price'),
                'weight' => Input::get('weight'),
                'complect' => Input::get('complect'),
                'recomend' => !empty($recomend) ? $recomend : '',
//                'brand_id' => Input::get('brand_id'),
//                'one_c_code' => Input::get('one_c_code'),
                'add_date' => $add_date,
            ];

            GoodsItemId::where('id', $exist_item->goods_item_id)
                ->update($data);


            $data = [
                'name' => Input::get('name'),
                'short_descr' => !is_null(Input::get('short_descr')) ? Input::get('short_descr') : '',
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ];

            if (!is_null($exist_item_by_lang)) {
                GoodsItem::where('goods_item_id', $exist_item->goods_item_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            } else {

                $create_data = [
                    'goods_item_id' => $exist_item->goods_item_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                GoodsItem::create($data);
            }

            //goods set

            $exist_set_items = GoodsItemIdSet::where('goods_item_id', $exist_item->goods_item_id)->get();

            if (Input::get('goods_set') == 'on') {

                if (!$exist_set_items->isEmpty()) {
                    for ($i = 0; $i < count($exist_set_items); $i++) {
                        $n = $i + 1;
                        if (!empty(Input::get('set_item_' . $n)) && !empty(Input::get('set_item_numb_' . $n))) {
                            $set_data = [
                                'set_goods_item_id' => Input::get('set_item_' . $n),
                                'set_items_number' => Input::get('set_item_numb_' . $n)
                            ];

                            GoodsItemIdSet::where('id', $exist_set_items[$i]->id)->update($set_data);
                        }
                    }
                } else {
                    for ($i = 1; $i <= 2; $i++) {
                        if (!empty(Input::get('set_item_' . $i)) && !empty(Input::get('set_item_numb_' . $i))) {
                            $set_data = [
                                'goods_item_id' => $exist_item->goods_item_id,
                                'set_goods_item_id' => Input::get('set_item_' . $i),
                                'set_items_number' => Input::get('set_item_numb_' . $i)
                            ];

                            GoodsItemIdSet::create($set_data);
                        }
                    }
                }
            } else {
                if (!empty($exist_set_items)) {
                    GoodsItemIdSet::where('goods_item_id', $exist_item->goods_item_id)->delete();
                }
            }

            //goods colors
            $goods_colors = GoodsItemColors::where('goods_item_id', $exist_item->goods_item_id)->get();

            if (!$goods_colors->isEmpty())
                GoodsItemColors::where('goods_item_id', $exist_item->goods_item_id)->delete();

            if (!empty(Input::get('goods_colors_id'))) {

                foreach (Input::get('goods_colors_id') as $one_color) {

                    $maxPositionColors = GetMaxPosition('goods_item_colors');

                    $data = [
                        'goods_item_id' => $exist_item->goods_item_id,
                        'goods_colors_id' => $one_color,
                        'position' => $maxPositionColors + 1,
                    ];

                    GoodsItemColors::create($data);
                }
            }

//            Modules

//            $exist_goods_modules_id = GoodsItemModulesId::where('goods_item_id', $id)->get();
//
//            if(!$exist_goods_modules_id->isEmpty()){
//
//                $exist_goods_modules_by_lang = [];
//                $exist_goods_modules = [];
//
//                foreach ($exist_goods_modules_id as $key => $one_exist_module) {
//                    $exist_goods_modules_by_lang[$key] = GoodsItemModules::where('goods_item_modules_id', $one_exist_module->id)
//                        ->where('lang_id', $updated_lang_id)
//                        ->first();
//                }
//                $exist_goods_modules_by_lang = array_filter($exist_goods_modules_by_lang);
//
//                foreach ($exist_goods_modules_id as $key => $one_exist_module) {
//                    $exist_goods_modules[] = GoodsItemModules::where('goods_item_modules_id', $one_exist_module->id)
//                        ->where('lang_id', '<>' , $updated_lang_id)
//                        ->first();
//                }
//                $exist_goods_modules = array_filter($exist_goods_modules);
//
//                if(!empty($exist_goods_modules_by_lang)) {
//
//                    if (!empty(array_filter(Input::get('module_title')))) {
//
//                        foreach ($exist_goods_modules_id as $one_exist_module) {
//                            GoodsItemModules::where('goods_item_modules_id', $one_exist_module->id)
//                                ->where('lang_id', $updated_lang_id)
//                                ->delete();
//                        }
//
//                        $maxPositionModule = GetMaxPosition('goods_item_modules_id');
//
//                        foreach (Input::get('module_title') as $key => $one_content) {
//                            if($key <= 0){
//
//                                $data = [
//                                    'position' => $maxPositionModule + 1,
//                                    'goods_item_id' => $exist_item->goods_item_id
//                                ];
//
//
//                                $goods_item_modules_id = GoodsItemModulesId::create($data);
//
//                                $data = [
//                                    'goods_item_modules_id' => $goods_item_modules_id->id,
//                                    'lang_id' => Input::get('lang'),
//                                    'name' => !is_null(Input::get('module_title')[$key]) ? Input::get('module_title')[$key] : '',
//                                    'body' => !is_null($one_content) ? $one_content : '',
//                                ];
//
//                            }
//                            else {
//                                $data = [
//                                    'goods_item_modules_id' => $key,
//                                    'lang_id' => Input::get('lang'),
//                                    'name' => !is_null(Input::get('module_title')[$key]) ? Input::get('module_title')[$key] : '',
//                                    'body' => !is_null($one_content) ? $one_content : '',
//                                ];
//                            }
//
//
//                            GoodsItemModules::create($data);
//                        }
//
//                    }
//                    else {
//
//                        if(empty($exist_goods_modules)) {
//                            foreach ($exist_goods_modules_id as $one_exist_module) {
//                                GoodsItemModules::where('goods_item_modules_id', $one_exist_module->id)
//                                    ->where('lang_id', $updated_lang_id)
//                                    ->delete();
//                            }
//
//                            GoodsItemModulesId::wherE('goods_item_id', $id)->delete();
//
//                        }
//                        else {
//                            foreach ($exist_goods_modules_id as $one_exist_module) {
//                                GoodsItemModules::where('goods_item_modules_id', $one_exist_module->id)
//                                    ->where('lang_id', $updated_lang_id)
//                                    ->delete();
//                            }
//                        }
//                    }
//
//                }
//                else {
//
//                    if (!empty(array_filter(Input::get('module_title')))) {
//
//                        if($exist_goods_modules_id->isEmpty()) {
//                            $maxPositionModule = GetMaxPosition('goods_item_modules_id');
//
//                            $data = [
//                                'position' => $maxPositionModule + 1,
//                                'goods_item_id' => $exist_item->goods_item_id
//                            ];
//
//
//                            $goods_item_modules_id = GoodsItemModulesId::create($data);
//
//                            foreach (Input::get('content') as $key => $one_content) {
//
//                                $data = [
//                                    'goods_item_modules_id' => $goods_item_modules_id->id,
//                                    'lang_id' => Input::get('lang'),
//                                    'name' => !is_null(Input::get('module_title')[$goods_item_modules_id->id]) ? Input::get('module_title')[$goods_item_modules_id->id] : '',
//                                    'body' => !is_null($one_content) ? $one_content : '',
//                                ];
//
//                                GoodsItemModules::create($data);
//                            }
//                        }
//                        else {
//
//                            foreach (Input::get('content') as $key => $one_content) {
//
//                                $data = [
//                                    'goods_item_modules_id' => $key,
//                                    'lang_id' => Input::get('lang'),
//                                    'name' => !is_null(Input::get('module_title')[$key]) ? Input::get('module_title')[$key] : '',
//                                    'body' => !is_null($one_content) ? $one_content : '',
//                                ];
//
//                                GoodsItemModules::create($data);
//                            }
//                        }
//
//                    }
//                    else {
//
//                        if(empty($exist_goods_modules)) {
//                            foreach ($exist_goods_modules_id as $one_exist_module) {
//                                GoodsItemModules::where('goods_item_modules_id', $one_exist_module->id)->delete();
//                            }
//
//                            GoodsItemModulesId::wherE('goods_item_id', $id)->delete();
//
//                        }
//                        else {
//                            foreach ($exist_goods_modules_id as $one_exist_module) {
//                                GoodsItemModules::where('goods_item_modules_id', $one_exist_module->id)
//                                    ->where('lang_id', $updated_lang_id)
//                                    ->delete();
//                            }
//                        }
//                    }
//                }
//
//            }
//            else {
//                if (!empty(array_filter(Input::get('module_title')))) {
//
//                    $maxPositionModule = GetMaxPosition('goods_item_modules_id');
//
//                    foreach(Input::get('content') as $key => $one_content){
//
//                        $data = [
//                            'position' => $maxPositionModule + 1,
//                            'goods_item_id' => $exist_item->goods_item_id
//                        ];
//
//                        $goods_item_modules_id = GoodsItemModulesId::create($data);
//
//                        $data = [
//                            'goods_item_modules_id' => $goods_item_modules_id->id,
//                            'lang_id' => Input::get('lang'),
//                            'name' => !is_null(Input::get('module_title')[$key]) ? Input::get('module_title')[$key] : '',
//                            'body' => !is_null($one_content) ? $one_content : '',
//                        ];
//
//                        GoodsItemModules::create($data);
//                    }
//
//                }
//            }
//            Modules

            //Goods parameter item id

            $goods_parameter_id = GoodsParametrId::where('goods_subject_id', Input::get('p_id'))
                ->join('goods_parametr', 'goods_parametr.goods_parametr_id', '=', 'goods_parametr_id.id')
                ->where('deleted', 0)
                ->where('active', 1)
                ->orderBy('position', 'asc')
                ->groupBy('goods_parametr_id')
                ->get();

            $first_param_rsc = GoodsParametrItemRsc::first();

            if (!$goods_parameter_id->isEmpty()) {
                foreach ($goods_parameter_id as $one_parameter_id) {
                    $parametr_item = GoodsParametrItemId::where('goods_item_id', $exist_item->goods_item_id)
                        ->where('goods_parametr_id', $one_parameter_id->goods_parametr_id)
                        ->first();

                    if (is_null($parametr_item)) {
                        $data = [
                            'goods_item_id' => $exist_item->goods_item_id,
                            'goods_parametr_id' => $one_parameter_id->goods_parametr_id
                        ];

                        $goods_parametr_item_id = GoodsParametrItemId::create($data);
                    }

                    switch ($one_parameter_id->parametr_type) {
                        case 'textarea':

                            if (!is_null($parametr_item)) {
                                if (CheckIfExistsItemSimpleDataLang($one_parameter_id->goods_parametr_id, $exist_item->goods_item_id, $updated_lang_id)) {
                                    $data = [
                                        'goods_parametr_item_id' => $parametr_item->id,
                                        'lang_id' => Input::get('lang'),
                                        'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                    ];

                                    GoodsParametrItemSimple::where('goods_parametr_item_id', $parametr_item->id)
                                        ->where('lang_id', $updated_lang_id)
                                        ->update($data);
                                } else {
                                    $data = [
                                        'goods_parametr_item_id' => $parametr_item->id,
                                        'lang_id' => Input::get('lang'),
                                        'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                    ];

                                    GoodsParametrItemSimple::create($data);
                                }
                            } else {
                                $data = [
                                    'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                    'lang_id' => Input::get('lang'),
                                    'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                ];

                                GoodsParametrItemSimple::create($data);
                            }
                            break;

                        case 'input':
                            switch ($one_parameter_id->measure_type) {
                                case 'no_measure':
                                    if (!is_null($parametr_item)) {
                                        if (CheckIfExistsItemSimpleDataLang($one_parameter_id->goods_parametr_id, $exist_item->goods_item_id, $updated_lang_id)) {
                                            $data = [
                                                'goods_parametr_item_id' => $parametr_item->id,
                                                'lang_id' => Input::get('lang'),
                                                'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                            ];

                                            GoodsParametrItemSimple::where('goods_parametr_item_id', $parametr_item->id)
                                                ->where('lang_id', $updated_lang_id)
                                                ->update($data);
                                        } else {
                                            $data = [
                                                'goods_parametr_item_id' => $parametr_item->id,
                                                'lang_id' => Input::get('lang'),
                                                'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                            ];

                                            GoodsParametrItemSimple::create($data);
                                        }
                                    } else {
                                        $data = [
                                            'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                            'lang_id' => Input::get('lang'),
                                            'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                        ];

                                        GoodsParametrItemSimple::create($data);
                                    }
                                    break;

                                case 'with_measure':
                                    if (!is_null($parametr_item)) {
                                        $data = [
                                            'goods_parametr_item_id' => $parametr_item->id,
                                            'goods_measure_id' => 0,
                                            'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                        ];

                                        GoodsParametrItemMeasure::where('goods_parametr_item_id', $parametr_item->id)
                                            ->update($data);
                                    } else {
                                        $data = [
                                            'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                            'goods_measure_id' => 0,
                                            'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                        ];

                                        GoodsParametrItemMeasure::create($data);
                                    }
                                    break;

                                case 'measure_list':
                                    if (!is_null($parametr_item)) {
                                        $data = [
                                            'goods_parametr_item_id' => $parametr_item->id,
                                            'goods_measure_id' => Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_measure_id'],
                                            'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                        ];

                                        GoodsParametrItemMeasure::where('goods_parametr_item_id', $parametr_item->id)
                                            ->update($data);
                                    } else {
                                        $data = [
                                            'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                            'goods_measure_id' => Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_measure_id'],
                                            'parametr_value' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['parametr_value'] : ''
                                        ];

                                        GoodsParametrItemMeasure::create($data);
                                    }
                                    break;

                                default:
                                    break;
                            }
                            break;

                        case 'radio':
                        case 'select':
                            if (!is_null($parametr_item)) {
                                $goods_parameter_item_rsc = GoodsParametrItemRsc::where('goods_parametr_item_id', $parametr_item->id)->first();

                                $data = [
                                    'goods_parametr_item_id' => $parametr_item->id,
                                    'goods_parametr_value_id' => Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'],
                                ];

                                if (!is_null($goods_parameter_item_rsc)) {

                                    GoodsParametrItemRsc::where('goods_parametr_item_id', $parametr_item->id)
                                        ->update($data);

                                } else {

                                    GoodsParametrItemRsc::create($data);
                                }
                            } else {
                                $data = [
                                    'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                    'goods_parametr_value_id' => !is_null(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id']) ? Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'] : $first_param_rsc->goods_parametr_value_id,
                                ];

                                GoodsParametrItemRsc::create($data);

                            }
                            break;

                        case 'checkbox':
                            if (!is_null($parametr_item)) {
                                GoodsParametrItemRsc::where('goods_parametr_item_id', $parametr_item->id)->delete();

                                if (!empty(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'])) {
                                    foreach (Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'] as $pv) {
                                        $data = [
                                            'goods_parametr_item_id' => $parametr_item->id,
                                            'goods_parametr_value_id' => $pv,
                                        ];

                                        GoodsParametrItemRsc::create($data);
                                    }
                                }
                            } else {
                                if (!empty(Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'])) {
                                    foreach (Input::get('parametr_' . $one_parameter_id->goods_parametr_id)['goods_parametr_value_id'] as $pv) {
                                        $data = [
                                            'goods_parametr_item_id' => $goods_parametr_item_id->id,
                                            'goods_parametr_value_id' => $pv,
                                        ];

                                        GoodsParametrItemRsc::create($data);
                                    }
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
            //Goods parameter item id
        }

        if (is_null($id)) {
            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.save', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'memberslist')
            ]);
        }
        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.updated_text', $this->lang)],
            'redirect' => urlForLanguage($this->lang, 'editgoodsitem/' . $id . '/' . $updated_lang_id)
        ]);
    }

    public function goodsItemCart()
    {
        $view = 'admin.goods.item-cart';

        $lang_id = $this->lang_id;

        $deleted_elems_by_alias = GoodsSubjectId::where('alias', Request::segment(4))
            ->first();

        $deleted_item_id_elems = [];
        if (!is_null($deleted_elems_by_alias))
            $deleted_item_id_elems = GoodsItemId::where('deleted', 1)
                ->where('active', 0)
                ->where('goods_subject_id', $deleted_elems_by_alias->id)
                ->get();

        $deleted_item_elems = [];
        if (!empty($deleted_item_id_elems)) {
            foreach ($deleted_item_id_elems as $key => $one_deleted_item_elem) {
                $deleted_item_elems[$key] = GoodsItem::where('goods_item_id', $one_deleted_item_elem->id)
                    ->first();
            }
        }

        $deleted_item_elems = array_filter($deleted_item_elems, 'strlen');

        return view($view, get_defined_vars());
    }

    public function destroyGoodsItemFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $goods_item_elems_id = GoodsItemId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$goods_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($goods_item_elems_id as $one_goods_item_elems_id) {
                    if ($one_goods_item_elems_id->deleted == 1 && $one_goods_item_elems_id->active == 0) {
                        $goods_photo = GoodsPhoto::where('goods_item_id', $one_goods_item_elems_id->id)->get();
                        if (!is_null($goods_photo)) {
                            foreach ($goods_photo as $one_goods_photo) {
                                if (File::exists('upfiles/gallery/s/' . $one_goods_photo->img))
                                    File::delete('upfiles/gallery/s/' . $one_goods_photo->img);

                                if (File::exists('upfiles/gallery/m/' . $one_goods_photo->img))
                                    File::delete('upfiles/gallery/m/' . $one_goods_photo->img);

                                if (File::exists('upfiles/gallery/' . $one_goods_photo->img))
                                    File::delete('upfiles/gallery/' . $one_goods_photo->img);
                            }
                        }

                        $goods_item_elems = GoodsItem::where('goods_item_id', $one_goods_item_elems_id->id)
                            ->first();

                        $del_message .= $goods_item_elems->name . ', ';

                        GoodsItemId::destroy($one_goods_item_elems_id->id);
                        GoodsItem::where('goods_item_id', $one_goods_item_elems_id->id)->delete();

                        GoodsItemIdSet::where('goods_item_id', $one_goods_item_elems_id->id)->delete();

                        GoodsItemColors::where('goods_item_id', $one_goods_item_elems_id->id)->delete();

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

    public function destroyGoodsItemToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $goods_item_elems_id = GoodsItemId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$goods_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($goods_item_elems_id as $one_goods_item_elems_id) {

                    if ($one_goods_item_elems_id->deleted == 0) {
                        $goods_item_elems = GoodsItem::where('goods_item_id', $one_goods_item_elems_id->id)
                            ->where('lang_id', $lang_id)
                            ->first();

                        $cart_message .= $goods_item_elems->name . ', ';

                        GoodsItemId::where('id', $one_goods_item_elems_id->id)
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

    public function restoreGoodsItem()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $goods_item_elems_id = GoodsItemId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$goods_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($goods_item_elems_id as $one_goods_item_elems_id) {

                    $goods_name = GetNameByLang($one_goods_item_elems_id->id, $this->lang_id, 'GoodsItem', 'goods_item_id');

                    if ($one_goods_item_elems_id->restored == 0) {

                        $cart_message .= $goods_name . ', ';

                        GoodsItemId::where('id', $one_goods_item_elems_id->id)
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

    public function itemsPhoto($id)
    {
        $view = 'admin.goods.items-photo';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $goods_item = GoodsItem::where('goods_item_id', $id)->first();

        if (is_null($goods_item)) {
            return App::abort(503, 'Unauthorized action.');
        }

        if (!is_null($goods_item)) {
            $goods_item_id = GoodsItemId::where('id', $goods_item->goods_item_id)->first();

            $goods_photo = GoodsPhoto::where('goods_item_id', $goods_item->goods_item_id)
                ->orderBy('position', 'asc')
                ->get();
        }

        return view($view, get_defined_vars());
    }

    public function itemsSize($id)
    {
        $view = 'admin.goods.items-size';

        $lang = $this->lang;
        $lang_id = $this->lang_id;

        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $goods_item = GoodsItem::where('goods_item_id', $id)->first();

        if (is_null($goods_item)) {
            return App::abort(503, 'Unauthorized action.');
        }

        $parentColors = GoodsItemColors::where('goods_item_id', $id)
            ->get();

        $colors_checked = GoodsItemColors::where('goods_item_id', $id)
            ->get()
            ->keyBy('goods_colors_id')
            ->keys();

        $colors_list = GoodsColors::whereIn('goods_colors_id', $colors_checked)
            ->where('lang_id', $lang_id)
            ->get();



        if (!is_null($goods_item)) {
            $goods_item_id = GoodsItemId::where('id', $goods_item->goods_item_id)->first();

            // dd($goods_item_id);

            $goods_size = GoodsSize::where('goods_item_id', $goods_item->goods_item_id)
                ->orderBy('position', 'asc')
                ->get();
//            dd($goods_size);
        }
        return view($view, get_defined_vars());
    }

    public function saveItemSize(Httprequest $request)
    {


        $validator = Validator::make($request->all(), [
            'sku' => ['required', Rule::unique('goods_size')->ignore($request->get('id'))]
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);


        $data = $request->all();
        $files = $request->file();

        $fileName = null;

        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $fileName = md5(time()) . rand(11111111, 99999999) . '.' . $extension;

            switch (strtolower($file->getClientOriginalExtension())) {
                case 'jpg':
                case 'png':
                case 'jpeg': {
                    $destinationPath = 'upfiles/size/';
                    break;
                }
                default : {
                    return response()->json([
                        'status' => false,
                        'messages' => controllerTrans('variables.invalid_img_format', $this->lang)
                    ]);
                    break;
                }
            }

            $file->move($destinationPath, $fileName);
        }

        $id = isset($data['id']) ? $data['id'] : null;


        if($fileName)
            $data['img'] = $fileName;

        if(isset($data['colors']))
            $data['colors'] = implode(', ', $data['colors']);


        if( $id ){
            $size = GoodsSize::where('id', $id)->update($data);
            $reload = false;
        }
        else {
            $size = GoodsSize::create($data);
            $reload = true;
        }

        return response()->json([
            'status' => true,
            'messages' => controllerTrans('variables.save', $this->lang),
            'size' => $size,
            'reload' => $reload,
        ]);


    }

    public function destroyGoodsPhoto()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $goods_photo = GoodsPhoto::whereIn('id', $deleted_elements_id_arr)
                ->get();

            if (!$goods_photo->isEmpty()) {
                foreach ($goods_photo as $one_goods_photo) {
                    if (File::exists('upfiles/gallery/s/' . $one_goods_photo->img))
                        File::delete('upfiles/gallery/s/' . $one_goods_photo->img);

                    if (File::exists('upfiles/gallery/m/' . $one_goods_photo->img))
                        File::delete('upfiles/gallery/m/' . $one_goods_photo->img);

                    if (File::exists('upfiles/gallery/' . $one_goods_photo->img))
                        File::delete('upfiles/gallery/' . $one_goods_photo->img);

                    GoodsPhoto::destroy($one_goods_photo->id);
                }

                $del_message = controllerTrans('variables.the_photos', $this->lang) . ' ' . controllerTrans('variables.success_deleted', $this->lang);

                return response()->json([
                    'status' => true,
                    'del_messages' => $del_message,
                    'deleted_elements' => $deleted_elements_id_arr
                ]);
            }

            return response()->json([
                'status' => false
            ]);
        }

        return response()->json([
            'status' => false
        ]);

    }

    public function destroyGoodsSize()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $goods_size = GoodsSize::whereIn('id', $deleted_elements_id_arr)
                ->get();

            if (!$goods_size->isEmpty()) {
                foreach ($goods_size as $one_goods_size) {

                    GoodsSize::destroy($one_goods_size->id);
                }

                $del_message = controllerTrans('variables.the_photos', $this->lang) . ' ' . controllerTrans('variables.success_deleted', $this->lang);

                return response()->json([
                    'status' => true,
                    'del_messages' => $del_message,
                    'deleted_elements' => $deleted_elements_id_arr
                ]);
            }

            return response()->json([
                'status' => false
            ]);
        }

        return response()->json([
            'status' => false
        ]);

    }

    /**
     * Parameters
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsParameters($id)
    {
        $view = 'admin.parameters.parameters-list';

        $lang_id = $this->lang_id;
        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $goods_subject_id = GoodsSubjectId::find($id);

        if (is_null($goods_subject_id)) {
            return App::abort(503, 'Unauthorized action.');
        }

        $goods_parameter_id = GoodsParametrId::where('goods_subject_id', $id)
            ->where('deleted', 0)
            ->orderBy('position', 'asc')
            ->get();

        if (!empty($goods_parameter_id)) {
            $goods_parameter = [];

            foreach ($goods_parameter_id as $key => $one_goods_parameter_id) {
                $goods_parameter[$key] = GoodsParametr::where('goods_parametr_id', $one_goods_parameter_id->id)
                    ->first();
            }

            $goods_parameter = array_filter($goods_parameter);

        } else {
            $goods_parameter = [];
        }

        return view($view, get_defined_vars());
    }

    public function createGoodsParameter($subject_id)
    {
        $view = 'admin.parameters.create-parameter';
        $lang_id = $this->lang_id;

        $goods_subject_id = GoodsSubjectId::findOrFail($subject_id);

        $measure_id = GoodsMeasureId::where('active', 1)
            ->orderBy('position', 'asc')
            ->get();

        $measure = [];

        foreach ($measure_id as $key => $one_measure_id) {
            $measure[$key] = GoodsMeasure::where('goods_measure_id', $one_measure_id->id)
                ->where('lang_id', $lang_id)
                ->first();
        }

        $measure = array_filter($measure);

        return view($view, get_defined_vars());
    }

    public function editGoodsParameter($id, $edited_lang_id)
    {
        $view = 'admin.parameters.edit-parameter';
        $lang_id = $this->lang_id;
        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $goods_parameter_without_lang = GoodsParametr::where('goods_parametr_id', $id)->first();

        if (is_null($goods_parameter_without_lang)) {
            return App::abort(503, 'Unauthorized action.');
        }

        $goods_parametr = GoodsParametr::where('lang_id', $edited_lang_id)
            ->where('goods_parametr_id', $goods_parameter_without_lang->goods_parametr_id)
            ->first();

        if (!is_null($goods_parametr)) {
            $goods_parametr_id = GoodsParametrId::where('id', $goods_parametr->goods_parametr_id)
                ->first();
        } else {
            $goods_parametr_id = GoodsParametrId::where('id', $goods_parameter_without_lang->goods_parametr_id)
                ->first();
        }

        $goods_subject_id = GoodsSubjectId::where('id', $goods_parametr_id->goods_subject_id)->first();

        $measure_id = GoodsMeasureId::where('active', 1)
            ->orderBy('position', 'asc')
            ->get();

        $measure = [];

        foreach ($measure_id as $key => $one_measure_id) {
            $measure[$key] = GoodsMeasure::where('goods_measure_id', $one_measure_id->id)
                ->where('lang_id', $lang_id)
                ->first();
        }

        $measure = array_filter($measure);

        $measure_list = GoodsMeasureList::where('goods_parametr_id', $id)
            ->orderBy('position', 'asc')
            ->get();

        $goods_parameter_value_id = GoodsParametrValueId::where('goods_parametr_id', $id)
            ->orderBy('position', 'asc')
            ->get();

        if (!empty($goods_parameter_value_id)) {
            $goods_parameter_value = [];

            foreach ($goods_parameter_value_id as $key => $one_parameter_value_id) {
                $goods_parameter_value[$key] = GoodsParametrValue::where('goods_parametr_value_id', $one_parameter_value_id->id)
                    ->first();
            }

            $goods_parameter_value = array_filter($goods_parameter_value);
        } else {
            $goods_parameter_value = [];
        }


        return view($view, get_defined_vars());
    }

    public function saveGoodsParameter($id, $updated_lang_id)
    {

        if (is_null($id)) {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:goods_parametr_id',
            ]);
        } else {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required',
            ]);
        }

        if ($item->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $maxPosition = GetMaxPosition('goods_parametr_id');
        $maxPositionMeasureList = GetMaxPosition('goods_measure_list');

        $parametr_type_value = Input::get('parametr_type_value');
        $goods_measure_list = Input::get('goods_measure_list');

//        Check if lang exist
        if (checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if (is_null($id)) {

            //Parameter & ParameterId

            if (Input::get('measure_type') == 'with_measure') {
                $goods_measure_id = Input::get('goods_measure_id');
            } else {
                $goods_measure_id = 0;
            }

            if (Input::get('parametr_type') == 'textarea' || Input::get('parametr_type') == 'select' || Input::get('parametr_type') == 'radio' || Input::get('parametr_type') == 'checkbox') {
                $goods_measure_id = 0;
                $measure_type = '';
            } else {
                $measure_type = Input::get('measure_type');
            }

            $data = [
                'goods_subject_id' => Input::get('goods_subject_id'),
                'measure_type' => $measure_type,
                'goods_measure_id' => $goods_measure_id,
                'parametr_type' => Input::get('parametr_type'),
                'alias' => Input::get('alias'),
                'position' => $maxPosition + 1,
                'active' => Input::get('active') == 'on' ? 1 : 0,
                'deleted' => 0,
                'show_in_list' => Input::get('show_in_list') == 'on' ? 1 : 0,
                'font_for_list' => Input::get('font_for_list') or '',
                'display_on_list_page' => Input::get('display_on_list_page') == 'on' ? 1 : 0,
                'start_open' => Input::get('start_open') == 'on' ? 1 : 0,
                'display_in_line' => Input::get('display_in_line') == 'on' ? 1 : 0,
            ];

            $parameter_id = GoodsParametrId::create($data);

            $data = [
                'goods_parametr_id' => $parameter_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
            ];

            GoodsParametr::create($data);

            //Parameter & ParameterId

            //ParameterValue & ParameterValueId

            if (Input::get('parametr_type') == 'select' || Input::get('parametr_type') == 'radio' || Input::get('parametr_type') == 'checkbox') {

                foreach ($parametr_type_value as $key => $one_parameter_val) {
                    $maxPositionGoodsParameter = GetMaxPosition('goods_parametr_value_id');

                    $data = [
                        'goods_parametr_id' => $parameter_id->id,
                        'position' => $maxPositionGoodsParameter + 1,
                        'active' => 1
                    ];

                    $goods_parameter_value_id = GoodsParametrValueId::create($data);


                    $data = [
                        'goods_parametr_value_id' => $goods_parameter_value_id->id,
                        'lang_id' => Input::get('lang'),
                        'name' => $one_parameter_val,
                    ];

                    GoodsParametrValue::create($data);
                }

            }

            if (Input::get('measure_type') == 'measure_list') {
                foreach ($goods_measure_list as $key => $one_goods_measure_id) {
                    $arr['goods_measure_id'] = $one_goods_measure_id;

                    $data = [
                        'goods_parametr_id' => $parameter_id->id,
                        'goods_measure_id' => $one_goods_measure_id,
                        'position' => $maxPositionMeasureList + 1
                    ];

                    GoodsMeasureList::create($data);
                }
            }

            //ParameterValue & ParameterValueId

        } else {
            $exist_parameter = GoodsParametr::where('goods_parametr_id', $id)->first();

            if (is_null($exist_parameter)) {
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if (checkIfAliasExist($exist_parameter->goods_parametr_id, Input::get('alias'), 'goods_parametr_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $exist_parameter_by_lang = GoodsParametr::where('goods_parametr_id', $exist_parameter->goods_parametr_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            //Parameter & ParameterId

            if (Input::get('measure_type') == 'with_measure') {
                $goods_measure_id = Input::get('goods_measure_id');
            } else {
                $goods_measure_id = 0;
            }

            if ($exist_parameter->parametrId->parametr_type == 'textarea' || $exist_parameter->parametrId->parametr_type == 'select' || $exist_parameter->parametrId->parametr_type == 'radio' || $exist_parameter->parametrId->parametr_type == 'checkbox') {
                $goods_measure_id = 0;
                $measure_type = '';
            } else {
                $measure_type = Input::get('measure_type');
            }

            $data = [
                'goods_subject_id' => Input::get('goods_subject_id'),
                'measure_type' => $measure_type,
                'goods_measure_id' => $goods_measure_id,
                'parametr_type' => $exist_parameter->parametrId->parametr_type,
                'alias' => Input::get('alias'),
                'active' => Input::get('active') == 'on' ? 1 : 0,
                'show_in_list' => Input::get('show_in_list') == 'on' ? 1 : 0,
                'font_for_list' => Input::get('font_for_list') or '',
                'display_on_list_page' => Input::get('display_on_list_page') == 'on' ? 1 : 0,
                'start_open' => Input::get('start_open') == 'on' ? 1 : 0,
                'display_in_line' => Input::get('display_in_line') == 'on' ? 1 : 0,
            ];

            GoodsParametrId::where('id', $exist_parameter->goods_parametr_id)
                ->update($data);

            $data = [
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
            ];

            if (!is_null($exist_parameter_by_lang)) {
                GoodsParametr::where('goods_parametr_id', $exist_parameter->goods_parametr_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            } else {

                $create_data = [
                    'goods_parametr_id' => $exist_parameter->goods_parametr_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                GoodsParametr::create($data);
            }

            //Parameter & ParameterId

            //ParameterValue & ParameterValueId

            if ($exist_parameter->parametrId->parametr_type == 'textarea' || $exist_parameter->parametrId->parametr_type == 'select' || $exist_parameter->parametrId->parametr_type == 'radio' || $exist_parameter->parametrId->parametr_type == 'checkbox') {
                if (!is_null($parametr_type_value)) {
                    foreach ($parametr_type_value as $one_parameter_id => $one_parameter_val) {
                        if ($one_parameter_id < 0) {
                            $maxPositionGoodsParameter = GetMaxPosition('goods_parametr_value_id');
                            $data = [
                                'goods_parametr_id' => $id,
                                'position' => $maxPositionGoodsParameter + 1,
                                'active' => Input::get('active') == 'on' ? 1 : 0
                            ];

                            $goods_parameter_value_id = GoodsParametrValueId::create($data);

                            $data = [
                                'goods_parametr_value_id' => $goods_parameter_value_id->id,
                                'lang_id' => Input::get('lang'),
                                'name' => $one_parameter_val,
                            ];

                            GoodsParametrValue::create($data);
                        } else {
                            $data = [
                                'goods_parametr_value_id' => $one_parameter_id,
                                'lang_id' => Input::get('lang'),
                                'name' => $one_parameter_val,
                            ];

                            $exist_parameter_value_by_lang = GoodsParametrValue::where('goods_parametr_value_id', $one_parameter_id)
                                ->where('lang_id', $updated_lang_id)
                                ->get();

                            if ($exist_parameter_value_by_lang->isEmpty()) {
                                GoodsParametrValue::create($data);
                            } else {
                                GoodsParametrValue::where('goods_parametr_value_id', $one_parameter_id)
                                    ->where('lang_id', $updated_lang_id)
                                    ->update($data);
                            }
                        }
                    }
                }
            }

            if ($exist_parameter->parametrId->measure_type == 'measure_list') {
                if (!is_null($goods_measure_list)) {
                    foreach ($goods_measure_list as $one_goods_measure_id => $one_goods_measure_val) {
                        if ($one_goods_measure_id < 0) {
                            $maxPositionMeasureList = GetMaxPosition('goods_measure_list');

                            $data = [
                                'goods_parametr_id' => $exist_parameter->goods_parametr_id,
                                'goods_measure_id' => $one_goods_measure_val,
                                'position' => $maxPositionMeasureList + 1
                            ];

                            GoodsMeasureList::create($data);

                        } else {
                            $data = [
                                'goods_parametr_id' => $exist_parameter->goods_parametr_id,
                                'goods_measure_id' => $one_goods_measure_val,
                            ];

                            $exist_measure_list = GoodsMeasureList::where('id', $one_goods_measure_id)->first();
                            if (!is_null($exist_measure_list)) {
                                GoodsMeasureList::where('id', $exist_measure_list->id)
                                    ->update($data);
                            }
                        }
                    }
                }
            }
            //ParameterValue & ParameterValueId
        }

        if (is_null($id)) {
            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.save', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'goodsparameters/' . Input::get('goods_subject_id'))
            ]);
        }

        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.updated_text', $this->lang)],
            'redirect' => urlForLanguage($this->lang, 'editgoodsparameter/' . $id . '/' . $updated_lang_id)
        ]);

    }

    public function goodsParameterCart($subject_id)
    {
        $view = 'admin.parameters.parameter-cart';

        $lang_id = $this->lang_id;
        $parameter_subject_id = $subject_id;

        $deleted_parameters_id = GoodsParametrId::where('deleted', 1)
            ->where('active', 0)
            ->where('goods_subject_id', $parameter_subject_id)
            ->get();

        $deleted_parameters = [];
        foreach ($deleted_parameters_id as $key => $one_deleted_item_elem) {
            $deleted_parameters[$key] = GoodsParametr::where('goods_parametr_id', $one_deleted_item_elem->id)
                ->where('lang_id', $lang_id)
                ->first();
        }

        $deleted_parameters = array_filter($deleted_parameters, 'strlen');

        return view($view, get_defined_vars());
    }

    public function destroyGoodsParameterFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $parameter_elems_id = GoodsParametrId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$parameter_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($parameter_elems_id as $one_banner_item_elems_id) {

                    $parameter_elems = GoodsParametr::where('goods_parametr_id', $one_banner_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if (is_null($parameter_elems)) {
                        $parameter_elems = GoodsParametr::where('goods_parametr_id', $one_banner_item_elems_id->id)
                            ->first();
                    }

                    if ($one_banner_item_elems_id->deleted == 1 && $one_banner_item_elems_id->active == 0) {

                        $del_message .= $parameter_elems->name . ', ';

                        GoodsParametrId::destroy($one_banner_item_elems_id->id);
                        GoodsParametr::where('goods_parametr_id', $one_banner_item_elems_id->id)->delete();

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

    public function destroyGoodsParameterToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $parameter_elems_id = GoodsParametrId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$parameter_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($parameter_elems_id as $one_parameter_elems_id) {

                    $parameter_elems = GoodsParametr::where('goods_parametr_id', $one_parameter_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if (is_null($parameter_elems)) {
                        $parameter_elems = GoodsParametr::where('goods_parametr_id', $one_parameter_elems_id->id)
                            ->first();
                    }


                    if ($one_parameter_elems_id->deleted == 0) {

                        $cart_message .= $parameter_elems->name . ', ';

                        GoodsParametrId::where('id', $one_parameter_elems_id->id)
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

    public function restoreGoodsParameter()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $parameter_item_elems_id = GoodsParametrId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$parameter_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($parameter_item_elems_id as $one_parameter_item_elems_id) {

                    $parameter_name = GetNameByLang($one_parameter_item_elems_id->id, $this->lang_id, 'GoodsParametr', 'goods_parametr_id');

                    if ($one_parameter_item_elems_id->restored == 0) {

                        $cart_message .= $parameter_name . ', ';

                        GoodsParametrId::where('id', $one_parameter_item_elems_id->id)
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

    public function changeParameterValues()
    {
        $neworder = Input::get('neworder');
        $i = 0;
        $neworder = explode("&", $neworder);

        foreach ($neworder as $k => $v) {

            $id = str_replace("tablelistsorter_parametrvalue[]=", "", $v);

            if (!empty($id)) {
                GoodsParametrValueId::where('id', $id)->update(['position' => $i]);
                $i++;
            }
        }
    }

    public function changeMasuresList()
    {
        $neworder = Input::get('neworder');
        $i = 0;
        $neworder = explode("&", $neworder);

        foreach ($neworder as $k => $v) {

            $id = str_replace("tablelistsorter_measure[]=", "", $v);

            if (!empty($id)) {
                GoodsMeasureList::where('id', $id)->update(['position' => $i]);
                $i++;
            }
        }
    }

    public function removeParameter()
    {
        $parameter_val_id = Input::get('action');

        $count_goods_parameter_value_id = GoodsParametrValueId::where('goods_parametr_id', Input::get('param_id'))->count();

        if ($count_goods_parameter_value_id > 1) {
            GoodsParametrValue::where('goods_parametr_value_id', $parameter_val_id)->delete();
            GoodsParametrValueId::where('id', $parameter_val_id)->delete();

            return response()->json([
                'status' => true,
                'messages' => controllerTrans('variables.removed', $this->lang),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'messages' => controllerTrans('variables.min_one_elem', $this->lang),
            ]);
        }
    }

    public function removeMeasureList()
    {
        $parameter_val_id = Input::get('action');

        $count_goods_parameter_measures = GoodsMeasureList::where('goods_parametr_id', Input::get('param_id'))->count();

        if ($count_goods_parameter_measures > 2) {
            GoodsMeasureList::where('id', $parameter_val_id)->delete();
            return response()->json([
                'status' => true,
                'messages' => controllerTrans('variables.removed', $this->lang),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'messages' => controllerTrans('variables.min_two_elem', $this->lang),
            ]);
        }
    }

    public function searchObjects()

    {

        $item = Validator::make(Input::all(), [
            'id' => 'numeric|min:0',
        ]);

        if ($item->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $ajaxView = 'admin.goods.ajax-search-object';
        $search_key = Input::except('_token', 'goods_subject');
        $child_goods_item_list = [];
        $concrete_search_key = trim(Input::get('search-key'));

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->src;

        $new_url = "";
        if (!empty($search_key)) {
            foreach ($search_key as $key => $one_key) {
                if (!empty($one_key)) {
                    if (is_array($one_key)) {
                        $new_url_arr = '';
                        foreach ($one_key as $val) {
                            $new_url_arr .= $val . ',';
                        }
                        $new_url .= $key . '=[' . substr($new_url_arr, 0, -1) . ']&';
                    } else {
                        $new_url .= $key . "=" . $one_key . '&';
                    }
                }
            }

            $new_url = '?' . substr($new_url, 0, -1);

            if (!empty($concrete_search_key)) {
                $child_goods_item_list = GoodsItem::leftjoin('goods_item_id', 'goods_item_id.id', '=', 'goods_item.goods_item_id')
                    ->where('goods_item.lang_id', $this->lang_id)
                    ->where(function ($q) use ($concrete_search_key) {
                        $q->orWhere('goods_item.name', 'like', '%' . $concrete_search_key . '%');
//                        $q->orWhere('goods_item_id.one_c_code', 'like', '%' . $concrete_search_key . '%');
                    })
                    ->paginate(200);

                $child_goods_item_list->setPath(url($lang, ['back', 'goods']) . '?search-key=' . $concrete_search_key);

                if ($child_goods_item_list->isEmpty()) {
                    $child_goods_item_list = [];
                }

            }

        }

        if (!empty($child_goods_item_list)) {
            return response()->json([
                'status' => true,
                'url' => $new_url,
                'view' => view($ajaxView, compact('child_goods_item_list', 'url_for_active_elem'))->render(),
                'messages' => ''
            ]);
        } else {
            return response()->json([
                'status' => false,
                'url' => $new_url,
                'view' => view($ajaxView, compact('child_goods_item_list', 'url_for_active_elem'))->render(),
                'messages' => ''
            ]);
        }

    }

    public function globalSearchObjects($search_result)
    {
        $ajaxView = 'admin.goods.search-object';
        $child_goods_item_list = [];
        $concrete_search_key = $search_result;

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->src;

        $goods_subject_id = null;
        if (!is_null(Request::segment(4)))
            $goods_subject_id = GoodsSubjectId::where('alias', Request::segment(4))
                ->first();

        if (!empty($concrete_search_key)) {

            $child_goods_item_list = GoodsItem::leftjoin('goods_item_id', 'goods_item_id.id', '=', 'goods_item.goods_item_id')
                ->where('goods_item.lang_id', $this->lang_id)
                ->where(function ($q) use ($concrete_search_key) {
                    $q->orWhere('goods_item.name', 'like', '%' . $concrete_search_key . '%');
//                        $q->orWhere('goods_item_id.one_c_code', 'like', '%' . $concrete_search_key . '%');
                })
                ->paginate(200);

            $child_goods_item_list->setPath(url($lang, ['back', 'goods']) . '?search-key=' . $concrete_search_key);

            if ($child_goods_item_list->isEmpty()) {
                $child_goods_item_list = [];
            }

        }

        return view($ajaxView, compact('child_goods_item_list', 'url_for_active_elem', 'goods_subject_id'));
    }

    public function removeModule()
    {
        $module_id = Input::get('module_id');

        if (!is_null($module_id) || !empty($module_id)) {
            GoodsItemModulesId::destroy($module_id);
            GoodsItemModules::where('goods_item_modules_id', $module_id)->delete();

            return response()->json([
                'status' => true,
                'messages' => ['Module was deleted successful']
            ]);
        }

        return response()->json([
            'status' => false,
            'messages' => ['Ups, can\'t be deleted']
        ]);
    }
}
