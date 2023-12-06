@extends('layouts.app')
@section('extra-css')
    <style>
        .changed-input {
            background-color: #e9ecef !important;
            opacity: 1;
            /* Replace with your desired background color */
        }

        .custom-grid {
            display: grid;
            grid-gap: 15px;
            /* Adjust the gap between columns as needed */
        }

        @media (max-width: 575.98px) {

            /* For extra small screens (up to 575.98px), set a height of 100px */

            .custom-grid .item {
                height: 480px;
                grid-template-columns: repeat(1, 1fr);
            }
        }

        @media (min-width: 576px) and (max-width: 1092.98px) {

            /* For small screens, display 1 columns */
            .custom-grid .item {
                grid-template-columns: repeat(1, 1fr);
                height: 480px;
            }
        }

        @media (min-width: 1193px) {

            /* For medium screens and larger, display three columns */
            .custom-grid {
                grid-template-columns: repeat(3, 1fr);
                height: 350px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid bg-white">
        {{ Form::open(['route' => 'sales.store_sales', 'id' => 'salesForm']) }}

        @include('sales.form')

        {{ Form::close() }}
    </div>
@endsection

@section('extra-scripts')
    <script type="text/javascript">
        config = {
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
        };

        $('.select2').select2();
        // open modal
        $('#recordSaleBtn').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            if (validateForm()) {
                $('#passKeyModal').modal('show');
            } else {
                Swal.fire({
                    position: 'top',
                    title: 'Error!',
                    text: 'Please fill out all required fields.',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }
        });
        $('#printReceipt').on('click', function(e) {
            e.preventDefault();
            var url = "{{ route('print_latest_invoice_receipt') }}";
            window.open(url, "Receipt", "width=500,height=600");
        })
        $(document).keydown(function(event) {
            // Check if the key pressed is 'B' and the Ctrl key is pressed
            if (event.ctrlKey && event.key === 'b') {
                // Perform your desired function here
                var url = "{{ route('print_latest_invoice_receipt') }}";
                window.open(url, "Receipt", "width=500,height=600");
            }
        });
        //validate form before opening modal
        function validateForm() {
            var customerSelect = $('#customerSelect');
            var lpoNumber = $('#lpoNumber');
            var vehicleNumber = $('#vehicleNumber');
            var driverName = $('#driverName');
            var productSelect = $('#productSelect');
            var quantityInput = $('#quantityInput');
            var productPriceInput = $('#productPriceInput');
            var totalPriceInput = $('#totalPriceInput');

            // Perform your validation logic here
            if (
                customerSelect.val().trim() === '' ||
                lpoNumber.val().trim() === '' ||
                vehicleNumber.val().trim() === '' ||
                driverName.val().trim() === '' ||
                productSelect.val().trim() === '' ||
                quantityInput.val().trim() === '' ||
                productPriceInput.val().trim() === '' ||
                totalPriceInput.val().trim() === ''
            ) {
                return false; // Validation failed
            }

            return true; // Validation passed
        }
        //fetch product details on product selected
        $('#productSelect').change(function() {
            var productId = $(this).val();

            // Assuming you have an endpoint to fetch product details based on the ID
            $.ajax({
                url: '/sale/get-product/' + productId, // Replace with your actual endpoint
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the price field with the fetched product price
                    $('#productPriceInput').val(data.data.price);
                    $('#rate').val(data.data.price);
                    updateTotalPrice();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
        //fetch customer details on customer selected
        $('#customerSelect').change(function() {
            var customerId = $(this).val();

            // Assuming you have an endpoint to fetch product details based on the ID
            $.ajax({
                url: '/sale/get-customer/' + customerId, // Replace with your actual endpoint
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the price field with the fetched product price
                    $('#customerName').val(data.data.company);
                    $('#customerVrn').val(data.data.vrn);
                    $('#customerTin').val(data.data.tin);

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
        });
        //on change type(cash quantity)
        $('input[name="input_type"]').change(function() {
            var selectedOption = $(this).val();

            if (selectedOption === 'quantity') {
                $('#quantityInput').prop('readonly', false);
                $('#quantityInput').removeClass('changed-input');

                $('#totalPriceInput').prop('readonly', true);
                $('#totalPriceInput').addClass('changed-input');



                $('#totalPriceInput').val('');
                $('#quantityInput').val('');

            } else {
                $('#quantityInput').prop('readonly', true);
                $('#quantityInput').addClass('changed-input');

                $('#totalPriceInput').prop('readonly', false);
                $('#totalPriceInput').removeClass('changed-input');

                $('#totalPriceInput').val('');
                $('#quantityInput').val('');
            }

        });
        //on input change
        $('#quantityInput, #totalPriceInput').on('input', function() {
            updateTotalPrice();
        });
        //calculate quantity / cash
        function updateTotalPrice() {
            var paymentType = $('input[name="input_type"]:checked').val();

            var quantityInput = $('#quantityInput');
            var rateInput = $('#productPriceInput');
            var totalPriceInput = $('#totalPriceInput');

            // var qty = $('#qty');
            // var totalPrice = $('#total_price');

            var quantity = parseFloat(quantityInput.val()) || 0;
            var rate = parseFloat(rateInput.val()) || 0;

            if (paymentType === 'quantity') {
                var totalPriceCal = quantity * rate;
                totalPriceInput.val(totalPriceCal.toFixed(8));
                $('#total_price').val(totalPriceCal.toFixed(8));
            } else if (paymentType === 'cash') {
                var prodQuantity = parseFloat(totalPriceInput.val()) / rate;
                quantityInput.val(prodQuantity.toFixed(8));
                $('#qty').val(prodQuantity.toFixed(8));
            }
        }

        $('#salesForm').on('submit', function(e) {

            e.preventDefault();

            var data = $(this).serialize();
            // $("#spinner").show();
            $("#modalButton").hide();
            $.ajax({
                method: "post",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result.success == true) {

                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                        setTimeout(function() {
                            var url = "{{ route('print_invoice') }}?id=" + result.data.id;
                            window.open(url, "Receipt", "width=500,height=600");
                            location.reload();
                        }, 1500);

                    } else {
                        $("#modalButton").show();
                        // $("#spinner").hide();


                        Swal.fire({
                            position: 'top',
                            title: 'Error!',
                            text: result.msg,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });

                    }
                }
            });





            // newUserSidebar.modal('hide');

        });
    </script>
@endsection
