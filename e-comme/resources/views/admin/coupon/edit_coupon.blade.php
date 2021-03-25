@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <a class="breadcrumb-item" href="{{ route('admin.coupon') }}">Coupons</a>
            <span class="breadcrumb-item active">Edit Coupon</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Coupon Information</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Coupon update</h6>

                <div class="table-wrapper">


                    <form action="{{ route('update.coupon',$coupon->id) }}" method="POST">
                        @csrf
                        <div class="modal-body pd-20">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Code</label>
                                <input type="text" name="coupon"
                                       class="form-control @error('coupon') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $coupon->coupon }}">
                                @error('coupon')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Discount (%)</label>
                                <input type="text" name="discount"
                                       class="form-control @error('discount') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $coupon->discount }}">
                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-10"><i class="fa fa-save"> Update</i>
                                </button>
                                <a href="{{ route('admin.coupon') }}" class="btn btn-secondary pd-x-10" data-dismiss="modal"><i
                                        class="fa fa-arrow-circle-left"> Back</i>
                                </a>
                            </div>

                        </div><!-- modal-body -->
                    </form>

                </div><!-- table-wrapper -->
            </div><!-- card -->

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->


@endsection

