@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @if(request()->segment(5) == '' || request()->segment(4) == 'servicesCart')
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
                        trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                        trans('variables.add_element') => urlForLanguage($lang, 'createservices'),
                        trans('variables.elements_basket') => urlForLanguage($lang, 'servicescart')
                    ]
                ])
            @endif
        @else
            @if(request()->segment(5) == '' || request()->segment(4) == 'servicesCart')
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                        trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'servicesCart/servicescart')
                    ]
                ])
            @else
                @include('admin.list-elements', [
                    'actions' => [
                        trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                        trans('variables.elements_basket') => urlForLanguage($lang, 'servicescart')
                    ]
                ])
            @endif
        @endif


        <div class="list-table">
            @if(!empty($deleted_services_elems))
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
                    @foreach($deleted_services_elems as $one_services_element)
                        <tr id="{{$one_services_element->services_id}}">
                            <td>
                                <span>{{!empty(IfHasName($one_services_element->services_id, $lang_id, 'services')) ? IfHasName($one_services_element->services_id, $lang_id, 'services') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="medium check-restore-element">
                                <input type="checkbox" class="restore-all-elements"
                                       name="restore_elements[{{$one_services_element->services_id}}]"
                                       value="{{$one_services_element->services_id}}"
                                       url="{{urlForFunctionLanguage($lang, str_slug($one_services_element->name).'/restoreServices')}}">
                            </td>
                            @if($groupSubRelations->del_from_rec == 1)
                                <td class="medium check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$one_services_element->services_id}}]"
                                           value="{{$one_services_element->services_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($one_services_element->name).'/destroyServicesFromCart')}}">
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
