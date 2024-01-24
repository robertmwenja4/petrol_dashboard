@extends('layouts.app')

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>Edit Sale</h4>
            <a href="{{route('sale.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <form action="{{route('sale.update', $sale->id)}}" method="POST">
                @csrf
                @method("PATCH")
                @include('sales.edit_form')
            </form>
        </div>
    </div>
    
@endsection
@section('extra-scripts')
    <script>
        const config = {};
        const Form = {
            init(){
                $('#customer').change(this.customerChange);
                $('#product').change(this.productChange);
                $('#type').change(this.onTypeChange);
                $('.filter').on('keyup','#quantity, #price', this.qtyPriceChange);
            },
            customerChange(){
                const customerId = $(this).val();
                $.ajax({
                url: '/sale/get-customer/' + customerId, // Replace with your actual endpoint
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the price field with the fetched product price
                    // $('#customerName').val(data.data.company);
                    $('#vrn_no').val(data.data.vrn);
                    $('#tin_no').val(data.data.tin);

                    if (data.data.customer_type == 'cash') {
                        $('#lpoNumber').prop('required', false);
                        $('#driverName').prop('required', false);
                        $('#vehicleNumber').prop('required', false);
                    } else {
                        $('#lpoNumber').prop('required', true);
                        $('#driverName').prop('required', true);
                        $('#vehicleNumber').prop('required', true);
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
            },
            productChange(){
                var productId = $(this).val();

                // Assuming you have an endpoint to fetch product details based on the ID
                $.ajax({
                    url: '/sale/get-product/' + productId, // Replace with your actual endpoint
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Update the price field with the fetched product price
                        // $('#productPriceInput').val(data.data.price);
                        $('#rate').val(data.data.price);
                        Form.updatePrice();
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            },
            updatePrice(){
                let rate = $('#rate').val();
                let quantity = $('#quantity').val();
                let total_price = quantity*rate;
                $('#price').val(total_price);
            },
            onTypeChange(){
                const type_val = $('#type').val();
                if(type_val == 'cash'){
                    $('#price').prop('readonly', false);
                    $('#quantity').prop('readonly', true);

                }else{
                    $('#quantity').prop('readonly', false);
                    $('#price').prop('readonly', true);
                }
            },
            qtyPriceChange(){
                let qty = $('#quantity').val();
                let total_price = $('#price').val();
                let rate = $('#rate').val();
                const type_val = $('#type').val();
                let quantity = 0;
                let price = 0;
                if(type_val == 'cash'){
                    quantity = total_price/rate;
                    $('#quantity').val(quantity);
                }else if(type_val == 'quantity'){
                    price = qty*rate;
                    $('#price').val(price);
                }
            }
        };
        $(()=>Form.init());
    </script>
@endsection