<?php

namespace App\Http\Controllers;

use App\Models\AdminUserActionPermision;
use App\Models\ModulesId;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Modules;
use App\Models\ModulesSubmenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleManager extends Controller
{
    private $curr_lang_id;
    private $curr_lang;

    public function __construct()
    {
        Route::currentRouteAction();

        $this->curr_lang_id = $this->lang()['lang_id'];
        $this->curr_lang = $this->lang()['lang'];
    }

    public function routeResponder($lang, $module_alias, $submenu = null, $action = 'index',$id = null, $lang_id = null)
    {

        if (!Auth::check())
            return redirect(url($lang.'/back/auth/login'));

        $module_id = ModulesId::where('level', 1)
            ->where('active', 1)
            ->where('deleted', 0)
            ->where('alias', $module_alias)
            ->first();

        $module = Modules::where('modules_id', $module_id->id)
            ->where('lang_id', $this->curr_lang_id)
            ->first();

        $submodule_id = !$submenu ? null : ModulesId::where('level', 2)
            ->where('active', 1)
            ->where('deleted', 0)
            ->where('alias', $submenu)
            ->first();

        $submodule = !$submodule_id ? null : Modules::where('modules_id', $submodule_id->id)
            ->where('lang_id', $this->curr_lang_id)
            ->first();

        $group = User::find(Auth::user()->id)->group()->first();

        if($submodule_id){

            $permission = AdminUserActionPermision::where([
                'modules_id' => $submodule_id->p_id,
                'admin_user_group_id' => $group->id
            ])->get();

            if($permission->isEmpty()) {
                return redirect($lang . '/back');
            }elseif($permission->isNotEmpty()){
                foreach($permission as $one_permission){
                    $curr_url = url()->current();
                    if($one_permission->new == 0)
                        $new = strpos($curr_url, 'create');
                    else
                        $new = false;

                    if($one_permission->save == 0)
                        $save = strpos($curr_url, 'save');
                    else
                        $save = false;

                    if($one_permission->active == 0)
                        $active = strpos($curr_url, 'changeactive');
                    else
                        $active = false;

                    if($one_permission->del_to_rec == 0)
                        $del_to_rec = strpos($curr_url, 'ToCart');
                    else
                        $del_to_rec = false;

                    if($one_permission->del_from_rec == 0)
                        $del_from_rec = strpos($curr_url, 'FromCart');
                    else
                        $del_from_rec = false;

                    if(($new || $save || $active || $del_from_rec || $del_to_rec) !== false){
                        return response()->json([
                            'status' => false,
                            'messages' => 'You do not have enough rights for modify this item!'
                        ]);
                    }
                }
            }
        }
        elseif($module_id){

            if(($module_id->alias == 'sitemap' || $module_id->alias == 'modules-constructor') && Auth::user()->root == 0) {
                return redirect($lang.'/back');
            }

            if($module_id->alias == 'sitemap' && request()->method() == 'GET')
                return redirect($lang.'/back');

            $permission = AdminUserActionPermision::where([
                'modules_id' => $module_id->id,
                'admin_user_group_id' => $group->id
            ])->get();

            if($permission->isEmpty()){
                return redirect($lang.'/back');
            }elseif(!$permission->isEmpty()){

                foreach($permission as $one_permission){
                    $curr_url = url()->current();
                    if($one_permission->new == 0)
                        $new = strpos($curr_url, 'create');
                    else
                        $new = false;

                    if($one_permission->save == 0)
                        $save = strpos($curr_url, 'save');
                    else
                        $save = false;

                    if($one_permission->active == 0)
                        $active = strpos($curr_url, 'changeactive');
                    else
                        $active = false;

                    if($one_permission->del_to_rec == 0)
                        $del_to_rec = strpos($curr_url, 'ToCart');
                    else
                        $del_to_rec = false;

                    if($one_permission->del_from_rec == 0)
                        $del_from_rec = strpos($curr_url, 'FromCart');
                    else
                        $del_from_rec = false;

                    if(($new || $save || $active || $del_from_rec || $del_to_rec) !== false){
                        return response()->json([
                            'status' => false,
                            'messages' => 'You do not have enough rights for modify this item!'
                        ]);
                    }
                }
            }

        }
        else{
            return redirect($lang.'/back');
        }

        if (!empty($submodule->modulesId->controller)) {
            $controller = app()->make('App\Http\Controllers\Admin\\' . $submodule->modulesId->controller);
            return app()->call([$controller, $action], [$id, $lang_id]);
        } elseif (!empty($module->modulesId->controller)) {

            $controller = app()->make('App\Http\Controllers\Admin\\' . $module->modulesId->controller);
            return app()->call([$controller, $action], [$id, $lang_id]);
        } else {
            return redirect($lang.'/back');
        }
    }
}
