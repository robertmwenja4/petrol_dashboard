<div class="modal fade" id="product_priceModal">
    <div class="modal-dialog" style="margin-right: 0;">
        <form class="modal-content pt-0" method="POST" action="{{route('product_price.store')}}">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Add ProductPrice</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-name">Product Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach (['diesel','petrol','kerosine'] as $item)
                            <option value="{{$item}}">{{ucfirst($item)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="date">From Date</label>
                    <input type="date" class="form-control" id="date" placeholder="e" name="from_date" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="price">Price per Litre</label>
                    <input type="text" class="form-control" id="price" placeholder="0.00" name="price" />
                </div>
                
                
                <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>