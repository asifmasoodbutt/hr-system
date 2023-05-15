@extends('layouts.app')

@section('title')
Employee | HRM System
@endsection

@section('heading')
Employee
@endsection

@section('main-content')

@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_employees_url = {!!json_encode(config('constants.GET_EMPLOYEES_ENDPOINT')) !!};
    const employee_details_url = {!!json_encode(config('constants.GET_EMPLOYEES_ENDPOINT')) !!};
</script>

@endsection