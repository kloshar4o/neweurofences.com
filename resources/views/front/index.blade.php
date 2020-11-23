@extends('front.front-app')
@include('front.header')

@section('container')

    @desktop

    @php

        $homes = [
            "Residential complex" => 'cityBg',
            "High-tech I" => 'hiTech',
            "High-tech II"  => 'homeBg',
            "Villa"  => 'daceaBg',
            "Village house" => 'subUrban',
        ];

        $fences = [
            "Louvered" => 'louvered',
            "Horizontal" => 'horizontal',
            "Vertical" => 'vertical',
            "Welded Wire" => 'mesh',
        ];

    @endphp

    <div class="animationBlock">

        <ul>
            @foreach ($homes as $translate => $home)
                <li><a href="#tab-{{$loop->iteration}}">{{ __($translate) }}</a>
                    <div class="arrow"></div>
                </li>
            @endforeach
        </ul>

        @foreach ($homes as $home)
            <div id='tab-{{$loop->iteration}}'>

                <div class="animatedFences" data-order="1">

                    <a class="prev"></a>
                    <a class="next"></a>
                    <img class="house" src="{{ asset('front-assets/img/animation/'.$home.'.png')}}" alt="">

                    @foreach ($fences as $fence)

                        <div id="{{$fence}}" class="fences gate {{!$loop->index ? 'show':''}}"
                             data-order="{{$loop->iteration}}">
                            <div class="fenceLeft">
                                <img src="{{ asset('front-assets/img/animation/'.$fence.'/leftSection.png') }}" alt="">
                            </div>
                            <div class="fenceCanti">
                                <img class="shadow" src="{{ asset('front-assets/img/animation/'.$fence.'/big.png') }}"
                                     alt="">
                                <img src="{{ asset('front-assets/img/animation/'.$fence.'/big.png') }}" alt="">
                            </div>
                            <div class="fencePathGate swing">
                                <img class="pillers"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/pilons.png') }}" alt="">
                                <img class="pillers shadow"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/pilons.png') }}" alt="">
                                <img class="gates gatePath"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/mini.png') }}" alt="">
                                <img class="gates gatePath shadow"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/mini.png') }}" alt="">
                                <img class="gates gateLeft gatePath gateDeph"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/mini.png') }}" alt="">
                            </div>
                            <div class="fenceDriveGate swing">
                                <img class="gates gateLeft shadow"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/left.png') }}" alt="">
                                <img class="gates gateLeft"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/left.png') }}" alt="">
                                <img class="gates gateLeft gateDeph"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/left.png') }}" alt="">
                                <img class="gates gateRight shadow"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/right.png') }}" alt="">
                                <img class="gates gateRight"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/right.png') }}" alt="">
                                <img class="gates gateRight gateDeph"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/right.png') }}" alt="">
                            </div>
                            <div>
                                <img class="fenceRight"
                                     src="{{ asset('front-assets/img/animation/'.$fence.'/rightSection.png') }}" alt="">

                            </div>
                        </div>

                    @endforeach

                    <div class="prevGate"></div>
                    <div class="nextGate"></div>
                </div>

                <ul class="changeGate">

                    @foreach ($fences as $key => $fence)
                        <li {{!$loop->index ? 'class=active':''}} data-order="{{$loop->iteration}}">{{ __($key) }}
                            <div class="arrow"></div>
                        </li>
                    @endforeach

                </ul>
            </div>
        @endforeach

    </div>

    @enddesktop

    <div class="front_about">

        <div class="front_about_video">


            <a href="https://www.youtube.com/embed/02KAyCCR6pk"
               data-src="https://www.youtube.com/embed/02KAyCCR6pk"
               data-fancybox="gallery">

                <img src="{{ asset('front-assets/img/video_bg.jpg') }}"/>
                <img class="play" src="{{ asset('front-assets/img/play.png') }}"/>

            </a>
        </div>


        <div class="front_about_text">

            <h1>{{$meta_main_page->h1_title ?? ''}}</h1>

            {!! $meta_main_page->body ?? '' !!}
        </div>

    </div>

    <div class="ov-hide">

        <div class="index_page_product_menu_main front_slider transition">
            @foreach($front_goods_subject_list as $one_goods_subject)
                <div>
                    <a href="{{ url($lang, $one_goods_subject->alias) }}">
                        <div class="index_page_product_menu">

                            <img src="{{ asset('upfiles/goods')}}/{{ $one_goods_subject->getOneImg->img or ''}}"
                                 class="index_page_product_menu_img"
                                 alt="{{$one_goods_subject->title}}"
                                 title="{{$one_goods_subject->name}}"/>

                            <div class="index_page_product_menu_title_main">
                                <div class="index_page_product_menu_title1"></div>
                                <div class="index_page_product_menu_title2 img_center">
                                    <img src="{{ asset('upfiles/goods')}}/{{ $one_goods_subject->getSecondImg->img or ''}}">
                                </div>
                                <div class="index_page_product_menu_title3">
                                    <div class="index_page_product_menu_title3_1">
                                        <div class="index_page_product_menu_title3_2">{{ $one_goods_subject->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="front_slider_navigation dots">
            @foreach($front_goods_subject_list->slice(0, 4) as $one_goods_subject)
                <div></div>
            @endforeach
        </div>

    </div>
    @include('front.templates.advantages')


    <div class="text floridabg" style="background-image: url('/front-assets/img/maps/{{config('app.name')}}.jpg')">
        <div class="relative">
            <p>{{__('We make a custom fence in')}}: <br> {{$contacts_joined}}</p>
        </div>
    </div>

    <div class="container">

        <div class="subTitle"> {{__("Gallery")}}</div>
        @include('front.templates.galleryContainer')
    </div>


@stop

@push('scripts')

    <script>
        new DraggableSlider({
            slider: '.front_slider',
            navigation: '.front_slider_navigation',
            onlyDesktop: true,
            slidesInView: 1.1
        });
    </script>

@endpush


@include('front.footer')