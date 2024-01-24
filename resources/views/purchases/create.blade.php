@extends('layouts.app')

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Create Purchase</h4>
            <a href="{{route('purchase.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('purchase.store')}}" method="POST">
                @csrf
                @include('purchases.form')
            </form>
        </div>
    </div>
    
@endsection
