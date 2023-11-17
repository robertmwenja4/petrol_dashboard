<div class="modal fade" id="shiftModal">
    <div class="modal-dialog" style="margin-right: 0;">
        <form class="modal-content pt-0" method="POST" action="{{route('shift.store')}}">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-shiftname">Shift Name</label>
                    <input type="text" class="form-control dt-shift-name" id="basic-icon-default-shiftname" placeholder="Day Shift" name="name" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-start_time">Start Time</label>
                    <input type="time" id="basic-icon-default-start_time" class="form-control dt-start_time" placeholder="09:00 PM" name="start_time" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-end_time">End Time</label>
                    <input type="time" id="basic-icon-default-end_time" class="form-control dt-end_time" placeholder="09:00 AM" name="end_time" />
                </div>
                
                <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>