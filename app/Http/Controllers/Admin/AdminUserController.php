<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUserActionPermision;
use App\Models\Modules;
use App\Models\ModulesId;
use Illuminate\Support\Facades\Request;
use App\Models\AdminUserGroup;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;





class AdminUserController extends Controller
{

    private $lang;
    private $lang_id;

    public function __construct()
    {
        $this->lang = $this->lang()['lang'];
        $this->lang_id = $this->lang()['lang_id'];
    }

    public function index()
    {
        $view = 'admin.user.users-group';

        $user_group = AdminUserGroup::where('deleted', 0)
            ->where('active', 1)
            ->paginate(10);

        return view($view, get_defined_vars());
    }

    public function createItem()
    {
        $view = 'admin.user.create-group';


        return view($view, get_defined_vars());
    }

    public function createUser()
    {
        $view = 'admin.user.create-user';

        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$this->lang.'/back/'.$modules_name->modulesId->alias;

        return view($view, get_defined_vars());
    }

    public function cartItems()
    {
        $view = 'admin.user.group-cart';

        $deleted_group = AdminUserGroup::where('deleted', 1)
            ->where('active', 0)
            ->get();

        return view($view, get_defined_vars());
    }

    public function membersList()
    {
        $view = 'admin.user.users';

        $user_group_id = AdminUserGroup::where('deleted', 0)
            ->where('active', 1)
            ->where('alias', Request::segment(4))
            ->first();

        if(is_null($user_group_id)){
            return App::abort(503, 'Unauthorized action.');
        }

        $user = User::with('group')
            ->where('admin_user_group_id', $user_group_id->id)
            ->paginate(10);

        return view($view, get_defined_vars());
    }

    public function editUser($id)
    {

        $view = 'admin.user.edit-user';

        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$this->lang.'/back/'.$modules_name->modulesId->alias;

        $group = User::find($id)->group;

        $user = User::where('id', $id)->first();

        if(is_null($user)){
            return App::abort(503, 'Unauthorized action.');
        }

        if($group->alias != Request::segment(4)){
            return redirect(url($this->lang_id, ['back', 'admin_user']));
        }

        $all_group = AdminUserGroup::where('deleted', 0)
            ->where('active', 1)
            ->get();

        return view($view, get_defined_vars());

    }

