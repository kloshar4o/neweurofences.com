<!--START header-->
<header class="flex flex--between">

    <div>
        <a href="/{{$lang}}" class="logo">
            <span class="logoTextBig">GMD</span>
        </a>
    </div>

    <div class="flex">
        <div class="flex header-langs">

            @foreach($lang_list as $one_lang)
                <a href="{{url($one_lang->lang, array_except(request()->segments(), 0))}}"
                   class="header-lang {{($lang === $one_lang->lang) ? 'active' : ''}}">
                    {{strtolower($one_lang->lang)}}
                </a>
            @endforeach

        </div>

        <a href="{{url('/', $lang)}}" target="_blank" class="border-button">
            <i class="fas fa-home"></i> <span>{{myTrans('Go to the site')}}</span>
        </a>


        @auth
            <div class="header-logout">
                <a href="{{url($lang . '/back/auth/logout')}}" class="border-button">
                    <i class="fas fa-door-open"></i> <span>{{myTrans('Log out')}}</span>
                </a>
            </div>
        @endauth

        <div class="hamburger hamburger--3dxy js-hamburger" onclick="menu.toggleHash()">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </div>

</header>
