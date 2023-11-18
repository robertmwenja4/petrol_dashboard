@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$users->count()}}</h3>
                                    <span>Total Users</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$users->where('status','active')->count()}}</h3>
                                    <span>Active Users</span>
                                </div>
                                <div class="avatar bg-light-danger p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-plus" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$users->where('status','inactive')->count()}}</h3>
                                    <span>Inactive Users</span>
                                </div>
                                <div class="avatar bg-light-success p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-check" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$users->where('status','pending')->count()}}</h3>
                                    <span>Pending Users</span>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-x" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-header">
                        <button type="button" id="btnPop" class="btn btn-primary" style="margin-right: 0;">
                            Add User
                        </button>
                        {{-- @include('users.partials.user_modal') --}}
                    </div>
                    {{-- <div class="card-body border-bottom">
                        <h4 class="card-title">Search & Filter</h4>
                        <div class="row">
                            <div class="col-md-4 user_role"></div>
                            <div class="col-md-4 user_plan"></div>
                            <div class="col-md-4 user_status"></div>
                        </div>
                    </div> --}}
                    <div class="card-datatable card-body table-responsive pt-0">
                        {{-- user-list-table --}}
                        <table class="table" id="usersTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Code</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $user)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->code}}</td>
                                        <td>{{@$user->role->name}}</td>
                                        <td>
                                            @php
                                                $badge_type = $user->status == 'active'? 'badge-success' : 'badge-warning';
                                                $link = '<span data-id="'. $user->id .'" class="badge '. $badge_type .'">'. ucfirst($user->status) .'</span>';
                                            @endphp 
                                            {{ucfirst($user->status)}}</td>
                                        <td>
                                            @include('users.partials.action_buttons')
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal to add new user starts-->
                    @include('users.partials.user_modal')
                    @include('users.partials.user_edit_modal')
                    <!-- Modal to add new user Ends-->
                </div>
                <!-- list and filter end -->
            </section>
            <!-- users list ends -->

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#usersTbl').DataTable();
        $('#btnPop').click(function () {
            // Show the modal
            $('#userModal').modal('show');
        });
        $('.btnEdit').on('click', function() {

            var userId = $(this).data('user-id');
            var user = @json($users);
            console.log(user, userId);
            // Find the user by ID
            var selectedUser = user.find(u => u.id === userId);
            console.log(selectedUser);

            // Populate the modal with user data
            $('#fullname').val(selectedUser.name);
            $('#email').val(selectedUser.email);
            $('#code').val(selectedUser.code);
            $('#status').val(selectedUser.status);
            $('#role').val(selectedUser.role_id);
            $('#contact').val(selectedUser.phone_number);
            $('#editUserId').val(selectedUser.id);
            $('#editModal').modal('show');
        });

        $("#editForm").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            // console.log(formData);

            // Submit form data via AJAX
            $.ajax({
                url: "{{route('users.update')}}",
                type: "post",
                data: formData,
                success: function (data) {
                    // Handle success, e.g., close the modal or update the table
                    $("#editModal").modal("hide");
                    // Update the table or perform any other necessary actions
                },
                error: function (error) {
                    console.log("Error updating user:", error);
                }
            });
        });
    </script>
@endsection