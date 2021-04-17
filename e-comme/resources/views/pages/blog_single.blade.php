@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single_responsive.css')}}">

    @foreach($post as $row)
        <!-- Single Blog Post -->

        <div class="single_post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="single_post_title">
                            @if(Session()->get('lang') == 'arabic')
                                {{ $row->post_title_ar }}
                            @else
                                {{ $row->post_title_en }}
                            @endif
                        </div>
                        <div class="single_post_text">
                            <p>
                                @if(Session()->get('lang') == 'arabic')
                                    {!! $row->details_ar !!}
                                @else
                                    {!! $row->details_en !!}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
