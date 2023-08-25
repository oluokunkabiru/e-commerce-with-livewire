@extends('layouts.app')

@section('title')
  Shop
@endsection

@section('shop')
  active
@endsection

@section('contents')
  <div class="p-relative">
    @include('partial.component-loading')
    <div class="bradcaump py-4">
      <div class="container">
        <a href="{{ route('home') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-home mr-2"
            aria-hidden="true"></i>Home</a>
        <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
            aria-hidden="true"></i></button>
        <button class="btn btn-lg btn-transparent p-3 shadow-0">
          Properties</button>
      </div>
    </div>
    <div class="container py-4 mt-4">
      <div class="row">
        @if ($categories->count() > 0)
          @foreach ($categories as $category)
            <div wire:key='{{ $loop->index }}' class="my-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="product-card p-relative text-center w-100 bg-white rounded-3 shadow-1-strong">
                <a class="btn mb-1 btn-light p-0 shadow-0" href="{{ route('category', $category->slug) }}">
                    <img
                    style="width:100%; height:150px; object-fit:cover"
                    observe='true' observe-src="{{ $category->getMedia('category')->first() !=null ? $category->getMedia('category')->first()->getFUllUrl():null }}" class="img-fluid" alt="">
                  <div style="height: 395px;" class="img-progress">
                    <div class="spinner-border text__primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                </a>
                <h1 class="small-font my-3">{{ $category->name }}</h1>
                <p class="smaller-font pb-4">{{ $category->products_count }}
                  Propert{{ $category->products_count > 1 ? 'ies' : 'y' }}</p>
              </div>
            </div>
          @endforeach

        @else
          @include('partial.empty-table', ["title" => "No Category Found"])
        @endif
      </div>
    </div>
  </div>
@endsection
