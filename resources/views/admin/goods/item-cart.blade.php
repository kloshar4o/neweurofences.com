@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                    trans('variables.add_subject') => urlForLanguage($lang, 'creategoodsitem'),
                    trans('variables.elements_basket') => urlForLanguage($lang, 'goodsitemcart')
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                    trans('variables.elements_basket') => urlForLanguage($lang, 'goodsitemcart')
                ]
            ])
        @endif


        <div class="list-table">
            @if(!empty($deleted_item_elems))
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
                    @foreach($deleted_item_elems as $deleted_one_item_elem)
                        <tr id="{{$deleted_one_item_elem->goods_item_id}}">
                            <td>
                                <span>{{!empty(IfHasName($deleted_one_item_elem->goods_item_id, $lang_id, 'goods_item')) ? IfHasName($deleted_one_item_elem->goods_item_id, $lang_id, 'goods_item') : trans('variables.another_name')}}</span>
                            </td>
                            <td class="medium check-restore-element">
                                <input type="checkbox" class="restore-all-elements"
                                       name="restore_elements[{{$deleted_one_item_elem->goods_item_id}}]"
                                       value="{{$deleted_one_item_elem->goods_item_id}}"
                                       url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_item_elem->name).'/restoreGoodsItem')}}">
                            </td>
                            @if($groupSubRelations->del_from_rec == 1)
                                <td class="medium check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$deleted_one_item_elem->goods_item_id}}]"
                                           value="{{$deleted_one_item_elem->goods_item_id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($deleted_one_item_elem->name).'/destroyGoodsItemFromCart')}}">
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