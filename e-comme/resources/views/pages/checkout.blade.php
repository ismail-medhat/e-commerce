@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/cart_responsive.css')}}">

    <!-- Cart -->

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Checkout</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach($cart as $row)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image text-center"><br><img
                                                src=" {{ asset($row->options->image) }}"
                                                style="width: 80px;height: 80px;" alt=""></div>
                                        <div
                                            class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $row->name }}</div>
                                            </div>
                                            @if($row->options->color == NULL)

                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Color</div>
                                                    <div class="cart_item_text">{{ $row->options->color }}
                                                    </div>
                                                </div>
                                            @endif

                                            @if($row->options->size == NULL)

                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Size</div>
                                                    <div class="cart_item_text">{{ $row->options->size }}
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <br>

                                                <form method="POST" action="{{ route('update.cart.item') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $row->rowId }}">
                                                    <input type="number" name="qty" value="{{ $row->qty }}"
                                                           style="width: 40px;">
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fas fa-check-square"></i></button>
                                                </form>

                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">${{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">${{ $row->price*$row->qty }}</div>
                                            </div>

                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Action</div>
                                                <br>
                                                <a href="{{ route('remove.cart',$row->rowId) }}"
                                                   class="btn btn-danger btn-sm">x</a>
                                            </div>
                                        </div>
                                    </li>
                                    <hr>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Order Total -->
                        <div class="order_total_content" style="padding: 15px;">
                            <h5 style="margin-left: 20px;">Apply Coupon</h5>
                            <form>
                                @csrf
                                <div class="form-group col-lg-4">
                                    <input type="text" class="form-control" name=" " required
                                           placeholder="Enter Your Coupon">
                                </div>
                                <button type="submit" class="btn btn-danger ml-3">Submit</button>
                            </form>
                        </div>

                        <ul class="list-group col-lg-4 " style="float: right;">
                            <li class="list-group-item">Subtotal : <span style="float: right;">252</span></li>
                            <li class="list-group-item">Coupon : <span style="float: right;">252</span></li>
                            <li class="list-group-item">Shiping Charge : <span style="float: right;">252</span></li>
                            <li class="list-group-item">Vat : <span style="float: right;">252</span></li>
                            <li class="list-group-item">Total : <span style="float: right;">252</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="cart_buttons">
                <button type="button" class="button cart_button_clear">All Cancel</button>
                <a href="{{ route('user.checkout') }}" class="button cart_button_checkout">Checkout</a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="{{asset('frontend/js/cart_custom.js')}}"></script>
@endsection
