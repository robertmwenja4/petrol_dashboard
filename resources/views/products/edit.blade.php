@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Edit Product</h4>
            <a href="{{route('product.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('product.update', $product->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('products.form')
            </form>
        </div>
    </div>
    
</div>
@endsection