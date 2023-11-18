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
                                            {{-- @include('users.partials.action_buttons') --}}
                                            <a class="btn btn-sm btn-primary" href="{{route('user.show', $user->id)}}"><i data-feather="eye"></i></a>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                                                <i data-feather="edit"></i>
                                              </button>
                                            {{-- <a class="btn btn-sm btn-secondary btnEdit" data-toggle="modal" data-target="#editModal{{ $user->id }}" data-user-id="{{ $user->id }}" href="javascript:"><i data-feather="edit"></i></a> --}}
                                            <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"><i data-feather="trash"></i></button>
                                                {{-- <a class="btn btn-sm btn-danger" type="submit" href="#"><i data-feather="trash"></i></a> --}}
                                            </form>
                                            
                                        </td>
                                        
                                    </tr>
                                    {{-- @include('users.partials.user_edit_modal', ['user' => $user]) --}}
                                    <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="0" aria-labelledby="exampleModalLabel{{$user->id}}" aria-hidden="false">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel{{$user->id}}">Edit User</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('user.update', ['user' => $user->id])}}" method="post">
                                                    @csrf
                                                    @method('PUT')
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
                                                        <input type="text" id="email" class="form-control dt-email" value="{{ $user->email }}"  placeholder="john.doe@example.com" name="email" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-contact">Contact</label>
                                                        <input type="text" id="contact" class="form-control dt-contact" value="{{ $user->phone_number }}"  placeholder="+2557 123 456 78" name="phone_number" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="user-role">User Role</label>
                                                        <select id="role" name="role_id" class="select2 form-select">
                                                            @foreach ($roles as $role)
                                                                <option value="{{$role->id}}" {{$role->id == @$user->role_id ? 'selected' : ''}}>{{$role->name}}</option>
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
                    <!-- Modal to add new user starts-->
                    @include('users.partials.user_modal')

                    
                      
                      <!-- Modal -->
                      
                    
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
            // console.log(user, userId);
            // // Find the user by ID
            var selectedUser = user.find(u => u.id === userId);
            // console.log(selectedUser);

            // Populate the modal with user data
            // $('#fullname').val(selectedUser.name);
            // $('#email').val(selectedUser.email);
            // $('#code').val(selectedUser.code);
            // $('#status').val(selectedUser.status);
            // $('#role').val(selectedUser.role_id);
            // $('#contact').val(selectedUser.phone_number);
            // $('#editUserId').val(selectedUser.id);
            // $(`#editModal${selectedUser.id}`).modal('show');
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