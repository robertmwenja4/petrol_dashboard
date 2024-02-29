<div class="form-group row">
    <div class="col-3">
        <label for="shift_name">Shift Name</label>
        <input type="text" name="shift_name" value="{{ @$date }}" id="shift_name" placeholder=""
            class="form-control" disabled>

        <input type="text" name="shift_name" value="{{ @$date }}" id="shift_name" placeholder=""
            class="form-control" hidden>

    </div>
    <div class="col-3">
        <label for="shift_type_id">Shift Time</label>
        {{-- @dd($date) --}}
        {{-- {{ Form::select('shift_time', $times, null, ['placeholder' => 'Select Time', 'class' => 'select2 form-select', 'required']) }} --}}
        <select class="form-control " name="shift_type_id" id="timeSelect" required>
            <option value="">SELECT TIME</option>
            @foreach ($times as $time)
                <option value="{{ $time->id }}">{{ $time->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@include('sales.passkey_modal')
<div class="row col-2 mt-4">
    <button id="createShiftBtn" type="button" class="btn btn-primary btn-lg mx-2">Create</button>
</div>
