@extends('layouts.app')

@section('content')

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Edit</h4>
            <a href="{{route('user_allocation.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('user_allocation.update', $user_allocation->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('user_allocations.form')
            </form>
        </div>
    </div>
    

@endsection