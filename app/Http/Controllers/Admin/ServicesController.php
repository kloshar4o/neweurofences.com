<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryItemId;
use App\Models\GallerySubject;
use App\Models\GallerySubjectId;
use App\Models\Services;
use App\Models\ServicesId;
use App\Models\ServicesImages;
use App\Models\ServicesTechnologies;
use App\Models\ServicesWorks;
use App\Models\Technologies;
use App\Models\TechnologiesId;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
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
        $view = 'admin.services.elements-list';

        $lang_id = $this->lang_id;

        $services_id_elements = ServicesId::where('deleted', 0)
            ->orderBy('position', 'asc')
            ->get();

        $services_elements = [];
        foreach($services_id_elements as $key => $services_id_element){
            $services_elements[$key] = Services::where('services_id', $services_id_element->id)
                ->first();
        }

        $services_elements = array_filter($services_elements);

        return view($view, get_defined_vars());
    }

    // ajax response for position
    public function changePosition(Request $request)
    {
        $neworder = $request->get('neworder');

        $i = 0;
        $neworder = explode("&", $neworder);
        foreach ($neworder as $k=>$v) {
            $id = str_replace("tablelistsorter[]=","", $v);
            $i++;

            if(!empty($id)){
                ServicesId::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for img position
    public function changeImgPosition(Request $request)
    {
        $newOrder = $request->get('newOrder');

        $i = 0;
        foreach ($newOrder as $k=>$v) {
            $id = $v;
            $i++;

            if(!empty($id)){
                ServicesImages::where('id', $id)->update(['position' => $i]);
            }
        }
    }

    // ajax response for active
    public function changeActive(Request $request)
    {
        $active = $request->get('active');
        $id = $request->get('id');

        $element_id = ServicesId::findOrFail($id);

        if(!is_null($element_id))
            $element_name = GetNameByLang($element_id->id, $this->lang_id, 'Services', 'services_id');
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

        ServicesId::where('id', $id)->update(['active' => $change_active]);

        return response()->json([
            'status' => true,
            'type' => 'info',
            'messages' => [$msg]
        ]);

    }

    public function createServices()
    {
        $view = 'admin.services.create-services';

        $technologies_id = TechnologiesId::where('active', 1)
            ->where('deleted', 0)
            ->orderBy('position', 'asc')
            ->get();

        $technologies = [];
        if(!$technologies_id->isEmpty()) {
            foreach ($technologies_id as $item) {
                $technologies[] = Technologies::where('technologies_id', $item->id)
                    ->where('lang_id', $this->lang_id)
                    ->first();
            }

            $technologies = array_filter($technologies);
        }

        $works_subject_id = GallerySubjectId::where('active', 1)
            ->where('level', 1)
            ->where('p_id', 0)
            ->where('alias', 'our-works')
            ->where('deleted', 0)
            ->orderBy('position', 'asc')
            ->first();

        $works = [];

        if(!is_null($works_subject_id)) {

            $works_id = GallerySubjectId::where('p_id', $works_subject_id->id)
                ->where('active', 1)
                ->where('deleted', 0)
                ->orderBy('position', 'asc')
                ->get();

            if (!$works_id->isEmpty()) {
                foreach ($works_id as $item) {
                    $works[] = GallerySubject::where('gallery_subject_id', $item->id)
                        ->where('lang_id', $this->lang_id)
                        ->first();
                }

                $works = array_filter($works);

            }
        }

        return view($view, get_defined_vars());
    }

    public function editServices($id, $edited_lang_id)
    {
        $view = 'admin.services.edit-services';

        $lang = $this->lang;
        $modules_name = $this->menu()['modules_name'];
        $url_for_active_elem = '/'.$lang.'/back/'.$modules_name->modulesId->alias;

        $services_without_lang = Services::where('services_id', $id)->first();
        $services_id = null;
        if(is_null($services_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $services_elems = Services::where('lang_id', $edited_lang_id)
            ->where('services_id', $services_without_lang->services_id)
            ->first();

        if(!is_null($services_without_lang)){
            $services_id = ServicesId::where('id', $services_without_lang->services_id)
                ->first();
        }
        elseif(!is_null($services_elems)){
            $services_id = ServicesId::where('id', $services_elems->services_id)
                ->first();
        }

        $technologies_id = TechnologiesId::where('active', 1)
            ->where('deleted', 0)
            ->orderBy('position', 'asc')
            ->get();

        $technologies = [];
        if(!$technologies_id->isEmpty()) {
            foreach ($technologies_id as $item) {
                $technologies[] = Technologies::where('technologies_id', $item->id)
                    ->where('lang_id', $this->lang_id)
                    ->first();
            }

            $technologies = array_filter($technologies);
        }

        $selected_technologies = [];

        if(!is_null($services_id)) {
            $selected_technologies = $services_id->servicesTechnologies->pluck('technologies_id')->toArray();
        }

        $works_subject_id = GallerySubjectId::where('active', 1)
            ->where('level', 1)
            ->where('p_id', 0)
            ->where('alias', 'our-works')
            ->where('deleted', 0)
            ->orderBy('position', 'asc')
            ->first();

        $works = [];
        $selected_works = [];

        if(!is_null($works_subject_id)) {

            $works_id = GallerySubjectId::where('p_id', $works_subject_id->id)
                ->where('active', 1)
                ->where('deleted', 0)
                ->orderBy('position', 'asc')
                ->get();

            if (!$works_id->isEmpty()) {
                foreach ($works_id as $item) {
                    $works[] = GallerySubject::where('gallery_subject_id', $item->id)
                        ->where('lang_id', $this->lang_id)
                        ->first();
                }

                $works = array_filter($works);

            }

            if(!is_null($services_id)) {
                $selected_works = $services_id->servicesWorks->pluck('works_id')->toArray();
            }
        }

        return view($view, get_defined_vars());
    }

    public function saveServices(Request $request, $id, $updated_lang_id)
    {

        if(is_null($id)){
            $item = Validator::make($request->all(), [
                'name' => 'required',
                'alias' => 'required|unique:services_id',
                'descr' => 'min:0|max:1024'
            ]);
        }
        else {
            $item = Validator::make($request->all(), [
                'name' => 'required',
                'alias' => 'required',
                'descr' => 'min:0|max:1024'
            ]);
        }

        if($item->fails()){
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);
        }


        $maxPosition = GetMaxPosition('services_id');

        $array_img = [];
        if(!is_null($request->get('file')) && !empty($request->get('file'))) {
            foreach ($request->get('file') as $item) {
                if(!is_null($item))
                    $array_img[] = basename($item);
            }
        }

//        Check if lang exist
        if(checkIfLangExist($request->get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if(is_null($id)){
            $data = [
                'alias' => $request->get('alias'),
                'position' => $maxPosition + 1,
                'active' => 1,
                'deleted' => 0
            ];

            $services_id = ServicesId::create($data);

            $data = [
                'services_id' => $services_id->id,
                'lang_id' => $request->get('lang'),
                'name' => $request->get('name'),
                'descr' => !is_null($request->get('descr')) ? $request->get('descr') : '',
                'body' => !is_null($request->get('body')) ? $request->get('body') : '',
                'page_title' => !is_null($request->get('title')) ? $request->get('title') : '',
                'h1_title' => !is_null($request->get('h1_title')) ? $request->get('h1_title') : '',
                'meta_title' => !is_null($request->get('meta_title')) ? $request->get('meta_title') : '',
                'meta_keywords' => !is_null($request->get('meta_keywords')) ? $request->get('meta_keywords') : '',
                'meta_description' => !is_null($request->get('meta_description')) ? $request->get('meta_description') : '',
            ];

            Services::create($data);

//            Upload images for current services
            if(!is_null($request->get('file')) && !empty($request->get('file'))  && !empty($array_img)) {
                foreach (array_reverse($request->get('file')) as $item) {
                    $maxImgPosition = GetMaxPosition('services_images');
                    $img = basename($item);

                    $data = [
                        'services_id' => $services_id->id,
                        'img' => $img,
                        'active' => 1,
                        'position' => $maxImgPosition + 1
                    ];

                    ServicesImages::create($data);
                }
            }
//            Upload images for current services

//            Services - Technologies

            if(!is_null($request->get('technologies_id'))) {

                $technologies_ids = $request->get('technologies_id');

                foreach ($technologies_ids as $technologies_id) {
                    $data = [
                        'services_id' => $services_id->id,
                        'technologies_id' => $technologies_id
                    ];

                    ServicesTechnologies::create($data);
                }

            }

//            Services - Technologies

//            Services - Works

            if(!is_null($request->get('works_id'))) {

                $works_ids = $request->get('works_id');

                foreach ($works_ids as $works_id) {
                    $data = [
                        'services_id' => $services_id->id,
                        'works_id' => $works_id
                    ];

                    ServicesWorks::create($data);
                }

            }

//            Services - Works

        }
        else {

            $exist_services = Services::where('services_id', $id)->first();

            if(is_null($exist_services)){
                return App::abort(503, 'Unauthorized action.');
            }

//            Check if alias exist
            if(checkIfAliasExist($exist_services->services_id, $request->get('alias'), 'services_id') == true) {
                return response()->json([
                    'status' => false,
                    'messages' => [controllerTrans('variables.alias_exist', $this->lang)],
                ]);
            }
//            Check if alias exist


            $exist_services_by_lang = Services::where('services_id', $exist_services->services_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = [
                'alias' => $request->get('alias')
            ];

            $services_id = ServicesId::where('id', $exist_services->services_id)
                ->update($data);

            $data = [
                'name' => $request->get('name'),
                'descr' => !is_null($request->get('descr')) ? $request->get('descr') : '',
                'body' => !is_null($request->get('body')) ? $request->get('body') : '',
                'page_title' => !is_null($request->get('title')) ? $request->get('title') : '',
                'h1_title' => !is_null($request->get('h1_title')) ? $request->get('h1_title') : '',
                'meta_title' => !is_null($request->get('meta_title')) ? $request->get('meta_title') : '',
                'meta_keywords' => !is_null($request->get('meta_keywords')) ? $request->get('meta_keywords') : '',
                'meta_description' => !is_null($request->get('meta_description')) ? $request->get('meta_description') : '',
            ];

            if(!is_null($exist_services_by_lang)){
                Services::where('services_id', $exist_services->services_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else {

                $create_data = [
                    'services_id' => $exist_services->services_id,
                    'lang_id' => $request->get('lang'),
                ];

                $data = array_merge($data, $create_data);

                Services::create($data);
            }

//            Upload images for current services
            if(!is_null($request->get('file')) && !empty($array_img)) {

                $exist_services_images = ServicesImages::where('services_id', $exist_services->services_id)
                    ->whereIn('img', $array_img)
                    ->pluck('img')
                    ->toArray();

                if(count($array_img) >= count($exist_services_images)) {
                    foreach ($exist_services_images as $exist_services_image) {
                        $pos = array_search($exist_services_image, $array_img);
                        unset($array_img[$pos]);
                    }

                    if(!empty($array_img)) {
                        foreach (array_reverse($array_img) as $item) {
                            $maxImgPosition = GetMaxPosition('services_images');
                            $img = basename($item);

                            $data = [
                                'services_id' => $exist_services->services_id,
                                'img' => $img,
                                'active' => 1,
                                'position' => $maxImgPosition + 1
                            ];

                            ServicesImages::create($data);
                        }
                    }
                }
                else {
                    foreach (array_reverse($request->get('file')) as $item) {
                        $maxImgPosition = GetMaxPosition('services_images');
                        $img = basename($item);

                        $data = [
                            'services_id' => $exist_services->services_id,
                            'img' => $img,
                            'active' => 1,
                            'position' => $maxImgPosition + 1
                        ];

                        ServicesImages::create($data);
                    }
                }
            }
//            Upload images for current services

//            Services - Technologies

            if(!is_null($request->get('technologies_id'))) {

                $technologies_ids = $request->get('technologies_id');

                ServicesTechnologies::where('services_id', $exist_services->services_id)->delete();

                foreach ($technologies_ids as $technologies_id) {
                    $data = [
                        'services_id' => $exist_services->services_id,
                        'technologies_id' => $technologies_id
                    ];

                    ServicesTechnologies::create($data);
                }

            }

//            Services - Technologies

//            Services - Works

            if(!is_null($request->get('works_id'))) {

                $works_ids = $request->get('works_id');

                ServicesWorks::where('services_id', $exist_services->services_id)->delete();

                foreach ($works_ids as $works_id) {
                    $data = [
                        'services_id' => $exist_services->services_id,
                        'works_id' => $works_id
                    ];

                    ServicesWorks::create($data);
                }

            }

//            Services - Works

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
            'redirect' => urlForLanguage($this->lang, 'editservices/'.$id.'/'.$updated_lang_id)
        ]);
    }

    public function servicesCart(Request $request)
    {
        $view = 'admin.services.services-cart';

        $lang_id = $this->lang_id;

        $deleted_elems_by_alias = ServicesId::where('alias', $request->segment(4))
            ->first();

        $deleted_services_id_elems = ServicesId::where('deleted', 1)
            ->where('active', 0)
            ->get();

        $deleted_services_elems = [];

        foreach($deleted_services_id_elems as $key => $one_deleted_services_elem){
            $deleted_services_elems[$key] = Services::where('services_id', $one_deleted_services_elem->id)
                ->first();
        }

        $deleted_services_elems = array_filter( $deleted_services_elems, 'strlen' );

        return view($view, get_defined_vars());
    }

    public function destroyServicesFromCart(Request $request)
    {

        $deleted_elements_id = substr($request->get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $services_item_elems_id = ServicesId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$services_item_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($services_item_elems_id as $one_services_item_elems_id) {

                    $services_item_elems = Services::where('services_id', $one_services_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($services_item_elems)){
                        $services_item_elems = Services::where('services_id', $one_services_item_elems_id->id)
                            ->first();
                    }

                    if ($one_services_item_elems_id->deleted == 1 && $one_services_item_elems_id->active == 0) {

                        $services_images = $one_services_item_elems_id->moduleMultipleImg;

                        if(!is_null($services_images) && !$services_images->isEmpty()) {
                            foreach ($services_images as $services_image) {
                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$services_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/s/'.$services_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$services_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/m/'.$services_image->img);

                                if(File::exists('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$services_image->img))
                                    File::delete('upfiles/'.$this->menu()['modules_name']->modulesId->alias.'/'.$services_image->img);
                            }
                        }

                        $del_message .= $services_item_elems->name . ', ';

                        ServicesId::destroy($one_services_item_elems_id->id);
                        Services::where('services_id', $one_services_item_elems_id->id)->delete();

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

    public function destroyServicesToCart(Request $request)
    {

        $deleted_elements_id = substr($request->get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $services_item_elems_id = ServicesId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$services_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($services_item_elems_id as $one_services_item_elems_id) {

                    $services_item_elems = Services::where('services_id', $one_services_item_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($services_item_elems)){
                        $services_item_elems = Services::where('services_id', $one_services_item_elems_id->id)
                            ->first();
                    }


                    if ($one_services_item_elems_id->deleted == 0) {

                        $cart_message .= $services_item_elems->name . ', ';

                        ServicesId::where('id', $one_services_item_elems_id->id)
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

    public function restoreServices(Request $request)
    {

        $restored_elements_id = substr($request->get('id'), 1, -1);

        if (!empty($restored_elements_id)) {
            $restored_elements_id_arr = explode(',', $restored_elements_id);

            $promotion_item_elems_id = ServicesId::whereIn('id', $restored_elements_id_arr)->get();

            if (!$promotion_item_elems_id->isEmpty()) {

                $cart_message = '';

                foreach ($promotion_item_elems_id as $one_promotion_item_elems_id) {

                    $promotion_name = GetNameByLang($one_promotion_item_elems_id->id, $this->lang_id, 'Services', 'services_id');

                    if ($one_promotion_item_elems_id->restored == 0) {

                        $cart_message .= $promotion_name . ', ';

                        ServicesId::where('id', $one_promotion_item_elems_id->id)
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

    /**
     * return to another url, if method membersList does not exist
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function membersList()
    {
        return redirect(urlForFunctionLanguage($this->lang, ''));
    }
}
