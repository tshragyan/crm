@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <p class="text-success">{{ Session::get('message') }}</p>
    @endif

    <a href="{{route('employee.edit', ['employee' => $employee->id])}}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{route('employee.destroy', ['employee' => $employee->id])}}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>

    <h1>
        Name: {{ $employee->name }}
    </h1>

    <h1>
        Last Name: {{ $employee->name }}
    </h1>
    <h1>
        Email: {{ $employee->email }}
    </h1>
    <h1>
        Phone: {{ $employee->email }}
    </h1>

    <h1>
        Company Name: {{ $employee->company->name }}
    </h1>

    <h1>
        Company Email: {{ $employee->company->email }}
    </h1>

    <h1>
        Company Website: {{ $employee->company->website }}
    </h1>

    <h1>
        Company logo: <img src="{{asset('storage/' . $employee->company->logo)}}" alt="">

    </h1>

@endsection
