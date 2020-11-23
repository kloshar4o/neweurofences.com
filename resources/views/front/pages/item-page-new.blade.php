@extends('front.front-app')

@include('front.header')

@section('container')


    @php($priceText = getPrices($goods_item->goods_item_id))

    <div class="container item-page">

        @include('front.pages.breadcrumbs-alt')

        {{--Admin button--}}
        @if(Auth::check())

            <div class="editPageBtn fixed">
                <a target="_blank"
                   href="/{{$lang}}/back/goods/{{$children}}/editgoodsitem/{{$goods_item->goods_item_id}}/1"><img
                            src="/front-assets/img/edit.png"
                            alt="">Edit {{$goods_item->name}} Page</a>
            </div>

        @endif

        <div class="item-page-header">

            <div class="title">
                {{ $goods_item->name or '' }}
            </div>

            <div class="item-page-price-text">

                @if($goods_item->complect == 'pcs')
                    Preț / Buc:
                @elseif($goods_item->complect == 'm2')
                    Preț / M2:
                @else
                    Preț / Set:
                @endif
                <span>{{$priceText or myTrans('Not_fixed')}}</span>
            </div>

        </div>

        <div class="oneProductBlock">

            <div class="productLeft">

                {{--Slider and nav buttons--}}
                <div class="wraperSlider">

                    @if(!empty($goods_item->h1_title))
                        <a class="btn3d" href="{{$goods_item->h1_title}}" data-src="{{$goods_item->h1_title}}"
                           data-fancybox="gallery" data-type="iframe">
                            <img src="{{ asset('front-assets/img/3d-open.png') }}"/>
                        </a>
                    @endif

                    {{--Admin button--}}
                    @if(Auth::check())
                        <a class="editBack editImage" target="_blank"
                           href="/{{$lang}}/back/goods/{{$children}}/itemsphoto/{{$goods_item->goods_item_id}}">
                            <img src="/front-assets/img/editimage.png" alt="">
                        </a>
                    @endif

                    <div class="ov-hide product_slider_wrap">

                        <div class="product_slider my_slider transition">

                            {{--goods photos--}}
                            @foreach($goods_item_photo as $one_photo)

                                @if(!empty($one_photo->img))
                                    <div>
                                        <a data-fancybox="product_gallery"
                                           data-src="/upfiles/gallery/{{$one_photo->img }}"
                                           href="/upfiles/gallery/{{$one_photo->img }}">
                                            <img src="/upfiles/gallery/m/{{$one_photo->img }}"
                                                 alt="{{ $goods_item->name or '' }}">
                                        </a>
                                    </div>
                                @endif

                            @endforeach

                            {{--sizes photos--}}
                            @if(!empty($goods_item_size))
                                @foreach($goods_item_size as $one_goods_size)
                                    @if(!empty($one_goods_size->img))
                                        <div data-size_id="{{$one_goods_size->id}}">
                                            <a data-fancybox="product_gallery"
                                               data-src="{{asset('upfiles/size')}}/{{$one_goods_size->img}}"
                                               href="{{asset('upfiles/size')}}/{{$one_goods_size->img}}">
                                                <img src="{{asset('upfiles/size')}}/{{$one_goods_size->img}}"
                                                     alt="no-image">
                                                {{--<img src="/upfiles/size/{{ $one_goods_size->img or '' }}" alt="{{ $goods_item->name or '' }}">--}}
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>

                        <label for="next" class="arrow next">
                            <svg>
                                <use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use>
                            </svg>
                        </label>
                        <label for="back" class="arrow back">
                            <svg>
                                <use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use>
                            </svg>
                        </label>


                        @if(!empty($goods_item_size))
                            <div class="product_slider mini_slider transition">

                                @foreach($goods_item_photo as $one_photo)
                                    @if(!empty($one_photo->img))
                                        <div>
                                            <img height="80px" src="/upfiles/gallery/{{$one_photo->img }}"
                                                 alt="{{ $goods_item->name or '' }}">
                                        </div>
                                    @endif
                                @endforeach

                                @if(!empty($goods_item_size))
                                    @foreach($goods_item_size as $one_goods_size)
                                        @if(!empty($one_goods_size->img))

                                            <div>
                                                <img src="{{asset('upfiles/size')}}/{{$one_goods_size->img}}"
                                                     alt="{{ $goods_item->name or '' }}">
                                            </div>

                                        @endif
                                    @endforeach
                                @endif


                            </div>
                        @endif

                    </div>


                </div>


            </div>


            <div class="productRight">


                @include('front.templates.productOrder')


            </div>

        </div>

        <div class="pink-bg">

            <div class="product_tab_navs">

            </div>
            <div class="product_tabs">

                <div class="content">

                    {!! $goods_item->body  or ''!!}

                </div>

                <div class="sizes">

                    @if(!empty($item_size_list) && count($item_size_list)>1)
                        <div class="item_page_avalaible_size_main item_page_recommended_main_div">


                            <h2>Dimensiuni</h2>
                            <div class="item_page_avalaible_size_body">
                                <table class="item_page_avalaible_size_table " cellpadding="0" cellspacing="0">
                                    @foreach($item_size_list as $item_size_list_item)
                                        <tr class="item_page_avalaible_size_tr">
                                            <td class="item_page_avalaible_size_td1">
                                                <a href="{{asset('upfiles/size')}}/{{$item_size_list_item->img or ''}}"
                                                   data-fancybox="sizes_gallery"
                                                   data-src="{{asset('upfiles/size')}}/{{$item_size_list_item->img or ''}}">
                                                    <img class="item_page_avalaible_size_td2_img1"
                                                         src="{{asset('upfiles/size')}}/{{$item_size_list_item->img or ''}}"
                                                         alt="no-image"/>
                                                </a>

                                                @if(!empty($item_size_list_item->url_3d))
                                                    <a class="item_page_avalaible_size_td2_a"
                                                       href="{{$item_size_list_item->url_3d}}" target="_blank"
                                                       data-fancybox="gallery" data-type="iframe">
                                                        <img src="{{ asset('front-assets/img/3d-open.png') }}"
                                                             class="item_page_avalaible_size_td2_img"/>
                                                    </a>
                                                @else
                                                    <img src="{{ asset('front-assets/img/3d-open.png') }}"
                                                         style="opacity: .3; vertical-align: top;"
                                                         class="item_page_avalaible_size_td2_img"/>
                                                @endif
                                            </td>

                                            @if( !empty($item_size_list_item->colors) )
                                                @php($all_colors = $colors_list->keyBy('id')->toArray())

                                                <td class="item_page_avalaible_size_td2 sizeColors">

                                                    @if( !empty($item_size_list_item->colors) )

                                                        @foreach($colors_list as $one_color)
                                                            @if(in_array($one_color->goods_colors_id, explode(", ",$item_size_list_item->colors)))

                                                                <div>
                                                                    <div class="hexagon ral_{{$one_color['ral']}}"
                                                                         title="{{$one_color['name']}} (RAL_{{$one_color['ral']}})">
                                                                        <div class="ratio-1-1"
                                                                             style="background-color: {{$one_color['hex']}}"></div>
                                                                        <div class="item-page-text">{{$one_color['name']}}</div>
                                                                    </div>
                                                                </div>

                                                            @endif
                                                        @endforeach

                                                    @else
                                                        <img src="/upfiles/goods/d91c8f74b89ab60fdadef4c2ea56524132270273.png"
                                                             alt="Galvanized">
                                                    @endif

                                                </td>

                                            @endif

                                            <td class="item_page_avalaible_size_td3">
                                                <table>
                                                    <thead>
                                                    <th>{{myTrans('sku')}}</th>
                                                    @foreach($dimensions as $dimension)
                                                        @if ($item_size_list_item->{$dimension})
                                                            <th>{{myTrans($dimension)}}</th> @endif
                                                    @endforeach
                                                    </thead>
                                                    <tbody>
                                                    <tr>

                                                        <td>{{$item_size_list_item->sku}}</td>
                                                        @foreach($dimensions as $dimension)
                                                            @if ($item_size_list_item->{$dimension})
                                                                <td>{!! convert_to_inches($item_size_list_item->{$dimension}) !!}</td> @endif
                                                        @endforeach

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="item_page_avalaible_size_td4" style="position: relative;">
                                                <b>
                                                    @if(strlen($item_size_list_item->price) > 0)
                                                        @money($item_size_list_item->price)

                                                        <div class="set">
                                                            @if($goods_item->complect == 'pcs')
                                                                Preț / Buc
                                                            @elseif($goods_item->complect == 'm2')
                                                                Preț / M2
                                                            @else
                                                                Preț / Set
                                                            @endif
                                                        </div>

                                                    @else
                                                        {{myTrans('Price')}}: {{myTrans('Not_fixed')}}
                                                    @endif
                                                </b>

                                                @if(Auth::check())

                                                    <a target="_blank" class="editBack"
                                                       href="/{{$lang}}/back/goods/{{$children}}/itemssize/{{$goods_item->goods_item_id}}#edit-size-show-{{$item_size_list_item->id}}">
                                                        <img src="/front-assets/img/edit.png" alt="">
                                                    </a>

                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="delivery">

                </div>
            </div>


            {{--Admin button--}}
            @if(Auth::check())
                <div class="editPageBtn">
                    <a href="/{{$lang}}/back/goods/{{$children}}/itemssize/{{$goods_item->goods_item_id}}"><img
                                src="/front-assets/img/plus-circle-outline.png" alt="">Edit/Add Prices and Sizes</a>
                </div>
            @endif

        </div>

        @if(!empty($goods_recomend) && !empty($goods_recomend[0]))
            <div class="item_page_recommended_main_div">
                <div class="subTitle">{{ ShowLabelById(51,$lang_id) }}</div>
                <div class="categoryItems">
                    @foreach($goods_recomend as $one_recomend)
                        <div class="oneCatalogItem">

                            <div class="photo">
                                <a href="{{ url($lang,[$parent->alias,request()->segment(3),$one_recomend->alias]) }}">
                                    <img src="/upfiles/gallery/s/{{ $photo_recomend[$one_recomend->goods_item_id]->img or '' }}"
                                         alt="">
                                </a>
                                <div class="arrow"></div>
                            </div>
                            <div class="aboutProdus">
                                <div class="content">
                                    <a href="{{ url($lang,[$parent->alias,request()->segment(3),$one_recomend->alias]) }}"
                                       class="name">{{ $one_recomend->name or '' }}</a>
                                    <div class="price">
                                        <div class="num">{{ getPrices($one_recomend->id, $one_recomend->price) }}</div>
                                    </div>
                                    @if(!empty($one_recomend->goods_set))
                                        @if(!empty($recomend_colors_list[$one_recomend->goods_item_id]) && !empty($recomend_colors_list[$one_recomend->goods_item_id][0]))
                                            <div class="color">
                                                <span>{{ ShowLabelById(58,$lang_id) }}</span>
                                                <div class="someColor">
                                                    @foreach($recomend_colors_list[$one_recomend->goods_item_id] as $recomend_color)
                                                        <img src="/upfiles/goods/{{ $recomend_color->img }}" alt="">
                                                    @endforeach
                                                </div>
                                            </div>

                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>


    @if(!empty($goods_subject) && !empty($goods_subject->body))
        <div id="detail">
            <div class="closeModal" data-izimodal-close=""> X</div>
            {!! $goods_subject->body or '' !!}
        </div>
    @endif

@stop

@push('scripts')

    <script>
        const product_gallery = new GallerySlider({
            slider: '.my_slider',
            miniSlider: '.mini_slider',
        });
    </script>

@endpush

@include('front.footer')


