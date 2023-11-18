@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Create Customer</h4>
            <a href="{{route('customer.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('customer.update', $customer->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('customers.form')
            </form>
        </div>
    </div>
    
</div>
@endsection