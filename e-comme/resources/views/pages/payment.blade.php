@extends('layouts.app')

@section('content')

    @include('layouts.menubar')

    @php
        $setting = DB::table('settings')->first();
        $charge  = $setting->shiping_charge;
        $vat  = $setting->vat;
    @endphp

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_responsive.css')}}">


    <!-- Contact Form -->

    <div class="contact_form">
        <div class="container">
            <div class="row">

                <div class="col-lg-7" style="border: 1px solid grey;padding: 20px;border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center" style="color: darkred;"> Cart Products
                            <hr>
                        </div>


                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach($cart as $row)
                                    <li class="cart_item clearfix">

                                        <div
                                            class="cart_item_info d-flex flex-md-row flex-column justify-content-between">

                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Product Image</b></div>
                                                <div class="cart_item_text"><img
                                                        src=" {{ asset($row->options->image) }}"
                                                        style="width: 80px;height: 80px;" alt=""></div>
                                            </div>

                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Name</b></div>
                                                <div class="cart_item_text">{{ $row->name }}</div>
                                            </div>
                                            @if($row->options->color == NULL)

                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"><b>Color</b></div>
                                                    <div class="cart_item_text">{{ $row->options->color }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if($row->options->size == NULL)

                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"><b>Size</b></div>
                                                    <div class="cart_item_text">{{ $row->options->size }}
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title"><b>Quantity</b></div>
                                                <div class="cart_item_text">{{ $row->qty }}</div>

                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title"><b>Price</b></div>
                                                <div class="cart_item_text">${{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title"><b>Total</b></div>
                                                <div class="cart_item_text">${{ $row->price*$row->qty }}</div>
                                            </div>


                                        </div>
                                    </li>
                                    <hr>
                                @endforeach
                            </ul>
                        </div>

                        <ul class="list-group col-lg-8 " style="float: right;">
                            @if(Session::has('coupon'))
                                <li class="list-group-item">Subtotal : <span
                                        style="float: right;"> ${{ Session::get('coupon')['balance'] }}</span></li>
                                <li class="list-group-item">Coupon : ({{ Session::get('coupon')['name'] }})
                                    <a href="{{ route('coupon.remove') }}" class="btn btn-danger btn-sm">X</a>
                                    <span style="float: right;">
                                    ${{ Session::get('coupon')['discount'] }}</span></li>
                            @else
                                <li class="list-group-item">Subtotal : <span
                                        style="float: right;"> ${{ Cart::subtotal() }}</span></li>
                            @endif

                            <li class="list-group-item">Shiping Charge : <span
                                    style="float: right;">${{ $charge }}</span></li>
                            <li class="list-group-item">Vat : <span style="float: right;">${{ $vat }}</span></li>
                            @if(Session::has('coupon'))
                                <li class="list-group-item">Total : <span
                                        style="float: right;">${{ Session::get('coupon')['balance']+$charge+$vat }}</span>
                                </li>
                            @else
                                <li class="list-group-item">Total : <span
                                        style="float: right;">${{ Cart::subtotal()+$charge+$vat }}</span></li>
                            @endif
                        </ul>


                    </div>
                </div>


                <div class="col-lg-5" style="border: 1px solid grey;padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center" style="color: darkred;"> Shiping Address
                            <hr>
                        </div>

                        <form action="{{ route('payment.process') }}" method="POST" id="contact_form">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail">Full Name </label>
                                <input type="text" id="name" placeholder="Enter Your full name"
                                       name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Phone</label>
                                <input type="text" id="name" placeholder="Enter Your phone"
                                       name="phone" value="{{ old('phone') }}"
                                       class="form-control @error('phone') is-invalid @enderror" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Email </label>
                                <input type="email" id="name" placeholder="Enter Your email"
                                       name="email" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Address </label>
                                <input type="text" id="name" placeholder="Enter Your  address"
                                       name="address" value="{{ old('address') }}"
                                       class="form-control @error('address') is-invalid @enderror" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">city </label>
                                <input type="text" id="name" placeholder="Enter Your city"
                                       name="city" value="{{ old('city') }}"
                                       class="form-control @error('city') is-invalid @enderror" required>
                            </div>

                            <div class="contact_form_title text-center">
                                Payment By
                            </div>
                            <div class="form-group">
                                <ul class="logos_list">
                                     <li><input type="radio" name="payment" value="stripe"><img src="{{ asset('frontend/images/mastercard.png') }}" style="width: 100px;height: 70px;"></li>
                                     <li><input type="radio" name="payment" value="paypal"><img src="{{ asset('frontend/images/paypal.png') }}" style="width: 100px;height: 70px;"></li>
                                     <li><input type="radio" name="payment" value="ideal"><img src="{{ asset('frontend/images/mollie.png') }}" style="width: 100px;height: 70px;"></li>
                                </ul>
                            </div><hr>


                            <div class="contact_form_button text-center">
                                <button type="submit" class="btn btn-info"><i class="fab fa-paypal"></i> Pay Now</button>
                            </div>
                        </form>

                    </div>
                </div>


            </div><!-- row -->
        </div>
        <div class="panel"></div>
    </div>



@endsection

