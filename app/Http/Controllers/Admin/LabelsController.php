<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Labels;
use App\Models\LabelsId;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LabelsController extends Controller
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
        $view = 'admin.labels.labels-list';

        $lang_id = $this->lang_id;

        $labels_list_id = LabelsId::orderBy('id', 'desc')
            ->paginate(200);

        $labels_list = [];
        foreach($labels_list_id as $key => $one_label_id){
            $labels_list[$key] = Labels::where('labels_id' ,$one_label_id->id)
                ->first();
        }
        //Remove all null values --start
        $labels_list = array_filter( $labels_list, 'strlen' );
        //Remove all null values --end

        return view($view, get_defined_vars());
    }

    public function createItem()
    {
        $view = 'admin.labels.create-label';

        return view($view, get_defined_vars());
    }

    public function editItem($id, $edited_lang_id)
    {
        $view = 'admin.labels.edit-label';

        $labels_without_lang = Labels::where('labels_id', $id)
            ->first();

        if(is_null($labels_without_lang)){
            return App::abort(503, 'Unauthorized action.');
        }

        $labels = Labels::where('labels_id', $labels_without_lang->labels_id)
            ->where('lang_id', $edited_lang_id)
            ->first();

        return view($view, get_defined_vars());
    }

    public function save($id, $updated_lang_id)
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

        $labels_id = LabelsId::max('id');

        $data_labels_id = array_filter([
            'id' => $labels_id + 1
        ]);

//        Check if lang exist
        if(checkIfLangExist(Input::get('lang')) == false)
            return response()->json([
                'status' => false,
                'messages' => [controllerTrans('variables.lang_not_exist', $this->lang)],
            ]);
//        Check if lang exist

        if(is_null($id)){
            $next_label_id = LabelsId::create($data_labels_id);
            $data = array_filter([
                'name' => Input::get('name'),
                'lang_id' => Input::get('lang'),
                'labels_id' => $next_label_id->id
            ]);
            Labels::create($data);
        }
        else{
            $curr_labels_id = Labels::where('labels_id', $id)->first();

            if(is_null($curr_labels_id)){
                return App::abort(503, 'Unauthorized action.');
            }

            $exist_labels_by_lang = Labels::where('labels_id', $curr_labels_id->labels_id)
                ->where('lang_id', $updated_lang_id)
                ->first();

            $data = array_filter([
                'name' => Input::get('name'),
                'lang_id' => $updated_lang_id,
                'labels_id' => $curr_labels_id->labels_id
            ]);

            if(!is_null($exist_labels_by_lang)){
                Labels::where('labels_id', $curr_labels_id->labels_id)
                    ->where('lang_id', $updated_lang_id)
                    ->update($data);
            }
            else{
                Labels::create($data);
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

    public function destroyLabelFromCart()
    {

        $deleted_elements_id = substr(Input::get('id'), 1, -1);
        $lang_id = $this->lang_id;

        if (!empty($deleted_elements_id)) {
            $deleted_elements_id_arr = explode(',', $deleted_elements_id);

            $label_elems_id = LabelsId::whereIn('id', $deleted_elements_id_arr)->get();

            if (!$label_elems_id->isEmpty()) {

                $del_message = '';

                foreach ($label_elems_id as $one_label_elems_id) {

                    $label_elems = Labels::where('labels_id', $one_label_elems_id->id)
                        ->where('lang_id', $lang_id)
                        ->first();

                    if(is_null($label_elems)){
                        $label_elems = Labels::where('labels_id', $one_label_elems_id->id)
                            ->first();
                    }

                    $del_message .= $label_elems->name . ', ';

                    LabelsId::destroy($one_label_elems_id->id);
                    Labels::where('labels_id', $one_label_elems_id->id)->delete();


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