    public function save($id){

        if(is_null($id)){
            $item = Validator::make(Input::all(), [
                'login' => 'required|min:3',
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:4',
                'repeat_password' => 'required|same:password',
            ]);
        }
        else {
            if(!empty(Input::get('password'))){
                $item = Validator::make(Input::all(), [
                    'login' => 'required|min:3',
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'min:4',
                    'repeat_password' => 'same:password',
                ]);
            }
            else {
                $item = Validator::make(Input::all(), [
                    'login' => 'required|min:3',
                    'name' => 'required',
                    'email' => 'required|email',
                ]);
            }
        }


        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $img = basename(Input::get('file')[0]);

        $group_id = AdminUserGroup::where('alias', Request::segment(4))
            ->where('active', 1)
            ->where('deleted', 0)
            ->first();

        if(is_null($group_id))
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.group-not-exist', $this->lang)],
            ]);

        if(is_null($id)){
            $data = array_filter([
                'login' => Input::get('login'),
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'password' => bcrypt(Input::get('password')),
                'remember_token' => Input::get('_token'),
                'admin_user_group_id' => $group_id->id,
                'img' => $img,
                'root' => 0
            ]);
        }
        else {

            if(auth()->user()->id != $id) {
//        Check if group exist

                $group_id = AdminUserGroup::where('id', Input::get('group-list'))
                    ->where('active', 1)
                    ->where('deleted', 0)
                    ->first();

                //$group_id = true;

                if (is_null($group_id))
                    return response()->json([
                        'status' => false,
                        'messages' => [controllerTrans('variables.group-not-exist', $this->lang)],
                    ]);

//        Check if group exist
            }

            if(!empty(Input::get('password'))){
                $data = array_filter([
                    'login' => Input::get('login'),
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'password' => bcrypt(Input::get('password')),
                    'remember_token' => Input::get('_token'),
                    'admin_user_group_id' => $group_id->id,
                    'img' => $img,
                    'root' => 0
                ]);
            }
            else {
                $data = array_filter([
                    'login' => Input::get('login'),
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'remember_token' => Input::get('_token'),
                    'admin_user_group_id' => $group_id->id,
                    'img' => $img,
                    'root' => 0
                ]);
            }
        }


        if(is_null($id)){

            User::create($data);

            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.save', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'memberslist')
            ]);
        }
        else {

            User::where('id', $id)->update($data);

            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.updated_text', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'edituser/'.$id)
            ]);
        }
    }

    public function editList($id)
    {
        $view = 'admin.user.edit-list';

        $group = AdminUserGroup::where('id', $id)->first();

        if(is_null($group)){
            return App::abort(503, 'Unauthorized action.');
        }

        $lang = $this->lang;


        $result = [];

        $modules_id = ModulesId::where('active', 1)
            ->where('deleted', 0)
            ->where('level', 1)
            ->orderBy('position', 'asc')
            ->get();

        $modules = [];
        if(!$modules_id->isEmpty()) {
            foreach ($modules_id as $item) {
                $modules[] = Modules::where('modules_id', $item->id)
                    ->where('lang_id', $this->lang_id)
                    ->first();
            }

            $modules = array_filter($modules);
        }

        if(!empty($modules)) {

            foreach ($modules as $keyModules => $singleModules) {
                $result[$keyModules]['modules'] = $singleModules;
                $result[$keyModules]['name'] = !empty(IfHasName($singleModules->modules_id, $this->lang_id, 'modules')) ? IfHasName($singleModules->modules_id, $this->lang_id, 'modules') : trans('variables.another_name');
                $result[$keyModules]['permission'] = $singleModules->modulesPermission;
                $result[$keyModules]['roles'] = [];

                $pretendentRole = AdminUserActionPermision::where('admin_user_group_id', $id)->get();
                foreach ($pretendentRole as $k => $roles) {
                    if ($roles)
                        $result[$keyModules]['roles'][] = $roles;
                }

            }
        }

        $child_modules = AdminUserGroup::findOrFail($id)->userPermission;
        $arr = [];
        $new = [];
        $save = [];
        $active = [];
        $del_to_rec = [];
        $del_from_rec = [];
        $moderate = [];
        foreach($child_modules as $k => $v){
            $arr[] = $v->modules_id;
            $new[] = $v->new.$v->modules_id;
            $save[] = $v->save.$v->modules_id;
            $active[] = $v->active.$v->modules_id;
            $del_to_rec[] = $v->del_to_rec.$v->modules_id;
            $del_from_rec[] = $v->del_from_rec.$v->modules_id;
            $moderate[] = $v->moderate.$v->modules_id;
        }

        return view($view, get_defined_vars());
    }

    public function saveList($id)
    {
        $item = Validator::make(Input::all(), [
            'name' => 'required',
        ]);

        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }

        $data = [
            'name' => Input::get('name'),
            'alias' => str_slug(Input::get('name')),
            'active' => 1,
            'deleted' => 0,
        ];

        if(is_null($id)){
            $new_group = AdminUserGroup::create($data);
        }
        else{
            AdminUserGroup::where('id', $id)->update($data);
            $new_group = AdminUserGroup::find($id);
        }

        $new_group_id = AdminUserGroup::findOrFail($new_group->id)->id;

        AdminUserActionPermision::where('admin_user_group_id', $id)->delete();

        $new = Input::get('new');
        $save = Input::get('save');
        $active = Input::get('active');
        $del_to_rec = Input::get('del_to_rec');
        $del_from_rec = Input::get('del_from_rec');
        $moderate = Input::get('moderate');
        $modules_id = Input::get('modules_id');
        $arr = ['new' => $new, 'save' => $save, 'active' => $active, 'del_to_rec' => $del_to_rec, 'del_from_rec' => $del_from_rec, 'moderate' => $moderate];

        if(!empty($modules_id)) {
            foreach ($modules_id as $key => $mod_id) {
                $arr['modules_id'] = $mod_id;
                isset($arr['new'][$key]) ? $new_val = 1 : $new_val = 0;
                isset($arr['save'][$key]) ? $save_val = 1 : $save_val = 0;
                isset($arr['active'][$key]) ? $active_val = 1 : $active_val = 0;
                isset($arr['del_to_rec'][$key]) ? $del_to_rec_val = 1 : $del_to_rec_val = 0;
                isset($arr['del_from_rec'][$key]) ? $del_from_rec_val = 1 : $del_from_rec_val = 0;
                isset($arr['moderate'][$key]) ? $moderate_val = 1 : $moderate_val = 0;

                $data = [
                    'new' => $new_val,
                    'save' => $save_val,
                    'active' => $active_val,
                    'del_to_rec' => $del_to_rec_val,
                    'del_from_rec' => $del_from_rec_val,
                    'moderate' => $moderate_val,
                    'admin_user_group_id' => $new_group_id,
                    'modules_id' => $mod_id,

                ];

                AdminUserActionPermision::create($data);
            }
        }



        if(is_null(AdminUserGroup::find($id))){
            return response()->json([
                'status' => true,
                'messages' => [controllerTrans('variables.save', $this->lang)],
                'redirect' => urlForFunctionLanguage($this->lang, '')
            ]);
        }
        return response()->json([
            'status' => true,
            'messages' => [controllerTrans('variables.save', $this->lang)],
            'redirect' => urlForLanguage($this->lang, 'editlist/'.$id)
        ]);

    }

    public function destroyUserFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $user_item_elems_id = User::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$user_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($user_item_elems_id as $one_user_item_elems_id) {

                        $del_message .= $one_user_item_elems_id->name . ', ';

                        User::destroy($one_user_item_elems_id->id);

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

    public function destroyGroupFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $group_item_elems_id = AdminUserGroup::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$group_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($group_item_elems_id as $one_group_item_elems_id) {

                    if ($one_group_item_elems_id->deleted == 1 && $one_group_item_elems_id->active == 0) {

                        $del_message .= $one_group_item_elems_id->name . ', ';

                        AdminUserGroup::destroy($one_group_item_elems_id->id);
                        AdminUserActionPermision::where('admin_user_group_id', $one_group_item_elems_id->id)->delete();

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

    public function destroyGroupToCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $group_item_elems_id = AdminUserGroup::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$group_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($group_item_elems_id as $one_group_item_elems_id) {

                    if ($one_group_item_elems_id->deleted == 0) {

                        $cart_message .= $one_group_item_elems_id->name . ', ';

                        AdminUserGroup::where('id', $one_group_item_elems_id->id)
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

    public function restore()
    {

        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $admin_item_elems_id = AdminUserGroup::whereIn('id', $restored_elements_id_arr)->get();

            if (!$admin_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($admin_item_elems_id as $one_admin_item_elems_id) {

                    $admin_name = $one_admin_item_elems_id->name;

                    if ($one_admin_item_elems_id->restored == 0) {

                        $cart_message .= $admin_name . ', ';

                        AdminUserGroup::where('id', $one_admin_item_elems_id->id)
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
