@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <span class="breadcrumb-item active">Categories</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Category Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Category List
                    <a href="" class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#modaldemo3"><i
                            class="fa fa-plus-circle"> Add New</i></a>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Category name</th>
                            <th class="wd-20p">Created At</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($category->count())
                            @foreach($category as $key=>$cat)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $cat->category_name }}</td>
                                    <td>
                                        @if($cat->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                        @else
                                            {{Carbon\Carbon::parse($cat->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.category',$cat->id) }}" class="btn btn-sm btn-info bol" ><i class="fa fa-edit"> Edit</i></a>
                                        <a href="{{ route('delete.category',$cat->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"> Delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <span class="border text-danger"> No Category added yet !</span>
                        @endif


                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->


        <!-- LARGE MODAL -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Category Add</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                        <div class="modal-body pd-20">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" name="category_name"
                                       class="form-control @error('category_name') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Enter Category Name">
                                @error('category_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-10"><i class="fa fa-plus-square"> ADD</i>
                                </button>
                                <button type="button" class="btn btn-secondary pd-x-10" data-dismiss="modal"><i
                                        class="fa fa-times-circle"> Cancel</i>
                                </button>
                            </div>

                        </div><!-- modal-body -->
                    </form>
                </div>

            </div><!-- modal-dialog -->
        </div><!-- modal -->

@endsection
