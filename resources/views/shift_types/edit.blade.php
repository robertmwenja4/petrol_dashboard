@extends('layouts.app')

@section('content')

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            @if(session('flash_success'))
            <div class="alert bg-success alert-dismissible m-1" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success!</strong> {!!session('flash_success')!!}
            </div>
            @endif
            @if(session('flash_error'))
            <div class="alert bg-danger alert-dismissible m-1" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Error!</strong> {!!session('flash_error')!!}
            </div>
            @endif
            <h4>Edit StockAdjustment</h4>
            <a href="{{route('shift_type.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('shift_type.update', $shift_type->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('shift_types.form')
            </form>
        </div>
    </div>
    
@endsection
@section('extra-scripts')
    <script>
       
    </script>
@endsection