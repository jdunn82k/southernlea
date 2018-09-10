@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <form class="form-horizontal" role="form" id="shipping_form">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Shipping Address</legend>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="textinput">Name <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="textinput">Address 1 <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="address1"  class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="textinput">Address 2</label>
                            <div class="col-sm-10">
                                <input type="text" name="address2"  class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="textinput">City <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="city" class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="textinput">State <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="state" class="form-control shipping-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="textinput">Zip Code <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="zipcode" class="form-control shipping-input">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="phone">Phone Number <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" class="form-control shipping-input">
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <div class="col-md-3 cart-total">
                <div class="pull-right">
                    <div class="price-details">
                        <h3>Price Details</h3>
                        <span>SubTotal</span>
                        <span class="total1">${{$cartSubTotal}}</span>
                        <span>Sales Tax ({{$taxRate}}%)</span>
                        <span class="total1">{{$cartTax}}</span>
                        <span>Shipping</span>
                        <span class="total1">{{$shippingRate}}</span>
                        <div class="clearfix"></div>
                    </div>
                    <ul class="total_price mb-4">
                        <li class="last_price"> <h4>TOTAL</h4></li>
                        <li class="last_price"><span>${{number_format( ($cartSubTotal + $cartTax + $shippingRate), 2)}}</span></li>
                        <div class="clearfix"> </div>
                    </ul>
                    <form action="https://www.paypal.com/cgi-bin/webscr" id='paypal_form' method="post">
                        <fieldset>
                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" name="business" value="jamie@southernlea.com">

                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" name="cmd" value="_xclick">

                            <!-- Specify details about the item that buyers will purchase. -->
                            <input type="hidden" name="item_name" value="Southern Lea Purchase">
                            <input type="hidden" name="amount" value="{{number_format( ($cartSubTotal + $cartTax + $shippingRate), 2)}}">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="return" value="https://shop.southernlea.com/thankyou">
                            <input type="hidden" name="cancel" value="https://shop.southernlea.com/cart">

                            <!-- Display the payment button. -->
                            <input type="image" id="paypal_pay" name="submit" border="0"
                                   src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
                                   alt="Buy Now">
                            <img alt="" border="0" width="1" height="1"
                                 src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                        </fieldset>


                    </form>

                    <p><span class="text-red font-italic font-size-13">* Required Fields </span></p>
                </div>

            </div>
        </div>

        </div>
    </div>
@endsection