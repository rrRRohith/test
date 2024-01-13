@php
    $title = isset($company) ? 'Update company' : 'Create company';
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
                        <a href="{{ route('companies.index') }}"
                            class="ms-auto btn btn-light">{{ __('Back to companies') }}</a>
                    </div>

                    <div class="card-body">
                        @include('_alert')
                        <form
                            @isset($company)
                                action="{{ route('companies.update', ['company' => $company]) }}"
                            @else
                                action="{{ route('companies.store') }}"
                            @endif method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($company)
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control shadow-none @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', $company->name ?? null) }}" required autocomplete="name"
                                    autofocus>
                                <x-input-error field="name" />
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control shadow-none @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $company->email ?? null) }}" autocomplete="email">
                            <x-input-error field="email" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="website" class="col-md-4 col-form-label text-md-end">{{ __('Website') }}</label>
                        <div class="col-md-6">
                            <input id="website" type="text"
                                class="form-control shadow-none @error('website') is-invalid @enderror" name="website"
                                value="{{ old('website', $company->website ?? null) }}" autocomplete="website">
                            <x-input-error field="website" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Logo') }}</label>
                        <div class="col-md-6">
                            <div class="border text-center border-dotted border-2 rounded p-3">
                                <div class="image logo-img mb-3">
                                    <label for="logo" role="button">
                                        <img class="rounded w-100 company-logo"
                                            src="{{ asset('storage/images/' . ($company->logo ?? 'default.png')) }}"
                                            alt="Logo">
                                    </label>
                                </div>
                                <input id="logo" type="file" accept="image/*"
                                    class="form-control shadow-none @error('logo') is-invalid @enderror" name="logo"
                                    autocomplete="logo">
                                <x-input-error field="logo" />
                            </div>
                            <div class="small">{{ __('Allowed jepg, jpg, png, webp. (Min 100x100px)') }}</div>
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("change", "#logo", function() {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return;
                if (/^image/.test(files[0].type)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function() {
                        $('.company-logo').attr('src', this.result);
                    }
                }
            });
        });
    </script>
@endpush
