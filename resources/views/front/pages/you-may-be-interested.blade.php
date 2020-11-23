@isset($relatedQuery)

    @foreach($relatedQuery as $relatedPage)

        @if(count($relatedPage['products'])>0 && $dontSkip)

            <div class="title">{{myTrans('Related Products')}}</div>

            <div class="intrestedSubPage">
                <div class="intrestedSubTitle">
                    <h2>
                        <a href="/{{$lang}}/{{$relatedPage->parentsUrl}}/{{$relatedPage->alias}}">
                            <span>{{$relatedPage->page_title}}</span> </a>
                    </h2>
                </div>

                @include('front.templates.productTile', [
                'products'=> $relatedPage['products'],
                'products_img'=> $related_catalog_image,
                'products_url'=> "$relatedPage->parentsUrl/$relatedPage->alias",
                'colors'=> $related_catalog_color ?? ''
                ])

            </div>

            @if(Auth::check())
                <div class="editPageBtn">
                    <a href="/{{$lang}}/back/goods/{{$relatedPage->alias}}/creategoodsitem" target="_blank"><img
                                src="/front-assets/img/plus-circle-outline.png" alt="">Add {{$relatedPage->name}}
                    </a>
                </div>
            @endif


        @else

            @if(count($relatedPage['products']) == 0)
                @php($products_url = "$relatedPage->parentsUrl/$relatedPage->alias")

                <div class="intrestedTitle">
                    <h2>
                        <a href="{{"/$lang/$products_url"}}">
                            <small>S-ar putea să vă intereseze </small>
                            <span>{{$relatedPage->page_title}}</span></a>

                    </h2>
                </div>
            @endif

            @if($relatedPage['subPages'])
                @foreach($relatedPage['subPages'] as $subPage)

                    @php($relatedSubPage = $relatedPage[$subPage['alias']])

                    <div class="intrestedSubPage">

                        <div class="intrestedSubTitle">
                            <h2>

                                <a href="{{"/$lang/$products_url/$relatedSubPage->alias"}}">
                                    <span> {{$relatedSubPage->name}}</span>
                                </a>
                            </h2>
                        </div>

                        @include('front.templates.productTile', [
                        'products'=> $relatedSubPage->products,
                        'products_img'=> $related_catalog_image,
                        'products_url'=> "$products_url/$relatedSubPage->alias",
                        'colors'=> $related_catalog_color ?? ''
                        ])

                        @if(Auth::check())
                            <div class="editPageBtn">
                                <a href="/{{$lang}}/back/goods/{{$relatedSubPage->alias}}/creategoodsitem"
                                   target="_blank"><img src="/front-assets/img/plus-circle-outline.png"
                                                        alt="">Add {{$relatedSubPage->name}}
                                </a>
                            </div>
                        @endif

                    </div>

                @endforeach
            @endif

        @endif

    @endforeach

@endisset




