@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Create Shift</h4>
            <a href="{{route('shift.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-6">
                    <label for="shift_name">Shift Name</label>
                    <input type="text" name="name" id="shift_name" placeholder="Day Shift" class="form-control">
                </div>
            </div>
            
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection