@extends('layouts.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View customer</h4>
            <a href="{{route('customer.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Customer Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $customer['company'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Contact</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $customer['phone_number'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Address</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $customer['address'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    VRN Number</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $customer['vrn'] }}</div>
            </div>

            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    TIN Number</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $customer['tin'] }}</div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection