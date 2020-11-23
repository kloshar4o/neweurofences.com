@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="form-content">
        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                    trans('variables.add_item') => urlForLanguage($lang, 'creategoodsitem'),
                    trans('variables.elements_basket') => urlForLanguage($lang, 'goodsitemcart'),
                    trans('variables.edit_element') => urlForLanguage($lang, 'editgoodsitem/'.$goods_without_lang->goods_item_id.'/'.$edited_lang_id)
                ]
            ])
        @else
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                    trans('variables.elements_basket') => urlForLanguage($lang, 'goodsitemcart'),
                    trans('variables.edit_element') => urlForLanguage($lang, 'editgoodsitem/'.$goods_without_lang->goods_item_id.'/'.$edited_lang_id)
                ]
            ])
        @endif

        <div class="form-page">

            <div class="form-head">
                <span>{{trans('variables.edit_element')}} "{{$goods_elems->name or ''}}"</span>
            </div>
            <div class="form-body">
                <form class="form" method="POST"
                      action="{{ urlForLanguage($lang, 'saveitem/'.$goods_without_lang->goods_item_id.'/'.$edited_lang_id) }}"
                      id="edit-form" enctype="multipart/form-data" page="edit-item">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="lang">{{trans('variables.lang')}}</label>
                        </div>
                        <div class="input-wrap">
                            <select name="lang" id="lang" class="select2">
                                @foreach($lang_list as $lang_key => $one_lang)
                                    <option value="{{$one_lang->id}}" {{$one_lang->id == $edited_lang_id ? 'selected' : ''}}>{{$one_lang->descr}}</option>
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
                                {!! SelectGoodsItemTree($lang_id, 0 ,$goods_item_id->goods_subject_id) !!}
                            </select>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="p_id_other">{{trans('variables.p_id_other')}}</label>
                        </div>

                        <div class="input-wrap">
                            <select name="p_id_other[]" id="p_id_other" class="select2" multiple>
                                @if($goods_elems)
                                    {!! SelectGoodsItemTreeOther($lang_id, 0, $goods_elems->id ,$goods_item_id->goods_subject_id) !!}
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="name">{{trans('variables.title_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="name" id="name" value="{{$goods_elems->name or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="alias">{{trans('variables.alias_table')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="alias" id="alias" value="{{$goods_item_id->alias or ''}}"> <span
                                    class="btn btn-inline refresh_alias">Refresh Alias</span>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="alias">{{myTrans('sku')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="sku" id="sku" value="{{$goods_item_id->sku or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="descr">{{trans('variables.short_description')}}</label>
                        </div>
                        <div class="input-wrap">
                            <textarea id="descr" name="short_descr"
                                      rows="10">{{$goods_elems->short_descr or ''}}</textarea>
                        </div>
                    </div>
                    @if(!$brand->isEmpty())
                        <div class="fields-row">
                            <div class="label-wrap">
                                <label for="brand_id">{{trans('variables.brand')}}</label>
                            </div>
                            <div class="input-wrap">
                                <select name="brand_id" id="brand_id" class="select2">
                                    @foreach($brand as $one_brand)
                                        <option value="{{$one_brand->id or ''}}" {{$goods_item_id->brand_id == $one_brand->id ? 'selected' : ''}}>{{$one_brand->name or ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    @if(!empty($goods_parameter))
                        @foreach($goods_parameter as $one_parameter)
                            <div class="fields-row">
                                <div class="label-wrap">
                                    <label for="{{$one_parameter->parametrId->alias or ''}}">{{$one_parameter->name or ''}}</label>
                                </div>
                                <div class="input-wrap">
                                    <input type="hidden" name="goods_parametr_id[]"
                                           value="{{$one_parameter->goods_parametr_id or ''}}">
                                    {{addEditParameterInItem($one_parameter->goods_parametr_id, $edited_lang_id, $goods_without_lang->goods_item_id, $goods_subject_id)}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="goods_set">Set</label>
                        </div>
                        <div class="input-wrap">
                            <input type="checkbox" name="goods_set"
                                   id="goods_set" {{$goods_item_id->goods_set == 1 ? 'checked' : ''}}>
                        </div>
                    </div>
                    <div class="fields-row goods_set {{$goods_item_id->goods_set == 0 ? ' hidden' : ''}}">
                        @for($i=0;$i<2;$i++)

                            <?$n = $i + 1;?>
                            <div class="label-wrap">
                                <label for="set_item_1">Item {{ $n }}</label>
                            </div>
                            <div class="input-wrap">
                                <select class="select2" id="set_item_{{ $n }}" name="set_item_{{ $n }}">
                                    @if(!empty($goods_items_for_set))
                                        @foreach($goods_items_for_set as $one_item_for_set)
                                            <option value="{{ $one_item_for_set->goods_item_id }}"
                                                    {{ !empty($goods_set[$i]) && $one_item_for_set->goods_item_id == $goods_set[$i]->set_goods_item_id? ' selected' : '' }}
                                            >{{ $one_item_for_set->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="label-wrap">
                                <label for="set_item_{{ $n }}">Item {{ $n }}(number)</label>
                            </div>
                            <div class="input-wrap">
                                <input type="text" class="set_item_numb_{{ $n }}" id="set_item_numb_{{ $n }}"
                                       name="set_item_numb_{{ $n }}"
                                       value="{{  !empty($goods_set[$i])?$goods_set[$i]->set_items_number : '' }}">
                            </div>
                        @endfor

                        {{--<div class="label-wrap">--}}
                        {{--<label for="set_item_2">Элемент 2</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                        {{--<select class="select2" id="set_item_2" name="set_item_2">--}}
                        {{--@if(!empty($goods_items_for_set))--}}
                        {{--@foreach($goods_items_for_set as $one_item_for_set)--}}
                        {{--<option value="{{ $one_item_for_set->goods_item_id }}" {{ !is_null(ifSetItemPresent($goods_item_id->id,$one_item_for_set->goods_item_id))? 'checked' : '' }}>{{ $one_item_for_set->name }}</option>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}
                        {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="label-wrap">--}}
                        {{--<label for="set_item_2">Элемент 2 - количество</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-wrap">--}}
                        {{--<input type="text" class="set_item_numb_2" id="set_item_numb_2" name="set_item_numb_2" value="">--}}
                        {{--</div>--}}
                    </div>
                    <div style="position: relative">
                        <div class="label-wrap">
                            <label for="color">Цвет</label>
                        </div>


                        {{--                        <div class="input-wrap">
                                                    <ul>
                                                        @foreach($colors_list as $color)
                                                            <li style="width:160px;">
                                                                <input type="checkbox" value="{{$color->goods_colors_id}}" name="goods_colors_id[{{$color->goods_colors_id}}]" {{ in_array($color->goods_colors_id,$check_array)? 'checked' : '' }}/>
                                                                <a>{{ $color->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>--}}

                        <div class="item-page-colors">
                            @foreach($colors_list as $color)

                                <input id="ral{{$color->ral}}"
                                       type="checkbox"
                                       value="{{$color->goods_colors_id}}"
                                       name="goods_colors_id[{{$color->goods_colors_id}}]"
                                        {{ in_array($color->goods_colors_id,$check_array)? 'checked' : '' }}/>

                            @endforeach

                            @foreach($colors_list as $color)

                                <div>

                                    <input id="input_{{$color->id}}"
                                           type="checkbox"
                                           value="{{$color->goods_colors_id}}"
                                           name="goods_colors_id[{{$color->goods_colors_id}}]"
                                            {{ in_array($color->goods_colors_id,$check_array)? 'checked' : '' }}/>

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
                    {{--End color--}}

                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="price">Цена</label>
                        </div>
                        <div class="input-wrap">
                            <input name="price" id="price" value="{{$goods_item_id->price or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="complect">Комплектация</label>
                        </div>
                        <div class="input-wrap">
                            <select class="select2" id="complect" name="complect">
                                <option value="pcs" {{ $goods_item_id->complect == 'pcs'?  'selected' : '' }}>Preț /
                                    Buc
                                </option>
                                <option value="m2" {{ $goods_item_id->complect == 'm2' ? 'selected' : '' }}>Preț / M2
                                </option>
                                <option value="set" {{ $goods_item_id->complect == 'set' ? 'selected' : '' }}>Preț /
                                    Set
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="weight">Вес</label>
                        </div>
                        <div class="input-wrap">
                            <input name="weight" id="weight" value="{{$goods_item_id->weight or ''}}">
                        </div>
                    </div>
                    @if($goods_item_id->goods_set == 0)
                        <div class="fields-row ">
                            <div class="label-wrap">
                                <label for="recomend">Рекомендуемые товары</label>
                            </div>
                            <div class="input-wrap">
                                <select class="select2" id="recomend" name="recomend[]" multiple="multiple">
                                    @if(!empty($goods_recomendet))
                                        <?php $array = explode(',', $goods_item_id->recomend)?>
                                        @foreach($goods_recomendet as $one_recomend)
                                            <option value="{{ $one_recomend->goods_item_id }}" {{ !empty($array) &&  in_array($one_recomend->goods_item_id, $array)? 'selected' : '' }}>{{ $one_recomend->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="title">{{trans('variables.general_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="title" id="title" value="{{$goods_elems->page_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="h1_title">{{trans('variables.h1_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="h1_title" id="h1_title" value="{{$goods_elems->h1_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_title">{{trans('variables.meta_title_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_title" id="meta_title" value="{{$goods_elems->meta_title or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_keywords">{{trans('variables.meta_keywords_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_keywords" id="meta_keywords"
                                   value="{{$goods_elems->meta_keywords or ''}}">
                        </div>
                    </div>
                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="meta_description">{{trans('variables.meta_description_page')}}</label>
                        </div>
                        <div class="input-wrap">
                            <input name="meta_description" id="meta_description"
                                   value="{{$goods_elems->meta_description or ''}}">
                        </div>
                    </div>

                    <div class="fields-row">
                        <div class="label-wrap">
                            <label for="body0">{{trans('variables.description')}}</label>
                        </div>
                        <div class="input-wrap">
                            <textarea name="body" id="body0"
                                      data-type="ckeditor">{{$goods_elems->body or ''}}</textarea>
                        </div>
                    </div>
                    @if($groupSubRelations->save == 1)
                        <button class="btn" onclick="saveForm(this)"
                                data-form-id="edit-form">{{trans('variables.save_it')}}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

@stop