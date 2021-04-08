@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <a class="breadcrumb-item" href="{{ route('add.blog.category.list') }}">Blog</a>
            <span class="breadcrumb-item active">Edit Blog Category</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Blog Category Information</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Blog Category update</h6>

                <div class="table-wrapper">


                    <form action="{{ route('update.blog.category',$blogcatedit->id) }}" method="POST">
                        @csrf
                        <div class="modal-body pd-20">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name English</label>
                                <input type="text" name="category_name_en"
                                       class="form-control @error('category_name_en') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $blogcatedit->category_name_en }}">
                                @error('category_name_en')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name Arabic</label>
                                <input type="text" name="category_name_ar"
                                       class="form-control @error('category_name_ar') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $blogcatedit->category_name_ar }}">
                                @error('category_name_ar')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-10"><i class="fa fa-save"> Update</i>
                                </button>
                                <a href="{{ route('add.blog.category.list') }}" class="btn btn-secondary pd-x-10" data-dismiss="modal"><i
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
