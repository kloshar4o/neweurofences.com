@section('gallery')

    <div class="container galleryWrapper ov-hide">

        <div class="galleryBlock gallery_slider transition">
            @if(!empty($gallery_subject_list))
                @foreach($gallery_subject_list as $one_subject)
                    <div>

                        <a href="{{ url($lang,['gallery',$one_subject->alias]) }}" class="galleryItem">
                            <img src="/upfiles/galleryItems/m/{{ $photo[$one_subject->gallery_subject_id]->img or ''}}"
                                 alt="{{ $one_subject->name }}">
                            <div class="galleryDesc">
                                <span>{{ $one_subject->name }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
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

        <div class="gallery_navigation dots">
            @if(!empty($gallery_subject_list))
                @foreach($gallery_subject_list as $one_subject)
                    <div></div>
                @endforeach
            @endif
        </div>

    </div>

@stop

@push('scripts')

    <script>

        new DraggableSlider({
            slider: '.gallery_slider',
            navigation: '.gallery_navigation',
            slidesInViewResponsive: [
                {
                    views: 1.1,
                    innerWidth: 500,
                },
                {
                    views: 2.1,
                    innerWidth: 800,
                },
                {
                    views: 3.1,
                    innerWidth: 1200,
                },
                {
                    views: 4.1,
                    innerWidth: 1600,
                },
            ]
        });
    </script>

@endpush