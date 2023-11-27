@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-header row">
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
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Create customer</h4>
            <a href="{{route('customer.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('customer.store')}}" method="POST">
                @csrf
                @include('customers.form')
            </form>
        </div>
    </div>
    
</div>
@endsection
