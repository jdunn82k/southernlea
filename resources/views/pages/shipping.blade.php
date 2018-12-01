@extends('layouts.app')

@section('content')
    @php
        $shipping = 0.00;
    @endphp
    @foreach($cartContent as $item)
        @php
            if ($item->options->shipping > $shipping)
            {
                $shipping = $item->options->shipping;
            }
        @endphp
    @endforeach
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-5 col-lg-5 col-sm-12">
                <form class="form-horizontal" role="form" id="shipping_form">
                    <fieldset>

                        <!-- Form Name -->
                        <h4 class="mt-2 mb-4">Billing Information</h4>

                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="textinput">Email Address <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control shipping-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="textinput">Name <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="textinput">Address 1 <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="address1"  class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="textinput">Address 2</label>
                            <div class="col-sm-10">
                                <input type="text" name="address2"  class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="textinput">City <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="city" class="form-control shipping-input">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="textinput">State <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="state" class="form-control shipping-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="textinput">Zip Code <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="zipcode" class="form-control shipping-input">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-10 control-label" for="phone">Phone Number <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" class="form-control shipping-input">
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h4 class="mt-2 mb-4">Shipping Options</h4>
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" id="shipping-type">
                            <option value="1">Standard Shipping - ${{$shipping}}</option>
                            <option value="2">Local Pickup In Rockwall County, TX - FREE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3 cart-total">
                <div class="pull-right">
                    <div class="price-details">
                        <h3>Price Details</h3>
                        <span>SubTotal</span>
                        <span class="total1" id="cart-subtotal">${{$cartSubTotal}}</span>
                        <span>Sales Tax ({{$taxRate}}%)</span>
                        <span class="total1" id="cart-tax">${{$cartTax}}</span>
                        <span>Shipping</span>
                        <span class="total1" id="total-shipping">${{$shipping}}</span>
                        <span class="totall hide" id="total-shipping-free">$0.00</span>
                        <div class="clearfix"></div>
                    </div>
                    <ul class="total_price mb-4">
                        <li class="last_price"> <h4>TOTAL</h4></li>
                        <li class="last_price">
                            <span id="cart-total">${{number_format( ($cartSubTotal + $cartTax + $shipping), 2)}}</span>
                            <span class="hide" id="cart-total-free">${{number_format( ($cartSubTotal+$cartTax),2)}}</span>
                        </li>
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
                            <input type="hidden" name="amount" id="total_amount" value="{{number_format( ($cartSubTotal + $cartTax + $shipping), 2)}}">
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="check-fields">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <p id="error-message" class="mb-10">Please check required fields</p>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endsection