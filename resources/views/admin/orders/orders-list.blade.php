@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @include('admin.list-elements', [
            'actions' => [
                trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'ordersCart/orderscart')
            ]
        ])


        <div class="list-table">
            @if(!$orders->isEmpty())
                <table class="table" empty-response="{{trans('variables.list_is_empty')}}">
                    <thead>
                    <tr>
                        <th>{{trans('variables.name_text')}}</th>
                        {{--<th>{{trans('variables.email_text')}}</th>--}}
                        <th>{{trans('variables.phone')}}</th>
                        <th>{{trans('variables.date_table')}}</th>
                        <th>{{trans('variables.total_count')}}</th>
                        <th>{{trans('variables.total_price')}}</th>
                        <th>{{trans('variables.delivery_method')}}</th>
                        <th>{{trans('variables.pay_method')}}</th>
                        @if($groupSubRelations->active == 1)
                            <th>{{trans('variables.active_table')}}</th>
                            <th>{{trans('variables.edit_table')}}</th>
                        @endif
                        @if($groupSubRelations->del_to_rec == 1 || $groupSubRelations->del_from_rec == 1)
                            <th class="remove-all">{{trans('variables.delete_table')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $one_order)
                        <tr id="{{$one_order->id or ''}}">
                            <td>
                                <span>{{$one_order->ordersUsers->name or ''}}</span>
                            </td>
                            {{--<td>--}}
                                {{--<span>{{$one_order->ordersUsers->email or ''}}</span>--}}
                            {{--</td>--}}
                            <td>
                                <span>{{$one_order->ordersUsers->phone or ''}}</span>
                            </td>
                            <td>
                                <span>{{$one_order->created_at or ''}}</span>
                            </td>
                            <td>
                                <span>{{$one_order->ordersData->total_count or ''}}</span>
                            </td>
                            <td>
                                <span>{{$one_order->ordersData->total_price or ''}}</span>
                            </td>
                            <td>
                                <span>{{$one_order->delivery_method or ''}}</span>
                            </td>
                            <td>
                                <span>{{$one_order->pay_method or ''}}</span>
                            </td>
                            @if($groupSubRelations->active == 1)
                                <td class="small active-link">
                                    <a href="" class="change-active{{$one_order->active == 1 ? ' active' : ''}}"
                                       data-active="{{$one_order->active}}"
                                       element-id="{{$one_order->id}}"></a>
                                </td>
                            @endif
                            <td class="link-block">
                                <a href="{{urlForFunctionLanguage($lang, str_slug($one_order->ordersUsers->name).'/edititem/'.$one_order->id)}}">{{trans('variables.edit_table')}}</a>
                            </td>
                            @if($groupSubRelations->del_to_rec == 1 || $groupSubRelations->del_from_rec == 1)
                                <td class="check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements"
                                           name="destroy_elements[{{$one_order->id}}]"
                                           value="{{$one_order->id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($one_order->ordersUsers->name).'/destroyOrderToCart')}}">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="10">
                            @include('admin.pagination', ['paginator' => $orders])
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