@extends('admin.app')

@section('content')

    <div class="login-register-page">
        <div class="login-block-title">{{myTrans('Login')}}</div>
        <div class="login-block-content">
            <form method="POST" action="{{ url($lang.'/back/auth/login') }}" id="login-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="field-row">
                    <div class="field-wrap">
                        <label>
                            {{myTrans('Username')}}
                            <input name="login" placeholder="{{myTrans('Username')}}">
                        </label>
                    </div>
                </div>
                <div class="field-row">
                    <div class="field-wrap">
                        <label>
                            {{myTrans('Password')}}
                            <input type="password" name="password" placeholder="{{myTrans('Password')}}">
                        </label>
                    </div>
                </div>
                <button class="btn" onclick="saveForm(this)"
                        data-form-id="login-form">{{trans('variables.sing_in')}}</button>
            </form>
        </div>
    </div>

@stop

