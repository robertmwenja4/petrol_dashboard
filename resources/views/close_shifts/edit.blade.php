@extends('layouts.app')

@section('content')

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
            <h4>Edit Close Shift</h4>
            <a href="{{route('close_shift.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('close_shift.update', $close_shift->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('close_shifts.form')
            </form>
        </div>
    </div>
    

@endsection

@section('extra-scripts')
<script>
    const config = {
        ajaxSetup: {headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}},
        // date: {format: "{{ config('core.user_date_format')}}", autoHide: true},
    };

    const Form = {

        init() {
            // $('.datepicker').datepicker(config.date).datepicker('setDate', new Date());
            //$('#supplier').select2(config.select2);
            $.ajaxSetup(config.ajaxSetup);
            $('#shift').prop('disabled', true);
            // $('#shift').change(this.shiftChange);
            $('#closeshiftTbl').on('change', '.current_stock', this.stockChange);
        },

        stockChange(){
            const el = $(this);
            const row = el.parents('tr:first');
            const current_stock = row.find('.current_stock').val();
            const open_stock = row.find('.open_stock').val();
            const product_price = row.find('.product_price').val();

            //difference
            let balance = current_stock-open_stock;
            let amount = balance*product_price;
            row.find('.balance').val(balance);
            row.find('.amount').val(amount);
        }
       
    }

    $(() => Form.init());
</script>
@endsection