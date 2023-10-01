@extends('layouts.app')

@section('title')
    About Us
@endsection

@section('about-us')
    active
@endsection

@section('contents')
    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-home mr-2" aria-hidden="true"></i>Properties</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                About us</button>
        </div>
    </div>
    <div class="container py-4 mt-4">
        <h5 class="bigger-font f-500 text-uppercase text-center text-black">{{ config('app.name') }}</h5>
        <div class="my-4 p-4 about-us-text editor-text">
            {!! $aboutUs->about !!}
        </div>


        <div class="row my-4">
            <div  class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">
                {!! $aboutUs->mission !!}
            </div>

            <div  class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">
                {!! $aboutUs->vision !!}
            </div>

        </div>
    </div>
@endsection
