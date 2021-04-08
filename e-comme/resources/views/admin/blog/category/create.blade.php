@extends('admin.admin_layouts')

@section('admin_content')



    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <a class="breadcrumb-item" href="{{ route('all.blogpost') }}">All Blog Posts</a>
            <span class="breadcrumb-item active">Create Blog Post</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">New Post ADD
                    <a href="{{ route('all.blogpost') }}" class="btn btn-success btn-sm pull-right ">All Post</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30">New Post Information Add Form.</p>

                <form method="POST" action="{{ route('store.post') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post Title (ENGLISH): <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control @error('post_title_en') is-invalid @enderror" type="text"
                                           name="post_title_en"
                                           placeholder="Enter Post Title In English">
                                    @error('post_title_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post Title (ARABIC): <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control @error('post_title_ar') is-invalid @enderror" type="text"
                                           name="post_title_ar"
                                           placeholder="Enter Post Title In Arabic">
                                    @error('post_title_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->


                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Blog Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose country"
                                            name="category_id">
                                        <option label="Choose Category"></option>
                                        @foreach($blogcategory as $row)
                                            <option value="{{ $row->id }}">{{ $row->category_name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post Image: <span
                                            class="tx-danger">*</span></label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input"
                                               name="post_image" onchange="readURL(this);" required>
                                        <span class="custom-file-control"></span>
                                    </label>
                                </div>
                                <img src="#" id="one">
                            </div><!-- col-6 -->


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Post Details (English): <span
                                            class="tx-danger">*</span></label>
                                    <textarea class="form-control" id="summernote" name="details_en"></textarea>
                                    @error('details_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div><!-- col-12 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Post Details (Arabic): <span
                                            class="tx-danger">*</span></label>
                                    <textarea class="form-control" id="summernote2" name="details_ar"></textarea>
                                    @error('details_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div><!-- col-12 -->


                        </div><!-- row -->
                        <br>

                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5">Submit Form</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->

        </div><!-- row -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


@endsection

