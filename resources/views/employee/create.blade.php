@extends('layouts.app')

@section('content_header')
    Create Employee
@endsection

@section('content')
    <div class="container">
        <form action="{{route('employee.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('name')}}
                </div>
            @endif

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
            </div>
            @if ($errors->has('last_name'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('last_name')}}
                </div>
            @endif

            <div class="form-group">
                <label for="company_id">Company</label>
                <select name="company_id" id=="company_id">
                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('company_id'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('company_id')}}
                </div>
            @endif

            <div class="form-group">
                <label for="last_name">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email" placeholder="Email">
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('email')}}
                </div>
            @endif
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" value="{{ old('phone') }}" name="phone" class="form-control" id="phone" placeholder="Phone">
            </div>
            @if ($errors->has('phone'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('phone')}}
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
