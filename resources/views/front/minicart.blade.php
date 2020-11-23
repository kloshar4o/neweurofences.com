@php($total = 0)

@isset($miniCart)
    <div>


        @foreach($miniCart as $category_key => $category)

            <div class="ul-header-cart-wrapitem">

                <a  href="{{ "/$lang" . $category['url'] }}" class="category_title">{{$category['name']}}</a>

                <ul class="header-cart-wrapitem">

                    @foreach($category['products'] as $product_key => $product)

                        <li class="header-cart-item">

                            <div class="header-cart-item-wrapper {{!isset($product['sizes']) ? 'no_sizes' : ''}}">
                                <div class="header-cart-item-img">

                                    <div class="img">

                                        <img data-fancybox="minicart"
                                             data-src="/upfiles/gallery/{{$product['img']}}"
                                             src="/upfiles/gallery/s/{{$product['img']}}">
                                    </div>

                                    <a href="{{ "/$lang" . $product['url'] }}"
                                       class="header-cart-item-name">{{$product['name']}}</a>
                                </div>

                                <div class="header-cart-item-txt">

                                    @if($product['quantity'])

                                        @php($total += $product['price'] * $product['quantity'] )

                                        <div class="header-cart-item-info d-flex">


                                            <i class="delete_item" data-delete="{{"$category_key,$product_key"}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24">
                                                    <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                                                </svg>
                                            </i>


                                            <div class="price">{{$product['money']}}</div>
                                            <b>x {{$product['quantity']}}</b>

                                        </div>

                                    @else

                                        <div class="header-cart-item-info">

                                            @foreach($product['sizes'] as $size_key => $size)

                                                @if($size['quantity'])

                                                    @php($total += $size['price'] * $size['quantity'])


                                                    <div class="header-cart-item-info d-flex">

                                                        <i class="delete_item"
                                                           data-delete="{{"$category_key,$product_key,$size_key"}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24">
                                                                <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                                                            </svg>
                                                        </i>

                                                        <div>{{$size['label']}}</div>
                                                        <div class="size_price">
                                                            <div class="price">{{$size['money']}}</div>
                                                            <b>x {{$size['quantity']}}</b>
                                                        </div>

                                                    </div>

                                                @else

                                                    <div class="header-cart-item-info">

                                                        @isset($size['colors'])
                                                            @foreach($size['colors'] as $color_key => $color)

                                                                @php( $total += $size['price'] * $color['quantity'])

                                                                <div class="d-flex">


                                                                    <i class="delete_item"
                                                                       data-delete="{{"$category_key,$product_key,$size_key,$color_key"}}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="24" height="24" viewBox="0 0 24 24">
                                                                            <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                                                                        </svg>
                                                                    </i>


                                                                    <div>
                                                                        <span class="color"
                                                                              style="background-color: {{$color['hex']}}"></span>
                                                                        {{$size['label']}}
                                                                    </div>

                                                                    <div class="size_price">

                                                                        <div class="price">{{$size['money']}}</div>
                                                                        <b>x {{$color['quantity']}}</b>
                                                                    </div>

                                                                </div>

                                                            @endforeach
                                                        @endisset

                                                    </div>

                                                @endif


                                            @endforeach

                                        </div>

                                    @endif
                                </div>
                            </div>

                        </li>
                    @endforeach

                </ul>

            </div>

        @endforeach


    </div>

    <div>
        <div class="header-cart-total">Total: <span class="price">@money($total)</span></div>
        <div class="header-cart-buttons"><a href="/{{$lang}}/cart" class="btn">Verifică</a>
        </div>
    </div>

@endisset


@empty($miniCart)


    <div class="title text-center">{{myTrans('The cart is empty')}}</div>

@endempty