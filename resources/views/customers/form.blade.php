<div class="form-group row">
    <div class="col-4">
        <label for="customer_name">Customer Name/address</label>
        <input type="text" name="company" value="{{@$customer->company}}" id="customer_name" placeholder="eg. ORYX" class="form-control">
    </div>
    <div class="col-4">
        <label for="contact">Contacts</label>
        <input type="text" name="phone_number" value="{{@$customer->phone_number}}" id="contact" placeholder="eg. +255712345678" class="form-control">
    </div>
    <div class="col-4">
        <label for="address">Address</label>
        <input type="text" name="address" value="{{@$customer->address}}" id="address" placeholder="eg. Arusha" class="form-control">
    </div>
</div>
<div class="form-group row mt-2">
    <div class="col-4">
        <label for="vrn">VRN Number</label>
        <input type="text" name="vrn" value="{{@$customer->vrn}}" id="vrn" placeholder="eg. EF8599.." class="form-control">
    </div>
    <div class="col-4">
        <label for="tin">Tin Number</label>
        <input type="text" name="tin" value="{{@$customer->tin}}" id="tin" placeholder="eg. 1456623" class="form-control">
    </div>
</div>

<div class="row col-2 form-group mt-3">

    @if (@$customer)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>