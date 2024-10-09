@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <p class="text-success">{{ Session::get('message') }}</p>
    @endif

    <a href="{{route('company.edit', ['company' => $company->id])}}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{route('company.destroy', ['company' => $company->id])}}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>

    <h1>
        Name: {{ $company->name }}
    </h1>
    <h1>
        Email: {{ $company->email }}
    </h1>
    <h1>
        Website: {{ $company->website }}
    </h1>
    <img src="{{asset('storage/' . $company->logo)}}" alt="">

@endsection
