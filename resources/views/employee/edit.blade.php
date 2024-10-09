@extends('layouts.app')

@section('content_header')
    Edit Employee {{ $employee->name }}
@endsection

@section('content')
    <div class="container">
        <form action="{{route('employee.update', ['employee' => $employee->id])}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{ $employee->name }}" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('name')}}
                </div>
            @endif
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" value="{{ $employee->last_name }}" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
            </div>
            @if ($errors->has('last_name'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('last_name')}}
                </div>
            @endif

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ $employee->email }}" name="email" class="form-control" id="email" placeholder="Email">
            </div>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('email')}}
                </div>
            @endif

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" value="{{ $employee->phone }}" name="phone" class="form-control" id="phone" placeholder="Phone">
            </div>
            @if ($errors->has('phone'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('phone')}}
                </div>
            @endif

            <div class="form-group">
                <label for="company">Company</label>
                <select name="company_id" id="company">
                    @foreach($companies as $company)
                        <option value="{{$company->id}}"
                            @if($company->id === $employee->company_id)
                                selected="selected"
                            @endif
                        >{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('company_id'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('company_id')}}
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Edit</button>

        </form>
    </div>
@endsection
