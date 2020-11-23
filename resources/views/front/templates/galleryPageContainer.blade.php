@if($gallery_photos->isNotEmpty())

    <div class="ov-hide product_slider_wrap">

        <div class="product_slider sliderOne transition">
            @foreach($gallery_photos as $one_photo)
                <div>
                    <a data-fancybox="gallery" href="/upfiles/galleryItems/{{ $one_photo->img }}">

                        <img src="/upfiles/galleryItems/{{ $one_photo->img }}" title="{{ $one_photo->name }}"
                             alt="{{ $one_photo->name }}">
                        <p>{{$one_photo->name}}</p>

                    </a>
                </div>

            @endforeach
        </div>

        <label for="next" class="arrow next">
            <svg>
                <use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use>
            </svg>
        </label>
        <label for="back" class="arrow back">
            <svg>
                <use xlink:href="{{ asset('front-assets/img/symbols.svg#triangle') }}"></use>
            </svg>
        </label>


        <div class="sliderMini product_slider transition">
            @foreach($gallery_photos as $one_photo)
                <div>
                    <img src="/upfiles/galleryItems/{{ $one_photo->img }}"
                         alt="{{ $goods_item->name or '' }}">
                </div>
            @endforeach
        </div>

        <div class="gallery_navigation dots">
            @foreach($gallery_photos as $one_photo)
                <div></div>
            @endforeach
        </div>

    </div>


    @push('scripts')

        <script>
            const one_gallery = new GallerySlider({
                slider: '.sliderOne',
                miniSlider: '.sliderMini',
                miniSliderDots: '.gallery_navigation',
                miniSliderResponsive: [
                {
                    views: 3,
                    innerWidth: 500,
                },
                {
                    views: 4,
                    innerWidth: 1400,
                },
                {
                    views: 5
                },
            ]
            });
        </script>

    @endpush


@endif
