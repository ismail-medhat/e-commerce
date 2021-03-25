@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Admin</a>
            <span class="breadcrumb-item active">Subscribe</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Subscribe Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Subscribe List
                    <a href="" class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#modaldemo3"><i
                            class="fa fa-trash"> Delete All</i></a>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">E-mail</th>
                            <th class="wd-20p">Subscribing Date</th>
                            <th class="wd-20p">Subscribing Time</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($subscribe->count())
                            @foreach($subscribe as $key=>$row)
                                <tr>
                                    <td><input type="checkbox"> {{ $key +1 }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        @if($row->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                        @else
                                            {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('delete.subscribe',$row->id) }}" class="btn btn-sm btn-danger"
                                           id="delete"><i class="fa fa-trash"> Delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <span class="border text-danger"> No Coupons added yet !</span>
                        @endif


                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

@endsection


