@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container">

        @include('front.templates.breadcrumbs')

        <div class="oneProductBlock">
            <div class="productLeft">
                <div class="nameProduct">{{ $goods_item->name or '' }}</div>

                @if(!$goods_item_photo->isEmpty())
                    <div class="wraperSlider">
                        <div class="slider">
                            @foreach($goods_item_photo as $one_photo)
                                <a data-fancybox="gallery"{{mb_stripos($goods_item->h1_title, 'sketch')?' data-type=iframe':''}} data-src="{{mb_stripos($goods_item->h1_title, 'sketch')?$goods_item->h1_title:'/upfiles/gallery/'.$one_photo->img }}" href="{{mb_stripos($goods_item->h1_title, 'sketch')?$goods_item->h1_title:'/upfiles/gallery/'.$one_photo->img }}">
                                    <img src="/upfiles/gallery/m/{{ $one_photo->img or '' }}" alt="{{ $goods_item->name or '' }}">
                                </a>
                            @endforeach
                        </div>
                        @if(!empty($goods_item_photo[1]))
                            <label for="next" class="next"><svg><use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use></svg></label>
                            <label for="back" class="back"><svg><use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use></svg></label>
                        @endif
                    </div>
                @endif

                @if(!empty($goods_item->body))
                    <div> {!! $goods_item->body or '' !!} </div>
                @endif
                <div class="productOrder">
                    <div class="leftColumn">
                        <div class="row">
                            <span>{{ ShowLabelById(57,$lang_id) }}</span>
                            @if($goods_item->complect == 'set')
                                <strong>{{ ShowLabelById(79,$lang_id) }}</strong>
                            @elseif($goods_item->complect == 'cadre')
                                <strong>{{ ShowLabelById(80,$lang_id) }}</strong>
                            @else
                                <strong>{{ ShowLabelById(81,$lang_id) }}</strong>
                            @endif
                        </div>
                        @if(!empty($colors_list))
                            <div class="row">
                                <span>{{ ShowLabelById(58,$lang_id) }}</span>
                                <div class="colors">
                                    @foreach($colors_list as $one_color)
                                        <div class="oneColor">
                                            <input type="radio" id="{{$goods_item->goods_item_id}}_{{ $one_color->goods_colors_id }}" name="color" value="{{ $one_color->goods_colors_id }}">
                                            <label for="{{$goods_item->goods_item_id}}_{{ $one_color->goods_colors_id }}"><img src="/upfiles/goods/{{ $one_color->img or ''}}" alt="{{ $one_color->name }}"></label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="row">
                        <span>Instructiun pentru montare:</span>
                        <strong>Da</strong>
                        </div>
                        <div class="row">
                            <span>{{ ShowLabelById(60,$lang_id) }}</span>
                            <strong>{{ $goods_item->weight }} {{ ShowLabelById(61,$lang_id) }}</strong>
                        </div>
                    </div>
                    <div class="rightColumn">
                        @if(!empty($goods_item->price))
                            <div class="row"><div class="price"><strong>{{ $goods_item->price }}</strong>{{ ShowLabelById(30,$lang_id) }}</div></div>
                        @endif
                        <div class="row">
                            <div class="set">
                                @if($goods_item->complect == 'set')
                                    {{ ShowLabelById(77,$lang_id) }}
                                @elseif($goods_item->complect == 'cadre')
                                    {{ ShowLabelById(34,$lang_id) }}
                                @else
                                    {{ ShowLabelById(78,$lang_id) }}
                                @endif
                            </div>
                        </div>
                        <div class="row"><div class="livrare">Livrare gratuita</div></div>

                        <div class="row">
                            <form class="add_cart_form" action="#">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <span>{{ ShowLabelById(63,$lang_id) }}</span>
                                <label for="submit">
                                    <svg class=><use xlink:href="{{ asset('front-assets/img/symbols.svg#shopping-basket') }}"></use></svg>
                                    <div class="carton"></div>
                                </label>
                                <input type="number" class="counter" name="number" value="1" min="1">
                                <input type="hidden" class="goods_id" name="goods_id" value="{{ $goods_item->goods_item_id }}">
                                <input type="hidden" class="color_form" name="goods_color" value="">
                                <input type="submit" id="submit" class="add_to_cart_btn">
                            </form>
                        </div>

                    </div>
                    <div class="feedback_response order_response "></div>
                </div>
                <div class="wraperMiniSlider">
                    @if(!empty($goods_item_photo))
                        <div class="miniSlider">
                            @if(count($goods_item_photo) > 6)
                                @foreach($goods_item_photo as $one_photo)
                                    <a data-fancybox href="/upfiles/gallery/{{ $one_photo->img or '' }}">
                                        <img src="/upfiles/gallery/m/{{ $one_photo->img or ''}}" alt="{{ $goods_item->name or '' }}">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    @if(count($goods_item_photo) > 6)
                        <label for="forNext" class="next"><svg><use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use></svg></label>
                        <label for="forPrev" class="back"><svg><use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use></svg></label>
                    @endif
                </div>
                <a href="#" class="modal brown">{{ ShowLabelById(53,$lang_id) }}</a>
                @if(!empty($goods_subject_img))
                    <a href="#" class="modal" data-izimodal-open="#construct">{{ ShowLabelById(54,$lang_id) }}</a>
                @endif
                @if(!empty($goods_subject) && !empty($goods_subject->body))
                    <a href="#" class="modal" data-izimodal-open="#detail">{{ ShowLabelById(55,$lang_id) }}</a>
                @endif
            </div>
            <div class="productRight">
                @if($goods_item->goods_set == 1)
                    <div class="fullProductName">{{ ShowLabelById(56,$lang_id) }}</div>
                    @if(!empty($set_items))
						<?php $i = 2;?>
                        @foreach($set_items as $one_set_item)
							<?php
							$one_goods = $set_goods[$one_set_item->set_goods_item_id];
							?>
                            <div class="pic">
                                <div class="picTitle">{{ $one_set_item->set_items_number > 1?  ShowLabelById(84,$lang_id).' '.$one_set_item->set_items_number.' '.ShowLabelById(83,$lang_id).' | ' : ShowLabelById(82,$lang_id).' ' }}{{ $one_goods->name }}</div>
                                <a data-fancybox href="/upfiles/gallery/{{ $set_first_photo[$one_set_item->set_goods_item_id]->img or '' }}">
                                    <img src="/upfiles/gallery/m/{{ $set_first_photo[$one_set_item->set_goods_item_id]->img or ''}}" alt="{{ $one_goods->name }}">
                                </a>
                            </div>
                            @if(!empty($one_goods->body))
                                <div> {!! $one_goods->body or '' !!} </div>
                            @endif
                            <div class="productOrder">
                                <div class="leftColumn">
                                    <div class="row">
                                        <span>{{ ShowLabelById(57,$lang_id) }}</span>
                                        @if($one_goods->complect == 'set')
                                            <strong>{{ ShowLabelById(79,$lang_id) }}</strong>
                                        @elseif($one_goods->complect == 'cadre')
                                            <strong>{{ ShowLabelById(80,$lang_id) }}</strong>
                                        @else
                                            <strong>{{ ShowLabelById(81,$lang_id) }}</strong>
                                        @endif
                                    </div>
                                    @if(!empty($set_colors_list[$one_set_item->set_goods_item_id]))
                                        <div class="row">
                                            <span>{{ ShowLabelById(58,$lang_id) }}</span>
                                            <div class="colors">
                                                @foreach($set_colors_list[$one_set_item->set_goods_item_id] as $one_set_color)
                                                    <div class="oneColor">
                                                        <input type="radio" id="{{$one_set_item->set_goods_item_id}}_{{ $one_set_color->goods_colors_id }}" name="color" value="{{ $one_set_color->goods_colors_id }}">
                                                        <label for="{{$one_set_item->set_goods_item_id}}_{{ $one_set_color->goods_colors_id }}"><img src="/upfiles/goods/{{ $one_set_color->img or ''}}" alt="{{ $one_set_color->name }}"></label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                    <span>{{ ShowLabelById(59,$lang_id) }}</span>
                                    <strong>Da</strong>
                                    </div>
                                    @if(!empty($one_goods->weight))
                                        <div class="row">
                                            <span>{{ ShowLabelById(60,$lang_id) }}</span>
                                            <strong>{{ $one_goods->weight }} {{ ShowLabelById(61,$lang_id) }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="rightColumn">
                                    @if(!empty($one_goods->price))
                                        <div class="row"><div class="price"><strong>{{ $one_goods->price or ''}}</strong>{{ ShowLabelById(30,$lang_id) }}</div></div>
                                    @endif
                                    <div class="row">
                                        <div class="set">
                                            @if($one_goods->complect == 'set')
                                                {{ ShowLabelById(77,$lang_id) }}
                                            @elseif($one_goods->complect == 'cadre')
                                                {{ ShowLabelById(34,$lang_id) }}
                                            @else
                                                {{ ShowLabelById(78,$lang_id) }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row"><div class="livrare">{{ ShowLabelById(62,$lang_id) }}</div></div>


                                    <div class="row">
                                        <form class="add_cart_form" id="add_to_cart_{{ $i }}" action="{{ url($lang,['cartElements','goods']) }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <span>{{ ShowLabelById(63,$lang_id) }}</span>
                                            <label for="submit{{ $i }}">
                                                <svg class=><use xlink:href="{{ asset('front-assets/img/symbols.svg#shopping-basket') }}"></use></svg>
                                                <div class="c{{ $i }} carton"></div>
                                            </label>
                                            <input type="number" class="counter" name="number" value="1" min="1">
                                            <input type="hidden" class="goods_id" name="goods_id" value="{{ $one_goods->goods_item_id }}">
                                            <input type="hidden" class="color_form" name="goods_color" value="">
                                            <input type="submit" id="submit{{ $i }}" class="add_to_cart_{{ $i }}">
                                        </form>
                                    </div>

                                </div>
                                <div class="feedback_response order_response "></div>
                            </div>
							<?php $i++;?>
                        @endforeach
                    @endif
                @else




                    @if(!empty($goods_recomend) && !empty($goods_recomend[0]))
                        <div class="subTitle">{{ ShowLabelById(51,$lang_id) }}</div>
                        <div class="categoryItems">
                            @foreach($goods_recomend as $one_recomend)
                                <div  class="oneCatalogItem">

                                    <div class="photo">
                                        <a href="{{ url($lang,['catalog',request()->segment(3),$one_recomend->alias]) }}">
                                            <img src="/upfiles/gallery/s/{{ $photo_recomend[$one_recomend->goods_item_id]->img or '' }}" alt="">
                                        </a>
                                        <div class="arrow"></div>
                                    </div>
                                    <div class="aboutProdus">
                                        <div class="content">
                                            <a href="{{ url($lang,['catalog',request()->segment(3),$one_recomend->alias]) }}" class="name">{{ $one_recomend->name or '' }}</a>
                                            <div class="price">
                                                <div class="num">{{ $one_recomend->price }}</div>
                                                <div class="valut">{{ ShowLabelById(30,$lang_id) }}</div>
                                            </div>
                                            <span class="set">{{ ShowLabelById(77,$lang_id) }}</span>
                                            @if(!empty($one_recomend->goods_set))
                                                @if(!empty($recomend_colors_list[$one_recomend->goods_item_id]) && !empty($recomend_colors_list[$one_recomend->goods_item_id][0]))
                                                    <div class="color">
                                                        <span>{{ ShowLabelById(58,$lang_id) }}</span>
                                                        <div class="someColor">
                                                            @foreach($recomend_colors_list[$one_recomend->goods_item_id] as $recomend_color)
                                                                <img src="/upfiles/goods/{{ $recomend_color->img }}" alt="">
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif





                @endif
            </div>
        </div>
    </div>

    @if(!empty($goods_subject_img))
        <div id="construct">
            <div class="closeModal" data-izimodal-close=""> X </div>
            <div class="modalTitle">{{ ShowLabelById(64,$lang_id) }}</div>
            <img src="/upfiles/goods/{{ $goods_subject_img->img or '' }}" alt="">
            <div class="download">
                <a download="construct-{{ $goods_subject->alias }}.jpg" href="/upfiles/goods/{{ $goods_subject_img->img or '' }}">{{ ShowLabelById(65,$lang_id) }}</a>
            </div>
        </div>
    @endif

    @if(!empty($goods_subject) && !empty($goods_subject->body))
        <div id="detail">
            <div class="closeModal" data-izimodal-close=""> X </div>
            {!! $goods_subject->body or '' !!}
        </div>
    @endif

@stop

@include('front.footer')