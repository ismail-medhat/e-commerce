@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <span class="breadcrumb-item active">Posts</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Post Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Post List
                    <a href="{{ route('add.blogpost') }}" class="btn btn-sm btn-warning float-right">
                        <i class="fa fa-plus-circle"> Add New</i></a>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">Post Title</th>
                            <th class="wd-15p">Post Category</th>
                            <th class="wd-15p">Image</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($post->count())
                            @foreach($post as $row)
                                <tr>
                                    <td>{{ $row->post_title_en }}</td>
                                    <td>{{ $row->category_name_en }}</td>
                                    <td><img src="{{ URL::to($row->post_image) }}" height="50px;" width="50px;"></td>
                                    <td>

                                        <a href="{{route('edit.post',$row -> id)}}"
                                           class="btn btn-sm btn-primary" title="edit">
                                            <i class="fa fa-edit"></i></a>

                                        <a href="{{route('show.post',$row -> id)}}"
                                           class="btn btn-sm btn-success" title="show">
                                            <i class="fa fa-eye"></i></a>

                                        <a href="{{route('delete.post',$row -> id)}}"
                                           class="btn btn-sm btn-danger" id="delete" title="delete">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <span class="border text-danger"> No Post added yet !</span>
                        @endif

                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

@endsection

