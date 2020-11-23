@extends('front.front-app')

@include('front.header')

@section('container')

    @if(!empty($b_menu3))
        @php
            $url_new = "$b_menu1/$b_menu2/$b_menu3";
            $url_parent = $b_menu3;
        @endphp
    @elseif(!empty($b_menu2))
        @php
            $url_new = "$b_menu1/$b_menu2";
            $url_parent = $b_menu2;
        @endphp
    @elseif(!empty($b_menu1))
        @php
            $url_new = "$b_menu1";
            $url_parent = $b_menu1;
        @endphp
    @endif


    <div class="container catalog">
        @include('front.pages.breadcrumbs-alt')

        @if(Auth::check())
            <div class="editPageBtn fixed">
                <a target="_blank"
                   href="/{{$lang}}/back/goods/{{$main_catalog_goods->alias}}/editgoodssubject/{{$main_catalog_goods->id}}/1"><img
                            src="/front-assets/img/edit.png"
                            alt="">Edit {{$main_catalog_goods->name}} Page</a>
            </div>
        @endif


        <div class="title">{{ $main_catalog_goods->h1_title or '' }}</div>


        @if($catalog_item_list->isNotEmpty())
            @include('front.templates.productTile', [
            'products'=> $catalog_item_list,
            'products_img'=> $catalog_image,
            'products_url'=> $url_new,
            'colors'=> $colors_list
            ])
        @endif


        @if(Auth::check())
            <div class="editPageBtn">
                <a href="/{{$lang}}/back/goods/{{$children}}/creategoodsitem" target="_blank"><img
                            src="/front-assets/img/plus-circle-outline.png" alt="">Add {{$main_catalog_goods->name}}</a>
            </div>
        @endif


        @if(strlen($main_catalog_goods->body) > 0)

            <div class="catalog_categories_content_bottom_text">

                {!! $main_catalog_goods->body !!}

            </div>
        @endif


        @include('front.pages.you-may-be-interested')

        @include('front.templates.pagination', ['paginator' => $catalog_item_list, 'new_url' => ''])




        @if(!empty($child_goods_list))

            <div class="tallCards">

                <div class="subTitle t-left">{{myTrans('Other')}} {{$parent->name}}</div>

                <div class="catalog_categories_content">
                    @foreach($child_goods_list as $one_item)
                        <div class="tallCardsHolder isFences {{$one_item->alias === $children ? 'disable' : ''}}">


                            @if(Auth::check())
                                <a class="editBack" target="_blank"
                                   href="/en/back/goods/{{$url_parent}}/editgoodssubject/{{$one_item->id}}/1"><img
                                            src="/front-assets/img/edit.png"></a>
                            @endif

                            <a href="{{$one_item->alias === $children ? '#' : "./$one_item->alias"}}">
                                <div class="catalog_categories_item_main">
                                    <div>

                                        <div class="gatesImages">
                                            <img src="{{ asset('upfiles/goods')}}/{{$one_item->getOneImg->img or ''}}"
                                                 class="catalog_categories_item_img"
                                                 alt="{{$one_item->h1_title}}"
                                                 title="{{$one_item->name}}"/>

                                        </div>

                                    </div>
                                    <div class="catalog_categories_item_text_main">
                                        <div class="catalog_categories_item_text_back"></div>
                                        <div class="catalog_categories_item_text">
                                            {{$one_item->name}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif

        <div class="subTitle">{{ ShowLabelById(3,$lang_id) }}</div>

        @isset($galleries)
            <div class="catalog_categories_content_bottom_text">
                @foreach($galleries as $gallery_photos)
                    @include('front.templates.galleryPageContainer')
                @endforeach
            </div>
        @endisset


        @empty($galleries)
            @include('front.templates.galleryContainer')
        @endempty

    </div>

@stop

@include('front.footer')