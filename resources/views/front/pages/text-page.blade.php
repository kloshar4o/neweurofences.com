@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container">

        @include('front.templates.breadcrumbs')

        <div class="title">{{ $parent_menu->name or ''}}</div>
        <div class="content">{!! $parent_menu->body or '' !!}</div>

    </div>
    @include('front.templates.advantages')
@stop

@include('front.footer')