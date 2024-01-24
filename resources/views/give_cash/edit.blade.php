@extends('layouts.app')

@section('content')

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Edit GiveCash</h4>
            <a href="{{route('give_cash.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('give_cash.update', $give_cash->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('give_cash.edit_form')
            </form>
        </div>
    </div>
    

@endsection