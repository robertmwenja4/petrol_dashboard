@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View shift</h4>
            <a href="{{route('shift.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Shift Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $shift['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Start Time</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $shift['start_time'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    End Time</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $shift['end_time'] }}</div>
            </div>
            
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection