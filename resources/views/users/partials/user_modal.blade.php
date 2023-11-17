<div class="modal fade" id="userModal">
    <div class="modal-dialog" style="margin-right: 0;">
        <form class="modal-content pt-0" method="POST" action="{{route('user.store')}}">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" name="fullname" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-code">Code</label>
                    <input type="text" id="basic-icon-default-code" class="form-control dt-code" placeholder="123456" name="code" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" name="email" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-contact">Contact</label>
                    <input type="text" id="basic-icon-default-contact" class="form-control dt-contact" placeholder="+2557 123 456 78" name="phone_number" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="user-role">User Role</label>
                    <select id="user-role" name="role_id" class="select2 form-select">
                        <option value="">Search Role</option>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>