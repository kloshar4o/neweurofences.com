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

    public $alias = 'color';

    function index()
    {

        $view = 'admin.colors.colors-list';
        $blade = str_replace('.', '_', $view);
        $data = [];
        $gridData['data'] = GoodsColorsId::with('translates')->get();

        $lang_object = $this->lang();
        $currLang = $lang_object['lang_id'];
        $lang_list = $lang_object['lang_list'];

        foreach ($gridData['data'] as $color) {
            $color->url = "form/{$currLang}/{$color->id}";
            $color->name = $color->translate($currLang)->name;
            $color->lang_list = $lang_list;

            foreach ($color->lang_list as $lang_item) {
                $lang_item->url = "form/{$lang_item->id}/{$color->id}/";
                $lang_item->active = $color->hasLang($lang_item->id);
            }

        }

        $gridData['attributes'] = [
            'id' => 'id',
            'name' => myTrans('Color'),
            'ral' => 'RAL',
            'hex' => 'HEX/RGB/RGBA',

        ];

        return view('admin.colors.colors-list', get_defined_vars());
    }

    function form($lang_id, $id){

        $color = GoodsColorsId::with('translates')->find($id);

        return view('admin.colors.form', get_defined_vars());
    }

    public function createItem()
    {
        $view = 'admin.colors.create-colors';
        $colors_listq = GoodsColors::all();
        $colorewq = GoodsColorsId::all();
        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];

        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;
        return view('admin.colors.create-colors', get_defined_vars());
    }

    public function createColors()
    {

        $view = 'admin.colors.create-colors';

        $colors_listq = GoodsColorsId::

        join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->select('goods_colors.id', 'ral', 'hex', 'name', 'img')
            ->get();

        $category_list = GoodsColorsId::
        join('goods_colors', 'goods_colors_id.id', '=', 'goods_colors.goods_colors_id')
            ->select('goods_colors.id', 'name', 'img', 'lang_id', 'goods_colors.goods_colors_id as color_id')
            ->groupBy('color_id')
            ->where('p_id', 1)
            ->get();

        return view($view, get_defined_vars());
    }

    public function editcolors($id, $lang)
    {

        $view = 'admin.colors.edit-colors-item';

        $color = GoodsColors::where('id', $id)
            ->first();

        $edited_lang_id = $lang;
        return view($view, get_defined_vars());

    }

    public function save($id, $lang)
    {
        $item = Validator::make(Input::all(), [
            'ral' => 'required',
            'hex' => 'required',
            'name' => 'required'
        ]);

        if ($item->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        if (is_null($id)) {

            $color = GoodsColorsId::create([
                'structure' => Input::get('structure'),
                'position' => GoodsColorsId::max('position') + 1,
            ]);

            GoodsColors::create([
                'goods_colors_id' => $color->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'ral' => Input::get('ral'),
                'hex' => Input::get('hex'),
                'p_id' => Input::get('category'),
            ]);


        } else {

            GoodsColorsId::where('id', $id)->update([
                'structure' => Input::get('structure')
            ]);

            GoodsColors::where('id', $id)->update([
                'ral' => Input::get('ral'),
                'hex' => Input::get('hex'),
                'name' => Input::get('name')
            ]);

            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.updated_text', $this->lang)],
                'redirect' => urlForLanguage($this->lang)
            ]);

        }


        if (request()->segment(5) == 'editcolors') {
            if (is_null($id)) {
                return response()->json([
                    'status' => true,
                    //                'messages' => $id,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang)
                ]);
            }
        } else
            if (is_null($id)) {
                return response()->json([
                    'status' => true,
                    //                'messages' => $id,
                    'messages' => [controllerTrans('variables.save', $this->lang)],
                    'redirect' => urlForFunctionLanguage($this->lang, 'color')
                ]);
            }


    }

    public function update()
    {

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
