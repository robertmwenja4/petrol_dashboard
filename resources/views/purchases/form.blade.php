<div class="form-group row">
    <div class="col-3">
        <label for="product">Search Product</label>
        <select id="product" name="product_id" class="select2 form-select" data-placeholder="Search Product">
            <option value="">Search Product</option>
            @foreach ($products as $product)
                <option value="{{$product->id}}" {{$product->id == @$purchase->product_id ? 'selected' : ''}}>{{$product->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="shift_id">Select Shift</label>
        <select id="shift" name="shift_id" class="select2 form-select" data-placeholder="Search shift">
            <option value="">Search shift</option>
            @foreach ($shifts as $shift)
                <option value="{{$shift->id}}" {{$shift->id == @$purchase->shift_id ? 'selected' : ''}}>{{$shift->shift_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <label for="invoice_no">Invoice No.</label>
        <input type="text" name="invoice_no" value="{{@$purchase->invoice_no}}" id="invoice_no" placeholder="eg. S" class="form-control">
    </div>
    <div class="col-3">
        <label for="qty">Quantity</label>
        <input type="text" name="qty" value="{{@$purchase->qty}}" id="qty" placeholder="0.00" class="form-control">
    </div>
    
</div>
<div class="form-group row mt-3">
    <div class="col-3">
        <label for="cost">Total Cost</label>
        <input type="text" name="cost" value="{{@$purchase->cost}}" id="cost" placeholder="0.00" class="form-control">
    </div>
</div>


<div class="row col-2 form-group mt-3">

    @if (@$purchase)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>