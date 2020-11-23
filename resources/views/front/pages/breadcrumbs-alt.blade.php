<?php $arrow = '<svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangleDown").'"></use></svg>';?>

<div class="breadcrambs">
    <ul>
        @if(!empty(request()->segment(5)))
            <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li>
            <li><a href="{{ url($lang,$b_menu1) }}">{{ $b_menu1 }}</a>{!! $arrow !!}</li>
            <li><a href="{{ url($lang,[$b_menu1,$b_menu2]) }}">{{ $b_menu2 }}</a>{!! $arrow !!}</li>
            <li><a href="{{ url($lang,[$b_menu1,$b_menu2,$b_menu3]) }}">{{ $b_menu3 }}</a>{!! $arrow !!}</li>
            <li><span>{{ $b_menu4 }}</span></li>
        @elseif(!empty(request()->segment(4)))
            <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li>
            <li><a href="{{ url($lang,$b_menu1) }}">{{ $b_menu1 }}</a>{!! $arrow !!}</li>
            <li><a href="{{ url($lang,[$b_menu1,$b_menu2]) }}">{{ $b_menu2 }}</a>{!! $arrow !!}</li>
            <li><span>{{ $b_menu3 }}</span></li>
        @elseif(!empty(request()->segment(3)))
            <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li>
            <li><a href="{{ url($lang,$b_menu1) }}">{{ $b_menu1 }}</a>{!! $arrow !!}</li>
            <li><span>{{ $b_menu2 }}</span></li>
        @elseif(!empty(request()->segment(2)))
            <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li>
            <li><span>{{ $b_menu1 }}</span></li>
        @endif
    </ul>
</div>