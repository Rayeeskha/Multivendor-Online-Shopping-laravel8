@extends('frontend.layouts.default')
@section('pageTitle', 'Opera | Checkout') 
@section('content')
@php($cart = new \App\Helpers\Cart)
@php($items = $cart::get_item())

<!-- checkout page -->
<div id="checkout_page" class="checkout-page animate__animated animate__fadeInUp">
    <div class="sp_header bg-white p-3 ">
        <div class="container custom_container ">
            <div class="row ">
                <div class="col-12 ">
                    <ul>
                        <li class="d-inline-block font-weight-bolderer"><a href="{{ url('/') }}">home</a></li>
                        <li class="d-inline-block hr_ font-weight-bolderer"><a href="{{ url('checkout') }}">checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container custom_container">
    @if(!empty($items))
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="accordion" id="check_out_toggle">
                    <div class="card rounded mb-2">
                        <div class="card-header bg-white" id="chechout_add">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-body p-0 font-weight-bolder" type="button" data-toggle="collapse" data-target="#check_add" aria-expanded="false" aria-controls="check_add">
                                Address <span class="float-right"><i class="fas fa-angle-down"></i></span>
                                </button>
                            </h2>
                        </div>
                        <div id="check_add" class="collapse show" aria-labelledby="chechout_add" data-parent="#check_out_toggle">
                            <div class="card-body">
                                <div id="c_address" class="page-content">
                                      @php($i=1)
                                      @foreach($deliveries as $row)
                                        <span class="form-check d-inline-block">
                                           <input class="form-check-input address" type="radio" name="gridRadios" <?= $i++ ==1 ? 'checked':''; ?> value="{{$row->id}}">
                                            <label class="form-check-label" for="pay_by_check">{{$row->address.' ,'.$row->get_city->loc_name.' ,'.$row->get_state->loc_name.' ('.$row->pin_code.')'}}
                                            </label>
                                        </span>
                                        <br><br>
                                        @endforeach
                                        <a href="{{url('customer/dashboard')}}">Add New address</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="card rounded mb-2">
                        <div class="card-header bg-white" id="checkout_payment">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-body p-0 font-weight-bolder" type="button" data-toggle="collapse" data-target="#check_payment" aria-expanded="false" aria-controls="check_payment">
                                Payment<span class="float-right"><i class="fas fa-angle-down"></i></span>
                                </button>
                            </h2>
                        </div>
                        <div id="check_payment" class="collapse" aria-labelledby="checkout_payment" data-parent="#check_out_toggle">
                            <div class="card-body">
                                <div id="pay_check" class="page-content">
                                    <form >
                                        <div class="form-group text-left">
                                            <label class="font-weight-bolder">payment Method</label><br>
                                            <span class="form-check d-inline-block">
                                            <input class="form-check-input payment_type" type="radio" name="gridRadios" id="pay_by_check"  value="online">
                                            <label class="form-check-label" for="pay_by_check">
                                            Online
                                            </label>
                                            </span>
                                            <span class="form-check d-inline-block ml-2">
                                            <input class="form-check-input payment_type" type="radio" name="gridRadios" id="pay_by_bank" value="cod" checked>
                                            <label class="form-check-label" for="pay_by_bank">
                                            COD 
                                            </label>
                                            </span>
                                        </div>
                                        <!--div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="user_pay_check" >
                                            <label class="form-check-label" for="user_pay_check">I accept the Terms of Use & Privacy Policy</label>
                                        </div-->
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    


                <div class="accordion" id="location_toggle">
                    <div class="card rounded mb-2">
                        <div class="card-header bg-white" id="location_add">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-body p-0 font-weight-bolder" type="button" data-toggle="collapse" data-target="#loc_add" aria-expanded="false" aria-controls="loc_add">
                                Address <span class="float-right"><i class="fas fa-angle-down"></i></span>
                                </button>
                            </h2>
                        </div>
                        <div id="loc_add" class="collapse show" aria-labelledby="location_add" data-parent="#location_toggle">
                            <div class="card-body">
                                <div id="c_address" class="page-content">
                                      @php($i=1)
                                      @foreach($deliveries as $row)
                                        <span class="form-check d-inline-block">
                                           <input class="form-check-input address" type="radio" name="gridRadios" <?= $i++ ==1 ? 'checked':''; ?> value="{{$row->id}}">
                                            <label class="form-check-label" for="pay_by_check">{{$row->address.' ,'.$row->get_city->loc_name.' ,'.$row->get_state->loc_name.' ('.$row->pin_code.')'}}
                                            </label>
                                        </span>
                                        <br><br>
                                        @endforeach
                                        <a href="{{url('customer/dashboard')}}">Add New address</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="card rounded mb-2">
                        <div class="card-header bg-white" id="checkout_payment">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed text-body p-0 font-weight-bolder" type="button" data-toggle="collapse" data-target="#check_payment" aria-expanded="false" aria-controls="check_payment">
                                Payment<span class="float-right"><i class="fas fa-angle-down"></i></span>
                                </button>
                            </h2>
                        </div>
                        <div id="check_payment" class="collapse" aria-labelledby="checkout_payment" data-parent="#check_out_toggle">
                            <div class="card-body">
                                <div id="pay_check" class="page-content">
                                    <form >
                                        <div class="form-group text-left">
                                            <label class="font-weight-bolder">payment Method</label><br>
                                            <span class="form-check d-inline-block">
                                            <input class="form-check-input payment_type" type="radio" name="gridRadios" id="pay_by_check"  value="online">
                                            <label class="form-check-label" for="pay_by_check">
                                            Online
                                            </label>
                                            </span>
                                            <span class="form-check d-inline-block ml-2">
                                            <input class="form-check-input payment_type" type="radio" name="gridRadios" id="pay_by_bank" value="cod" checked>
                                            <label class="form-check-label" for="pay_by_bank">
                                            COD 
                                            </label>
                                            </span>
                                        </div>
                                        <!--div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="user_pay_check" >
                                            <label class="form-check-label" for="user_pay_check">I accept the Terms of Use & Privacy Policy</label>
                                        </div-->
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>










                    <!-- card -->
                       <div class="text-center">
                            <a href="javascript:void(0);" class="btn btn-primary f_13 product_checkout">
                            Process
                            </a>
                        </div>
                </div>
                
            </div>
            <div class="col-lg-4 col-12 ">
                <div class="border rounded bg-white final_payment">
                    <div class="card-body  border-bottom">
                        <p class="text-muted">{{isset($items) && count($items) ?? 0}} items</p>
                        <p class="font-weight-bolderer">show details</p>
                        <div>
                            <span class="font-weight-bolder">subtotal</span>
                            <span class="float-right font-weight-bolder">kwd {{number_format($cart::get_total(),2) ?? 0}}</span>
                        </div>
                        <hr>
                        <div>
                            <span class="font-weight-bolder">shipping</span>
                            <span class="float-right font-weight-bolder">kwd 0.00</span>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div>
                            <span class="font-weight-bolder">total Amount</span>
                            <span class="float-right font-weight-bolder">{{number_format($cart::get_total(),2) ?? 0}}</span>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        @else
          <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body cart">
                    <div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                        <h3><strong>Your Cart is Empty</strong></h3>
                        <h4>Add something to make me happy :)</h4> <a href="{{route('/')}}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endif
    </div>
</div>
<!-- checkout page -->

@endsection