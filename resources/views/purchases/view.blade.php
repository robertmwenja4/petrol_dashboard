@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View Purchase</h4>
            <a href="{{route('purchase.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Product</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ @$purchase->product['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Invoice No.</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $purchase['invoice_no'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Quantity</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $purchase['qty'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Cost</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ number_format($purchase->cost, '3') }}</div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection