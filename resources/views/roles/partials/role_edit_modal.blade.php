<div class="modal fade" id="editModal">
    <div class="modal-dialog" style="margin-right: 0;">
        <form class="modal-content pt-0"  id="editForm">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-name">Role Name</label>
                    <input type="text" class="form-control dt-shift-name" id="editname" placeholder="eg. Admin" name="name" />
                </div>
                <input type="hidden" id="editroleId" name="id">
                <button type="submit" id="submitBtn" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>