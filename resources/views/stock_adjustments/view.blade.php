@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View StockAdjustment</h4>
            <a href="{{route('stock_adjustment.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Product</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ @$stock_adjustment->product['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Previous Quantity</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $stock_adjustment['previous_qty'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Current Quantity</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $stock_adjustment['current_qty'] }}</div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection