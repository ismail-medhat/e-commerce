@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <a class="breadcrumb-item" href="{{ route('brands') }}">Brands</a>
            <span class="breadcrumb-item active">Edit Brand</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand Information</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Brand update</h6>

                <div class="table-wrapper">


                    <form action="{{ route('update.brand',$brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body pd-20">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name</label>
                                <input type="text" name="brand_name"
                                       class="form-control @error('brand_name') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $brand->brand_name }}">
                                @error('brand_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Logo</label>
                                <input type="file" name="brand_logo"
                                       class="form-control @error('brand_logo') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp">
                                @error('brand_logo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Brand Logo</label>
                                <img src="{{ URL::to($brand->brand_logo) }}" height="70px;" width="80px;">
                                <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-10"><i class="fa fa-save"> Update</i>
                                </button>
                                <a href="{{ route('brands') }}" class="btn btn-secondary pd-x-10" data-dismiss="modal"><i
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

