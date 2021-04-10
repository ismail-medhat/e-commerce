@extends('layouts.app')

@section('content')


    <div class="contact_form">

        <div class="container">
            <div class="row">
                <div class="col-8 card">
                    <table class="table table-responsive-md">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First</th>
                            <th>Last</th>
                            <th>Body</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark 1</td>
                            <td>Mark 2</td>
                            <td>Mark 3</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Mark 1</td>
                            <td>Mark 2</td>
                            <td>Mark 3</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mark 1</td>
                            <td>Mark 2</td>
                            <td>Mark 3</td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- col-8 -->

                <div class="col-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/profile.png') }}" class="card-img-top" style="height: 90px;width: 90px;margin-left:37%; ">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{ route('password.change') }}">Change Password</a></li>
                            <li class="list-group-item">Line 1</li>
                            <li class="list-group-item">Line 1</li>
                        </ul>
                        <div class="card-body">
                            <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                        </div>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->
        </div>
    </div>


@endsection
