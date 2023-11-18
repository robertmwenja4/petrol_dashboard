<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" style="margin-right: 0;">
        @csrf
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
        </div>
        <div class="modal-body flex-grow-1">
                <form class="modal-content pt-0"  id="editForm">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                    <input type="text" class="form-control dt-full-name" value="{{ $user->name }}" id="fullname" placeholder="John Doe" name="fullname" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-code">Code</label>
                    <input type="text" id="code" class="form-control dt-code" value="{{ $user->code }}"  placeholder="123456" name="code" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <input type="text" id="email" class="form-control dt-email" placeholder="john.doe@example.com" name="email" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-contact">Contact</label>
                    <input type="text" id="contact" class="form-control dt-contact" placeholder="+2557 123 456 78" name="phone_number" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="user-role">User Role</label>
                    <select id="role" name="role_id" class="select2 form-select">
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="status">User Status</label>
                    <select id="status" name="status" class="select2 form-select">
                        @foreach (['pending','active','inactive'] as $status)
                            <option value="{{$status}}">{{ucfirst($status)}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="editUserId" name="id">
                <button type="submit" id="submitBtn" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </form>
            </div>
    </div>
</div>