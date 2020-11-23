@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container">

        @include('front.templates.breadcrumbs')

        <div class="subTitle">{{ $parent_gallery_subject->name }}</div>

        @include('front.templates.galleryPageContainer')

        <div class="about">
            {!! $parent_gallery_subject->body or '' !!}
        </div>

        @if(!empty($used_goods))
            <div class="subTitle">{{ ShowLabelById(28,$lang_id) }}</div>
            <div class="catalogItems">
                @foreach($used_goods as $one_used_goods)
                    @if(!empty($one_used_goods))
                        <div class="catalogOneItem {{ $one_used_goods->alias }}">
                            <div class="catalogTitle">{{ $one_used_goods->name }}</div>
                            <a href="{{ url($lang,['catalog',$one_used_goods->alias]) }}"></a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

    </div>

@stop

@include('front.footer')