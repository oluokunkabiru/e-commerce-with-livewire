@extends('layouts.app')

@section('title')
    {{ $category->name }}
@endsection

@section("{{ $category->slug }}")
    active
@endsection

@section('contents')
<div class="bradcaump py-4">

        <div class="container" >
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-home mr-2" aria-hidden="true"></i>About</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                {{ $category->name }}</button>
        </div>
    </div>

    <div class="container-fluid" style="height: 40vh; background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('{{ $category->getMedia('category')->first() != null ? $category->getMedia('category')->first()->getFullUrl() : null }}') no-repeat center/cover; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h5 class="bigger-font f-500 text-uppercase text-white">{{ $category->name }}</h5>
    </div>


    <div class="container py-4 mt-4">
        <div class="about-us-text editor-text">
            {!! $category->about !!}
        </div>



    </div>
@endsection
