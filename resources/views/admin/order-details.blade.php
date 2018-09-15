@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="container">
                <div class="row">
                    <h3 class="title1">Order Details</h3>
                </div>
                <div class="row">
                    <div class="col-md-10 widget-shadow">
                        <table class="table table-sm">

                            <tr>
                                <td class="sub-table-heading">Order ID</td>
                                <td>{{$order_details->id}}</td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Date</td>
                                <td>@php
                                        $dt = new DateTime($order_details->created_at);
                                        echo $dt->format('m/j/y')." ".$dt->format('g:ia');
                                    @endphp</td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Customer</td>
                                <td>{{$order_details->name}}</td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Address</td>
                                <td>
                                    <p>{{$order_details->address_1}}</p>
                                    @php
                                        if ($order_details->address_2 !== false && $order_details->address_2 !== 'false'){
                                            echo "<p>".$order_details->address_2."</p>";
                                        }
                                    @endphp
                                    <p>{{$order_details->city}}, {{strtoupper($order_details->state)}} {{$order_details->zip_code}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Phone</td>
                                <td>{{$order_details->phone}}</td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Payment Method</td>
                                <td>{{$order_details->payment_method}}</td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Shipped Date</td>
                                <td>
                                    @php
                                        $dt = new DateTime($order_details->shipping_date);
                                        echo $dt->format('m/j/y')." ".$dt->format('g:ia');
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Shipping Carrier</td>
                                <td>{{$order_details->method}}</td>
                            </tr>
                            <tr>
                                <td class="sub-table-heading">Notes</td>
                                <td>
                                    @foreach($order_notes as $notes)
                                        <p>{{$notes->note}}</p>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 widget-shadow">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Item Purchased</th>
                                <th>Quantity</th>
                                <th class="text-right">Product Price</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $results = json_decode($order_details->product_info);
                                @endphp
                                @foreach($results as $result)
                                    <tr>
                                        <td>{{$result->product_name}} [{{$result->product_code}}]</td>
                                        <td>{{$result->quantity}}</td>
                                        <td align="right">${{number_format($result->product_price,2)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td align="right" class="sub-table-heading">Subtotal</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td align="right">${{$order_details->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right">Shipping Cost</td>
                                    <td align="right">${{$order_details->shipping_cost}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="right">Tax ({{$order_details->tax_rate}}%)</td>
                                    <td align="right">${{$order_details->grand_total - $order_details->subtotal - $order_details->shipping_cost}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td align="right" class="sub-table-heading">Order Total</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td align="right" class="sub-table-heading">${{$order_details->grand_total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection