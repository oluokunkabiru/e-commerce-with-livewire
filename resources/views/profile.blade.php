@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('contents')

    <div>
        <div class="bradcaump py-4">
            <div class="container">
                <a href="{{ route('shop') }}" class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i
                        class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>shop</a>
                <button class="btn btn-lg btn-transparent mr--6 p-3 shadow-0"><i class="fa fa-chevron-right"
                        aria-hidden="true"></i></button>
                <button class="btn btn-lg btn-transparent p-3 shadow-0">
                    Profile</button>
            </div>
        </div>
        <div class="container py-4 mt-4">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h4 class="bg-light p-4 text-center text-uppercase mb-4 shadow-5 rounded">User information</h4>

                    @livewire('child.update-profile')

                </div>
                <div class="col-md-6 col-sm-12">
                    <h4 class="bg-light p-4 text-center text-uppercase mb-4 shadow-5 rounded">Change password</h4>

                    @livewire('child.change-password')

                </div>
            </div>
        </div>
    </div>

@endsection
