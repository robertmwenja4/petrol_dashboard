<div class="form-group row">
    <div class="col-4">
        <label for="customer">Customer</label>
        <select name="customer_id" id="customer" class="select2 form-select">
            @foreach ($customers as $customer)
                <option value="{{$customer->id}}" {{$customer->id == $sale->customer_id ? 'selected' : ''}}>{{$customer->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="pump">Pump</label>
        <select name="pump_id" id="pump" class="select2 form-select">
            @foreach ($pumps as $pump)
                <option value="{{$pump->id}}" {{$pump->id == $sale->pump_id ? 'selected' : ''}}>{{$pump->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="user">User</label>
        <select name="user_id" id="user" class="select2 form-select">
            @foreach ($users as $user)
                <option value="{{$user->id}}" {{$user->id == $sale->user_id ? 'selected' : ''}}>{{$user->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row mt-2">
    <div class="col-4">
        <label for="shift">Shift</label>
        <select name="shift_id" id="shift" class="select2 form-select">
            @foreach ($shifts as $shift)
                <option value="{{$shift->id}}" {{$shift->id == $sale->shift_id ? 'selected' : ''}}>{{$shift->shift_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="amount">Amount</label>
        <input type="text" name="amount" value="{{@$sale->amount}}" id="amount" placeholder="eg. 1456623" class="form-control">
    </div>
</div>

<div class="row col-2 form-group mt-3">

    @if (@$sale)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>