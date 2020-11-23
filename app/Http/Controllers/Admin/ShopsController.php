<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityId;
use App\Models\Shops;
use App\Models\ShopsId;
use App\Models\ShopsImages;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ShopsController extends Controller
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
        $view = 'admin.shops.shops-list';

        $lang_id = $this->lang_id;

        $shops_list_id = ShopsId::orderBy('created_at', 'asc')
            ->get();

        $shops_list = [];
        foreach($shops_list_id as $key => $one_shops_id){
            $shops_list[$key] = Shops::where('shops_id' ,$one_shops_id->id)
                ->first();
        }

        $shops_list = array_filter( $shops_list);

        return view($view, get_defined_vars());
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = ShopsId::findOrFail($id);

        if(!is_null($element_id))
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Shops', 'shops_id');
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

        ShopsId::where('id', $id)->update(['active' => $change_active]);

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
                ShopsImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    public function createItem()
    {
        $view = 'admin.shops.create-shops';

        $city_id = CityId::where('active', 1)
            ->orderBy('position', 'asc')
            ->get();

        $city = [];

        if(!$city_id->isEmpty()){
            foreach($city_id as $one_city_id){
                $city[] = City::where('city_id', $one_city_id->id)
                    ->where('lang_id', $this->lang_id)
                    ->first();
            }

            $city = array_filter($city);
        }

        return view($view, get_defined_vars());
    }

    public function editItem($id, $edited_lang_id)
    {
        $view = 'admin.shops.edit-shops';

        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$this->lang.'/back/'.$modules_name->modulesId->alias;

        $shops_without_lang = Shops::where('shops_id', $id)
            ->first();

        if(is_null($shops_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $shops = Shops::where('shops_id', $shops_without_lang->shops_id)
            ->where('lang_id', $edited_lang_id)
            ->first();

        $city_id = CityId::where('active', 1)
            ->orderBy('position', 'asc')
            ->get();

        $city = [];

        if(!$city_id->isEmpty()){
            foreach($city_id as $one_city_id){
                $city[] = City::where('city_id', $one_city_id->id)
                    ->where('lang_id', $this->lang_id)
                    ->first();
            }

            $city = array_filter($city);
        }

        return view($view, get_defined_vars());
    }

    public function save($id, $updated_lang_id)
    {

        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'address' => 'required',
                'alias' => 'required|unique:shops_id',
            ]);
        }
        else {
            $item = Validator::make(Input::all(), [
                'name' => 'required',
                'address' => 'required',
                'alias' => 'required',
            ]);
        }

        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

