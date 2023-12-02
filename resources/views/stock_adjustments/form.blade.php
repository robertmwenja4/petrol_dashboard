<div class="form-group row">
    <div class="col-4">
        <label for="product">Search Product</label>
        <select id="product" name="product_id" class="select2 form-select" data-placeholder="Search Product">
            <option value="">Search Product</option>
            @foreach ($products as $product)
                <option value="{{$product->id}}" {{$product->id == @$stock_adjustment->product_id ? 'selected' : ''}}>{{$product->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="previous_qty">Previous Quantity</label>
        <input type="text" name="previous_qty" value="{{@$stock_adjustment->previous_qty}}" readonly id="previous_qty" placeholder="0.00" class="form-control">
    </div>
    <div class="col-4">
        <label for="current_qty">Current Quantity</label>
        <input type="text" name="current_qty" value="{{@$stock_adjustment->current_qty}}" id="current_qty" placeholder="0.00" class="form-control">
    </div>
    
</div>


<div class="row col-2 form-group mt-3">

    @if (@$stock_adjustment)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>