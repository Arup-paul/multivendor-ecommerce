<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Order Invoice') }}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        .gray {
            background-color: lightgray
        }
        hr {
            border: none;
            border-top: 1px dashed #8f8f8f;
            color: #fff;
            background-color: #fff;
            height: 1px;
            width: 100%;
        }
    </style>
</head>
<body>

<table width="100%">
    <tr>
        <td valign="top">
{{--            @php--}}
{{--                $logos = get_option('logo_setting', true);--}}
{{--                $path = parse_url($logos->logo ?? null)['path'];--}}
{{--            @endphp--}}
{{--            @isset($logos->logo)--}}
{{--            <img src="{{ public_path($path) }}" alt="" width="150"/>--}}
{{--            @else--}}
                <h2>{{ config('app.name') }}</h2>
{{--            @endisset--}}
        </td>
        <td align="right">
            <h3>{{ __('Order # :number',  ['number' => $order->id]) }}  </h3>

            @php
                echo DNS1D::getBarcodeHTML($order->id, 'C39');
            @endphp


        </td>
    </tr>
</table>

<br><br>

<table width="100%">
    <tr>
        <td valign="top">
            <address>
                <strong>{{ __('Billed To:') }}</strong><br>
                {{ $order->users->name }}<br>
                {{ $order->users->mobile }}<br>
                {{ $order->users->email }}<br>
            </address>
        </td>
        <td align="right">
            <address>
                <strong>{{ __('Shipped To:') }}</strong><br>
                {{ $order->deliveryAddress->name }}<br>
                {{ $order->deliveryAddress->mobile }}<br>
                {{ $order->deliveryAddress->email }}<br>
            </address>
        </td>
    </tr>
</table>

<br>

<table width="100%">
    <tr>
        <td valign="top">
            <address>
                <strong>{{ __('Payment Method:') }}</strong><br>
                {{ $order->payment_gateway}}<br>
            </address>
        </td>
        <td align="right">
            <address>
                <strong>{{ __('Order Date:') }}</strong><br>
                {{ formatted_date($order->created_at) }}<br>
            </address>
        </td>
    </tr>
</table>

<br/>

<h3>{{ __('Order Summary') }}</h3>
<table width="100%">
    <thead style="background-color: yellowgreen;">
    <tr>
        <th>{{ __('Product Name') }}</th>
        <th>{{ __('Product Color') }}</th>
        <th>{{ __('Product Code') }}</th>
        <th>{{ __('Barcode') }}</th>
        <th>{{ __('Quantity') }}</th>
        <th>{{ __('Size') }}</th>
        <th class="text-right"> {{ __('Total') }}</th
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderProducts as $item)
    <tr>
        <td>{{$item->product->product_name}}</td>
        <td>{{$item->product->product_color}}</td>
        <td>{{$item->product->product_code}}</td>
        <td>@php echo DNS1D::getBarcodeHTML($item->product->product_code, 'C39') @endphp</td>
        <td>{{$item->qty}}</td>
        <td>{{$item->size}}</td>
        <td>{{$item->total}}</td>
    </tr>
    @endforeach
</table>
<br>
<table width="100%">
    <tr>
        <td align="right">
            <h2>{{ __('Total') }} {{ number_format($order->orderProducts->sum('total'),2) }}</h2>
        </td>
    </tr>
</table>
<hr>
</body>
</html>
