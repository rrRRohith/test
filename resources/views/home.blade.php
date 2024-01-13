@extends('layouts.app')
@section('title', __('Your dashboard'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card bg-white border-0 shadow-sm">
                <div class="card-header border-0 bg-primary">
                    <div class="fw-bold fs-5 text-white">
                        {{ __('Dashboard') }}
                    </div>
                </div>

                <div class="card-body">
                    {{ __("Hello") }} {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
