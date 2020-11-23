@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="animationBlock">
        <a class="prev"></a>
        <a class="next"></a>
        <ul>
		 <li><a href="#tab-1">{{ ShowLabelById(10,$lang_id) }}</a><div class="arrow"></div></li> 
            <li><a href="#tab-2">{{ ShowLabelById(9,$lang_id) }}</a><div class="arrow"></div></li>
            <li><a href="#tab-3">{{ ShowLabelById(8,$lang_id) }}</a><div class="arrow"></div></li>
            <li><a href="#tab-4">{{ ShowLabelById(67,$lang_id) }}</a><div class="arrow"></div></li>
            <li><a href="#tab-5">{{ ShowLabelById(68,$lang_id) }}</a><div class="arrow"></div></li>
        </ul>
		
        <div id='tab-1'>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="100%" width="100%"
                    viewBox="0 0 1920 630" preserveAspectRatio="xMinYMax meet" id="svgContainer">
                <image xlink:href="{{ asset('front-assets/img/animation/cityBg.png') }}" class="bg" x="0" y="0" height="100%" width="100%"></image>

					{{--<g class="gate show" data-order="1">
                    <g id="gateBigFirst1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/big.png') }}" x="70" y="380"
                                transform="matrix(1,0,0,1,0,0)"
                                height="210"
                                width="701"></image>
                        <polygon id="gateHoverBigFirst1" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/leftSectionFirst.png') }}"
                                x="0" y="370" height="240" width="287"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/pilonsFirst.png') }}"
                                x="765" y="360" height="248" width="154"></image>
                    </g>
                    <g id="gateMiniFirst1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/mini.png') }}" x="782" y="358"
                                transform="matrix(1,0,0,1,0,0)" height="243"
                                width="119"></image>
                        <polygon id="gateHoverMiniFirst1" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="820" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleFirst1">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/left.png') }}" x="918" y="337"
                                transform="matrix(1,0,0,1,0,0)" height="263"
                                width="218"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/right.png') }}" x="1137" y="337"
                                transform="matrix(1,0,0,1,0,0)" height="263"
                                width="218"></image>
                        <polygon id="gateDoubleFirst1" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1115" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/rightPartFirst.png') }}"
                                x="1355" y="360" height="240" width="567"></image>
                    </g>
					</g>--}}

                <g class="gate show" data-order="1">
                    <g id="gateBigSecond1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/big.png') }}" x="260" y="370"
                                transform="matrix(1,0,0,1,0,0)"
                                height="229"
                                width="496"></image>
                        <polygon id="gateHoverBigSecond1" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/leftSectionSecond.png') }}"
                                x="0" y="370" height="239" width="305"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/pilonsSecond.png') }}"
                                x="755" y="360" height="239" width="196"></image>
                    </g>
                    <g id="gateMiniSecond1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/mini.png') }}" x="790" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="220"
                                width="123"></image>
                        <polygon id="gateHoverMiniSecond1" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="830" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleSecond1">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/left.png') }}" x="950" y="370"
                                transform="matrix(1,0,0,1,0,0)" height="223"
                                width="216"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/right.png') }}" x="1165" y="370"
                                transform="matrix(1,0,0,1,0,0)" height="223"
                                width="216"></image>
                        <polygon id="gateDoubleSecond1" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1145" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/rightSectionSecond.png') }}"
                                x="1374" y="360" height="239" width="546"></image>
                    </g>
                </g>

                {{--<g class="gate" data-order="2">
                    <g id="gateBigThird1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/big.png') }}" x="32" y="373"
                                transform="matrix(1,0,0,1,0,0)"
                                height="220"
                                width="726"></image>
                        <polygon id="gateHoverBigThird1" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="/front-assets/img/soon{{ $lang }}.png"
                                x="1710" y="300" height="50" width="212"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/leftSectionThird.png') }}"
                                x="0" y="370" height="239" width="311"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/pilonsThird.png') }}"
                                x="755" y="360" height="239" width="196"></image>
                    </g>
                    <g id="gateMiniThird1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/mini.png') }}" x="790" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="121"></image>
                        <polygon id="gateHoverMiniThird1" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="830" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleThird1">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/left.png') }}" x="950" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="213"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/right.png') }}" x="1165" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="219"></image>
                        <polygon id="gateDoubleThird1" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <image
                            xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                            x="1145" y="450" height="43" width="43"></image>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/rightSectionThird.png') }}"
                                x="1374" y="360" height="239" width="544"></image>
                    </g>
                </g>--}}



                {{--<g class="gate" data-order="2">
                    <g id="gateBigFourth1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/4/big.png') }}" x="58" y="375"
                                transform="matrix(1,0,0,1,0,0)"
                                height="220"
                                width="697"></image>
                        <polygon id="gateHoverBigFourth1" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/4/leftSectionFourth.png') }}"
                                x="0" y="370" height="241" width="286"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/4/pilonsFourth.png') }}"
                                x="755" y="368" height="237" width="154"></image>
                    </g>
                    <g id="gateMiniFourth1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/4/mini.png') }}" x="770" y="355"
                                transform="matrix(1,0,0,1,0,0)" height="241"
                                width="120"></image>
                        <polygon id="gateHoverMiniFourth1" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="810" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleFourth1">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/4/left.png') }}" x="907" y="356"
                                transform="matrix(1,0,0,1,0,0)" height="241"
                                width="230"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/4/right.png') }}" x="1137" y="356"
                                transform="matrix(1,0,0,1,0,0)" height="241"
                                width="231"></image>
                        <polygon id="gateDoubleFourth1" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1115" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/4/rightSectionFourth.png') }}"
                                x="1368" y="370" height="239" width="546"></image>
                    </g>
                </g>--}}

                <g class="gate" data-order="2">
                    <g id="gateBigFiveth1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/5/big.png') }}" x="58" y="378"
                                transform="matrix(1,0,0,1,0,0)"
                                height="230"
                                width="700"></image>
                        <polygon id="gateHoverBigFiveth1" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/5/leftSectionFiveth.png') }}"
                                x="0" y="370" height="248" width="267"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/5/pilonsFiveth.png') }}"
                                x="755" y="368" height="248" width="154"></image>
                    </g>
                    <g id="gateMiniFiveth1">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/5/mini.png') }}" x="773" y="378"
                                transform="matrix(1,0,0,1,0,0)" height="229"
                                width="118"></image>
                        <polygon id="gateHoverMiniFiveth1" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="810" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleFiveth1">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/5/left.png') }}" x="907" y="377"
                                transform="matrix(1,0,0,1,0,0)" height="229"
                                width="223"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/5/right.png') }}" x="1130" y="377"
                                transform="matrix(1,0,0,1,0,0)" height="229"
                                width="223"></image>
                        <polygon id="gateDoubleFiveth1" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1115" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/5/rightSectionFiveth.png') }}"
                                x="1340" y="370" height="251" width="600"></image>
                    </g>
                </g>

            </svg>
            <ul class="changeGate">
            {{--<li class="active" data-order="1">{{ ShowLabelById(69,$lang_id) }}
                    <div class="arrow"></div>
                </li>--}}
                <li class="active" data-order="1">{{ ShowLabelById(70,$lang_id) }}
                    <div class="arrow"></div>
                </li>
                {{--<li data-order="2">{{ ShowLabelById(71,$lang_id) }}
                    <div class="arrow"></div>
                </li>--}}
                {{--<li data-order="2">{{ ShowLabelById(72,$lang_id) }}
                    <div class="arrow"></div>
                </li>--}}
                <li data-order="2">{{ ShowLabelById(73,$lang_id) }}
                    <div class="arrow"></div>
                </li>
            </ul>
            <div class="prevGate"></div>
            <div class="nextGate"></div>
        </div>

        <div id='tab-2'>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="100%" width="100%"
                    viewBox="0 0 1920 630" preserveAspectRatio="xMinYMax meet" id="svgContainer">
                <image xlink:href="{{ asset('front-assets/img/animation/daceaBg.png') }}" class="bg" x="0" y="0" height="100%"
                        width="100%"></image>
						{{--<g class="gate show" data-order="1">
                    <g id="gateBigFirst2">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/big.png') }}" x="70" y="380"
                                transform="matrix(1,0,0,1,0,0)"
                                height="210"
                                width="701"></image>
                        <polygon id="gateHoverBigFirst2" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/leftSectionFirst.png') }}"
                                x="0" y="370" height="240" width="287"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/pilonsFirst.png') }}"
                                x="765" y="360" height="248" width="154"></image>
                    </g>
                    <g id="gateMiniFirst2">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/mini.png') }}" x="782" y="358"
                                transform="matrix(1,0,0,1,0,0)" height="243"
                                width="119"></image>
                        <polygon id="gateHoverMiniFirst2" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="820" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleFirst2">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/left.png') }}" x="918" y="337"
                                transform="matrix(1,0,0,1,0,0)" height="263"
                                width="218"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/right.png') }}" x="1137" y="337"
                                transform="matrix(1,0,0,1,0,0)" height="263"
                                width="218"></image>
                        <polygon id="gateDoubleFirst2" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1115" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/rightPartFirst.png') }}"
                                x="1355" y="360" height="240" width="567"></image>
                    </g>
						</g>--}}

                <g class="gate show" data-order="1">
                    <g id="gateBigSecond2">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/big.png') }}" x="260" y="370"
                                transform="matrix(1,0,0,1,0,0)"
                                height="229"
                                width="496"></image>
                        <polygon id="gateHoverBigSecond2" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/leftSectionSecond.png') }}"
                                x="0" y="370" height="239" width="305"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/pilonsSecond.png') }}"
                                x="755" y="360" height="239" width="196"></image>
                    </g>
                    <g id="gateMiniSecond2">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/mini.png') }}" x="790" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="220"
                                width="123"></image>
                        <polygon id="gateHoverMiniSecond2" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="830" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleSecond2">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/left.png') }}" x="950" y="370"
                                transform="matrix(1,0,0,1,0,0)" height="223"
                                width="216"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/right.png') }}" x="1165" y="370"
                                transform="matrix(1,0,0,1,0,0)" height="223"
                                width="216"></image>
                        <polygon id="gateDoubleSecond2" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1145" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/rightSectionSecond.png') }}"
                                x="1374" y="360" height="239" width="546"></image>
                    </g>
                </g>

                {{--<g class="gate" data-order="2">
                    <g id="gateBigThird2">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/big.png') }}" x="32" y="373"
                                transform="matrix(1,0,0,1,0,0)"
                                height="220"
                                width="726"></image>
                        <polygon id="gateHoverBigThird2" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>

                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="/front-assets/img/soon{{ $lang }}.png"
                                x="1710" y="300" height="50" width="212"></image>
                    </g>

                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/leftSectionThird.png') }}"
                                x="0" y="370" height="239" width="311"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/pilonsThird.png') }}"
                                x="755" y="360" height="239" width="196"></image>
                    </g>
                    <g id="gateMiniThird2">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/mini.png') }}" x="790" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="121"></image>
                        <polygon id="gateHoverMiniThird2" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="830" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleThird2">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/left.png') }}" x="950" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="213"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/right.png') }}" x="1165" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="219"></image>
                        <polygon id="gateDoubleThird2" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <image
                            xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                            x="1145" y="450" height="43" width="43"></image>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/rightSectionThird.png') }}"
                                x="1374" y="360" height="239" width="544"></image>
                    </g>
                </g>--}}

               {{--<g class="gate" data-order="2">
                            <g id="gateBigFourth2">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/big.png')}}" x="58" y="375"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="220"
                                       width="697"></image>
                                <polygon id="gateHoverBigFourth2" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/leftSectionFourth.png')}}"
                                        x="0" y="370" height="241" width="286"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/pilonsFourth.png')}}"
                                        x="755" y="368" height="237" width="154"></image>
                            </g>
                            <g id="gateMiniFourth2">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/mini.png')}}" x="770" y="355"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="120"></image>
                                <polygon id="gateHoverMiniFourth2" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFourth2">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/left.png')}}" x="907" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="230"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/right.png')}}" x="1137" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="231"></image>
                                <polygon id="gateDoubleFourth2" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/rightSectionFourth.png')}}"
                                        x="1368" y="370" height="239" width="546"></image>
                            </g>
                        </g>--}}

                 <g class="gate" data-order="2">
                            <g id="gateBigFiveth2">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/big.png')}}" x="58" y="378"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="230"
                                       width="700"></image>
                                <polygon id="gateHoverBigFiveth2" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/leftSectionFiveth.png')}}"
                                        x="0" y="370" height="248" width="267"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/pilonsFiveth.png')}}"
                                        x="755" y="368" height="248" width="154"></image>
                            </g>
                            <g id="gateMiniFiveth2">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/mini.png')}}" x="773" y="378"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="118"></image>
                                <polygon id="gateHoverMiniFiveth2" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFiveth2">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/left.png')}}" x="907" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/right.png')}}" x="1130" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <polygon id="gateDoubleFiveth2" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/rightSectionFiveth.png')}}"
                                        x="1340" y="370" height="251" width="600"></image>
                            </g>
                 </g>
                </g>

            </svg>
            <ul class="changeGate">
			{{--<li class="active" data-order="1">{{ ShowLabelById(69,$lang_id) }}
                    <div class="arrow"></div>
                </li>--}}
                <li class="active" data-order="1">{{ ShowLabelById(70,$lang_id) }}
                    <div class="arrow"></div>
                </li>
                {{--<li data-order="2">{{ ShowLabelById(71,$lang_id) }}
                    <div class="arrow"></div>
                </li>--}}
                {{--<li data-order="2">{{ ShowLabelById(72,$lang_id) }}
                    <div class="arrow"></div>
                </li>--}}
                <li data-order="2">{{ ShowLabelById(73,$lang_id) }}
                    <div class="arrow"></div>
                </li>
            </ul>
            <div class="prevGate"></div>
            <div class="nextGate"></div>
        </div>

        <div id='tab-3'>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="100%" width="100%"
                    viewBox="0 0 1920 630" preserveAspectRatio="xMinYMax meet" id="svgContainer">
                <image xlink:href="{{ asset('front-assets/img/animation/homeBg.png') }}" class="bg" x="0" y="0" height="100%"
                        width="100%"></image>
						{{--<g class="gate show" data-order="1">
                    <g id="gateBigFirst3">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/big.png') }}" x="70" y="380"
                                transform="matrix(1,0,0,1,0,0)"
                                height="210"
                                width="701"></image>
                        <polygon id="gateHoverBigFirst3" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/leftSectionFirst.png') }}"
                                x="0" y="370" height="240" width="287"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/pilonsFirst.png') }}"
                                x="765" y="360" height="248" width="154"></image>
                    </g>
                    <g id="gateMiniFirst3">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/mini.png') }}" x="782" y="358"
                                transform="matrix(1,0,0,1,0,0)" height="243"
                                width="119"></image>
                        <polygon id="gateHoverMiniFirst3" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="820" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleFirst3">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/left.png') }}" x="918" y="337"
                                transform="matrix(1,0,0,1,0,0)" height="263"
                                width="218"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/1/right.png') }}" x="1137" y="337"
                                transform="matrix(1,0,0,1,0,0)" height="263"
                                width="218"></image>
                        <polygon id="gateDoubleFirst3" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1115" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/1/rightPartFirst.png') }}"
                                x="1355" y="360" height="240" width="567"></image>
                    </g>
						</g>--}}

                <g class="gate show" data-order="1">
                    <g id="gateBigSecond3">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/big.png') }}" x="260" y="370"
                                transform="matrix(1,0,0,1,0,0)"
                                height="229"
                                width="496"></image>
                        <polygon id="gateHoverBigSecond3" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/leftSectionSecond.png') }}"
                                x="0" y="370" height="239" width="305"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/pilonsSecond.png') }}"
                                x="755" y="360" height="239" width="196"></image>
                    </g>
                    <g id="gateMiniSecond3">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/mini.png') }}" x="790" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="220"
                                width="123"></image>
                        <polygon id="gateHoverMiniSecond3" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="830" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleSecond3">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/left.png') }}" x="950" y="370"
                                transform="matrix(1,0,0,1,0,0)" height="223"
                                width="216"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/2/right.png') }}" x="1165" y="370"
                                transform="matrix(1,0,0,1,0,0)" height="223"
                                width="216"></image>
                        <polygon id="gateDoubleSecond3" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="1145" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/2/rightSectionSecond.png') }}"
                                x="1374" y="360" height="239" width="546"></image>
                    </g>
                </g>

                {{--<g class="gate" data-order="2">
                    <g id="gateBigThird3">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/big.png') }}" x="32" y="373"
                                transform="matrix(1,0,0,1,0,0)"
                                height="220"
                                width="726"></image>
                        <polygon id="gateHoverBigThird3" class="image-outline"
                                points="69,588,82,370,769,357,769,591"
                                fill="transparent"></polygon>
                    </g>

                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="/front-assets/img/soon{{ $lang }}.png"
                                x="1710" y="300" height="50" width="212"></image>
                    </g>

                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="500" y="450" height="43" width="43"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/leftSectionThird.png') }}"
                                x="0" y="370" height="239" width="311"></image>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/pilonsThird.png') }}"
                                x="755" y="360" height="239" width="196"></image>
                    </g>
                    <g id="gateMiniThird3">
                        <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/mini.png') }}" x="790" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="121"></image>
                        <polygon id="gateHoverMiniThird3" class="image-outline"
                                points="786,598,790,346,900,341,903,601"
                                fill="transparent"></polygon>
                    </g>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                                x="830" y="450" height="43" width="43"></image>
                    </g>
                    <g id="gateDoubleThird3">
                        <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/left.png') }}" x="950" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="213"></image>
                        <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xlink:href="{{ asset('front-assets/img/animation/3/right.png') }}" x="1165" y="373"
                                transform="matrix(1,0,0,1,0,0)" height="216"
                                width="219"></image>
                        <polygon id="gateDoubleThird3" class="image-outline"
                                points="920,614,918,346,1353,350,1358,615"
                                fill="transparent"></polygon>
                    </g>
                    <image
                            xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/tap.png') }}"
                            x="1145" y="450" height="43" width="43"></image>
                    <g>
                        <image
                                xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="{{ asset('front-assets/img/animation/3/rightSectionThird.png') }}"
                                x="1374" y="360" height="239" width="544"></image>
                    </g>
                </g>--}}

                {{--<g class="gate" data-order="2">
                            <g id="gateBigFourth3">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/big.png')}}" x="58" y="375"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="220"
                                       width="697"></image>
                                <polygon id="gateHoverBigFourth3" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/leftSectionFourth.png')}}"
                                        x="0" y="370" height="241" width="286"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/pilonsFourth.png')}}"
                                        x="755" y="368" height="237" width="154"></image>
                            </g>
                            <g id="gateMiniFourth3">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/mini.png')}}" x="770" y="355"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="120"></image>
                                <polygon id="gateHoverMiniFourth3" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFourth3">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/left.png')}}" x="907" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="230"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/right.png')}}" x="1137" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="231"></image>
                                <polygon id="gateDoubleFourth3" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/rightSectionFourth.png')}}"
                                        x="1368" y="370" height="239" width="546"></image>
                            </g>
                        </g>--}}

                        <g class="gate" data-order="2">
                            <g id="gateBigFiveth3">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/big.png')}}" x="58" y="378"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="230"
                                       width="700"></image>
                                <polygon id="gateHoverBigFiveth3" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/leftSectionFiveth.png')}}"
                                        x="0" y="370" height="248" width="267"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/pilonsFiveth.png')}}"
                                        x="755" y="368" height="248" width="154"></image>
                            </g>
                            <g id="gateMiniFiveth3">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/mini.png')}}" x="773" y="378"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="118"></image>
                                <polygon id="gateHoverMiniFiveth3" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFiveth3">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/left.png')}}" x="907" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/right.png')}}" x="1130" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <polygon id="gateDoubleFiveth3" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/rightSectionFiveth.png')}}"
                                        x="1340" y="370" height="251" width="600"></image>
                            </g>
                        </g>
                </g>
            </svg>
            <ul class="changeGate">
			{{--<li class="active" data-order="1">{{ ShowLabelById(69,$lang_id) }}
                    <div class="arrow"></div>
			</li>--}}
                <li class="active" data-order="1">{{ ShowLabelById(70,$lang_id) }}
                    <div class="arrow"></div>
                </li>
                {{--<li data-order="2">{{ ShowLabelById(71,$lang_id) }}
                    <div class="arrow"></div>--}}
                </li>
                {{--<li data-order="2">{{ ShowLabelById(72,$lang_id) }}
                    <div class="arrow"></div>
                </li>--}}
                <li data-order="2">{{ ShowLabelById(73,$lang_id) }}
                    <div class="arrow"></div>
                </li>
            </ul>
            <div class="prevGate"></div>
            <div class="nextGate"></div>
        </div>

        <div id='tab-4'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="100%" width="100%"
                         viewBox="0 0 1920 630" preserveAspectRatio="xMinYMax meet" id="svgContainer">
                        <image  xlink:href="{{ asset('front-assets/img/animation/subUrban.png')}}" class="bg" x="0" y="0" height="100%"
                               width="100%"></image>
							   {{--<g class="gate show" data-order="1">
                            <g id="gateBigFirst4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/big.png')}}" x="70" y="380"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="210"
                                       width="701"></image>
                                <polygon id="gateHoverBigFirst4" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/1/leftSectionFirst.png')}}"
                                        x="0" y="370" height="240" width="287"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/1/pilonsFirst.png')}}"
                                        x="765" y="360" height="248" width="154"></image>
                            </g>
                            <g id="gateMiniFirst4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/mini.png')}}" x="782" y="358"
                                       transform="matrix(1,0,0,1,0,0)" height="243"
                                       width="119"></image>
                                <polygon id="gateHoverMiniFirst4" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="820" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFirst4">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/left.png')}}" x="918" y="337"
                                       transform="matrix(1,0,0,1,0,0)" height="263"
                                       width="218"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/right.png')}}" x="1137" y="337"
                                       transform="matrix(1,0,0,1,0,0)" height="263"
                                       width="218"></image>
                                <polygon id="gateDoubleFirst4" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/1/rightPartFirst.png')}}"
                                        x="1355" y="360" height="240" width="567"></image>
                            </g>
							   </g>--}}

                        <g class="gate show" data-order="1">
                            <g id="gateBigSecond4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/big.png')}}" x="260" y="370"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="229"
                                       width="496"></image>
                                <polygon id="gateHoverBigSecond4" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/2/leftSectionSecond.png')}}"
                                        x="0" y="370" height="239" width="305"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/2/pilonsSecond.png')}}"
                                        x="755" y="360" height="239" width="196"></image>
                            </g>
                            <g id="gateMiniSecond4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/mini.png')}}" x="790" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="220"
                                       width="123"></image>
                                <polygon id="gateHoverMiniSecond4" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="830" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleSecond4">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/left.png')}}" x="950" y="370"
                                       transform="matrix(1,0,0,1,0,0)" height="223"
                                       width="216"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/right.png')}}" x="1165" y="370"
                                       transform="matrix(1,0,0,1,0,0)" height="223"
                                       width="216"></image>
                                <polygon id="gateDoubleSecond3" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1145" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/2/rightSectionSecond.png')}}"
                                        x="1380" y="360" height="239" width="546"></image>
                            </g>
                        </g>

                        {{--<g class="gate" data-order="2">
                            <g id="gateBigThird4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/big.png')}}" x="32" y="373"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="220"
                                       width="726"></image>
                                <polygon id="gateHoverBigThird4" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>

                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="/front-assets/img/soon{{ $lang }}.png"
                                        x="1710" y="300" height="50" width="212"></image>
                            </g>

                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/3/leftSectionThird.png')}}"
                                        x="0" y="370" height="239" width="311"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/3/pilonsThird.png')}}"
                                        x="755" y="360" height="239" width="196"></image>
                            </g>
                            <g id="gateMiniThird4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/mini.png')}}" x="790" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="216"
                                       width="121"></image>
                                <polygon id="gateHoverMiniThird4" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="830" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleThird4">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/left.png')}}" x="950" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="216"
                                       width="213"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/right.png')}}" x="1165" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="216"
                                       width="219"></image>
                                <polygon id="gateDoubleThird4" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <image
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                    x="1145" y="450" height="43" width="43"></image>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/3/rightSectionThird.png')}}"
                                        x="1384" y="360" height="239" width="544"></image>
                            </g>
                        </g>--}}

                        {{--<g class="gate" data-order="2">
                            <g id="gateBigFourth4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/big.png')}}" x="58" y="375"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="220"
                                       width="697"></image>
                                <polygon id="gateHoverBigFourth4" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/leftSectionFourth.png')}}"
                                        x="0" y="370" height="241" width="286"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/pilonsFourth.png')}}"
                                        x="755" y="368" height="237" width="154"></image>
                            </g>
                            <g id="gateMiniFourth4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/mini.png')}}" x="770" y="355"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="120"></image>
                                <polygon id="gateHoverMiniFourth4" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFourth4">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/left.png')}}" x="907" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="230"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/right.png')}}" x="1137" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="231"></image>
                                <polygon id="gateDoubleFourth4" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/rightSectionFourth.png')}}"
                                        x="1368" y="370" height="239" width="546"></image>
                            </g>
                        </g>--}}

                        <g class="gate" data-order="2">
                            <g id="gateBigFiveth4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/big.png')}}" x="58" y="378"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="230"
                                       width="700"></image>
                                <polygon id="gateHoverBigFiveth4" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/leftSectionFiveth.png')}}"
                                        x="0" y="370" height="248" width="267"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/pilonsFiveth.png')}}"
                                        x="755" y="368" height="248" width="154"></image>
                            </g>
                            <g id="gateMiniFiveth4">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/mini.png')}}" x="773" y="378"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="118"></image>
                                <polygon id="gateHoverMiniFiveth4" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFiveth4">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/left.png')}}" x="907" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/right.png')}}" x="1130" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <polygon id="gateDoubleFiveth4" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/rightSectionFiveth.png')}}"
                                        x="1340" y="370" height="251" width="600"></image>
                            </g>
                        </g>

                    </svg>
					<ul class="changeGate">
					{{--<li class="active" data-order="1">{{ ShowLabelById(69,$lang_id) }}
							<div class="arrow"></div>
						</li>--}}
						<li class="active" data-order="1">{{ ShowLabelById(70,$lang_id) }}
							<div class="arrow"></div>
						</li>
						{{--<li data-order="2">{{ ShowLabelById(71,$lang_id) }}
							<div class="arrow"></div>
						</li>--}}
						{{--<li data-order="2">{{ ShowLabelById(72,$lang_id) }}
							<div class="arrow"></div>
						</li>--}}
						<li data-order="2">{{ ShowLabelById(73,$lang_id) }}
							<div class="arrow"></div>
						</li>
					</ul>
                    <div class="prevGate"></div>
                    <div class="nextGate"></div>
                </div>

        <div id='tab-5'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="100%" width="100%"
                         viewBox="0 0 1920 630" preserveAspectRatio="xMinYMax meet" id="svgContainer">
                        <image  xlink:href="{{ asset('front-assets/img/animation/hiTech.png')}}" class="bg" x="0" y="0" height="100%"
                               width="100%"></image>
							   {{--<g class="gate show" data-order="1">
                            <g id="gateBigFirst5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/big.png')}}" x="70" y="380"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="210"
                                       width="701"></image>
                                <polygon id="gateHoverBigFirst5" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/1/leftSectionFirst.png')}}"
                                        x="0" y="370" height="240" width="287"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/1/pilonsFirst.png')}}"
                                        x="765" y="360" height="248" width="154"></image>
                            </g>
                            <g id="gateMiniFirst5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/mini.png')}}" x="782" y="358"
                                       transform="matrix(1,0,0,1,0,0)" height="243"
                                       width="119"></image>
                                <polygon id="gateHoverMiniFirst5" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="820" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFirst5">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/left.png')}}" x="918" y="337"
                                       transform="matrix(1,0,0,1,0,0)" height="263"
                                       width="218"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/1/right.png')}}" x="1137" y="337"
                                       transform="matrix(1,0,0,1,0,0)" height="263"
                                       width="218"></image>
                                <polygon id="gateDoubleFirst5" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/1/rightPartFirst.png')}}"
                                        x="1355" y="360" height="240" width="567"></image>
                            </g>
							   </g>--}}

                        <g class="gate show" data-order="1">
                            <g id="gateBigSecond5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/big.png')}}" x="260" y="370"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="229"
                                       width="496"></image>
                                <polygon id="gateHoverBigSecond5" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/2/leftSectionSecond.png')}}"
                                        x="0" y="370" height="239" width="305"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/2/pilonsSecond.png')}}"
                                        x="755" y="360" height="239" width="196"></image>
                            </g>
                            <g id="gateMiniSecond5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/mini.png')}}" x="790" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="220"
                                       width="123"></image>
                                <polygon id="gateHoverMiniSecond5" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="830" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleSecond5">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/left.png')}}" x="950" y="370"
                                       transform="matrix(1,0,0,1,0,0)" height="223"
                                       width="216"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/2/right.png')}}" x="1165" y="370"
                                       transform="matrix(1,0,0,1,0,0)" height="223"
                                       width="216"></image>
                                <polygon id="gateDoubleSecond5" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1145" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/2/rightSectionSecond.png')}}"
                                        x="1380" y="360" height="239" width="546"></image>
                            </g>
                        </g>

                        {{--<g class="gate" data-order="2">
                            <g id="gateBigThird5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/big.png')}}" x="32" y="373"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="220"
                                       width="726"></image>
                                <polygon id="gateHoverBigThird5" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>

                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink"xlink:href="/front-assets/img/soon{{ $lang }}.png"
                                        x="1710" y="300" height="50" width="212"></image>
                            </g>

                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/3/leftSectionThird.png')}}"
                                        x="0" y="370" height="239" width="311"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/3/pilonsThird.png')}}"
                                        x="755" y="360" height="239" width="196"></image>
                            </g>
                            <g id="gateMiniThird5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/mini.png')}}" x="790" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="216"
                                       width="121"></image>
                                <polygon id="gateHoverMiniThird5" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="830" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleThird5">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/left.png')}}" x="950" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="216"
                                       width="213"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/3/right.png')}}" x="1165" y="373"
                                       transform="matrix(1,0,0,1,0,0)" height="216"
                                       width="219"></image>
                                <polygon id="gateDoubleThird5gateMiniFirst5" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <image
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                    x="1145" y="450" height="43" width="43"></image>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/3/rightSectionThird.png')}}"
                                        x="1384" y="360" height="239" width="544"></image>
                            </g>
                        </g>--}}

                        {{--<g class="gate" data-order="2">
                            <g id="gateBigFourth5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/big.png')}}" x="58" y="375"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="220"
                                       width="697"></image>
                                <polygon id="gateHoverBigFourth5" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/leftSectionFourth.png')}}"
                                        x="0" y="370" height="241" width="286"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/pilonsFourth.png')}}"
                                        x="755" y="368" height="237" width="154"></image>
                            </g>
                            <g id="gateMiniFourth5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/mini.png')}}" x="770" y="355"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="120"></image>
                                <polygon id="gateHoverMiniFourth5" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFourth5">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/left.png')}}" x="907" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="230"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/4/right.png')}}" x="1137" y="356"
                                       transform="matrix(1,0,0,1,0,0)" height="241"
                                       width="231"></image>
                                <polygon id="gateDoubleFourth5" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/4/rightSectionFourth.png')}}"
                                        x="1368" y="370" height="239" width="546"></image>
                            </g>
                        </g>--}}

                        <g class="gate" data-order="2">
                            <g id="gateBigFiveth5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/big.png')}}" x="58" y="378"
                                       transform="matrix(1,0,0,1,0,0)"
                                       height="230"
                                       width="700"></image>
                                <polygon id="gateHoverBigFiveth5" class="image-outline"
                                         points="69,588,82,370,769,357,769,591"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="500" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/leftSectionFiveth.png')}}"
                                        x="0" y="370" height="248" width="267"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/pilonsFiveth.png')}}"
                                        x="755" y="368" height="248" width="154"></image>
                            </g>
                            <g id="gateMiniFiveth5">
                                <image class="image" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/mini.png')}}" x="773" y="378"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="118"></image>
                                <polygon id="gateHoverMiniFiveth5" class="image-outline"
                                         points="786,598,790,346,900,341,903,601"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="810" y="450" height="43" width="43"></image>
                            </g>
                            <g id="gateDoubleFiveth5">
                                <image class="image left" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/left.png')}}" x="907" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <image class="image right" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xlink:href="{{ asset('front-assets/img/animation/5/right.png')}}" x="1130" y="377"
                                       transform="matrix(1,0,0,1,0,0)" height="229"
                                       width="223"></image>
                                <polygon id="gateDoubleFiveth5" class="image-outline"
                                         points="920,614,918,346,1353,350,1358,615"
                                         fill="transparent"></polygon>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/tap.png')}}"
                                        x="1115" y="450" height="43" width="43"></image>
                            </g>
                            <g>
                                <image
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('front-assets/img/animation/5/rightSectionFiveth.png')}}"
                                        x="1340" y="370" height="251" width="600"></image>
                            </g>
                        </g>

                    </svg>
                    <ul class="changeGate">
					{{--<li class="active" data-order="1">{{ ShowLabelById(69,$lang_id) }}
                            <div class="arrow"></div>
					</li>--}}
                        <li class="active" data-order="1">{{ ShowLabelById(70,$lang_id) }}
                            <div class="arrow"></div>
                        </li>
                        {{--<li data-order="2">{{ ShowLabelById(71,$lang_id) }}
                            <div class="arrow"></div>
                        </li>--}}
                        {{--<li data-order="2">{{ ShowLabelById(72,$lang_id) }}
                            <div class="arrow"></div>
                        </li>--}}
                        <li data-order="2">{{ ShowLabelById(73,$lang_id) }}
                            <div class="arrow"></div>
                        </li>
                    </ul>
                    <div class="prevGate"></div>
                    <div class="nextGate"></div>
        </div>

    </div>

    <div class="container">
        <div class="title">{{ ShowLabelById(4,$lang_id) }}</div>
        <div class="catalogItems index">
            @if(!empty($front_goods_subject_list))
                @foreach($front_goods_subject_list as $one_goods_subject)
                    <div class="catalogOneItem {{ $one_goods_subject->alias }}">
                        <div class="catalogTitle">{{ $one_goods_subject->name }}</div>
                        <a href="{{ url($lang, ['catalog',$one_goods_subject->alias]) }}"></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @include('front.templates.advantages')
    <div class="container">
        <div class="title">{{ ShowLabelById(3,$lang_id) }}</div>
        <div class="galleryBlock">
            @if(!empty($gallery_subject_list))
                @foreach($gallery_subject_list as $one_subject)
                    <a href="{{ url($lang,['gallery',$one_subject->alias]) }}" class="galleryItem">
                        <img src="/upfiles/galleryItems/m/{{ $photo[$one_subject->gallery_subject_id]->img or ''}}" alt="{{ $one_subject->name }}">
                        <div class="galleryDesc">
                            <span>{{ $one_subject->name }}</span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <a href="{{ url($lang,'gallery') }}" class="btnAlso">{{ ShowLabelById(2,$lang_id) }}</a>

        <div>{!! $meta_main_page->body or '' !!}</div>

        <div class="map">
            {!! $google_map or '' !!}
        </div>
    </div>

@stop

@include('front.footer')