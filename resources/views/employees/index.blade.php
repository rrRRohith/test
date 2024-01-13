@extends('layouts.app')
@section('title', __('Employees'))
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
                        {{ __('Employees') }}
                    </div>
                    <a href="{{ route('employees.create') }}" class="ms-auto btn btn-light">{{ __("New employee") }}</a>
                </div>

                <div class="card-body">
                    @include('_alert')
                    <table id="table" class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Company</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <script src="
        https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="
        https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                serverSide: true,
                ajax: '{!! route('employees.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'company_name', name: 'company_name' },
                    { data: 'actions', name: 'actions', orderable: false, },
                ],
                pageLength: 10,
                responsive: true
            });
        });
    </script>
@endpush