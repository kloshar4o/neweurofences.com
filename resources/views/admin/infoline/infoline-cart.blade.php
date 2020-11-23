@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'createInfoLine/createinfoline'),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'infoLineCart/infolinecart')
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'infoLineCart/infolinecart')
                ]
            ])
        @endif


        <div class="list-table">
            @if(!empty($deleted_info_line))
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
                    @foreach($deleted_info_line as $deleted_one_info_line)
                        <tr id="{{$deleted_one_info_line->info_line_id}}">
                            <td>
                                <span>{{!empty(IfHasName($deleted_one_info_line->info_line_id, $lang_id, 'info_line')) ? IfHasName($deleted_one_info_line->info_line_id, $lang_id, 'info_line') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="medium check-restore-element">
                                <input type="checkbox" class="restore-all-elements"
                                       name="restore_elements[{{$deleted_one_info_line->info_line_id}}]"
                                       value="{{$deleted_one_info_line->info_line_id}}"
                                       url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_info_line->name).'/restoreInfoLine')}}">
                            </td>
                            @if($groupSubRelations->del_from_rec == 1)
                                <td class="medium check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$deleted_one_info_line->info_line_id}}]"
                                           value="{{$deleted_one_info_line->info_line_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_info_line->name).'/destroyInfoLineFromCart')}}">
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

