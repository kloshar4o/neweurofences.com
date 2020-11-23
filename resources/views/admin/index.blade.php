@extends('admin.app')

@section('content')
    <div class="main-dashboard">

        <div class="main-block block-1">
            <div class="main-block-title">Last gallery items</div>
            <div class="main-block-content">
                @if(!is_null($gallery_subject))
                    <a href="{{url($lang, ['back', 'gallery', $gallery_subject_id->alias, 'memberslist'])}}">{{$gallery_subject->name}}</a>
                @endif
                <span>Gallery items: {{$count_gallery_items}}</span>
                @if(!empty($gallery_item))
                    <div class="items">
                        @foreach($gallery_item as $item)
                            @if($item->galleryItemId->type == 'photo')
                                <div>
                                    @if(!empty($item->galleryItemId->img) && file_exists('upfiles/galleryItems/' . $item->galleryItemId->img))
                                        <a href="/upfiles/galleryItems/{{$item->galleryItemId->img}}"
                                           data-fancybox="main-gallery">
                                            <img src="/upfiles/galleryItems/s/{{$item->galleryItemId->img}}"
                                                 alt="{{$item->name}}" title="{{$item->name}}">
                                        </a>
                                    @else
                                        <img src="{{asset('admin-assets/img/no-image.png')}}" alt="no-image"
                                             title="No image">
                                    @endif
                                </div>
                            @else
                                <div class="youtube-img">
                                    <a href="https://www.youtube.com/embed/{{$item->galleryItemId->youtube_id or ''}}?autoplay=0"
                                       data-fancybox="main-gallery">
                                        <img src="http://img.youtube.com/vi/{{$item->galleryItemId->youtube_id or ''}}/0.jpg"
                                             alt="{{$item->name or ''}}" title="{{$item->name or ''}}">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="main-block block-2">
            <div class="main-block-title">Last feedback</div>
            @if(!$feedback->isEmpty())
                <div class="main-block-content">
                    @foreach($feedback as $item)
                        <a href="{{url($lang, ['back', 'feedform', str_slug($item->name), 'edititem', $item->id])}}">
                            <span class="name">{{$item->name or ''}}: </span>
                            <span>{{!empty($item->comment) ? strPosText($item->comment, 250) : ''}}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="main-block block-3">
            <div class="main-block-title">Last goods</div>

        </div>
        <div class="main-block block-4">
            <div class="main-block-title">Statistics</div>
            <div class="main-block-content">
                <div>
                    <span class="name">Pages: </span>
                    <span>{{$count_pages}}</span>
                </div>
                <div>

                </div>
                <div>
                    <span class="name">Feedback's: </span>
                    <span>{{$count_feedback}}</span>
                </div>
                <div>
                    <span class="name">Label's: </span>
                    <span>{{$count_labels}}</span>
                </div>
            </div>
        </div>

    </div>
@stop