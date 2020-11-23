@section('header')
    <div class="header">
        <div class="mobMenu smallMenu mobile">
            <a href="/{{$lang}}" class="logo sprite">
                <span class="logoTextBig">GMD</span>
                <span class="logoTextSmall">{{config('app.name')}}</span>
            </a>
            <div class="hamburger hamburger--3dxy js-hamburger" onclick="menu.toggle">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </div>
        <div class="top">
            <div class="container">
                @auth
                    @isset($lang_list)
                        <ul class="lang">
                            @foreach($lang_list as $one_lang)
                                <li>
                                    <a href="{{ url($one_lang->lang, array_except(request()->segments(), 0)) }}"
                                       class="{{$one_lang->id == $lang_id ? 'active' : ''}}">
                                        {{ strtoupper($one_lang->lang) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endisset
                @endauth

                <div class="follow">
                    <svg>
                        <use xlink:href="{{ asset('front-assets/img/symbols.svg#facebook') }}"></use>
                    </svg>
                    <a target="_blank" href="{{ $facebook }}"> {{ __('Follow us') }}</a>
                </div>
                @isset($front_top_menu)
                    <ul class="topMenu">
                        @foreach($front_top_menu as $one_top_menu)
                            <li>
                                <a href="{{ url($lang,$one_top_menu->alias) }}"{{ request()->segment(2) == $one_top_menu->alias? 'class=active' : '' }}>{{ $one_top_menu->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <div class="bottom">
            <div class="container">
                <div class="mobMenu smallMenu desktop">
                    <a href="/{{$lang}}" class="logo sprite">
                        <span class="logoTextBig">GMD</span>
                        <span class="logoTextSmall">{{config('app.name')}}</span>
                    </a>
                </div>
                <div class="right">
                    <a href="{{ url($lang,'contacts') }}"
                       class="recall"> {{ __('Contact us') }}
                        <svg>
                            <use xlink:href="{{ asset('front-assets/img/symbols.svg#recall') }}"></use>
                        </svg>
                    </a>
                    <a onclick="ga('send', 'event', 'Call', 'Click')"
                       href="tel:{{$phone}}"
                       class="phone"> {{$phone}}
                        <svg>
                            <use xlink:href="{{ asset('front-assets/img/symbols.svg#phone') }}"></use>
                        </svg>
                    </a>
                    @if(!empty($main_pdf) && $main_pdf != '')
                        <a href="{{ $main_pdf }}" download="catalog_{{ $lang }}.pdf" class="download">
                            {{ __('Price List') }}
                            <svg>
                                <use xlink:href="{{ asset('front-assets/img/symbols.svg#triangleDown') }}"></use>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="menu logo smallMenu close">
            <div class="container">
                <ul class="menuElement">
                    @isset($front_goods_subject_list)

                        <li class="{{ $_SERVER["REQUEST_URI"] == '/'.$lang  || $_SERVER["REQUEST_URI"] == '/' ? 'active' : '' }}">
                            <a href="{{url($lang)}}">{{__('Home')}}</a>
                        </li>

                        @foreach($front_goods_subject_list as $one_goods_subject)
                            <li class="{{ request()->segment(2) == $one_goods_subject->alias ? 'active' : '' }}">
                                <a href="{{ url($lang, $one_goods_subject->alias) }}">{{ $one_goods_subject->name }}</a>
                            </li>
                        @endforeach

                        @if(!$cartPage)
                            <a href="#" class="basket js-show-cart {{ session()->has('cart') ? 'not_empty_cart' : ''}}">
                                <svg>
                                    <use xlink:href="{{ asset('front-assets/img/symbols.svg#shopping-basket') }}"></use>
                                </svg>
                            </a>
                        @endif

                    @endisset
                </ul>
            </div>
        </div>
    </div>
@stop


@push('scripts')

    <script>
        const menu = new MenuOpenClose('open-menu');

    </script>
@endpush