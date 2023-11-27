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
            <h4>Create Close Shift</h4>
            <a href="{{route('close_shift.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('close_shift.store')}}" method="POST">
                @csrf
                @include('close_shifts.form')
            </form>
        </div>
    </div>
    
</div>
@endsection
@section('extra-scripts')
<script>
    const config = {
        ajaxSetup: {headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}},
        // date: {format: "{{ config('core.user_date_format')}}", autoHide: true},
        select2: {allowClear: true},
        fetchShiftItems: (shift_id) => {
            return $.ajax({
                url: "{{ route('shifts.goods') }}",
                type: 'POST',
                quietMillis: 50,
                data: {shift_id},
            });
        }
    };

    const Form = {

        init() {
            // $('.datepicker').datepicker(config.date).datepicker('setDate', new Date());
            //$('#supplier').select2(config.select2);
            $.ajaxSetup(config.ajaxSetup);
            $('#shift').select2(config.select2);
            $('#shift').change(this.shiftChange);
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
        },
    

        shiftChange() {
            const el = $(this);
            $('#closeshiftTbl tbody').html('');
            if (!el.val()) return;
            config.fetchShiftItems(el.val()).done(data => {
                data.forEach((v,i) => {
                    // console.log(v);
                    $('#closeshiftTbl tbody').append(Form.productRow(v,i));
                });
            });
            
        },

        productRow(v,i) {
            return `
                <tr>
                    <td>${v.user_name}</td>    
                    <td>${v.pump_name}</td>    
                    <td>${v.code}</td>    
                    <td>${v.product_name}</td>    
                    <td width="30%"><input name="open_stock[]" id="open_stock" class="form-control open_stock" value="${v.opening_stock}" readonly></td> 
                    <td width="30%"><input name="current_stock[]" id="current_stock" class="form-control current_stock" ></td>
                    <td width="30%"><input name="balance[]" id="balance" class="form-control balance" readonly></td>
                    <td width="30%"><input name="amount[]" id="amount" class="form-control amount" readonly></td>
                    <input type="hidden" name="product_id[]" id="product_id" value="${v.product_id}">
                    <input type="hidden" name="product_price[]" class="product_price" id="product_price" value="${v.product_price}">
                    <input type="hidden" name="category[]" class="category" id="category" value="${v.category}">
                    <input type="hidden" name="pump_id[]" id="pump_id" value="${v.pump_id}">
                    <input type="hidden" name="user_id[]" id="user_id" value="${v.user_id}">
                    <input type="hidden" name="nozzle_id[]" id="nozzle_id" value="${v.id}">
                </tr>
            `;
        }
       
    }

    $(() => Form.init());
</script>
@endsection