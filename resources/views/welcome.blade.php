@extends('layouts.app')
@section('title', __("Welcome"))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>{{ __("Welcome") }}</h1>
            @if (Route::has('login'))
                @auth
                <a href="{{ route('home') }}" class="btn btn-primary">{{ __("Go to your dashboard") }}</a>  
                @else
                <a href="{{ route('login') }}" class="btn btn-primary">{{ __("Login to your account") }}</a>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
