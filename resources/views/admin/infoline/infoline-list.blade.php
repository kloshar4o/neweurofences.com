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
            @if(!empty($info_line))
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
                    @foreach($info_line as $key => $one_info_line)
                        <tr id="{{$one_info_line->info_line_id}}">
                            <td>
                                <a href="{{urlForFunctionLanguage($lang, $one_info_line->infoLineId->alias.'/memberslist')}}">{{ !empty(IfHasName($one_info_line->info_line_id, $lang_id, 'info_line')) ? IfHasName($one_info_line->info_line_id, $lang_id, 'info_line') : trans('variables.another_name')}}</a>
                            </td>
                            <td class="edit-links">
                                @foreach($lang_list as $lang_key => $one_lang)
                                    <a href="{{urlForFunctionLanguage($lang, str_slug($one_info_line->name).'/editinfoline/'.$one_info_line->info_line_id.'/'.$one_lang->id)}}" {{ !empty(IfHasName($one_info_line->info_line_id, $one_lang->id, 'info_line')) ? 'class=active' : ''}}>{{$one_lang->lang}}</a>
                                @endforeach
                            </td>
                            @if($groupSubRelations->active == 1)
                                <td class="small active-link">
                                    <a href=""
                                       class="change-active{{$one_info_line->infoLineId->active == 1 ? ' active' : ''}}"
                                       data-active="{{$one_info_line->infoLineId->active}}"
                                       element-id="{{$one_info_line->infoLineId->id}}"></a>
                                </td>
                            @endif
                            <td class="dragHandle" nowrap=""></td>
                            @if($groupSubRelations->del_to_rec == 1)
                                @if(CheckIfInfoLineHasItems($one_info_line->info_line_id)->isEmpty())
                                    <td class="check-destroy-element">
                                        <input type="checkbox" class="remove-all-elements"
                                               name="destroy_elements[{{$one_info_line->info_line_id}}]"
                                               value="{{$one_info_line->info_line_id}}"
                                               url="{{urlForFunctionLanguage($lang, str_slug($one_info_line->name).'/destroyInfoLineToCart')}}">
                                    </td>
                                @else
                                    <td>{{trans('variables.delete_inner_modules')}}</td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="10">
                            @include('admin.pagination', ['paginator' => $info_line_id])
                        </td>
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
