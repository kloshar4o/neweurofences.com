<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityId;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
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
        $view = 'admin.city.cities-list';

        $lang_id = $this->lang_id;

        $city_list_id = CityId::orderBy('position', 'asc')
            ->get();

        $city_list = [];
        foreach($city_list_id as $key => $one_city_id){
            $city_list[$key] = City::where('city_id' ,$one_city_id->id)
                ->first();
        }

        $city_list = array_filter( $city_list);

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
                CityId::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = CityId::findOrFail($id);

        if(!is_null($element_id))
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'City', 'city_id');
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

        CityId::where('id', $id)->update(['active' => $change_active]);

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);

    }

    public function createItem()
    {
        $view = 'admin.city.create-city';

        return view($view, get_defined_vars());
    }

    public function editItem($id, $edited_lang_id)
    {
        $view = 'admin.city.edit-city';

        $city_without_lang = City::where('city_id', $id)
            ->first();

        if(is_null($city_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $city = City::where('city_id', $city_without_lang->city_id)
            ->where('lang_id', $edited_lang_id)
            ->first();

        return view($view, get_defined_vars());
    }

    public function save($id, $updated_lang_id)
    {
        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:city_id',
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

        $maxPosition = GetMaxPosition('city_id');

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
                'alias' => Input::get('alias'),
            ];

            $city_id = CityId::create($data);

            $data = [
                'city_id' => $city_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
            ];

            City::create($data);
        }
        else {
            $exist_city = City::where('city_id', $id)->first();

            $exist_city_by_lang = City::where('city_id', $exist_city->city_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

//            Check if alias exist
            if(checkIfAliasExist($exist_city->city_id, Input::get('alias'), 'city_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $data = [
                'alias' => Input::get('alias')
            ];

            CityId::where('id', $exist_city->city_id)
                ->update($data);

            $data = [
                'name' => Input::get('name'),
            ];

            if(!is_null($exist_city_by_lang)){
                City::where('city_id', $exist_city->city_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'city_id' => $exist_city->city_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                City::create($data);
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
            'redirect' => urlForLanguage($this->lang, 'edititem/'.$id.'/'.$updated_lang_id)
        ]);

    }

    public function destroyCityFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $city_elems_id = CityId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$city_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($city_elems_id as $one_city_elems_id) {
                    $city = City::where('city_id', $one_city_elems_id->id)
                        ->where('lang_id', $this->lang_id)
                        ->first();

                    $del_message .= $city->name . ', ';

                    City::where('city_id', $one_city_elems_id->id)->delete();
                    CityId::destroy($one_city_elems_id->id);
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

    /**
     * return to another url, if method membersList does not exist
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function membersList()
    {
        return redirect(urlForFunctionLanguage($this->lang, ''));
    }


}