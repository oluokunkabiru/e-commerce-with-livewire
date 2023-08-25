@extends('layouts.app')

@section('title')
    OOPs!! Page Forbidden
@endsection

@section('contents')

<div class="p-relative">

    @include('partial.component-loading')

    <div class="bradcaump py-4">
        <div class="container">
            <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-home mr-2" aria-hidden="true"></i>Properties</a>
            <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                    aria-hidden="true"></i></button>
            <button class="btn btn-lg btn-transparent p-3 shadow-0">
                403</button>
        </div>
    </div>
    <div class="container py-4 mt-4">


            @include('partial.error-table', ["title" => "403 You dont have permission to this page", 'icon'=>'fa-padlock'])

    </div>
</div>
@endsection


@section('extra-js')
    <script type="text/javascript" src="{{ asset('front/js/sweetalert.js') }}"></script>
@endsection
