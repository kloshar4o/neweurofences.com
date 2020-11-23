<?php $arrow = '<svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangleDown").'"></use></svg>';?>

<div class="breadcrambs">
    <ul>
        @if(!empty(request()->segment(4)))
            <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li><li><a href="{{ url($lang,$b_menu->alias) }}">{{ $b_menu->name }}</a>{!! $arrow !!}</li><li><a href="{{ url($lang,[$b_menu->alias,$b_menu_2->alias]) }}">{{ $b_menu_2->name }}</a>{!! $arrow !!}</li><li><span>{{ $b_menu_3->name }}</span></li>
        @elseif(!empty(request()->segment(3)))
            <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li><li><a href="{{ url($lang,$b_menu->alias) }}">{{ $b_menu->name }}</a>{!! $arrow !!}</li><li><span>{{ $b_menu_2->name }}</span></li>
        @elseif(!empty(request()->segment(2)))
            @if(request()->segment(2) == 'cart')
                <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li><li><span>{{ ShowLabelById(16,$lang_id) }}</span></li>
            @else
                <li><a href="/{{ $lang }}">{{ ShowLabelById(15,$lang_id) }}</a>{!! $arrow !!}</li><li><span>{{ $b_menu->name }}</span></li>
            @endif
        @endif
    </ul>
</div>