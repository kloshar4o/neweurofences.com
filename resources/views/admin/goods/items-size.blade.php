@extends('admin.app')

@section('content')

    @include('admin.breadcrumbs')

    <div class="list-page">


        @if($groupSubRelations->new == 1)
            @include('admin.list-elements', [
                'actions' => [
                    trans('variables.elements_list') => urlForLanguage($lang, 'memberslist'),
                    trans('variables.add_subject') => urlForLanguage($lang, 'creategoodsitem'),
                    trans('variables.edit_element') => urlForFunctionLanguage($lang, getSubjectByItem($goods_item_id->goods_subject_id)->alias.'/editgoodsitem/'.$goods_item->goods_item_id.'/'.$lang_id),
                    trans('variables.size') => urlForLanguage($lang, 'itemssize/'.$goods_item->goods_item_id),
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

        @php( $dimensions = ['height', 'width', 'gap', 'model', 'thickness'])
        @php( $input_sections = [
                ['number' => ['price'], 'text' => ['sku|required']],
                ['number' => $dimensions ],
                ['text' => ['url_3d']]
            ])


        <div class="form-page">

            <div class="form-head">{{$goods_item->name or ''}}</div>

            <div class="list-table">

                @if(!empty($goods_size) )

                    <table class="table" id="tablelistsorter"
                           action="gallery"
                           url="{{$url_for_active_elem}}"
                           empty-response="{{myTrans('List is empty')}}">

                        <thead>
                        <tr>
                            <th>{{myTrans('Image')}}</th>

                            <th>{{myTrans('Price')}}</th>

                            <th>{{ myTrans('SKU') }}</th>

                            @foreach($dimensions as $key)

                                <th>{{ myTrans($key) }}</th>

                            @endforeach

                            <th>{{myTrans('Edit')}}</th>

                            <th>{{myTrans('Active')}}</th>

                            <th>{{myTrans('Position')}}</th>

                            <th>{{myTrans('Delete')}}</th>

                        </tr>
                        </thead>

                        <tbody>

                        @foreach($goods_size as $one_goods_size)
                            <tr id="{{$one_goods_size->id or ''}}">

                                <td class="small">
                                    <img src="/upfiles/size/{{$one_goods_size->img}}">
                                </td>

                                <td class="small">
                                    @money($one_goods_size->price)
                                </td>


                                <td class="small">
                                    <em>{{ $one_goods_size->sku}}</em>
                                </td>

                                @foreach($dimensions as $key)

                                    <td class="small">
                                        <em>{{ $one_goods_size->{$key} }}</em>
                                    </td>

                                @endforeach

                                <td class="small">

                                    <button onclick="$('#edit-size-show-{{$one_goods_size->id}}').toggle();"
                                            class="btn">
                                        {{myTrans('Edit')}}
                                    </button>

                                </td>

                                <td class="small active-link">

                                    <a href="javascript:void(0)"
                                       class="change-active {{$one_goods_size->active == 1 ? 'active' : ''}}"
                                       data-active="{{$one_goods_size->active}}"
                                       element-id="{{$one_goods_size->id}}"
                                       action="size"
                                       url="{{$url_for_active_elem}}">

                                    </a>

                                </td>

                                <td class="small dragHandle" nowrap=""></td>

                                @if($groupSubRelations->del_from_rec == 1)
                                    <td class="small check-destroy-element">
                                        <input type="checkbox"
                                               class="remove-all-elements"
                                               name="destroy_elements[{{$one_goods_size->id}}]"
                                               value="{{$one_goods_size->id}}"
                                               url="{{urlForLanguage($lang, 'destroygoodssize')}}">
                                    </td>
                                @endif
                            </tr>

                            <tr id="edit-size-show-{{$one_goods_size->id}}" style="display: none;">
                                <td colspan="12">
                                    <div class="altehForm">

                                        <div class="imageHolder">
                                            <label for="editfile">
                                                <img src="{{asset('upfiles/size')}}/{{(!empty($one_goods_size->img)) ? $one_goods_size->img : 'noImage.jpg'}}"
                                                     alt="no-image">
                                            </label>
                                        </div>

                                        <form class="form"
                                              action="{{ urlForLanguage($lang, 'saveItemSize') }}"
                                              onsubmit="saveFormNew(event)">

                                            <input type="hidden" name="id" value="{{$one_goods_size->id}}"/>

                                            @foreach ($input_sections as $section)

                                                <div>

                                                    @foreach ($section as $type => $inputs)

                                                        @foreach($inputs as $input)

                                                            @php($input_explode = explode('|', $input))
                                                            @php($name = $input_explode[0])
                                                            @php($required = $input_explode[1] ?? '')

                                                            <div class="field">

                                                                <label for="{{$one_goods_size->id .'_'. $name}}" class="{{$required}}">
                                                                    {{myTrans($name)}}
                                                                </label>

                                                                <input id="{{$one_goods_size->id}}_{{$name}}"
                                                                       value="{{$one_goods_size->{$name} }}"
                                                                       type="{{$type}}"
                                                                       step="1"
                                                                       name="{{$name}}"
                                                                        {{$required}}/>

                                                            </div>
                                                        @endforeach


                                                    @endforeach

                                                </div>
                                            @endforeach


                                            <div class="item-page-select-color">

                                                <div class="item-page-colors">

                                                    @foreach($colors_list as $color)

                                                        <div>
                                                            <input type="checkbox"
                                                                   name="colors[]"
                                                                   value="{{$color->id}}"
                                                                   id="input_{{$color->id}}_{{$one_goods_size->id}}"
                                                                    {{ in_array($color->goods_colors_id,explode(", ",$one_goods_size->colors))? 'checked' : '' }}>


                                                            <label for="input_{{$color->id}}_{{$one_goods_size->id}}"
                                                                   title="{{$color->name}}({{$color->ral}})"
                                                                   class="{{$color->ral}} hexagon2">

                                                                <div class="ratio-1-1"
                                                                     style="background-color: {{$color->hex}};"></div>

                                                                <div class="item-page-check">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24"
                                                                         viewBox="0 0 24 24"
                                                                         style="fill: {{$color->hex}};">
                                                                        <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"></path>
                                                                    </svg>
                                                                </div>

                                                                <div class="item-page-text">{{$color->name}}</div>

                                                            </label>
                                                        </div>

                                                    @endforeach

                                                </div>

                                            </div>


                                            <div>
                                                <div class="field big">
                                                    <label for="editfile">{{myTrans('Image')}} (580x385)</label>

                                                    <input type="file" id="editfile" name="img" data-update="false"/>
                                                </div>
                                            </div>


                                            <button class="btn"
                                                    data-form-id="edit-size-{{$one_goods_size->id}}">Save
                                            </button>


                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
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

        </div>

        <div class="altehForm">

            <form class="form" action="{{ urlForLanguage($lang, 'saveItemSize') }}" onsubmit="saveFormNew(event)"
                  id="add-form-size" enctype="multipart/form-data" page="add-item">

                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                <input type="hidden" name="goods_item_id" value="{{Request::segment(6)}}"/>


                @foreach ($input_sections as $section)

                    <div>

                        @foreach ($section as $type => $inputs)

                            @foreach($inputs as $input)

                                @php($input_explode = explode('|', $input))
                                @php($name = $input_explode[0])
                                @php($required = $input_explode[1] ?? '')


                                <div class="field">

                                    <label for="{{$name}}" class="{{$required}}">{{myTrans($name)}}</label>

                                    <input id="{{$name}}"
                                           type="{{$type}}"
                                           name="{{$name}}"
                                            {{$required}}/>
                                </div>
                            @endforeach


                        @endforeach

                    </div>
                @endforeach

                <div class="item-page-select-color">

                    <div class="item-page-colors">

                        @foreach($colors_list as $color)

                            <div>
                                <input type="checkbox"
                                       name="colors[]"
                                       value="{{$color->id}}"
                                       id="input_{{$color->id}}">

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

                <div>
                    <div class="field big">
                        <label for="editfile">{{myTrans('Image')}} (580x385)</label>

                        <input type="file" id="editfile" name="img" data-update="false"/>

                    </div>
                </div>

                <button class="btn">{{myTrans('save')}}</button>


            </form>


        </div>

        <div id="loader-gif" class="loader-list"></div>

    </div>
@stop
