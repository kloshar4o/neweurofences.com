<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Doc;
use App\Models\Lang;
use App\Models\Menu;
use App\Models\MenuId;
use App\Models\MenuImages;
use App\Models\Modules;
use App\Models\ModulesId;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{

    use FileUploadTrait;

    private $main_folder = "menu";
    private $lang_id;
    private $lang;

    public function __construct()
    {
        $this->lang_id = $this->lang()['lang_id'];
        $this->lang = $this->lang()['lang'];
    }

    public function index()
    {
        $view = 'admin.menu.elements-list';

        $lang_id = $this->lang_id;

        $menu_id_elements = MenuId::where('level', 1)
            ->where('deleted', 0)
            ->orderBy('position', 'asc')
            ->get();

        $menu_elements = [];
        foreach ($menu_id_elements as $key => $menu_id_element) {
            $menu_elements[$key] = Menu::where('menu_id', $menu_id_element->id)
                ->first();
        }

        //Remove all null values --start
        $menu_elements = array_filter($menu_elements, 'strlen');
        //Remove all null values --end

        return view($view, get_defined_vars());
    }

    public function uploadPDF($id, $cur_lang)
    {
        $view = 'admin.menu.upload-pdf';

        $lang_id = $this->lang_id;

        $menu_id = MenuId::where('id', $id)
            ->where('deleted', 0)
            ->first();

        $this_menu = Menu::where('menu_id', $menu_id->id)->where('lang_id', $cur_lang)->first();

        $page_lang = Lang::where('id', $cur_lang)->first();

        return view($view, get_defined_vars());
    }

    // ajax response for position
    public function changePosition()
    {
        $neworder = Input::get('neworder');

        $i = 0;
        $neworder = explode("&", $neworder);
        foreach ($neworder as $k => $v) {
            $id = str_replace("tablelistsorter[]=", "", $v);
            $i++;

            if (!empty($id)) {
                MenuId::where('id', $id)->update(['position' => $i]);
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
                MenuImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = MenuId::findOrFail($id);

        if (!is_null($element_id)) {
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Menu', 'menu_id');
        } else {
            return response()->json(
                [
                    'status' => false,
                    'type' => 'error',
                    'messages' => [controllerTrans('variables.something_wrong', $this->lang)]
                ]
            );
        }

        if ($active == 1) {
            $change_active = 0;
            $msg = controllerTrans('variables.element_is_inactive', $this->lang, ['name' => $element_name]);
        } else {
            $change_active = 1;
            $msg = controllerTrans('variables.element_is_active', $this->lang, ['name' => $element_name]);
        }

        MenuId::where('id', $id)->update(['active' => $change_active]);

        return response()->json(
            [
                'status' => true,
                'type' => 'info',
                'messages' => [$msg]
            ]
        );
    }

    // ajax response for active
    public function changeTopMenu()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = MenuId::findOrFail($id);

        if (!is_null($element_id)) {
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Menu', 'menu_id');
        } else {
            return response()->json(
                [
                    'status' => false,
                    'type' => 'error',
                    'messages' => [controllerTrans('variables.something_wrong', $this->lang)]
                ]
            );
        }

        if ($active == 1) {
            $change_active = 0;
            $msg = controllerTrans('variables.element_is_inactive', $this->lang, ['name' => $element_name]);
        } else {
            $change_active = 1;
            $msg = controllerTrans('variables.element_is_active', $this->lang, ['name' => $element_name]);
        }

        MenuId::where('id', $id)->update(['top_menu' => $change_active]);

        return response()->json(
            [
                'status' => true,
                'type' => 'info',
                'messages' => [$msg]
            ]
        );
    }

    // ajax response for active
    public function changeFooterMenu()
    {
        $active = Input::get('active');
        $id = Input::get('id');

        $element_id = MenuId::findOrFail($id);

        if (!is_null($element_id)) {
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Menu', 'menu_id');
        } else {
            return response()->json(
                [
                    'status' => false,
                    'type' => 'error',
                    'messages' => [controllerTrans('variables.something_wrong', $this->lang)]
                ]
            );
        }

        if ($active == 1) {
            $change_active = 0;
            $msg = controllerTrans('variables.element_is_inactive', $this->lang, ['name' => $element_name]);
        } else {
            $change_active = 1;
            $msg = controllerTrans('variables.element_is_active', $this->lang, ['name' => $element_name]);
        }

        MenuId::where('id', $id)->update(['footer_menu' => $change_active]);

        return response()->json(
            [
                'status' => true,
                'type' => 'info',
                'messages' => [$msg]
            ]
        );
    }

    public function createMenu()
    {
        $view = 'admin.menu.create-menu';

        $curr_page_id = MenuId::where('alias', Request::segment(4))
            ->first();

        if (!is_null($curr_page_id)) {
            $curr_page_id = $curr_page_id->id;
        } else {
            $curr_page_id = null;
        }

        return view($view, get_defined_vars());
    }

    public function editMenu($id, $edited_lang_id)
    {
        $view = 'admin.menu.edit-menu';

        $lang = $this->lang;
        $menu = $this->menu();
        $modules_name = $menu['modules_name'];
        $module_id = $menu['modules_name_id'];

        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $menu_without_lang = Menu::where('menu_id', $id)->first();

        if (is_null($menu_without_lang)) {
            return App::abort(503, 'Unauthorized action.');
        }

        $menu_elems = Menu::query()
            ->where('lang_id', $edited_lang_id)
            ->where('menu_id', $menu_without_lang->menu_id)
            ->first();

        $menu_id = MenuId::query()
            ->where('id', $menu_without_lang->menu_id)
            ->first();

        $menu_docs = Doc::query()
            ->where('module_id', $module_id->id)
            ->where('element_id', $menu_without_lang->id)
            ->get();


        return view($view, get_defined_vars());
    }

    public function saveMenu($id, $updated_lang_id)
    {
        $request = request();


        if (is_null($id)) {
            $item = Validator::make(
                Input::all(),
                [
                    'name' => 'required',
                    'alias' => 'required|unique:menu_id',
                    'controller' => 'not_in:controller|not_in:Controller|min:10'
                ]
            );
        } else {
            $item = Validator::make(
                Input::all(),
                [
                    'name' => 'required',
                    'alias' => 'required',
                    'controller' => 'not_in:controller|not_in:Controller|min:10'
                ]
            );
        }

        if ($item->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'messages' => $item->messages(),
                ]
            );
        }

        $maxPosition = GetMaxPosition('menu_id');
        $level = GetLevel(Input::get('p_id'), 'menu_id');


        //set image names
        $array_img = [];
        if (!is_null(Input::get('file')) && !empty(Input::get('file'))) {
            foreach (Input::get('file') as $item) {
                if (!is_null($item)) {
                    $array_img[] = basename($item);
                }
            }
        }


//        Check if lang exist
        if (checkIfLangExist(Input::get('lang')) == false) {
            return response()->json(
                [
                    'status' => false,
                    'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
                ]
            );
        }
//        Check if lang exist
        if (is_null($id)) {
            $data = [
                'p_id' => Input::get('p_id'),
                'level' => $level + 1,
                'alias' => Input::get('alias'),
                'page_type' => Input::get('page_type'),
                'position' => $maxPosition + 1,
                'active' => 1,
                'top_menu' => 1,
                'footer_menu' => 1,
                'deleted' => 0,
                'link' => !is_null(Input::get('link')) ? Input::get('link') : '',
            ];

            $menu_id = MenuId::create($data);

            $data = [
                'menu_id' => $menu_id->id,
                'lang_id' => Input::get('lang'),
                'name' => Input::get('name'),
                'body' => !is_null(Input::get('body')) ? Input::get('body') : '',
                'page_title' => !is_null(Input::get('title')) ? Input::get('title') : '',
                'h1_title' => !is_null(Input::get('h1_title')) ? Input::get('h1_title') : '',
                'meta_title' => !is_null(Input::get('meta_title')) ? Input::get('meta_title') : '',
                'meta_keywords' => !is_null(Input::get('meta_keywords')) ? Input::get('meta_keywords') : '',
                'meta_description' => !is_null(Input::get('meta_description')) ? Input::get('meta_description') : '',
            ];

            $menu_data_id = Menu::query()->create($data)->id;

//            Upload images for current menu
            if (!is_null(Input::get('file')) && !empty(Input::get('file')) && !empty($array_img)) {
                foreach (array_reverse(Input::get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('menu_images');
                    $img = basename($item);

                    $data = [
                        'menu_id' => $menu_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    MenuImages::create($data);
                }
            }
//            Upload images for current menu

        } else {
            $exist_menu = Menu::where('menu_id', $id)->first();

            if (is_null($exist_menu)) {
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if (checkIfAliasExist($exist_menu->menu_id, Input::get('alias'), 'menu_id') == true) {
                return response()->json(
                    [
                        'status' => false,
                        'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                    ]
                );
            }
//            Check if alias exist


            $exist_menu_by_lang = Menu::where('menu_id', $exist_menu->menu_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'alias' => Input::get('alias'),
                'p_id' => Input::get('p_id'),
                'level' => $level + 1,
                'page_type' => Input::get('page_type'),
                'link' => !is_null(Input::get('link')) ? Input::get('link') : '',
            ];

            $menu_id = MenuId::where('id', $exist_menu->menu_id)
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

            if (!is_null($exist_menu_by_lang)) {
                $existing_menu = Menu::query()
                    ->where('menu_id', $exist_menu->menu_id)
                    ->where('lang_id', $updated_lang_id)
                    ->first();

                $existing_menu->update($data);
                $menu_data_id = $existing_menu->id;
            } else {
                $create_data = [
                    'menu_id' => $exist_menu->menu_id,
                    'lang_id' => Input::get('lang'),
                ];

                $data = array_merge($data, $create_data);

                $menu_data_id = Menu::create($data)->id;
            }

//            Upload images for current menu
            if (!is_null(Input::get('file')) && !empty($array_img)) {
                $exist_menu_images = MenuImages::where('menu_id', $exist_menu->menu_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if (count($array_img) >= count($exist_menu_images)) {
                    foreach ($exist_menu_images as $exist_menu_image) {
                        $pos = array_search($exist_menu_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if (!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('menu_images');
                            $img = basename($item);

                            $data = [
                                'menu_id' => $exist_menu->menu_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            MenuImages::create($data);
                        }
                    }
                } else {
                    foreach (array_reverse(Input::get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('menu_images');
                        $img = basename($item);

                        $data = [
                            'menu_id' => $exist_menu->menu_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        MenuImages::create($data);
                    }
                }
            }
//            Upload images for current menu
        }


        //Upload docs
        if ($request->hasFile('docs_upload')) {
            $data = $this->saveFiles($request->file('docs_upload'), $menu_data_id);
            foreach ($data as $i => $datum) {
                $data[$i]['module_id'] = $request->module_id;
                $data[$i]['element_id'] = $menu_data_id;
            }

            Doc::query()->insert($data);
        }

        //Delete docs
        if ($request->get('docs_delete')) {
            $docs = Doc::query()->whereIn('id', $request->docs_delete);

            foreach ($docs->get() as $doc) {
                $path = "$this->uploadPath/$this->main_folder/$menu_data_id/$doc->file_name";
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            $docs->delete();
        }

        if (is_null($id)) {
            if ($menu_id->level == 1) {
                return response()->json(
                    [
                        'status' => true,
                        'messages' => [controllerTrans('variables.save', $this->lang)],
                        'redirect' => urlForFunctionLanguage($this->lang, '')
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status' => true,
                        'messages' => [controllerTrans('variables.save', $this->lang)],
                        'redirect' => urlForFunctionLanguage(
                            $this->lang,
                            GetParentAlias($menu_id->id, 'menu_id') . '/memberslist'
                        )
                    ]
                );
            }
        }

        return response()->json(
            [
                'status' => true,
                'messages' => [controllerTrans('variables.updated_text', $this->lang)],
                'redirect' => urlForLanguage($this->lang, 'editmenu/' . $id . '/' . $updated_lang_id)
            ]
        );
    }

    public function membersList()
    {
        $view = 'admin.menu.child-list';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/' . $lang . '/back/' . $modules_name->modulesId->alias;

        $menu_list_id = MenuId::where('alias', Request::segment(4))
            ->first();

        if (is_null($menu_list_id)) {
            return App::abort(503, 'Unauthorized action.');
        }

        $child_menu_list_id = MenuId::where('p_id', $menu_list_id->id)
            ->where('deleted', 0)
            ->orderBy('position', 'asc')
            ->get();


        $child_menu_list = [];
        foreach ($child_menu_list_id as $key => $one_menu_elem) {
            $child_menu_list[$key] = Menu::where('menu_id', $one_menu_elem->id)
                ->first();
        }

        //Remove all null values --start
        $child_menu_list = array_filter($child_menu_list, 'strlen');
        //Remove all null values --end

        return view($view, get_defined_vars());
    }

    public function menuCart()
    {
        $view = 'admin.menu.menu-cart';

        $lang_id = $this->lang_id;

        $deleted_elems_by_alias = MenuId::where('alias', Request::segment(4))
            ->first();

        if (is_null($deleted_elems_by_alias)) {
            $deleted_menu_id_elems = MenuId::where('deleted', 1)
                ->where('active', 0)
                ->where('p_id', 0)
                ->get();
        } else {
            $deleted_menu_id_elems = MenuId::where('deleted', 1)
                ->where('active', 0)
                ->where('p_id', $deleted_elems_by_alias->id)
                ->get();
        }

        $deleted_menu_elems = [];

        foreach ($deleted_menu_id_elems as $key => $one_deleted_menu_elem) {
            $deleted_menu_elems[$key] = Menu::where('menu_id', $one_deleted_menu_elem->id)
                ->first();
        }

        $deleted_menu_elems = array_filter($deleted_menu_elems, 'strlen');

        return view($view, get_defined_vars());
    }

    public function destroyMenuFromCart()
    {
        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $menu_item_elems_id = MenuId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$menu_item_elems_id->isEmpty()) {
                $del_message = '';

                foreach ($menu_item_elems_id as $one_menu_item_elems_id) {
                    $menu_item_elems = Menu::where('menu_id', $one_menu_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if (is_null($menu_item_elems)) {
                        $menu_item_elems = Menu::where('menu_id', $one_menu_item_elems_id->id)
                            ->first();
                    }

                    if ($one_menu_item_elems_id->deleted == 1 && $one_menu_item_elems_id->active == 0) {
                        $menu_images = $one_menu_item_elems_id->moduleMultipleImg;

                        if (!is_null($menu_images) && !$menu_images->isEmpty()) {
                            foreach ($menu_images as $menu_image) {
                                if (File::exists(
                                    'upfiles/' . $this->menu(
                                    )['modules_name']->modulesId->alias . '/s/' . $menu_image->img
                                )) {
                                    File::delete(
                                        'upfiles/' . $this->menu(
                                        )['modules_name']->modulesId->alias . '/s/' . $menu_image->img
                                    );
                                }

                                if (File::exists(
                                    'upfiles/' . $this->menu(
                                    )['modules_name']->modulesId->alias . '/m/' . $menu_image->img
                                )) {
                                    File::delete(
                                        'upfiles/' . $this->menu(
                                        )['modules_name']->modulesId->alias . '/m/' . $menu_image->img
                                    );
                                }

                                if (File::exists(
                                    'upfiles/' . $this->menu(
                                    )['modules_name']->modulesId->alias . '/' . $menu_image->img
                                )) {
                                    File::delete(
                                        'upfiles/' . $this->menu(
                                        )['modules_name']->modulesId->alias . '/' . $menu_image->img
                                    );
                                }
                            }
                        }

                        $del_message .= $menu_item_elems->name . ', ';

                        //Delete Docs
                        $docs = Doc::query()->where('element_id', $menu_item_elems->id);

                        foreach ($docs->get() as $doc) {
                            $path = "$this->uploadPath/$this->main_folder/$menu_item_elems->id/$doc->file_name";
                            if (File::exists($path)) {
                                File::delete($path);
                            }
                        }

                        $docs->delete();

                        MenuId::destroy($one_menu_item_elems_id->id);
                        Menu::where('menu_id', $one_menu_item_elems_id->id)->delete();
                    }
                }

                if (!empty($del_message)) {
                    $del_message = substr($del_message, 0, -2) . '<br />' . controllerTrans(
                            'variables.success_deleted',
                            $this->lang
                        );
                }

                return response()->json(
                    [
                        'status' => true,
                        'del_messages' => $del_message,
                        'deleted_elements' => $deleted_elements_id_arr
                    ]
                );
            }

            return response()->json(
                [
                    'status' => false
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => false
                ]
            );
        }
    }

    public function destroyMenuToCart()
    {
        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $menu_item_elems_id = MenuId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$menu_item_elems_id->isEmpty()) {
                $cart_message = '';

                foreach ($menu_item_elems_id as $one_menu_item_elems_id) {
                    $menu_item_elems = Menu::where('menu_id', $one_menu_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if (is_null($menu_item_elems)) {
                        $menu_item_elems = Menu::where('menu_id', $one_menu_item_elems_id->id)
                            ->first();
                    }


                    if ($one_menu_item_elems_id->deleted == 0) {
                        $cart_message .= $menu_item_elems->name . ', ';

                        MenuId::where('id', $one_menu_item_elems_id->id)
                            ->update(['active' => 0, 'deleted' => 1]);
                    }
                }

                if (!empty($cart_message)) {
                    $cart_message = substr($cart_message, 0, -2) . '<br />' . controllerTrans(
                            'variables.success_added_cart',
                            $this->lang
                        );
                }

                return response()->json(
                    [
                        'status' => true,
                        'cart_messages' => $cart_message,
                        'deleted_elements' => $deleted_elements_id_arr
                    ]
                );
            }

            return response()->json(
                [
                    'status' => false
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => false
                ]
            );
        }
    }

    public function restoreMenu()
    {
        $restored_elements_id = substr(Input::get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $promotion_item_elems_id = MenuId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$promotion_item_elems_id->isEmpty()) {
                $cart_message = '';

                foreach ($promotion_item_elems_id as $one_promotion_item_elems_id) {
                    $promotion_name = GetNameByLang(
                        $one_promotion_item_elems_id->id,
                        $this->lang_id,
                        'Menu',
                        'menu_id'
                    );

                    if ($one_promotion_item_elems_id->restored == 0) {
                        $cart_message .= $promotion_name . ', ';

                        MenuId::where('id', $one_promotion_item_elems_id->id)
                            ->update(['active' => 1, 'deleted' => 0]);
                    }
                }

                if (!empty($cart_message)) {
                    $cart_message = substr($cart_message, 0, -2) . '<br />' . controllerTrans(
                            'variables.success_restored',
                            $this->lang
                        );
                }

                return response()->json(
                    [
                        'status' => true,
                        'cart_messages' => $cart_message,
                        'restored_elements' => $restored_elements_id_arr
                    ]
                );
            }

            return response()->json(
                [
                    'status' => false
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => false
                ]
            );
        }
    }
}