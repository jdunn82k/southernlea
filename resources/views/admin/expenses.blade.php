@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">

            <div class="row">

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