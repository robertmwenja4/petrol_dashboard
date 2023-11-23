<h3 class="text-center mt-2">Fuel Sale</h3>

<div class=" row custom-grid px-4">

    <div class="card item bg-white ">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="customer_id">A/C Customer</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::select('customer_id', $customers, null, ['placeholder' => 'Select Customer...', 'class' => 'select2 form-select', 'id' => 'customerSelect', 'required']) }}
                </div>

            </div>
            {{-- <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="sale_no">Sale No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('sale_no', '12345', ['disabled']) }}
                </div>

            </div> --}}

            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="customer">Customer</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('customer_name', null, ['readonly', 'class' => 'form-control', 'id' => 'customerName']) }}
                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="vrn_no">Other VRN No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('vrn_no', null, ['readonly', 'class' => 'form-control', 'id' => 'customerVrn']) }}
                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="tin_no">Other TIN No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('tin_no', null, ['readonly', 'class' => 'form-control', 'id' => 'customerTin']) }}
                </div>

            </div>



        </div>

    </div>


    <div class="card item bg-white">

        <div class="card-body">
            <div class="row">
                <h5 class="mb-3"><u>Lpo details</u> </h5>
            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="lpo_no">LPO No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('lpo_no', null, ['placeholder' => 'LPO Number', 'class' => 'form-control', 'required', 'id' => 'lpoNumber']) }}
                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="vehicle_no">Vehicle No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('vehicle_no', null, ['placeholder' => 'Vehicle Number', 'class' => 'form-control', 'required', 'id' => 'vehicleNumber']) }}
                </div>


            </div>

            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="mileage">Current Mileage</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::number('mileage', 0, ['placeholder' => 'Mileage', 'class' => 'form-control']) }}
                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="driver_name">Driver</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::text('driver', null, ['placeholder' => 'Driver Name', 'class' => 'form-control', 'required', 'id' => 'driverName']) }}
                </div>

            </div>
        </div>


    </div>

    <div class="card item bg-white">
        <div class="card-body">
            <div class="row">
                <h5 class="mb-3"><u>Sales details</u> </h5>
            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="product">Pump</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::select('pump_id', $pumps, null, ['placeholder' => 'Select Pump', 'class' => 'select2 form-select', 'required']) }}
                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="product">Product</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::select('product_id', $products, null, ['placeholder' => 'Select Product', 'class' => 'select2 form-select', 'id' => 'productSelect', 'required']) }}
                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="product">Select Input</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::radio('input_type', 'cash', null, ['style' => 'transform: scale(1.3);', 'required']) }}
                    {{ Form::label('cash', 'Cash') }}

                    {{ Form::radio('input_type', 'quantity', null, ['style' => 'transform: scale(1.3);', 'required']) }}
                    {{ Form::label('quantity', 'Quantity') }}


                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="lpo_no">Quantity</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::number('qty', null, ['readonly', 'placeholder' => 'Quantity', 'id' => 'quantityInput', 'required', 'step' => 'any', 'class' => 'form-control changed-input']) }}

                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="lpo_no">Rate</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::number('rate', '0.0000', ['readonly', 'id' => 'productPriceInput', 'step' => 'any', 'class' => 'form-control changed-input']) }}

                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="">Total Price</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::number('total_price', null, ['readonly', 'placeholder' => 'Total Price', 'id' => 'totalPriceInput', 'required', 'step' => 'any', 'class' => 'form-control changed-input']) }}

                </div>

            </div>
        </div>

    </div>

</div>

<div class="row justify-content-center mt-5">
    <div class="col-auto">
        {{ Form::submit('Record Sale', ['class' => 'btn btn-lg btn-success px-5 py-3']) }}
    </div>

</div>
