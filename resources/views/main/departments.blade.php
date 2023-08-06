@extends('layouts.app')

@section('title')
Departments | HRM System
@endsection

@section('head')
<link href="{{ asset('assets/css/departments-page.css') }}" rel="stylesheet">
@endsection

@section('heading')
Departments
@endsection

@section('main-content')
<p class="mb-4">All the departments are listed below.</p>

<!-- Departments DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Departments List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Department Name</th>
                        <th>Sections</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_departments_url = {!!json_encode(config('constants.GET_DEPARTMENTS_ENDPOINT')) !!};
</script>
<script src="{{ asset('assets/js/departments.js') }}"></script>

@endsection