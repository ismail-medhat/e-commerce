@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <span class="breadcrumb-item active">Products</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Product Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Product List
                    <a href="{{ route('add.product') }}" class="btn btn-sm btn-warning float-right">
                        <i class="fa fa-plus-circle"> Add New</i></a>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">Product Code</th>
                            <th class="wd-15p">Product Name</th>
                            <th class="wd-15p">Image</th>
                            <th class="wd-15p">Category</th>
                            <th class="wd-15p">Brand</th>
                            <th class="wd-10p">Quantity</th>
                            <th class="wd-10p">Status</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($product->count())
                            @foreach($product as $row)
                                <tr>
                                    <td>{{ $row->product_code }}</td>
                                    <td>{{ $row->product_name }}</td>
                                    <td><img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"></td>
                                    <td>{{ $row->category_name}}</td>
                                    <td>{{ $row->brand_name }}</td>
                                    <td>{{ $row->product_quantity }}</td>
                                    <td>

                                        @if($row->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">Inactive</span>
                                        @endif

                                    </td>
                                    <td>

                                        <a href="{{route('edit.product',$row -> id)}}"
                                           class="btn btn-sm btn-primary" title="edit">
                                            <i class="fa fa-edit"></i></a>

                                        <a href="{{route('show.product',$row -> id)}}"
                                           class="btn btn-sm btn-success" title="show">
                                            <i class="fa fa-eye"></i></a>

                                        <a href="{{route('delete.product',$row -> id)}}"
                                           class="btn btn-sm btn-danger" id="delete" title="delete">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        @if($row->status == 0)
                                            <a href="{{route('active.product',$row -> id)}}"
                                               class="btn btn-sm btn-info" title="active">
                                                <i class="fa fa-thumbs-up"></i></a>
                                        @else
                                            <a href="{{route('inactive.product',$row -> id)}}"
                                               class="btn btn-sm btn-danger" title="inactive">
                                                <i class="fa fa-thumbs-down"></i></a>
                                        @endif


                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <span class="border text-danger"> No Product added yet !</span>
                        @endif

                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

@endsection

