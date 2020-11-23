<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsGroups;
//use App\Models\GoodsColorsId;
use App\Models\Lang;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class GoodsGroupController extends Controller
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
        $view = 'admin.groups.group-list';

        $lang = $this->lang;
        $lang_id = Lang::where('lang',$lang)
            ->first();

        $modules_name = $this->menu()['modules_name'];

        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;


        $group_list = GoodsGroups::
        select('id', 'name', 'created_at','updated_at')
            ->groupBy('id')
            ->get();

        return view($view, get_defined_vars());
    }

    public function create()
    {
        $view = 'admin.groups.create-group';

        $group_list = GoodsGroups::all();


        return view($view, get_defined_vars());

    }

//    public function createItem()
//    {
//        $view = 'admin.groups.create-group';
//        $colors_listq = GoodsColors::all();
//        $colorewq = GoodsColorsId::all();
//        $lang = $this->lang;
//        $modules_name = $this->menu()['modules_name'];
//
//        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;
//        return view($view, get_defined_vars());
//    }
//
    public function createGroups()
    {

        $view = 'admin.groups.create-group';
        $group_list = GoodsGroups::
        select('id', 'name', 'created_at','updated_at')
            ->get();
//
//        $category_list = GoodsColorsId::
//        join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
//            ->select('goods_colors.id', 'name', 'img','lang_id','goods_colors.goods_colors_id as color_id')
//            ->groupBy('color_id')
//            ->where('p_id',1)
//            ->get();

//        dd(($group_list));

        return view($view, get_defined_vars());
    }
//
    public function editgroup($id,$lang){
        $view = 'admin.groups.edit-group-item';
        $groups_list = GoodsGroups::
        select('id', 'name')
            ->where('id',$id)
            ->first();

        $groups_lang =  GoodsGroups::
        select('id', 'name')
            ->where('id',$groups_list->id)

            ->first();

        $goods_color = GoodsGroups::where('id', $id)
            ->select('id')
            ->first();

        $edited_lang_id = $lang;
        return view($view, get_defined_vars());

    }

    public function save($id,$lang)
    {
        $item = Validator::make(Input::all(), [
            'name' => 'required'
        ]);
        if ($item->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }
        if (is_null($id)) {
            $data = [
                'name' => Input::get('name'),
            ];
            GoodsGroups::create($data);
        }
        else {

            if(!is_null($id)) {
                $goods_group = GoodsGroups::where('id', $id)
                    ->select('id')
                    ->first();
                $data = [
                    'name' => Input::get('name')
                ];
                GoodsGroups::where('id', $goods_group->id)
                    ->update($data);


//                 dd('fkcc');

            }
            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.updated_text', $this->lang)],
                'redirect' => urlForLanguage($this->lang)]);
        }
//

        if(request()->segment(5) == 'editgroups'){
            if (is_null($id)) {
                return response()->json([
                    'status' => true,
                    //                'messages' => $id,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang)
                ]);
            }
        }
        else
            if (is_null($id)) {
                return response()->json([
                    'status' => true,
                    //                'messages' => $id,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang,'groups')
                ]);
            }

    }


//    public function update()
//    {
//
//    }
//
    public function destroy()
    {
        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);
            $goods_group = GoodsGroups::whereIn('id', $deleted_elements_id_arr)->get();
            if (!$goods_group->isEmpty()) {
                $del_message = '';
                foreach ($goods_group as $one_goods_group_elems_id) {
                    $del_message .= $one_goods_group_elems_id->name . ', ';
                    GoodsGroups::destroy($one_goods_group_elems_id->id);

                }
            }

            if (!empty($del_message)) {
                $del_message = substr($del_message, 0, -2) . '<br />' . controllerTrans('variables.success_deleted', $this->lang);
            }
            return response()->json([
                'status' => true,
                'del_messages' => $del_message,
                'deleted_elements' => $deleted_elements_id_arr,
            ]);
        }
    }



}
