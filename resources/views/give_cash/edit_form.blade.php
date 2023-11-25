<div class="form-group row">
    <div class="col-4">
        <label for="give_cash_name">Reference No.</label>
        <input type="text" value="{{gen4tid('RC-',$give_cash->tid)}}" id="give_cash_name" placeholder="eg. ORYX" disabled class="form-control">
    </div>
    <div class="col-4">
        <label for="pump">Pump</label>
        <select name="pump_id" id="pump" class="select2 form-select">
            @foreach ($pumps as $pump)
                <option value="{{$pump->id}}" {{$pump->id == $give_cash->pump_id ? 'selected' : ''}}>{{$pump->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="user">User</label>
        <select name="user_id" id="user" class="select2 form-select">
            @foreach ($users as $user)
                <option value="{{$user->id}}" {{$user->id == $give_cash->user_id ? 'selected' : ''}}>{{$user->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row mt-2">
    <div class="col-4">
        <label for="shift">Shift</label>
        <select name="shift_id" id="shift" class="select2 form-select">
            @foreach ($shifts as $shift)
                <option value="{{$shift->id}}" {{$shift->id == $give_cash->shift_id ? 'selected' : ''}}>{{$shift->shift_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="amount">Amount</label>
        <input type="text" name="amount" value="{{@$give_cash->amount}}" id="amount" placeholder="eg. 1456623" class="form-control">
    </div>
</div>

<div class="row col-2 form-group mt-3">

    @if (@$give_cash)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>