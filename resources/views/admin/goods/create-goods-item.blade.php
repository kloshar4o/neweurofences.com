@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                    trans('variables.add_object') => urlForLanguage($lang, 'creategoodsitem'),
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

        <div class="form-page">
            <div class="form-head">
                <span>{{trans('variables.add_element')}}</span>
            </div>
            <div class="form-body">
                <form class="form" method="POST" action="{{ urlForLanguage($lang, 'saveitem') }}" id="add-form"
                      enctype="multipart/form-data" page="add-item">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="lang">{{trans('variables.lang')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="lang" id="lang" class="select2">
                                @foreach($lang_list as $lang_key => $one_lang)
                                    <option value="{{$one_lang->id}}" {{$one_lang->id == $lang_id ? 'selected' : ''}}>{{$one_lang->descr}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="p_id">{{trans('variables.p_id_name')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="p_id" id="p_id" class="select2">
                                {!! SelectGoodsItemTree($lang_id, 0 ,$curr_page_id) !!}
                            </select>
                        </div>
                    </div>


                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="p_id_other">{{trans('variables.p_id_other')}}</label>
                        </div>

                        <div class="input-wrap">

                            <select name="p_id_other[]" id="p_id_other" class="select2" multiple>
                                {!! SelectGoodsItemTreeOther($lang_id, 0, 0 ,$curr_page_id) !!}
                            </select>
                        </div>
                    </div>

                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="name">{{trans('variables.title_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="name" id="name">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="alias">{{trans('variables.alias_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="alias" id="alias">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="alias">{{myTrans('sku')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="sku" id="sku">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="descr">{{trans('variables.short_description')}}</label>
                        </div>
                        <div class="input-wrap">
                            <textarea id="descr" name="short_descr" rows="10"></textarea>
                        </div>
                    </div>
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="one_c_code">{{trans('variables.1c_code')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<input id="one_c_code" name="one_c_code">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    @if(!$brand->isEmpty())
                        <div class="fields-row">
                            <div class="label-wrap">
                                <label for="brand_id">{{trans('variables.brand')}}</label>
                            </div>
                            <div class="input-wrap">
                                <select name="brand_id" id="brand_id" class="select2">
                                    @foreach($brand as $one_brand)
                                        <option value="{{$one_brand->id or ''}}">{{$one_brand->name or ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    {{--@if(!empty($goods_parameter))--}}
                        {{--@foreach($goods_parameter as $one_parameter)--}}
                            {{--<div class="fields-row">--}}
                                {{--<div class="label-wrap">--}}
                                    {{--<label for="{{$one_parameter->parametrId->alias or ''}}">{{$one_parameter->name or ''}}</label>--}}
                                {{--</div>--}}
                                {{--<div class="input-wrap">--}}
                                    {{--<input type="hidden" name="goods_parametr_id[]"--}}
                                           {{--value="{{$one_parameter->goods_parametr_id or ''}}">--}}
                                    {{--{{addEditParameterInItem($one_parameter->goods_parametr_id, $lang_id, null, $curr_page_id, $goods_subject_id)}}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="show_on_main">{{trans('variables.show_on_main')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<input type="checkbox" name="show_on_main" id="show_on_main">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="popular_element">{{trans('variables.popular_element')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<input type="checkbox" name="popular_element" id="popular_element">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="new_element">{{trans('variables.new_element')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<input type="checkbox" name="new_element" id="new_element">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="fields-row new_element hidden">--}}
                        {{--<div class="label-wrap">--}}
                            {{--<label for="datepicker">{{trans('variables.date_table')}}</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<input class="datetimepicker" id="datepicker" name="add_date"--}}
                                   {{--value="{{date('d-m-Y')}}">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--Goods for set--}}
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="goods_set">Set</label>
                        </div>
                        <div class="input-wrap">
                            <input type="checkbox" name="goods_set" id="goods_set">
                        </div>
                    </div>
                    <div class="fields-row goods_set " style="display: none;">
                        <div class="label-wrap">
                            <label for="set_item_1">Элемент 1</label>
                        </div>
                        <div class="input-wrap">
                            <select class="select2" id="set_item_1" name="set_item_1">
                                @if(!empty($goods_items_for_set))
                                    @foreach($goods_items_for_set as $one_item_for_set)
                                        <option value="{{ $one_item_for_set->goods_item_id }}">{{ $one_item_for_set->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="label-wrap">
                            <label for="set_item_1">Элемент 1 - количество</label>
                        </div>
                        <div class="input-wrap">
                            <input type="text" class="set_item_numb_1" id="set_item_numb_1" name="set_item_numb_1" value="">
                        </div>

                        <div class="label-wrap">
                            <label for="set_item_2">Элемент 2</label>
                        </div>
                        <div class="input-wrap">
                            <select class="select2" id="set_item_2" name="set_item_2">
                                @if(!empty($goods_items_for_set))
                                    @foreach($goods_items_for_set as $one_item_for_set)
                                        <option value="{{ $one_item_for_set->goods_item_id }}">{{ $one_item_for_set->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="label-wrap">
                            <label for="set_item_2">Элемент 2 - количество</label>
                        </div>
                        <div class="input-wrap">
                            <input type="text" class="set_item_numb_2" id="set_item_numb_2" name="set_item_numb_2" value="">
                        </div>
                    </div>
                    {{--<div class="fields-row modules">--}}
                        {{--<div class="fields-title">--}}
                            {{--<span>{{trans('variables.modules')}}</span>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                            {{--<div class="module">--}}
                                {{--<div class="label-wrap">--}}
                                    {{--<label for="title_1">{{trans('variables.module_title')}}</label>--}}
                                {{--</div>--}}
                                {{--<div class="input-wrap">--}}
                                    {{--<input name="module_title[]" id="title_1">--}}
                                {{--</div>--}}
                                {{--<div class="label-wrap">--}}
                                    {{--<label for="body1">{{trans('variables.description')}}</label>--}}
                                {{--</div>--}}
                                {{--<div class="input-wrap">--}}
                                    {{--<textarea name="content[]" id="body1" data-type="ckeditor"></textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="button-new-module">--}}
                                {{--<button class="btn new_module" type="button"--}}
                                        {{--data-title="{{trans('variables.module_title')}}"--}}
                                        {{--data-description="{{trans('variables.description')}}">{{trans('variables.new_module')}}</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    {{--Color--}}
                    <div style="position: relative">
                        <div class="label-wrap">
                            <label for="color">Цвет</label>
                        </div>
                        <div class="input-wrap">

{{--                                @foreach($colors_list as $color)
                                    <li >
                                        <input type="checkbox" value="{{$color->goods_colors_id}}" name="goods_colors_id[{{$color->goods_colors_id}}]"/>
                                        <img src="/upfiles/goods/{{ $color->img }}"/>
                                        <a>{{ $color->name }}</a>
                                    </li>
                                @endforeach
                            --}}

                            <div class="item-page-colors">


                                    @foreach($colors_list as $color)

                                        <div>

                                            <input id="input_{{$color->id}}" type="checkbox" value="{{$color->goods_colors_id}}" name="goods_colors_id[{{$color->goods_colors_id}}]"/>

                                            <label for="input_{{$color->id}}"
                                                   title="{{$color->name}}({{$color->ral}})"
                                                   class="{{$color->ral}} hexagon2">

                                                <div class="ratio-1-1" style="background-color: {{$color->hex}};"></div>

                                                <div class="item-page-check">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" style="fill: {{$color->hex}};">
                                                        <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"></path>
                                                    </svg>
                                                </div>

                                                <div class="item-page-text">{{$color->name}}</div>

                                            </label>
                                        </div>

                                    @endforeach
                            </div>

                        </div>
                    </div>
                    {{--End color--}}



                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="price">Цена</label>
                        </div>
                        <div class="input-wrap">
                            <input name="price" id="price">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="complect">Комплектация</label>
                        </div>
                        <div class="input-wrap">
                            <select class="select2" id="complect" name="complect">
                                <option value="pcs">Preț / Buc</option>
                                <option value="m2">Preț / M2</option>
                                <option value="set">Preț / Set</option>
                            </select>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="weight">Вес</label>
                        </div>
                        <div class="input-wrap">
                            <input name="weight" id="weight">
                        </div>
                    </div>
                    <div class="fields-row goods_set ">
                        <div class="label-wrap">
                            <label for="recomend">Рекомендуемые товары</label>
                        </div>
                        <div class="input-wrap">
                            <select class="select2" id="recomend" name="recomend[]" multiple="multiple">
                                @if(!empty($goods_recomendet))
                                    @foreach($goods_recomendet as $one_recomend)
                                        <option value="{{ $one_recomend->goods_item_id }}">{{ $one_recomend->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="title">{{trans('variables.general_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="title" id="title">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="h1_title">{{trans('variables.h1_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="h1_title" id="h1_title">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_title">{{trans('variables.meta_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_title" id="meta_title">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_keywords">{{trans('variables.meta_keywords_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_keywords" id="meta_keywords">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_description">{{trans('variables.meta_description_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_description" id="meta_description">
                        </div>
                    </div>

                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="body0">{{trans('variables.description')}}</label>
                        </div>
                        <div class="input-wrap">
                            <textarea name="body" id="body0" data-type="ckeditor"></textarea>
                        </div>
                    </div>
                    @if($groupSubRelations->save == 1)
                        <button class="btn" onclick="saveForm(this)"
                                data-form-id="add-form">{{trans('variables.save_it')}}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

@stop