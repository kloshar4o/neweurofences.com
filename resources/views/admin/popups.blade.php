
<div class="alert-parent">
    @if (session('feedform'))
        <div class="alert-notification" id="alert-feedform"><a
                    href="{{url($lang, ['back', 'feedform'])}}">{!! session()->get('feedform') !!}</a></div>
    @else
        <div class="alert-notification hidden" id="alert-feedform"><a
                    href="{{url($lang, ['back', 'feedform'])}}"></a></div>
    @endif
    @if (session('comment'))
        <div class="alert-notification" id="alert-comments"><a
                    href="{{url($lang, ['back', 'comments'])}}">{!! session()->get('comment') !!}</a></div>
    @else
        <div class="alert-notification hidden" id="alert-comments"><a
                    href="{{url($lang, ['back', 'comments'])}}"></a></div>
    @endif
</div>

<div class="remove-many-object">
    <span data-msg="{{trans('variables.remove-all')}}"></span>
</div>

<div class="restore-many-object">
    <span data-msg="{{trans('variables.remove-all')}}"></span>
</div>

@if (session()->has('message'))
    <div class="alert alert-info">{!! session()->get('message') !!}</div>
@endif
@if (session()->has('error-message'))
    <div class="error-alert alert-info">{!! session()->get('error-message') !!}</div>
@endif
<div class="alert json-info"></div>
<div class="alert json-error"></div>