@section('footer')
    <div class="footer">
        <div class="container">
            <div class="footerTop">
                <div class="footerMenu">

                    <a href="/{{ $lang }}" class="logoFooter">{{$company}}</a>

                    @if(!empty($front_footer_menu))
                        <div class="footerMenuItems">
                            <ul>
                                @foreach($front_footer_menu as $one_top_menu)
                                    <li><a href="{{ url($lang,$one_top_menu->alias) }}">{{ $one_top_menu->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                @isset($contacts)
                    <div class="footerAddress">
                        @foreach($contacts as $one_contact)
                            <div class="col">
                                <div class="titleCity">{{ $one_contact->name or '' }}</div>
                                {!! $one_contact->body or '' !!}
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
            <div class="footerCopy">
                <div class="copy">© {{ date("Y") }}  {{ ShowLabelById(1,$lang_id) }}</div>
            </div>
        </div>


        @if($whatsapp1)
            <div class="whatsapp">

                <div class="whatsapp_btn">
                    <img src="{{asset('front-assets/img/Whatsapp.png')}}">
                    <p>{{__('Text us on')}} WhatsApp</p>
                </div>

                <div class="whatsapp_open">
                    <a class="desktop" href="https://api.whatsapp.com/send?phone={{$whatsapp1->body}}&amp;text="
                       target="_blank">{{$whatsapp1->name}}</a>
                    <a class="desktop" href="https://api.whatsapp.com/send?phone={{$whatsapp1->body}}&amp;text="
                       target="_blank">{{$whatsapp1->name}}</a>

                    @if($whatsapp2)
                        <a class="mobile" href="https://web.whatsapp.com/send?phone={{$whatsapp2->name}}&amp;text="
                           target="_blank">{{$whatsapp2->body}}</a>
                        <a class="mobile" href="https://web.whatsapp.com/send?phone={{$whatsapp2->name}}&amp;text="
                           target="_blank">{{$whatsapp2->body}}</a>
                    @endif

                </div>
            </div>
        @endif

        <div class="cookie" style="display:none;">
            <div class="container">
                <span>{{ ShowLabelById(82, $lang_id) }}</span>
                <div class="btns">
                    <a href="#" class="js-cookie-accept" id="cookie-accept">{{ ShowLabelById(83, $lang_id) }}</a>
                </div>
            </div>
        </div>

    </div>
@stop