//        Check if lang exist
        if(checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        $array_img = [];
        if(!is_null(Input::get('file')) && !empty(Input::get('file'))) {
            foreach (Input::get('file') as $item) {
                if(!is_null($item))
                    $array_img[] = basename($item);
            }
        }

        $phone = '';
        if(!empty(Input::get('phone'))) {
            $phone = implode(';', Input::get('phone'));
        }

        $schedule = '';
        if(!empty(Input::get('schedule'))) {
            $schedule = implode(';', Input::get('schedule'));
        }


        if(is_null($id)){
            $data = [
                'active' => 1,
                'alias' => Input::get('alias'),
                'city_id' => Input::get('city_id'),
                'phone' => $phone,
                'latitude' => !is_null(Input::get('latitude')) ? Input::get('latitude') : '',
                'longitude' => !is_null(Input::get('longitude')) ? Input::get('longitude') : '',
            ];

            $shops_id = ShopsId::create($data);

            $data = [
                'shops_id' => $shops_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'address' => !is_null(Input::get('address')) ? Input::get('address') : '',
                'schedule' => $schedule,
            ];

            Shops::create($data);

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img)) {
                foreach (array_reverse(Input::get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('shops_images');
                    $img = basename($item);

                    $data = [
                        'shops_id' => $shops_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    ShopsImages::create($data);
                }
            }
//            Upload images for current menu
        }
        else {
            $exist_shops = Shops::where('shops_id', $id)->first();

            $exist_shops_by_lang = Shops::where('shops_id', $exist_shops->shops_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

//            Check if alias exist
            if(checkIfAliasExist($exist_shops->shops_id, Input::get('alias'), 'shops_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist

            $data = [
                'alias' => Input::get('alias'),
                'city_id' => Input::get('city_id'),
                'phone' => $phone,
                'latitude' => !is_null(Input::get('latitude')) ? Input::get('latitude') : '',
                'longitude' => !is_null(Input::get('longitude')) ? Input::get('longitude') : '',
            ];

            ShopsId::where('id', $exist_shops->shops_id)
                ->update($data);

            $data = [
                'name' => Input::get('name'),
                'address' => !is_null(Input::get('address')) ? Input::get('address') : '',
                'schedule' => $schedule,
            ];

            if(!is_null($exist_shops_by_lang)){
                Shops::where('shops_id', $exist_shops->shops_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'shops_id' => $exist_shops->shops_id,
                    'lang_id' => Input::get('lang')
                ];

                $data = array_merge($data, $create_data);

                Shops::create($data);
            }

//            Upload images for current menu
            if(!is_null(Input::get('file')) && !empty($array_img)) {

                $exist_shops_images = ShopsImages::where('shops_id', $exist_shops->shops_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if(count($array_img) >= count($exist_shops_images)) {
                    foreach ($exist_shops_images as $exist_shops_image) {
                        $pos = array_search($exist_shops_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if(!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('shops_images');
                            $img = basename($item);

                            $data = [
                                'shops_id' => $exist_shops->shops_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            ShopsImages::create($data);
                        }
                    }
                }
                else {
                    foreach (array_reverse(Input::get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('shops_images');
                        $img = basename($item);

                        $data = [
                            'shops_id' => $exist_shops->shops_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        ShopsImages::create($data);
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
            'redirect' => urlForLanguage($this->lang, 'edititem/'.$id.'/'.$updated_lang_id)
        ]);

    }

    public function destroyShopsFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $shops_elems_id = ShopsId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$shops_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($shops_elems_id as $one_shops_elems_id) {
                    $shops = Shops::where('shops_id', $one_shops_elems_id->id)
                        ->where('lang_id', $this->lang_id)
                        ->first();

                    if(is_null($shops)) {
                        $shops = Shops::where('shops_id', $one_shops_elems_id->id)
                            ->first();
                    }

                    $shops_images = $one_shops_elems_id->moduleMultipleImg;

                    if(!is_null($shops_images) && !$shops_images->isEmpty()) {
                        foreach ($shops_images as $shops_image) {
                            if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$shops_image->img))
                                File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$shops_image->img);

                            if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$shops_image->img))
                                File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$shops_image->img);

                            if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$shops_image->img))
                                File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$shops_image->img);
                        }
                    }

                    $del_message .= $shops->name . ', ';

                    Shops::where('shops_id', $one_shops_elems_id->id)->delete();
                    ShopsId::destroy($one_shops_elems_id->id);
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

    public function removeClone()
    {

        $curr_id = Input::get('curr_id');
        $curr_element = Input::get('curr_element');
        $input_name = Input::get('input_name');
        $lang_id = Input::get('lang_id');

        $shops_id = ShopsId::find($curr_id);

        if(is_null($shops_id))
            return response()->json([
                'status' => false,
                'type' => 'error',
                'messages' => [controllerTrans('variables.item_error', $this->lang)]
            ]);


        $shops = Shops::where('shops_id', $shops_id->id)
            ->where('lang_id', $lang_id)
            ->first();

        if(is_null($shops))
            return response()->json([
                'status' => false,
                'type' => 'error',
                'messages' => [controllerTrans('variables.item_error', $this->lang)]
            ]);


        if($input_name == 'schedule') {

            $schedule_arr = explode(';', $shops->schedule);

            if(array_key_exists($curr_element, $schedule_arr))
                unset($schedule_arr[$curr_element]);

            if(count($schedule_arr) > 0) {
                $schedule = implode(';', $schedule_arr);

                Shops::where('shops_id', $shops_id->id)
                    ->where('lang_id', $lang_id)
                    ->update(['schedule' => $schedule]);
            }
            else {
                return response()->json([
                    'status' => false,
                    'type' => 'warning',
                    'messages' => [controllerTrans('variables.min_one_input', $this->lang)]
                ]);
            }

        }
        elseif($input_name == 'phone') {
            $phone_arr = explode(';', $shops_id->phone);

            if(array_key_exists($curr_element, $phone_arr))
                unset($phone_arr[$curr_element]);

            if(count($phone_arr) > 0) {
                $phone = implode(';', $phone_arr);

                ShopsId::where('id', $shops_id->id)
                    ->update(['phone' => $phone]);
            }
            else {
                return response()->json([
                    'status' => false,
                    'type' => 'warning',
                    'messages' => [controllerTrans('variables.min_one_input', $this->lang)]
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [controllerTrans('variables.item_deleted', $this->lang)]
        ]);

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