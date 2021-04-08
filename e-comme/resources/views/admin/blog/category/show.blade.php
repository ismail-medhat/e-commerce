@extends('admin.admin_layouts')

@section('admin_content')



    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <a class="breadcrumb-item" href="{{ route('all.blogpost') }}">All Blog Posts</a>
            <span class="breadcrumb-item active">Show Blog Post</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">New Post ADD
                    <a href="{{ route('all.blogpost') }}" class="btn btn-success btn-sm pull-right ">All Post</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30">Show Post Information.</p>

                    <div class="form-layout">
                        <div class="row mg-b-25">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong class="form-control-label">Post Title (ENGLISH): <span
                                            class="tx-danger">*</span></strong>
                                    <span> {{$post->post_title_en}} </span>
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong class="form-control-label">Post Title (ARABIC): <span
                                            class="tx-danger">*</span></strong>
                                    <span> {{$post->post_title_ar}} </span>
                                </div>
                            </div><!-- col-6 -->


                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <strong class="form-control-label">Post Category (English): <span class="tx-danger">*</span></strong>
                                    <span> {{$post->category_name_en}} </span>
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <strong class="form-control-label">Post Category (Arabic): <span class="tx-danger">*</span></strong>
                                    <span> {{$post->category_name_ar}} </span>
                                </div>
                            </div><!-- col-6 -->





                            <div class="col-lg-12">
                                <hr>
                                <div class="form-group">
                                    <strong class="form-control-label">Post Details (English): <span
                                            class="tx-danger">*</span></strong>
                                    <span> {!! $post->details_en !!} </span>
                                </div>
                            </div><!-- col-12 -->



                            <div class="col-lg-12">
                                <hr>
                                <div class="form-group">
                                    <strong class="form-control-label">Post Details (Arabic): <span
                                            class="tx-danger">*</span></strong>
                                    <span> {!! $post->details_ar !!} </span>
                                </div>
                                <hr>
                            </div><!-- col-12 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Post Image: <span
                                            class="tx-danger">*</span></label><br>
                                </div>
                                <img src="{{ URL::to($post->post_image) }}" style="width: 200px;height: 200px;" >
                            </div><!-- col-4 -->


                        </div><!-- row -->
                        <br>


                    </div><!-- form-layout -->

            </div><!-- card -->

        </div><!-- row -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->



@endsection

