@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            @if(session('flash_success'))
                <div class="alert bg-success alert-dismissible m-1" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {!!session('flash_success')!!}
                </div>
            @endif
            @if(session('flash_error'))
                <div class="alert bg-danger alert-dismissible m-1" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> {!!session('flash_error')!!}
                </div>
            @endif
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$roles->count()}}</h3>
                                    <span>Total Roles</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">4,567</h3>
                                    <span>Paid Users</span>
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
                                    <h3 class="fw-bolder mb-75">19,860</h3>
                                    <span>Active Users</span>
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
                                    <h3 class="fw-bolder mb-75">237</h3>
                                    <span>Pending Users</span>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-x" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-header">
                        <button type="button" id="btnPop" class="btn btn-primary" style="margin-right: 0;">
                            Add Role
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
                        <table class="table" id="rolesTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $i => $role)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->created_at}}</td>
                                        <td>
                                            {{-- @include('roles.partials.action_buttons') --}}
                                            <a class="btn btn-sm btn-primary" href="{{route('role.show', $role->id)}}"><i data-feather="eye"></i></a>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$role->id}}">
                                                <i data-feather="edit"></i>
                                              </button>
                                            <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>

                                            </form>

                                        </td>
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$role->id}}" tabindex="0" aria-labelledby="exampleModalLabel{{$role->id}}" aria-hidden="false">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel{{$role->id}}">Edit role</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('role.update', ['role' => $role->id])}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-name">Role Name</label>
                                                        <input type="text" class="form-control dt-shift-name" value="{{$role->name}}" id="name" placeholder="eg. Admin" name="name" />
                                                    </div>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                            
                                            
                                          </div>
                                        </div>
                                      </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal to add new role starts-->
                    @include('roles.partials.role_modal')
                    {{-- @include('roles.partials.role_edit_modal') --}}
                    <!-- Modal to add new user Ends-->
                </div>
                <!-- list and filter end -->
            </section>
            <!-- roles list ends -->

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#rolesTbl').DataTable();
        $('#btnPop').click(function () {
            // Show the modal
            $('#roleModal').modal('show');
        });
        $('.btnEdit').on('click', function() {

            var roleId = $(this).data('role-id');
            var role = @json($roles);
            console.log(role, roleId);
            // Find the role by ID
            var selectedrole = role.find(u => u.id === roleId);
            console.log(selectedrole);

            // Populate the modal with role data
            $('#editname').val(selectedrole.name);
            $('#editroleId').val(selectedrole.id);
            $('#exampleModal').modal('show');
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
                    $("#exampleModal").modal("hide");
                    // Update the table or perform any other necessary actions
                },
                error: function (error) {
                    console.log("Error updating user:", error);
                }
            });
        });
    </script>
@endsection