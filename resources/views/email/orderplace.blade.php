<html>
<body style="font-family:Arial;">
<div style="text-align:center;"><img src="{{ $message->embed("img/main-01.png") }}" width='300' height='auto'></div>
{{--<div style="text-align:center;"><img src="{{URL::to('img/main-01.jpg')}}" width='300' height='auto'></div>--}}
<div style="margin-top:10px;">
    <h2 style="text-align:center;">New Order Placed!</h2>
</div>

<div style="margin-top:10px;margin-left:20px;">
    <h4>Customer Details</h4>
    <p style="margin-bottom:1;">{{$name}}</p>
    <p style="margin-bottom:0;margin-top:0;">{{$add1}}</p>
    @if ($add2 != 'false' && $add2 !== false)
        <p style="margin-bottom:0;margin-top:0;">{{$add2}}</p>
    @endif
    <p style="margin-top:0;">{{$city}}, {{$state}}  {{$zip}}</p>
</div>

<div style="margin-top:10px;margin-left:20px;">
    <h2 style="text-align:center;">Order Details</h2>

    <p style="margin-bottom:1px;"><span style="font-weight:bold;font-size:16px;">Method:</span> Paypal</p>
    <p style="margin-bottom:1px;margin-top:0;"><span style="font-weight:bold;font-size:16px;">Date:</span><span style="margin-left:21px;"> {{ \Carbon\Carbon::now('America/New_York')->toFormattedDateString() }}</span></p>
    <p style="margin-top:0;"><span style="font-weight:bold;font-size:16px;">Time:</span> <span style="margin-left:19px;">{{ \Carbon\Carbon::now('America/New_York')->format('g:i A') }}</span></p>
    <div>
        <table style="width:80%;text-align:left;">
            <thead>
                <tr style="font-size:18px;">
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th style="text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product['name']}}</td>
                        <td>{{$product['product_code']}}</td>
                        <td>{{$product['qty']}}</td>
                        <td>${{number_format($product['unit_price'],2)}}</td>
                        <td style="text-align:right;">${{number_format($product['total_price'],2)}}</td>
                    </tr>
                @endforeach
                <tr style="height:50px;vertical-align:bottom;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p style="font-size:18px;font-weight:bold;">Subtotal</p></td>
                    <td style="text-align:right;">${{$subTotal}}</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p style="font-size:18px;font-weight:bold;">Tax <span style="font-size:16px;font-weight:normal;">({{\Config::get('cart.tax')}}%)</span></p></td>
                    <td style="text-align:right;">${{$tax}}</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p style="font-size:18px;font-weight:bold;">Shipping</p></td>
                    <td style="text-align:right;">${{$shipping}}</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="text-align:right;"><p style="font-size:18px;font-weight:bold;font-size:24px;">Grand Total</p></td>
                    <td style="font-weight:bold;font-size:24px;text-align:right;">${{ $grandTotal }}</td>
                </tr>

                <tr>
                    <td style="text-align:right;" colspan="4">
                        <p style="font-size:18px;font-weight:bold;font-size:24px;">Total Items To Ship</p>
                    </td>
                    <td style="font-weight:bold;font-size:24px;text-align:right;">{{ $cartTotal }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>