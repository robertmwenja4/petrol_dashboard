<div class="form-group row">
    <div class="col-4">
        <label for="product_name">Product Name</label>
        <input type="text" name="name" value="{{@$product->name}}" id="product_name" placeholder="eg. Super 1" class="form-control">
    </div>
    <div class="col-4">
        <label for="code">Code</label>
        <input type="text" name="code" value="{{@$product->code}}" id="code" placeholder="eg. S1" class="form-control">
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
    <div class="col-4">
        <label for="readings">Readings</label>
        <input type="text" name="readings" value="{{@$product->readings}}" id="readings" placeholder="0.00" class="form-control">
    </div>
    <div class="col-4">
        <label for="price">Prices per Litre</label>
        <input type="text" name="price" value="{{@$product->price}}" id="price" placeholder="0.00" class="form-control">
    </div>
    <div class="col-4">
        <label for="category">Product Category</label>
        
        <select id="user-category" name="category" class="select2 form-select">
            @foreach (['diesel','petrol','kerosine'] as $category)
                <option value="{{$category}}" {{$category == @$product->category ? 'selected' : ''}}>{{ucfirst($category)}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row col-2 form-group mt-3">

    @if (@$product)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>