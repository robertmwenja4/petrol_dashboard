<div class="modal fade" id="roleModal">
    <div class="modal-dialog" style="margin-right: 0;">
        <form class="modal-content pt-0" method="POST" action="{{route('role.store')}}">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-name">Role Name</label>
                    <input type="text" class="form-control dt-shift-name" id="name" placeholder="eg. Admin" name="name" />
                </div>
                
                
                <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>