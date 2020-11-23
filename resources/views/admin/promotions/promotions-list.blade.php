@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'createPromotion/createpromotion'),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'promotionsCart/cartpromotion')
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'promotionsCart/cartpromotion')
                ]
            ])
        @endif


        <div class="list-table">
            @if(!empty($promotion_list))
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
                    @foreach($promotion_list as $one_promotion)
                        <tr id="{{$one_promotion->promotions_id}}">
                            <td>
                                <span>{{ !empty(IfHasName($one_promotion->promotions_id, $lang_id, 'promotions')) ? IfHasName($one_promotion->promotions_id, $lang_id, 'promotions') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="edit-links">
                                @foreach($lang_list as $lang_key => $one_lang)
                                    <a href="{{urlForFunctionLanguage($lang, str_slug($one_promotion->name).'/editpromotion/'.$one_promotion->promotions_id.'/'.$one_lang->id)}}" {{ !empty(IfHasName($one_promotion->promotions_id, $one_lang->id, 'promotions')) ? 'class=active' : ''}}>{{$one_lang->lang}}</a>
                                @endforeach
                            </td>
                            @if($groupSubRelations->active == 1)
                                <td class="small active-link">
                                    <a href=""
                                       class="change-active {{$one_promotion->PromotionsId->active == 1 ? ' active' : ''}}"
                                       data-active="{{$one_promotion->PromotionsId->active}}"
                                       element-id="{{$one_promotion->PromotionsId->id}}"></a>
                                </td>
                            @endif
                            <td class="dragHandle" nowrap=""></td>
                            @if($groupSubRelations->del_to_rec == 1)
                                <td class="check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$one_promotion->promotions_id}}]"
                                           value="{{$one_promotion->promotions_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($one_promotion->name).'/destroyPromotionToCart')}}">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="10">
                            @include('admin.pagination', ['paginator' => $promotion_id])
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