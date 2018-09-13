@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="container font-calibri">
                <div class="row">
                    <h3 class="title1">Orders To Ship</h3>
                    <table class="table table-bordered display" id="orders-to-ship-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer Name</th>
                                <th>Customer Address</th>
                                <th>Payment</th>
                                <th>Payment Method</th>
                                <th># of Items</th>
                                <th>Date </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                @if ($order->order_shipped === 0)
                                    <tr>
                                        <td><a href="{{URL::to('/admin/order/'.$order->id)}}">#{{$order->id}}</a></td>
                                        <td>{{$order->name}}</td>
                                        <td>
                                            <p>{{$order->address_1}}</p>
                                            @php
                                                if ($order->address_2 !== 'false' && $order->address_2 !== false){
                                                    echo "<p>".$order->address_2."</p>";
                                                }
                                            @endphp
                                            <p>{{$order->city}}, {{$order->state}}  {{$order->zip_code}}</p>
                                        </td>
                                        <td>${{$order->grand_total}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>{{$order->total_items_sold}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td><button type="button" class="btn btn-primary">Mark As Shipped</button></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <h3 class="title1">Past Orders</h3>
                    <table class="table table-bordered display" id="past-orders-table">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Payment</th>
                            <th>Payment Method</th>
                            <th># of Items</th>
                            <th>Date </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            @if ($order->order_shipped === 1)
                                <tr>
                                    <td>{{$order->name}}</td>
                                    <td>
                                        <p>{{$order->address_1}}</p>
                                        @php
                                            if ($order->address_2 !== 'false' && $order->address_2 !== false){
                                                echo "<p>".$order->address_2."</p>";
                                            }
                                        @endphp
                                        <p>{{$order->city}}, {{$order->state}}  {{$order->zip_code}}</p>
                                    </td>
                                    <td>${{$order->grand_total}}</td>
                                    <td>{{$order->payment_method}}</td>
                                    <td>{{$order->total_items_sold}}</td>
                                    <td>{{$order->created_at}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection