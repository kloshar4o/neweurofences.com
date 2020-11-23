@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">

        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.add_element') => urlForFunctionLanguage($lang, 'createBrand/createitem'),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'brandsCart/cartitems')
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForFunctionLanguage($lang, ''),
                    trans('variables.elements_basket') => urlForFunctionLanguage($lang, 'brandsCart/cartitems')
                ]
            ])
        @endif


        <div class="list-table">
            @if(!$brand_list->isEmpty())
                <table class="table" empty-response="{{trans('variables.list_is_empty')}}">
                    <thead>
                    <tr>
                        <th>{{trans('variables.title_table')}}</th>
                        <th>{{trans('variables.edit_table')}}</th>
                        @if($groupSubRelations->active == 1)
                            <th>{{trans('variables.active_table')}}</th>
                        @endif
                        @if($groupSubRelations->del_to_rec == 1)
                            <th class="remove-all">{{trans('variables.delete_table')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brand_list as $key => $brand)
                        <tr id="{{$brand->id}}">
                            <td>
                                <span>{{$brand->name or ''}}</span>
                            </td>
                            <td class="link-block">
                                <a href="{{urlForFunctionLanguage($lang, str_slug($brand->name).'/edititem/'.$brand->id)}}">{{trans('variables.edit_table')}}</a>
                            </td>
                            @if($groupSubRelations->active == 1)
                                <td class="small active-link">
                                    <a href="" class="change-active {{$brand->active == 1 ? ' active' : ''}}"
                                       data-active="{{$brand->active}}"
                                       element-id="{{$brand->id}}"></a>
                                </td>
                            @endif
                            @if($groupSubRelations->del_to_rec == 1)
                                <td class="check-destroy-element">
                                    <input type="checkbox" class="remove-all-elements" name="destroy_elements[{{$brand->id}}]"
                                           value="{{$brand->id}}"
                                           url="{{urlForFunctionLanguage($lang, str_slug($brand->name).'/destroyBrandToCart')}}">
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
