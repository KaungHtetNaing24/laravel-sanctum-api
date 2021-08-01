@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard three') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div>
                <ul>
                    <li>Name: {{ Auth::user()->name }}</li>
                    <li>Email: {{ Auth::user()->email }}</li>
                    <li>
                        Roles:
                        @foreach(Auth::user()->roles as $role)
                        <span class="badge badge-primary">{{ $role->name }}</span>
                        @endforeach
                    </li>
                </ul>
                </div>
                <hr>

                @foreach(Auth::user()->roles as $role)
                @if($role->name == 'Manager')
                <a href="{{ url('admin/managers') }}" class="btn btn-primary">Dashboard One</a>
                @endif
                @if($role->name == 'Staff')
                <a href="{{ url('admin/staffs') }}" class="btn btn-primary">Dashboard Two</a>
                @endif
                @if($role->name == 'User')
                <a href="{{ url('admin/normal_users') }}" class="btn btn-primary">Dashboard Three</a>
                @endif
           @endforeach
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
