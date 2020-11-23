@if(!$products->isEmpty())

    <div class="sqareCards gridBy{{count($products)}}">
        <div class="catalog_categories_content">


            @foreach($products as $one_item)
                @php($id = $one_item->goods_item_id )
                @php($colors = isset( $colors_list[$id]) ? $colors_list[$id] : [])
                @php($price = getPrices($id, $one_item->price))


                <div class="catalog_categories_a">

                    @if(Auth::check())

                        <a class="editBack" target="_blank" href="/{{$lang}}/back/goods/{{$children}}/editgoodsitem/{{$id}}/1"><img src="/front-assets/img/edit.png"
                                                                                                                                    alt=""></a>
                        <a class="editBack editImage"
                           target="_blank" href="/{{$lang}}/back/goods/{{$children}}/itemsphoto/{{$id}}">
                            <img src="/front-assets/img/editimage.png"></a>

                    @endif

                    <a href="{{"/$lang/$products_url/$one_item->alias"}}">
                        <div class="catalog_categories_item_main">
                            <div class="catalog_categories_item_div">

                                <div class="catalog_categories_item_text">
                                    {{ $one_item->name }}
                                </div>

                                <img src="{{ asset('/upfiles/gallery/m')}}/{{ $products_img[$id]->img or ''  }}" class="catalog_categories_item_img" alt="{{ $one_item->name }}" title="{{ $one_item->name }}"/>

                                <div class="productInfoFlex">


                                            <div class="productInfo">
                                                @if(count($colors) !== 0)
                                                <div class="smallcolor">
                                                    <sub>{{myTrans('Colors')}}</sub>
                                                    @foreach($colors as $one_color)
                                                        <div class="oneColor" title="{{$one_color->name}} (RAL {{$one_color->ral}})"
                                                             style="background-color: {{$one_color->hex}}; color: {{$one_color->hex}}"></div>
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>


                                        @isset($price)
                                            <div class="productInfo prices">
                                                <div>
                                                    <sub>{{myTrans('Price')}} </sub>
                                                    <span class="price">{{$price}}</span>
                                                </div>
                                            </div>
                                        @endisset



                                </div>


                            </div>
                        </div>
                    </a>


                </div>
            @endforeach
        </div>
    </div>
@endif
