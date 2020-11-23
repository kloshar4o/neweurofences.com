<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\SettingsId;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class SettingsController extends Controller
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
        $view = 'admin.settings.settings-list';

        $lang_id = $this->lang_id;

        $settings_list_id = SettingsId::orderBy('id', 'asc')
            ->paginate(20);

        $settings_list = [];
        foreach($settings_list_id as $key => $one_settings_list_id){
            $settings_list[$key] = Settings::where('settings_id', $one_settings_list_id->id)
                ->first();
        }

        //Remove all null values --start
        $settings_list = array_filter( $settings_list, 'strlen' );
        //Remove all null values --end

        return view($view, get_defined_vars());
    }

    public function createItem()
    {
        $view = 'admin.settings.create-setting';


        return view($view, get_defined_vars());
    }


    public function editItem($id, $edited_lang_id)
    {
        $view = 'admin.settings.edit-setting';

        $settings_without_lang = Settings::where('settings_id', $id)
            ->first();

        if(is_null($settings_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $settings = Settings::where('settings_id', $settings_without_lang->settings_id)
            ->where('lang_id', $edited_lang_id)
            ->first();

        if(!is_null($settings_without_lang)){
            $settings_id = SettingsId::where('id', $settings_without_lang->settings_id)
                ->first();
        }
        elseif(!is_null($settings)){
            $settings_id = SettingsId::where('id', $settings->settings_id)
                ->first();
        }

        return view($view, get_defined_vars());
    }

    public function save($id, $updated_lang_id)
    {
        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'alias' => 'required|unique:settings_id'
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

        $data = array_filter([
            'alias' => Input::get('alias'),
            'set_type' => Input::get('set_type')
        ]);

//        Check if lang exist
        if(checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        $lang_id = Input::get('lang');

        if(is_null($id)){
            $settings_id = SettingsId::create($data);

            if(!empty(Input::get('body'))){
                $data = array_filter([
                    'name' => Input::get('name'),
                    'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                    'lang_id' => $lang_id,
                    'settings_id' => $settings_id->id
                ]);
            }
            elseif(!empty(Input::get('textarea'))){
                $data = array_filter([
                    'name' => Input::get('name'),
                    'body' => !is_null(Input::get('textarea')) ? Input::get('textarea') : '',
                    'lang_id' => $lang_id,
                    'settings_id' => $settings_id->id
                ]);
            }
            elseif(!empty(Input::get('input'))){
                $data = array_filter([
                    'name' => Input::get('name'),
                    'body' => !is_null(Input::get('input')) ? Input::get('input') : '',
                    'lang_id' => $lang_id,
                    'settings_id' => $settings_id->id
                ]);
            }
            else {
                $data = array_filter([
                    'name' => Input::get('name'),
                    'lang_id' => $lang_id,
                    'settings_id' => $settings_id->id
                ]);
            }

            Settings::create($data);
        }
        else {
            $settings = Settings::where('settings_id', $id)->first();

            if(is_null($settings)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($settings->settings_id, Input::get('alias'), 'settings_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            SettingsId::where('id', $settings->settings_id)
                ->update($data);

            $exist_settings_by_lang = Settings::where('settings_id', $settings->settings_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            if(!empty(Input::get('body'))){
                $data = array_filter([
                    'name' => Input::get('name'),
                    'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                    'lang_id' => $updated_lang_id,
                    'settings_id' => $settings->settings_id
                ]);
            }
            elseif(!empty(Input::get('textarea'))){
                $data = array_filter([
                    'name' => Input::get('name'),
                    'body' => Input::get('textarea'),
                    'lang_id' => $updated_lang_id,
                    'settings_id' => $settings->settings_id
                ]);
            }
            elseif(!empty(Input::get('input'))){
                $data = array_filter([
                    'name' => Input::get('name'),
                    'body' => !is_null(Input::get('input')) ? Input::get('input') : '',
                    'lang_id' => $updated_lang_id,
                    'settings_id' => $settings->settings_id
                ]);
            }
            else {
                $data = array_filter([
                    'name' => Input::get('name'),
                    'lang_id' => $updated_lang_id,
                    'settings_id' => $settings->settings_id
                ]);
            }

            if(!is_null($exist_settings_by_lang)){
                Settings::where('settings_id', $settings->settings_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else{
                Settings::create($data);
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

    public function destroySettingFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $setting_item_elems_id = SettingsId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$setting_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($setting_item_elems_id as $one_setting_item_elems_id) {

                    $setting_item_elems = Settings::where('settings_id', $one_setting_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($setting_item_elems)){
                        $setting_item_elems = Settings::where('settings_id', $one_setting_item_elems_id->id)
                            ->first();
                    }

                    $del_message .= $setting_item_elems->name . ', ';

                    SettingsId::destroy($one_setting_item_elems_id->id);
                    Settings::where('settings_id', $one_setting_item_elems_id->id)->delete();


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