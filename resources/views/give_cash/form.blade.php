<h3 class="text-center mt-2">Give Cash <span>
        <button id="printReceipt" class="btn btn-md btn-primary" aria-label="Mute"><svg aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer"
                viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                <path
                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
            </svg></button></span>
</h3>


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
