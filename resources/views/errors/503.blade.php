@extends('admin.app')

@include('admin.nav-bar')

@include('admin.left-menu')

@section('content')

    <div class="error-page-msg">
        <span>{{trans('variables.be_right_back')}}</span>
    </div>

@stop

@section('footer')
    <footer>
        @include('admin.footer')
    </footer>
@stop