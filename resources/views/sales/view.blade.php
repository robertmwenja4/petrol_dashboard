@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View Sale</h4>
            <a href="{{route('sale.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Delivery Note No.</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ gen4tid('DN-',$sale->tid) }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Sale Type</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $sale['type'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Customer</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ @$sale->customer['company'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    LPO No.</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $sale['lpo_no'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Sold By</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ @$sale->user['name'] }}</div>
            </div>

            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Quantity</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $sale['qty'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Rate</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $sale['rate'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Total Price</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $sale['total_price'] }}</div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection