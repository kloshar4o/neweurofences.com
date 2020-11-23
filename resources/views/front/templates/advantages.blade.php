
@php($icons = [
    "proect" =>     ['strong' => 'Custom', 'light' => 'Sizes'],
    "montaj" =>     ['strong' => 'Simple', 'light' => 'Install'],
    "dostavca" =>   ['strong' => 'Fast', 'light' => 'Delivery'],
    "zabor" =>      ['strong' => 'Installation', 'light' => 'Services'],
])

<div class="avantage icons">
    <div class="container">
        <div class="avantageItems">
            @foreach($icons as $key => $paragraph)

                <div class="icon">
                    <div class="img {{$key}}"></div>
                    <div class="text">
                        <p><strong>{{ __($paragraph['strong']) }}</strong></p>
                        <p>{{ __($paragraph['light']) }}</p>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>
