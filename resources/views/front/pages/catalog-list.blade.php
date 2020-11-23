@extends('front.front-app')

@include('front.header')

@section('container')


    @if(Auth::check())
        <div class="editPageBtn fixed">
            <a target="_blank" href="/{{$lang}}/back/goods/{{$parent->alias}}/editgoodssubject/{{$parent->id}}/1"><img
                        src="/front-assets/img/edit.png" alt="">Edit {{$parent->name}} Page</a>
        </div>
    @endif

    <div class="container catalog-list">
        @include('front.pages.breadcrumbs-alt')


        <h1 class="title">
            {{$parent->h1_title}}
        </h1>

        @if(!empty($child_goods_list) && $level == 1)

            <div class="tallCards">
                <div class="catalog_categories_content">
                    @foreach($child_goods_list as $one_item)

                        <div class="tallCardsHolder {{$isGates  ? 'isGates' : 'isFences'}} {{$one_item->noChilds  ? 'noChilds' : ''}}">

                            @if(Auth::check())
                                <a class="editBack" target="_blank"
                                   href="/en/back/goods/{{$url_parent}}/editgoodssubject/{{$one_item->id}}/1"><img
                                            src="/front-assets/img/edit.png"></a>
                            @endif

                            <a href="{{"/$lang/$url_new/$one_item->alias"}}">
                                <div class="catalog_categories_item_main">
                                    <div>

                                        <div class="gatesImages">
                                            @if($isGates)

                                                @foreach($one_item['children']->sortBy('position') as $one_child_item)
                                                    <div class="gatePng">
                                                        <img src="/upfiles/goods/{{$one_child_item->getOneImg->img or ''}}">
                                                    </div>
                                                @endforeach

                                            @else
                                                <img src="{{ asset('upfiles/goods')}}/{{$one_item->getOneImg->img or ''}}"
                                                     class="catalog_categories_item_img"
                                                     alt="{{$one_item->h1_title}}"
                                                     title="{{$one_item->name}}"/>
                                            @endif


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

        @if(Auth::check())
            <div class="editPageBtn">
                <a href="/{{$lang}}/back/goods/{{$url_parent}}/creategoodssubject/"><img
                            src="/front-assets/img/plus-circle-outline.png" alt="">Add {{$parent->name}}</a>
            </div>
        @endif

        @if(strlen($parent->body) > 0)
            <div class="catalog_categories_content_bottom_text">

                {!! $parent->body !!}

            </div>
        @endif

        @include('front.pages.you-may-be-interested', ['dontSkip' => false, 'products_url' => $url_new] )
        @include('front.pages.you-may-be-interested')


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