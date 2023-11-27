@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View product</h4>
            <a href="{{route('product.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Product Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $product['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Code</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $product['code'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Description</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $product['description'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Price per Litre</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ number_format($product->price, '3') }}</div>
            </div>

            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Product Category</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $product['category'] }}</div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection