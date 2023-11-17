@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View User</h4>
            <a href="{{route('user.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $user['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Email</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $user['email'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Code</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $user['code'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Status</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $user['status'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Role</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ @$user->role['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Contact</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $user['phone_number'] }}</div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection