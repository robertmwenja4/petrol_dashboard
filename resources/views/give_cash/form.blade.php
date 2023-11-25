<h3 class="text-center mt-2">Give Cash</h3>

<div class="row justify-content-center px-5 mt-3">

    <div class="card col-md-6 col-xs-12">
        <div class="card-body">
            <div class="row">
                <h5 class="mb-3"><u>Cash details</u> </h5>
                {{ Form::hidden('shift_id', $shift->id) }}
            </div>
            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="product">Pump</label>
                <div class="col-md-9 col-sm-12">
                    {{ Form::select('pump_id', $pumps, null, ['placeholder' => 'Select Pump', 'class' => 'form-control form-select select2 ', 'required', 'id' => 'pumpSelect']) }}
                </div>


            </div>

            <div class="row align-items-center mb-3">
                <label class="col-md-3 col-sm-12" for="">Amount</label>
                <div class="col-md-9 col-sm-12">

                    {{ Form::number('amount', null, ['placeholder' => 'Total Amount', 'id' => 'cashAmount', 'required', 'step' => 'any', 'class' => 'form-control']) }}

                </div>

            </div>
        </div>

    </div>

</div>
@include('sales.passkey_modal')
<div class="row justify-content-center mt-3">
    <div class="col-auto">
        {{ Form::button('Give Cash', ['class' => 'btn btn-lg btn-success px-5 py-2', 'id' => 'giveCashBtn']) }}
    </div>

</div>
