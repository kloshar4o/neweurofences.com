<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsColors;
use App\Models\GoodsColorsId;
use App\Models\Lang;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class GoodsColorController extends Controller
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
        $view = 'admin.colors.colors-list';

        $lang = $this->lang;
        $lang_id = Lang::where('lang',$lang)
            ->first();

        $modules_name = $this->menu()['modules_name'];

        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $colors_list = GoodsColorsId::
        join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->select('goods_colors.id', 'name', 'img','lang_id','goods_colors.goods_colors_id as color_id')
            ->groupBy('color_id')
            ->where('p_id','!=',1)
            ->get();

        return view($view, get_defined_vars());

    }

//    public function create()
//    {
//        $view = 'admin.colors.create-colors';
//
//        $colors_list = GoodsColors::all();
//        $colorewq = GoodsColorsId::all();
//
//        return view($view, get_defined_vars());
//
//    }

    public function createItem()
    {
        $view = 'admin.colors.create-colors';
        $colors_listq = GoodsColors::all();
        $colorewq = GoodsColorsId::all();
        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];

        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;
        return view($view, get_defined_vars());
    }

    public function createColors()
    {

        $view = 'admin.colors.create-colors';
        $colors_listq = GoodsColorsId::
          join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
        ->select('goods_colors.id', 'name', 'img')
        ->get();

        $category_list = GoodsColorsId::
        join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->select('goods_colors.id', 'name', 'img','lang_id','goods_colors.goods_colors_id as color_id')
            ->groupBy('color_id')
            ->where('p_id',1)
            ->get();

//        dd(($category_list));

        return view($view, get_defined_vars());
    }

    public function editcolors($id,$lang){
        $view = 'admin.colors.edit-colors-item';
        $colors_list = GoodsColorsId::
        join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->select('goods_colors.id', 'name', 'img','lang_id','goods_colors.goods_colors_id as color_id')
            ->where('goods_colors.id',$id)
            ->first();
//        dd(($id));
        $color_lang =  GoodsColorsId::
        join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->select('goods_colors.id', 'name', 'img','lang_id','goods_colors.goods_colors_id as color_id')
            ->where('goods_colors.goods_colors_id',$colors_list->color_id)
            ->where('lang_id',$lang)
            ->first();

        $goods_color = GoodsColors::where('id', $id)
            ->select('goods_colors_id')
            ->first();
//
//        $goods_color_p_id = GoodsColors::where('id', $id)
//            ->where('p_id')
//            ->first();
//dd(($goods_color->goods_colors_id));
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
        $array_img = [];
        if (!is_null(Input::get('file')) && !empty(Input::get('file'))) {
            foreach (Input::get('file') as $item) {
                if (!is_null($item))
                    $array_img[] = basename($item);
            }
        }

//            Upload images for current menu
        if (!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img) && is_null($id))  {
            foreach (array_reverse(Input::get('file')) as $item) {
                $img = basename($item);

                $data = [
                    'img' => $img,
                ];

            }
            $color = GoodsColorsId::create($data);

            if (is_null($id)) {

                $data = [
                    'goods_colors_id' => $color->id,
                    'lang_id' => Input::get('lang'),
                    'name' => Input::get('name'),
                    'p_id' => Input::get('category'),
                ];

                GoodsColors::create($data);

            }
//            Upload images for current menu

        } else {
////
             if(!is_null($id)) {


                 $goods_color = GoodsColors::where('id', $id)
                     ->select('goods_colors_id')
                     ->first();
                 $check_if = GoodsColors::where('goods_colors_id', $goods_color->goods_colors_id)
                     ->where('lang_id', $lang)
                     ->first();
                 $colors_list = GoodsColorsId::
                 join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
                     ->select('goods_colors.id', 'name', 'img', 'goods_colors_id.id as id_colors2', 'lang_id')
                     ->where('goods_colors.id', $id)
                     ->first();
                 if (is_null($check_if)) {
                     $data = [
                         'goods_colors_id' => $goods_color->goods_colors_id,
                         'lang_id' => $lang,
                         'name' => Input::get('name')
                     ];
                     GoodsColors::create($data);
                 }
                     $color_id_list = GoodsColorsId::where('id', $colors_list->id_colors2)->first();
                     $data = [
                         'name' => Input::get('name')
                     ];
                     GoodsColors::where('goods_colors_id', $goods_color->goods_colors_id)
                         ->where('lang_id',$lang)
                         ->update($data);


                     if (!empty(Input::get('file')) && !empty($array_img)) {
//                         if (File::exists('upfiles/goods/' . $color_id_list->img))
//                             File::delete('upfiles/goods/' . $color_id_list->img);

                         //
                         foreach (array_reverse(Input::get('file')) as $item) {
                             $img = basename($item);

                             $data = [
                                 'img' => $img,
                             ];
                         }
                         GoodsColorsId::where('id', $colors_list->id_colors2)->update($data);
                     }

                 }
                 return response()->json([
                     'status' => true,
                     'messages' => [controllerTrans('variables.updated_text', $this->lang)],
                     'redirect' => urlForLanguage($this->lang)
                 ]);

        }

        if(request()->segment(5) == 'editcolors'){
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
			        'redirect' => urlForFunctionLanguage($this->lang,'color')
		        ]);
	        }


    }

    public function destroy()
    {
        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);
            $goods_colors = GoodsColors::whereIn('id', $deleted_elements_id_arr)->get();
            if (!$goods_colors->isEmpty()) {
                $del_message = '';
                foreach ($goods_colors as $one_goods_colors_elems_id) {
                    $del_message .= $one_goods_colors_elems_id->name . ', ';
                    GoodsColors::destroy($one_goods_colors_elems_id->id);
                    GoodsColorsId::destroy($one_goods_colors_elems_id->goods_colors_id);
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
