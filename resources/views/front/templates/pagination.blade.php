@if ($paginator->lastPage() > 1)
    <?php
        $start = $paginator->currentPage() - 2;
        $end = $paginator->currentPage() + 2;
        $last_page = $paginator->lastPage();
        if ($start < 1) $start = 1;
        if ($end >= $paginator->lastPage()) $end = $paginator->lastPage();
    ?>

    <div class="paginator">
        <ul>
        @if(!empty($new_url))
            <li>
                {!! ($paginator->currentPage() == 1) ? '<a class="back"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>' : '<a href="' . $curr_url . $new_url . '&page=' . ($paginator->currentPage()-1) . '" class="back"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>' !!}
            </li>
            <li>
                {!! ($paginator->currentPage() == 1) ? '<a class=active>' . 1 . '</a>' : '<a href="' . $curr_url . $new_url . '&page=1' . '">' . 1 . '</a>' !!}
            </li>
            @if($start > 1)
                <li>
                    <span>...</span>
                </li>
            @endif
            @for ($i = $start + 1; $i < $end; $i++)
                <li>
                    {!! ($paginator->currentPage() == $i) ? '<a class=active>' . $i . '</a>' : '<a href="' . $curr_url . $new_url . '&page=' . $i . '">' . $i . '</a>' !!}
                </li>
            @endfor
            @if($end < $paginator->lastPage())
                <li>
                    <span>...</span>
                </li>
            @endif
            <li>
                {!! ($paginator->currentPage() == $last_page) ? '<a class=active>' . $last_page . '</a>' : '<a href="' . $curr_url . $new_url . '&page=' . $last_page . '">' . $last_page . '</a>' !!}
            </li>
            <li>
                {!! ($paginator->currentPage() == $paginator->lastPage()) ? '<a class="next"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>' : '<a href="' . $curr_url . $new_url . '&page=' . ($paginator->currentPage()+1) . '" class="next"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>'  !!}
            </li>
        @else
            <li>
                {!! ($paginator->currentPage() == 1) ? '<a class="back"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>' : '<a href="' . $paginator->url($paginator->currentPage()-1) . $new_url . '" class="back"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>' !!}
            </li>
            <li>
                {!! ($paginator->currentPage() == 1) ? '<a class=active>' . 1 . '</a>' : '<a href="' . $paginator->url(1) . $new_url . '">' . 1 . '</a>' !!}
            </li>
            @if($start > 1)
                <li>
                    <span>...</span>
                </li>
            @endif
            @for ($i = $start + 1; $i < $end; $i++)
                <li>
                    {!! ($paginator->currentPage() == $i) ? '<a class=active>' . $i . '</a>' : '<a href="' . $paginator->url($i) . $new_url . '">' . $i . '</a>' !!}
                </li>
            @endfor
            @if($end < $paginator->lastPage())
                <li>
                    <span>...</span>
                </li>
            @endif
            <li>
                {!! ($paginator->currentPage() == $last_page) ? '<a class=active>' . $last_page . '</a>' : '<a href="' . $paginator->url($last_page) . $new_url . '">' . $last_page . '</a>' !!}
            </li>
            <li>
                {!! ($paginator->currentPage() == $paginator->lastPage()) ? '<a class="next"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>' : '<a href="' . $paginator->url($paginator->currentPage()+1) . $new_url . '" class="next"><svg><use xlink:href="'.asset("front-assets/img/symbols.svg#triangle").'"></use></svg></a>'  !!}
            </li>
        @endif
        </ul>
    </div>
@endif
