@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container">
        <div class="page-404 all h1_all">
            <div class="page-404-wrap">
                <h1>Страница не найдена</h1>
                <p class="error_404" style="font-size: 35px;margin: 0;font-weight: 600;">Ошибка 404</p>
                <p>Возможно, запрашиваемая Вами страница была перенесена или удалена. Также возможно, Вы допустили небольшую опечатку при вводе адреса – такое случается даже с нами, поэтому еще раз внимательно проверьте ;)</p>
                <a href="{{url($lang)}}" class="btn-3">Перейти на главную</a>
            </div>
        </div>
    </div>

@stop

@include('front.footer')
