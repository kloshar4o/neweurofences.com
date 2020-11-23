<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Letter</title>
    <style>
        * {
            font-family: system-ui-apple-system, BlinkMacSystemFont, Segoe UI, Helvetica Neue, Helvetica, Arial, sans-serif;
            text-rendering: optimizelegibility;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body>

@isset($miniCart)
    @php($form = $form ?? [])
    @php($total = 0)
    @php($td = 'border: solid 1px #888; padding:10px;')
    @php($img = 'max-height: 60px; vertical-align: middle; margin-bottom: 0; padding-bottom: 0; margin-right: 10px;')
    @php($link = 'padding-bottom: 0;margin-bottom: 0;color: #7c5f56;')


    <table style="width: 620px;margin: auto; text-align: center;">
        <tr>
            <td>
                <table style="width: 100%; width: 600px;">
                    <tr>
                        <td style="text-align: left">
                            <a href="{{url($lang)}}"
                               style="{{$link}} text-decoration: none; display: block;width: 120px;text-align: center;">
                                <span style="font-size: 38px;color: #7c5f56;letter-spacing: 2px;">GMD</span><br>
                                <span style="text-align: center;font-size: 12px;color: grey;letter-spacing: 1px;">GarduriMD.ro</span>
                            </a>
                        </td>
                        @isset($forClient)

                            <td style="text-align: right">
                                Phone: 0 755 330 716
                            </td>

                        @endisset
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; padding-top: 30px;">

                @isset($forClient)
                    <p>Buna {{isset($form['name']) ? $form['name'] : ''}},</p>
                    <p>Vă mulțumim pentru comandă</p>
                    <p>Detaliile comenzii dvs.</p>
                @endisset

                <ul>
                    @foreach($form as $key => $value)
                        <li>
                            <b>{{myTrans($key)}}</b>: {{$value}}
                        </li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td>

                @foreach($miniCart as $category_key => $category)

                    @foreach($category['products'] as $product_key => $product)


                        <h3 style="text-align: right; max-width: 600px; margin-bottom: 0; padding-bottom: 0">
                            <a href="{{ url("/$lang". $category['url']) }}" style="{{$link}}">{{$category['name']}}</a>
                        </h3>

                        @if($product['quantity'])

                            @php($total += $product['price'] * $product['quantity'] )



                            <table style="border-collapse: collapse;width: 100%;max-width: 600px;margin: 10px 0 50px">
                                <thead>
                                <tr>

                                    <th colspan="4" style="{{$td}}  text-align: left;">
                                        <img style="{{$img}}"
                                             src="{{url('/upfiles/gallery/s/' . $product['img'])}}">

                                        <a href="{{ url("/$lang" . $product['url']) }}"
                                           style="{{$link}}">{{$product['name']}}</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="{{$td}}">{{myTrans('sku')}}</th>
                                    <th style="{{$td}}">{{myTrans('Quantity')}}</th>
                                    <th style="{{$td}}">{{myTrans('Price')}}</th>
                                    <th style="{{$td}}">{{myTrans('Total')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>

                                    <td style="{{$td}}">{{$product['sku']}}</td>
                                    <td style="{{$td}}">{{$product['quantity']}}</td>
                                    <td style="{{$td}}">{{$product['money']}}</td>
                                    <td style="{{$td}}">@money($product['price'] * $product['quantity'])</td>

                                </tr>
                                </tbody>
                            </table>


                        @else

                            <table style="border-collapse: collapse;width: 100%;max-width: 600px;margin: 10px 0 50px">
                                <thead>
                                <tr>
                                    <th colspan="6" style="{{$td}} text-align: left;">

                                        <img style="{{$img}}"
                                             src="{{url('/upfiles/gallery/s/' . $product['img'])}}">

                                        <a href="{{ url("/$lang" . $product['url']) }}"
                                           style="{{$link}}">{{$product['name']}}</a>

                                    </th>
                                </tr>
                                <tr>
                                    <th style="{{$td}}">{{myTrans('Color')}}</th>
                                    <th style="{{$td}}">{{myTrans('sku')}}</th>
                                    <th style="{{$td}}">{{myTrans('Size')}}</th>
                                    <th style="{{$td}}">{{myTrans('Quantity')}}</th>
                                    <th style="{{$td}}">{{myTrans('Price')}}</th>
                                    <th style="{{$td}}">{{myTrans('Total')}}</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($product['sizes'] as $size_key => $size)

                                    @if($size['quantity'])


                                        @php($total += $size['price'] * $size['quantity'])



                                        <tr>

                                            <td style="{{$td}}"></td>
                                            <td style="{{$td}}">{{$size['sku']}}</td>
                                            <td style="{{$td}}">{{$size['label']}}</td>
                                            <td style="{{$td}}">{{$color['quantity']}}</td>
                                            <td style="{{$td}}">{{$size['money']}}</td>
                                            <td style="{{$td}}">@money($size['price'] * $size['quantity'])</td>

                                        </tr>

                                    @else

                                        @foreach($size['colors'] as $color_key => $color)

                                            @php( $total += $size['price'] * $color['quantity'])


                                            <tr>

                                                <td style="{{$td}}; text-align: left;">
                                        <span style="display: inline-block;
                                                margin-right: 10px;
                                                background-color: {{$color['hex']}};
                                                width: 20px;height: 21px;
                                                clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                                                margin-left: auto;">
                                        </span>

                                                    {{$color['name']}}

                                                </td>

                                                <td style="{{$td}}">{{$size['sku']}}</td>
                                                <td style="{{$td}}">{{$size['label']}}</td>
                                                <td style="{{$td}}">{{$color['quantity']}}</td>
                                                <td style="{{$td}}">{{$size['money']}}</td>
                                                <td style="{{$td}}">@money($size['price'] * $color['quantity'])</td>

                                            </tr>

                                        @endforeach


                                    @endif

                                @endforeach

                                </tbody>
                            </table>

                        @endif

                    @endforeach

                @endforeach

            </td>
        </tr>
        <tr>
            <td>
                <h1 style="text-align: right;margin-right: 10px; margin-top: -10px;">@money($total)</h1>
            </td>
        </tr>
    </table>




@endisset


@empty($miniCart)


    <div class="title text-center">{{myTrans('The cart is empty')}}</div>

@endempty

</body>
</html>