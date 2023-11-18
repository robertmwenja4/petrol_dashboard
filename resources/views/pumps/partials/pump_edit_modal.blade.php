<div class="modal fade" id="editModal">
    <div class="modal-dialog" style="margin-right: 0;">
        <form class="modal-content pt-0"  id="editForm">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pump</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-name">Pump Name</label>
                    <input type="text" class="form-control" id="editname" placeholder="eg. Pump 1" name="name" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="code">Pump Code</label>
                    <input type="text" class="form-control" id="editcode" placeholder="eg. P1" name="code" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="description">Description</label>
                    <input type="text" class="form-control" id="editdescription" placeholder="eg. Describe" name="description" />
                </div>
                <input type="hidden" id="editpumpId" name="id">
                <button type="submit" id="submitBtn" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>