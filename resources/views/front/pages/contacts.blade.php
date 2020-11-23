@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container">

        @include('front.templates.breadcrumbs')

        <div class="title">{{ $parent_menu->name or '' }}</div>

        @include('front.templates.contact-form')

        <div class="tabWrap">
            <ul>
                @if(!empty($cont))
                    @foreach($cont as $one_cont)
                        <li><a href="#tab-{{ $loop->index}} ">{{ $one_cont->name }}</a><div class="arrow"></div></li>
                    @endforeach
                @endif

                {{--<li><a href="#tab2">{{ ShowLabelById(45,$lang_id) }}</a><div class="arrow"></div></li>--}}
                {{--<li><a href="#tab3">{{ ShowLabelById(46,$lang_id) }}</a><div class="arrow"></div></li>--}}
            </ul>
            @if(!empty($cont))
                @foreach($cont as $one_cont)
                    <div class="hidden" id="tab-{{ $loop->index }}">
                        <div class="mapWrapper">
                            <div class="information">
                                <div class="textInfo">
                                    {!! $one_cont->body or '' !!}
                                </div>
                            </div>
                            <div class="map">
                                {!! $one_cont->h1_title !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

@stop

@include('front.footer')