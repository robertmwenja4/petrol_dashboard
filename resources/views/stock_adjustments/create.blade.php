@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Create StockAdjustment</h4>
            <a href="{{route('stock_adjustment.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('stock_adjustment.store')}}" method="POST">
                @csrf
                @include('stock_adjustments.form')
            </form>
        </div>
    </div>
    
</div>
@endsection
@section('extra-scripts')
    <script>
        $('#product').change(function () { 
            const product_id = $(this).val();
            $.ajax({
                method: "GET",
                url: "stock_adjust/"+product_id,
                success: function (response) {
                    console.log(response);
                    $('#previous_qty').val(response.readings);
                }
            });
            
        });
    </script>
@endsection