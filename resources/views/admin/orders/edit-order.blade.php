@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @include('admin.list-elements', [
        'actions' => [
            trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
            trans('variables.edit_element') => urlForFunctionLanguage($lang, str_slug($orders->ordersUsers->name) . '/edititem/' . $orders->id),
            trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'ordersCart/orderscart')
        ]
    ])


        <div class="list-table">
            <div class="table-title">
                <span>Order info</span>
            </div>
            <table class="table" empty-response="{{trans('variables.list_is_empty')}}">
                <thead>
                <tr>
                    <th>{{trans('variables.order_type')}}</th>
                    <th>{{trans('variables.delivery_method')}}</th>
                    <th>{{trans('variables.pay_method')}}</th>
                    <th>{{trans('variables.total_count')}}</th>
                    <th>{{trans('variables.total_price')}}</th>
                    <th>{{trans('variables.date_table')}}</th>
                    @if($groupSubRelations->active == 1)
                        <th>{{trans('variables.active_table')}}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <span>{{$orders->fast_order == 1 ? 'Fast' : 'Simple'}}</span>
                    </td>
                    <td>
                        <span>{{$orders->delivery_method or ''}}</span>
                    </td>
                    <td>
                        <span>{{$orders->pay_method or ''}}</span>
                    </td>
                    <td>
                        <span>{{$orders->ordersData->total_count or ''}}</span>
                    </td>
                    <td>
                        <span>{{$orders->ordersData->total_price or ''}}</span>
                    </td>
                    <td>
                        <span>{{$orders->created_at or ''}}</span>
                    </td>
                    @if($groupSubRelations->active == 1)
                        <td class="small active-link">
                            <a href="" class="change-active{{$orders->active == 1 ? ' active' : ''}}"
                               data-active="{{$orders->active}}" action="edit-order" url="{{$url_for_active_elem}}"
                               element-id="{{$orders->id}}"></a>
                        </td>
                    @endif
                </tr>
                <tfoot>
                <tr>
                    <td colspan="10"></td>
                </tr>
                </tfoot>
            </table>

            <div class="table-delimiter"></div>

            <div class="table-title">
                <span>User info</span>
            </div>
            <table class="table" empty-response="{{trans('variables.list_is_empty')}}">
                <thead>
                <tr>
                    <th>{{trans('variables.name_text')}}</th>
                    {{--<th>{{trans('variables.email_text')}}</th>--}}
                    <th>{{trans('variables.phone')}}</th>
                    {{--<th>{{trans('variables.address')}}</th>--}}
                    <th>{{trans('variables.comment_table')}}</th>
                    {{--<th>{{trans('variables.district')}}</th>--}}
                    {{--<th>{{trans('variables.city')}}</th>--}}
                    {{--<th>{{trans('variables.house')}}</th>--}}
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <span>{{$orders->ordersUsers->name or ''}}</span>
                    </td>
                    {{--<td>--}}
                        {{--<span>{{$orders->ordersUsers->email or ''}}</span>--}}
                    {{--</td>--}}
                    <td>
                        <span>{{$orders->ordersUsers->phone or ''}}</span>
                    </td>
                    {{--<td>--}}
                        {{--<span>{{$orders->ordersUsers->address or ''}}</span>--}}
                    {{--</td>--}}
                    <td>
                        <span>{{$orders->ordersUsers->descr or ''}}</span>
                    </td>
                    {{--<td>--}}
                        {{--<span>{{$orders->ordersUsers->district or ''}}</span>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<span>{{$orders->ordersUsers->city or ''}}</span>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<span>{{$orders->ordersUsers->house or ''}}</span>--}}
                    {{--</td>--}}
                </tr>
                <tfoot>
                <tr>
                    <td colspan="10"></td>
                </tr>
                </tfoot>
            </table>

            @if(!$orderedItems->isEmpty())
            <div class="table-delimiter"></div>

            <div class="table-title">
                <span>Ordered items</span>
            </div>
            <table class="table" empty-response="{{trans('variables.list_is_empty')}}">
                <thead>
                <tr>
                    <th>{{trans('variables.name_text')}}</th>
                    {{--<th>{{trans('variables.barcode')}}</th>--}}
                    <th>{{trans('variables.price')}}</th>
                    <th>{{trans('variables.total_count')}}</th>
                    <th>{{trans('variables.date_table')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderedItems as $orderedItem)
                    <tr>
                        <td>
                            <span>{{$orderedItem->goods_name or ''}}</span>
                        </td>
                        {{--<td>--}}
                            {{--<span>{{$orderedItem->one_c_code or ''}}</span>--}}
                        {{--</td>--}}
                        <td>
                            <span>{{$orderedItem->goods_price or ''}}</span>
                        </td>
                        <td>
                            <span>{{$orderedItem->items_count or ''}}</span>
                        </td>
                        <td>
                            <span>{{$orderedItem->created_at or ''}}</span>
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                <tr>
                    <td colspan="10"></td>
                </tr>
                </tfoot>
            </table>
            @endif

        </div>
        <div id="loader-gif" class="loader-list"></div>
    </div>

@stop

