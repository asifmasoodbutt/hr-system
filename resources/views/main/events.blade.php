@extends('layouts.app')

@section('title')
Events | HRM System
@endsection

@section('head')
<style>
    .status-active {
        background-color: #90EE90;
        color: black;
        border-radius: 5px;
    }

    .status-inactive {
        background-color: #FF474C;
        color: black;
        border-radius: 5px;
    }

    .font-size-14 {
        font-size: 14px;
    }
</style>
@endsection

@section('heading')
Events
@endsection

@section('main-content')
<div class="d-flex justify-content-between align-items-center">
    <p class="mb-4">All the events are listed below.</p>
    <a href="#" class="btn btn-primary btn-icon-split reg-employee-btn">
        <span class="icon"><i class="fas fa-calendar-plus"></i></span>
        <span class="text">Add New Event</span>
    </a>
</div>

<!-- Events DataTale -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Events List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>From Time</th>
                        <th>To Time</th>
                        <th>Manager</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-end mt-3" id="pagination-links">
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- Page level custom scripts -->
<script>
    const get_events_url = {!!json_encode(config('constants.GET_EVENTS_ENDPOINT'))!!};
</script>
<script src="{{ asset('assets/js/admin/events.js') }}"></script>
<script src="{{ asset('assets/js/side-notification.js') }}"></script>

@endsection