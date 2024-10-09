@extends('layouts.app')
@section('content')
    @if(Session::has('message'))
        <p class="text-success">{{ Session::get('message') }}</p>
    @endif

    <div class="container">
        <h1>Employees</h1>
        <a href="{{ route('employee.create') }}">Create Employee</a>
        <table id="companies-table" class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#companies-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('employee.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

    </script>
@endsection
