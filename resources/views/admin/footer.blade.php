
@if(auth()->check() == true)
    <!--modal-settings-->
    <div style="display: none;">
        <div class="modal modal-settings" id="modal-settings">
            <div class="modal-top">
                <div class="modal-title">Settings</div>
                <div class="modal-close arcticmodal-close"></div>
            </div>
            <div class="modal-center">
                <div class="modal-text">
                    @if(!is_null($menu))
                        @foreach($menu as $m)
                            @if($m->modulesId->alias == 'modules-constructor')
                                <a href="{{url($lang, ['back', $m->modulesId->alias])}}" class="modules" id="{{$m->modulesId->alias}}" title="{{$m->name or ''}}"></a>
                            @endif
                            @if($m->modulesId->alias == 'sitemap')
                                <a href="{{url($lang, ['back', $m->modulesId->alias])}}" class="sitemap" id="{{$m->modulesId->alias}}" title="{{$m->name or ''}}"></a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--END modal-settings-->
@endif
