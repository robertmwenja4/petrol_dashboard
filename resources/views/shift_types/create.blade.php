@extends('layouts.app')

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Create Shift Type</h4>
            <a href="{{route('shift_type.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('shift_type.store')}}" method="POST">
                @csrf
                @include('shift_types.form')
            </form>
        </div>
    </div>
    
@endsection
@section('extra-scripts')
    <script>
       
    </script>
@endsection