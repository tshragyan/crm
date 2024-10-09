@extends('layouts.app')

@section('content_header')
    Edit Company {{ $company->name }}
@endsection

@section('content')
    <div class="container">
        <form action="{{route('company.update', ['company' => $company->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{ $company->name }}" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('name')}}
                </div>
            @endif

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ $company->email }}" name="email" class="form-control" id="email" placeholder="Email">
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('email')}}
                </div>
            @endif
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" value="{{ $company->website }}" name="website" class="form-control" id="website" placeholder="Website">
            </div>
            @if ($errors->has('website'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('website')}}
                </div>
            @endif
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" name="logo" class="form-control" id="logo">
            </div>
            @if ($errors->has('logo'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('logo')}}
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Edit</button>

        </form>
    </div>
@endsection
