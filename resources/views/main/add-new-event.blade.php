@extends('layouts.app')

@section('title')
Add New Event | HRM System
@endsection

@section('heading')
Add New Event
@endsection

@section('head')
<style>
    .form {
        margin: 0 auto;
        max-width: 500px;
    }

    .redError {
        color: red;
    }

    .hiddenDiv {
        display: none;
    }

    .text-green {
        color: green;
    }

    #apiValidationErrorMessage {
        text-align: center;
    }
</style>
@endsection

@section('main-content')
<p class="mb-4">Here you can add a new event.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Event Form</h6>
    </div>
    <div class="card-body">
        <form class="form" id="add-event-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control input-field" id="title" required></input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Event Type</label>
                        <select class="form-control input-field" id="eventTypeId" required></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>From Date</label>
                        <input type="datetime-local" class="form-control input-field" id="fromDateTime" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>To Date</label>
                        <input type="datetime-local" class="form-control input-field" id="toDateTime" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Manager</label>
                        <select class="form-control input-field" id="managerId" required></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" id="add-event-btn" class="btn btn-primary btn-block">Add Event</button>
                </div>
            </div>
            <br>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Page level custom scripts -->
<script>
    const get_event_types_endpoint = {!!json_encode(config('constants.GET_EVENT_TYPES_ENDPOINT'))!!};
    const get_users_endpoint = {!!json_encode(config('constants.GET_USERS_ENDPOINT'))!!};
    const add_event_endpoint = {!!json_encode(config('constants.ADD_EVENT_ENDPOINT'))!!};
</script>
<script src="{{ asset('assets/js/admin/add-event.js') }}"></script>
<script src="{{ asset('assets/js/side-notification.js') }}"></script>
@endsection