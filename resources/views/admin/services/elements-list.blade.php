@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'createServices/createservices'),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'servicesCart/servicescart')
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'servicesCart/servicescart')
                ]
            ])
        @endif


        <div class="list-table">
            @if(!empty($services_elements))
                <table class="table" id="tablelistsorter" empty-response="{{trans('variables.list_is_empty')}}">
                    <thead>
                    <tr>
                        <th>{{trans('variables.title_table')}}</th>
                        <th>{{trans('variables.edit_table')}}</th>
                        @if($groupSubRelations->active == 1)
                            <th>{{trans('variables.active_table')}}</th>
                        @endif
                        <th>{{trans('variables.position_table')}}</th>
                        @if($groupSubRelations->del_to_rec == 1)
                            <th class="remove-all">{{trans('variables.delete_table')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services_elements as $one_services_element)
                        <tr id="{{$one_services_element->services_id}}">
                            <td>
                                <span>{{!empty(IfHasName($one_services_element->services_id, $lang_id, 'services')) ? IfHasName($one_services_element->services_id, $lang_id, 'services') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="edit-links">
                                @foreach($lang_list as $lang_key => $one_lang)
                                    <a href="{{urlForFunctionLanguage($lang, $one_services_element->servicesId->alias.'/editservices/'.$one_services_element->services_id.'/'.$one_lang->id)}}" {{ !empty(IfHasName($one_services_element->services_id, $one_lang->id, 'services')) ? 'class=active' : ''}}>{{$one_lang->lang}}</a>
                                @endforeach
                            </td>
                            @if($groupSubRelations->active == 1)
                                <td class="small active-link">
                                    <a href=""
                                       class="change-active{{$one_services_element->servicesId->active == 1 ? ' active' : ''}}"
                                       data-active="{{$one_services_element->servicesId->active}}"
                                       element-id="{{$one_services_element->servicesId->id}}"></a>
                                </td>
                            @endif
                            <td class="dragHandle" nowrap=""></td>
                            @if($groupSubRelations->del_to_rec == 1)
                                <td class="check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$one_services_element->services_id}}]"
                                           value="{{$one_services_element->services_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($one_services_element->name).'/destroyServicesToCart')}}">
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

