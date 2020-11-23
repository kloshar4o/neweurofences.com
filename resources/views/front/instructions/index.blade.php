@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container">

        @include('front.templates.breadcrumbs')

        <div class="title">{{ $parent_menu->name or '' }}</div>

        <div class="instructions cards">
            @foreach($children as $child)

                <div class="instruction card closed">
                    <div class="card-button" onclick="toggleCard(this, event)">
                        <div class="card-image">
                            @isset($child->oneImage->img)
                                <img src="/upfiles/menu/{{$child->oneImage->img}}" alt="">
                            @endisset
                        </div>
                        <div class="card-title">
                            {{$child->page_title or ''}}
                        </div>
                        <div class="card-docs homeless-files-previews ml-auto">
                            @foreach($child->docs as $doc)
                                <div class="homeless-files-preview {{$doc->extension ?? 'unknown'}}">
                                    <a class="homeless-file-icon" target="_blank" href="{{$doc->src}}">{{$doc->extension ?? 'Unknown'}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $child->body or '' !!}
                    </div>
                </div>

            @endforeach
        </div>

    </div>

@stop

<script>
    let lastOpenedCard = null;

    function toggleCard(card_button, event) {
        if(event.target.href) return

        const this_card = card_button.closest('.card');
        const clickedLastOpened = lastOpenedCard === this_card;

        if (clickedLastOpened) {
            this_card.classList.toggle('closed');
            this_card.classList.toggle('open');
            return
        }

        if (lastOpenedCard) {
            lastOpenedCard.classList.add('closed');
            lastOpenedCard.classList.remove('open');
        }

        lastOpenedCard = this_card;

        const this_card_body = this_card.querySelector('.card-body');
        this_card_body.style.maxHeight = this_card_body.scrollHeight;
        this_card.classList.add('open');
        this_card.classList.remove('closed');

    }
</script>
@include('front.footer')