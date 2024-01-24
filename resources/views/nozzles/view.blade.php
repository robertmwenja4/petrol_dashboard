@extends('layouts.app')

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View nozzle</h4>
            <a href="{{route('nozzle.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Nozzle Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $nozzle['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Code</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $nozzle['code'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Pump Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $nozzle->pump['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Product</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $nozzle->product['name'] }}</div>
            </div>
            
        </div>
    </div>
    
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection