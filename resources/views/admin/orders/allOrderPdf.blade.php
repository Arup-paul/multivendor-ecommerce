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

    </tr>
</table>

<br><br>


<h3>{{ __('Order Summary') }}</h3>
<hr>
    <table width="100%">
        <thead style="background-color: lightgrey">
        <tr>
            <th class="text-left">{{ __('Order Id') }}</th>
            <th>{{ __('Payment Gateway') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Customer') }}</th>
            <th class="text-right"> {{ __('Total') }}</th>
            <th>{{ __('Payment') }}</th>
            <th>{{ __('Order Status') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key => $order)
            <tr>
                <td class="text-left">{{ $order->id }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ formatted_date($order->created_at) }}</td>
                <td>
                    <a href="#">{{ $order->users->name }}</a>
                </td>
                <td >{{ $order->grand_total  }}</td>
                <td>
                    @if($order->payment_status ==2)
                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                    @elseif($order->payment_status ==1)
                        <span class="badge badge-success">{{ __('Complete') }}</span>
                    @elseif($order->payment_status == 0)
                        <span class="badge badge-danger">{{ __('Cancel') }}</span>
                    @elseif($order->payment_status == 3)
                        <span class="badge badge-danger">{{ __('Incomplete') }}</span>
                    @endif
                </td>
                <td>
                    @if($order->order_status ==0)
                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                    @elseif($order->order_status == 3)
                        <span class="badge badge-success">{{ __('Complete') }}</span>
                    @elseif($order->order_status == 4)
                        <span class="badge badge-danger">{{ __('Cancel') }}</span>
                    @elseif($order->order_status == 1)
                        <span class="badge badge-info">{{ __('Processing') }}</span>
                    @elseif($order->order_status == 2)
                        <span class="badge badge-info">{{ __('Shipping') }}</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

<hr>
</body>
</html>
