@extends('layouts.app')

@section('content')

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Edit Shift</h4>
            <a href="{{route('shift.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('shift.update', $shift->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('shifts.edit_form')
            </form>
        </div>
    </div>
    

@endsection

@section('extra-scripts')
<script type="text/javascript">
    config = {
        ajax: {headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}}
    };

    const Form = {

        init() {
            $.ajaxSetup(config.ajax);
            // $('#user_id').select2();
        
            
            
        },
        
       
    };

    $(() => Form.init());
</script>
@endsection