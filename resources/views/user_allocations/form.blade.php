<div class="form-group row">
    <div class="col-4">
        <label for="user">User Name</label>
        <select id="user" name="user_id" class="select2 form-select">
            @foreach ($users as $user)
                <option value="{{$user->id}}" {{$user->id == @$product->user_id ? 'selected' : ''}}>{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="shift">Search Shift</label>
        <select id="user-shift" name="shift_id" class="select2 form-select">
            @foreach ($shifts as $shift)
                <option value="{{$shift->id}}" {{$shift->id == @$product->shift_id ? 'selected' : ''}}>{{$shift->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="pump">Search Pump</label>
        <select id="user-pump" name="pump_id" class="select2 form-select">
            @foreach ($pumps as $pump)
                <option value="{{$pump->id}}" {{$pump->id == @$product->pump_id ? 'selected' : ''}}>{{$pump->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row mt-2">
    <div class="col-6">
        <label for="product">Search Products</label>
        <select id="product" name="product_id" class="select2 form-select" multiple>
            {{-- @foreach ($products as $product)
                <option value="{{$product->id}}" {{$product->id == @$product->product_id ? 'selected' : ''}}>{{$product->name}}</option>
            @endforeach --}}
        </select>
    </div>
</div>

<div class="row col-2 form-group mt-3">

    @if (@$user_allocation)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>