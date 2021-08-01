@extends('back.master')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard Two</h1>
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
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                
                <button class="btn btn-danger float-right">Logout</button>
            </form>
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


@endsection