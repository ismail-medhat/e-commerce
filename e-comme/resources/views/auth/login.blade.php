@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/contact_responsive.css')}}">


    <!-- Contact Form -->

    <div class="contact_form">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 offset-lg-1" style="border: 1px solid grey;padding: 20px;border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center" style="color: darkred;">Sign In <hr></div>

                        <form action="{{ route('login') }}"  method="post" id="contact_form">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail">Email Or Phone </label>
                                <input type="text" id="email" name="email" placeholder="Enter Your Email Or Phone"
                                       name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Password </label>
                                <input type="password" name="password" placeholder="Enter Your password"
                                       class="form-control @error('password') is-invalid @enderror" required>
                            </div>

                            <div class="contact_form_button">
                                <button type="submit" class="btn btn-info">Login</button>
                            </div>
                        </form>
                        <br>
                        <a href="{{ route('password.request') }}">I forget my password</a><br><br>
                        <button class="btn btn-primary btn-block"><i class="fab fa-facebook-square"></i> Login With Facebook</button>
                        <button class="btn btn-danger btn-block"><i class="fab fa-google"></i> Login With Google</button>

                    </div>
                </div>


                <div class="col-lg-5 offset-lg-1" style="border: 1px solid grey;padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center" style="color: darkred;">Sign Up <hr></div>

                        <form action="{{ route('register') }}" method="POST" id="contact_form">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail">Full Name </label>
                                <input type="text" id="name" placeholder="Enter Your full name"
                                       name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Phone </label>
                                <input type="text" id="phone" placeholder="Enter Your Phone"
                                       name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Email </label>
                                <input type="email" value="{{ old('email') }}" id="email" placeholder="Enter Your Email" name="email" class="form-control @error('password') is-invalid @enderror">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Password </label>
                                <input type="password" id="email" placeholder="Enter Your password"
                                       name="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail">Confirm Password </label>
                                <input type="password" id="email" placeholder="Re-Type Your password"
                                       name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="contact_form_button">
                                <button type="submit" class="btn btn-info">Register</button>
                            </div>
                        </form>

                    </div>
                </div>



            </div><!-- row -->
        </div>
        <div class="panel"></div>
    </div>



@endsection
