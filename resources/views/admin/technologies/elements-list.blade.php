@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'createTechnologies/createtechnologies'),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'technologiesCart/technologiescart')
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'technologiesCart/technologiescart')
                ]
            ])
        @endif


        <div class="list-table">
            @if(!empty($technologies_elements))
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
                    @foreach($technologies_elements as $one_technologies_element)
                        <tr id="{{$one_technologies_element->technologies_id}}">
                            <td>
                                <span>{{!empty(IfHasName($one_technologies_element->technologies_id, $lang_id, 'technologies')) ? IfHasName($one_technologies_element->technologies_id, $lang_id, 'technologies') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="edit-links">
                                @foreach($lang_list as $lang_key => $one_lang)
                                    <a href="{{urlForFunctionLanguage($lang, $one_technologies_element->technologiesId->alias.'/edittechnologies/'.$one_technologies_element->technologies_id.'/'.$one_lang->id)}}" {{ !empty(IfHasName($one_technologies_element->technologies_id, $one_lang->id, 'technologies')) ? 'class=active' : ''}}>{{$one_lang->lang}}</a>
                                @endforeach
                            </td>
                            @if($groupSubRelations->active == 1)
                                <td class="small active-link">
                                    <a href=""
                                       class="change-active{{$one_technologies_element->technologiesId->active == 1 ? ' active' : ''}}"
                                       data-active="{{$one_technologies_element->technologiesId->active}}"
                                       element-id="{{$one_technologies_element->technologiesId->id}}"></a>
                                </td>
                            @endif
                            <td class="dragHandle" nowrap=""></td>
                            @if($groupSubRelations->del_to_rec == 1)
                                <td class="check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$one_technologies_element->technologies_id}}]"
                                           value="{{$one_technologies_element->technologies_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($one_technologies_element->name).'/destroyTechnologiesToCart')}}">
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

