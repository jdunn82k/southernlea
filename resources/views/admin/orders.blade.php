@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">

                <div class="row">
                    <div class="col-md-12 widget-shadow">
                        <h3 class="title1 mt-4">Orders To Ship</h3>
                        <table class="table table-bordered display" id="orders-to-ship-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Payment</th>
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
                                        <td>{{$order->name}}<br><a href="mailto:{{$order->email}}">{{$order->email}}</a></td>
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
                                        <td>{{$order->total_items_sold}}</td>
                                        <td>
                                            @php
                                                $dt = new DateTime($order->created_at);
                                                echo $dt->format('m/j/y')."<br>".$dt->format('g:ia');
                                            @endphp
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" id="open-shipping-modal" data-order-id="{{$order->id}}">Mark As Shipped</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 widget-shadow">
                        <h3 class="title1 mt-4">Past Orders</h3>
                        <table class="table table-bordered display" id="past-orders-table">
                            <thead>
                            <tr>
                                <th>#</th>
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
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mark-as-shipped-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Enter Shipping Information</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="order_id" id="order_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group clearfix mb-10">
                                    <label for="tracking" class="col-sm-4 control-label">Tracking Number</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="tracking" name='tracking' value="">
                                    </div>
                                </div>
                                <div class="form-group clearfix mb-10">
                                    <label for="carrier" class="col-sm-4 control-label">Carrier</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="carrier" name="carrier">
                                            <option value="usps">USPS</option>
                                            <option value="fedex">FedEx</option>
                                            <option value="ups">UPS</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix mb-10">
                                    <label for="notes" class="col-sm-4 control-label">Add Note</label>
                                    <div class="col-sm-7">
                                        <textarea id="notes" name="notes" class="form-control height-200"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <button class="btn btn-primary pull-right" id="complete-order">Complete Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection