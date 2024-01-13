@php
    $title = isset($employee) ? 'Update employee' : 'Create employee';
@endphp
@extends('layouts.app')
@section('title', __($title))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card bg-white border-0 shadow-sm">
                    <div class="card-header border-0 bg-primary d-flex align-items-center">
                        <div class="fw-bold fs-5 text-white">
                            {{ __($title) }}
                        </div>
                        <a href="{{ route('employees.index') }}" class="ms-auto btn btn-light">{{ __("Back to employees") }}</a>
                    </div>

                    <div class="card-body">
                        @include('_alert')
                        <form
                            @isset($employee)
                                action="{{ route('employees.update', ['employee' => $employee]) }}"
                            @else
                                action="{{ route('employees.store') }}"
                            @endif method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($employee)
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First name') }}</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control shadow-none @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name', $employee->first_name ?? null) }}" required autocomplete="first_name" autofocus>
                                    <x-input-error field="first_name" />
                            </div>
                        </div>
                            <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text"
                                    class="form-control shadow-none @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name', $employee->last_name ?? null) }}" required autocomplete="last_name" autofocus>
                                    <x-input-error field="last_name" />
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control shadow-none @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $employee->email ?? null) }}" autocomplete="email">
                                <x-input-error field="email" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                        <div class="col-md-6">
                            <input id="phone" type="text"
                                class="form-control shadow-none @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone', $employee->phone ?? null) }}" autocomplete="phone">
                                <x-input-error field="phone" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="company_id" class="col-md-4 col-form-label text-md-end">{{ __('Company') }}</label>
                        <div class="col-md-6">
                            @if ($companies->count())
                            <select id="company_id" type="text"
                                class="form-select shadow-none @error('company_id') is-invalid @enderror" name="company_id" autocomplete="company_id">
                                <option value="">{{ __("Select a company") }}</option>
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}" @selected(old('company_id', $employee->company_id ?? null) == $company->id)>{{ $company->name }}</option>
                            @endforeach
                            </select>
                            <x-input-error field="company_id" />
                            @else
                                <x-alert type="warning" message="No companies found." />
                            @endif
                            </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __($title) }}
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
