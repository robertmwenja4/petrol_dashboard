<div class="modal fade" id="editModal">
    <div class="modal-dialog" style="margin-right: 0;">
        <form class="modal-content pt-0"  id="editForm">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Edit Nozzle</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-name">Nozzle Name</label>
                    <input type="text" class="form-control" id="name" placeholder="eg. nozzle 1" name="name" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="code">Code</label>
                    <input type="text" class="form-control" id="code" placeholder="eg. code" name="code" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="pump">Pump Name</label>
                    <select name="pump_id" id="pump" class="select2 form-select">
                        @foreach ($pumps as $pump)
                            <option value="{{$pump->id}}">{{$pump->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="Product">Product</label>
                    <select name="product_id" id="product" class="select2 form-select">
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="editpumpId" name="id">
                <button type="submit" id="submitBtn" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>