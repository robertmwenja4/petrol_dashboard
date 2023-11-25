@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Edit Sale</h4>
            <a href="{{route('sale.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('sale.update', $sale->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('sale.edit_form')
            </form>
        </div>
    </div>
    
</div>
@endsection