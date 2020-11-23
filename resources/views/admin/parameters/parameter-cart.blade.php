@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.parameters_list') => urlForLanguage($lang, 'goodsparameters/'.$parameter_subject_id),
                    trans('variables.add_parameter') => urlForLanguage($lang, 'creategoodsparameter/'.$parameter_subject_id),
                    trans('variables.elements_basket') => urlForLanguage($lang, 'goodsparametercart/'.$parameter_subject_id)
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.parameters_list') => urlForLanguage($lang, 'goodsparameters/'.$parameter_subject_id),
                    trans('variables.add_parameter') => urlForLanguage($lang, 'creategoodsparameter/'.$parameter_subject_id),
                    trans('variables.elements_basket') => urlForLanguage($lang, 'goodsparametercart/'.$parameter_subject_id)
                ]
            ])
        @endif


        <div class="list-table">
            @if(!empty($deleted_parameters))
                <table class="table" empty-response="{{trans('variables.list_is_empty')}}">
                    <thead>
                    <tr>
                        <th>{{trans('variables.title_table')}}</th>
                        <th class="restore-all">{{trans('variables.reestablish_table')}}</th>
                        @if($groupSubRelations->del_from_rec == 1)
                            <th class="remove-all">{{trans('variables.delete_table')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deleted_parameters as $deleted_one_item_elem)
                        <tr id="{{$deleted_one_item_elem->goods_parametr_id}}">
                            <td>
                                <span>{{!empty(IfHasName($deleted_one_item_elem->goods_parametr_id, $lang_id, 'goods_parametr')) ? IfHasName($deleted_one_item_elem->goods_parametr_id, $lang_id, 'goods_parametr') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="check-restore-element">
                                <input type="checkbox" class="restore-all-elements"
                                       name="restore_elements[{{$deleted_one_item_elem->goods_parametr_id}}]"
                                       value="{{$deleted_one_item_elem->goods_parametr_id}}"
                                       url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_item_elem->name).'/restoreGoodsParameter')}}">
                            </td>
                            @if($groupSubRelations->del_from_rec == 1)
                                <td class="check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$deleted_one_item_elem->goods_parametr_id}}]"
                                           value="{{$deleted_one_item_elem->goods_parametr_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_item_elem->name).'/destroyGoodsParameterFromCart')}}">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                    </tfoot>
                </table>
            @else
                <div class="empty-response">{{trans('variables.list_is_empty')}}</div>
            @endif
        </div>
        <div id="loader-gif" class="loader-list"></div>
    </div>

@stop