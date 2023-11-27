<div class="form-group row">
    <div class="col-4">
        <label for="customer">Customer</label>
        <select name="customer_id" id="customer" class="select2 form-select">
            @foreach ($customers as $customer)
                <option value="{{$customer->id}}" {{$customer->id == $sale->customer_id ? 'selected' : ''}}>{{$customer->company}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4">
        <label for="tin">Tin Number</label>
       <input type="text" name="tin_no" value="{{$sale->tin_no}}" class="form-control" readonly id="tin_no">
    </div>
    <div class="col-4">
        <label for="vrn">VRN Number</label>
       <input type="text" name="vrn_no" value="{{$sale->vrn_no}}" class="form-control" readonly id="vrn_no">
    </div>

</div>
<br>
<h4>LPO Details</h4>
<div class="form-group row">
    <div class="col-3">
        <label for="LPO No">LPO No</label>
        <input type="text" name="lpo_no" value="{{$sale->lpo_no}}" class="form-control" id="">
    </div>
    <div class="col-3">
        <label for="Vehicle No.">Vehicle No.</label>
        <input type="text" name="vehicle_no" value="{{$sale->vehicle_no}}" class="form-control" id="">
    </div>
    <div class="col-3">
        <label for="Current Milleage">Current Milleage</label>
        <input type="text" name="mileage" value="{{$sale->mileage}}" class="form-control" id="">
    </div>
    <div class="col-3">
        <label for="Driver's Name">Driver's Name</label>
        <input type="text" name="driver" value="{{$sale->driver}}" class="form-control" id="">
    </div>
</div>
<br>
<h4>Sales Details</h4>
<div class="filter">
    <div class="form-group row">
        <div class="col-3">
            <label for="pump">Pump</label>
            <select name="pump_id" id="pump" class="select2 form-select">
                @foreach ($pumps as $pump)
                    <option value="{{$pump->id}}" {{$pump->id == $sale->pump_id ? 'selected' : ''}}>{{$pump->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <label for="product">Product</label>
            <select name="product_id" id="product" class="select2 form-select">
                @foreach ($products as $product)
                    <option value="{{$product->id}}" {{$product->id == $sale->product_id ? 'selected' : ''}}>{{$product->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <label for="type">Type</label>
            <select name="type_id" id="type" class="select2 form-select">
                <option value="">Select Type</option>
              @foreach (['cash','quantity'] as $item)
                  <option value="{{$item}}">{{ucfirst($item)}}</option>
              @endforeach
            </select>
        </div>
        <div class="col-3">
            <label for="Quantity">Quantity</label>
            <input type="text" name="qty" value="{{$sale->qty}}" class="form-control" readonly id="quantity">
        </div>
        
    </div>
    <br>
    <div class="form-group row">
        <div class="col-3">
            <label for="Rate">Rate</label>
            <input type="text" name="rate" value="{{$sale->rate}}" class="form-control" readonly id="rate">
        </div>
        <div class="col-3">
            <label for="Total Price">Total Price</label>
            <input type="text" name="total_price" value="{{$sale->total_price}}" readonly class="form-control" id="price">
        </div>
    </div>
</div>

<div class="row col-2 form-group mt-3">

    @if (@$sale)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>