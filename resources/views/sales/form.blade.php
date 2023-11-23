<h2 class="text-center">Fuel Sale</h2>

<div class=" row custom-grid px-4 mb-4">

    <div class="card item">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="customer">A/C Customer</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::select('customer_id', $customers, null, ['placeholder' => 'Select Customer...', 'class' => 'select2 form-select']) }}
                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="customer">Sale No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('sale_no', '12345', ['class' => '', 'disabled']) }}
                </div>

            </div>

            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="customer">Customer</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('sale_no', 'Oryx', ['disabled']) }}
                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="customer">Other VRN No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('sale_no', 'VRN-12345', ['disabled']) }}
                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="customer">Other TIN No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('sale_no', 'TIN-123-45', ['disabled']) }}
                </div>

            </div>



        </div>

    </div>


    <div class="card item ">
        <div class="card-body">
            <div class="row">
                <h5 class="mb-3"><u>Lpo details</u> </h5>
            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="lpo_no">LPO No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('lpo_no', null, ['placeholder' => 'LPO Number']) }}
                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="vehicle_no">Vehicle No</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('vehicle_no', null, ['placeholder' => 'Vehicle Number']) }}
                </div>


            </div>

            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="mileage">Current Mileage</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::text('mileage', 0, ['placeholder' => 'Mileage']) }}
                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="driver_name">Driver</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::text('driver_name', null, ['placeholder' => 'Driver Name']) }}
                </div>

            </div>
        </div>


    </div>

    <div class="card item">
        <div class="card-body">
            <div class="row">
                <h5 class="mb-3"><u>Sales details</u> </h5>
            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="product">Product</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::select('customer_id', $customers, null, ['placeholder' => 'Select Product', 'class' => 'select2 form-select']) }}
                </div>


            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="lpo_no">Quantity</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::text('lpo_no', null, ['placeholder' => 'Quantity']) }}
                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="lpo_no">Rate</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::text('lpo_no', 3678, ['disabled']) }}
                </div>

            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="mileage">Total Price</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::text('mileage', null, ['placeholder' => 'Total Price']) }}
                </div>

            </div>
        </div>

    </div>

</div>

<div class="row d-flex justify-content-center">
    <div class="col-auto">
        {{ Form::button('Record Sale', ['class' => 'btn btn-lg btn-success px-5 py-3', 'onclick' => '']) }}
    </div>

</div>
