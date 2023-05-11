@extends('layouts.app')

@section('title')
Departments | HRM System
@endsection

@section('heading')
Departments
@endsection

@section('main-content')
<p class="mb-4">All the departments are listed below.</p>

<!-- DataTales Example -->
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

<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
<script>
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const tableBody = document.querySelector('#data-table tbody');
                    data.data.forEach((item) => {
                        const row = `<tr><td>${item.id}</td><td>${item.name}</td><td>section</td></tr>`;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                } catch (error) {
                    console.error(error);
                }
            } else {
                console.error(`Request failed with status ${this.status}`);
            }
        }
    };
    xhttp.open('GET', @json(config('constants.GET_DEPARTMENTS_ENDPOINT')), true);
    const token = localStorage.getItem('token');
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
</script>

@endsection