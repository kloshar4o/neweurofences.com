@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container">

        @include('front.templates.breadcrumbs')

        <div class="title">{{ $parent_menu->name or '' }}</div>

        @include('front.templates.galleryContainer')

        @include('front.templates.pagination', ['paginator' => $gallery_subject_list, 'new_url' => ''])

    </div>

@stop

@include('front.footer')