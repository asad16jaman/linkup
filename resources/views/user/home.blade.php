@extends('user.layout.app')
@section("title")
    home page
@endsection

@section('maincontent')

        <!-- Carousel Start -->
            @include("user.home.carousel",['carousels' => $carousels])
        <!-- Carousel End -->

        <!-- About Start -->
             @include("user.home.about",['about'=> $about])
        <!-- About End -->


        <!-- Services Start -->
            @include("user.home.service",['services' => $services])
        <!-- Services End -->


        <!-- Project Start -->
             @include("user.home.project",['projects'=>$projects])
        
        <!-- Project End -->

        <!-- Team Start -->
        @include("user.home.team",['teams'=>$teams])
        <!-- Team End -->


        <!-- Testimonial Start -->
             @include("user.home.client",compact(['clients']))
        <!-- Testimonial End -->


        <!-- FAQ Start -->
             @include("user.home.fqa")
        <!-- FAQ End -->

     @endsection