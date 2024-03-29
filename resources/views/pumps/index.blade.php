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
                                    <h3 class="fw-bolder mb-75">{{$pumps->count()}}</h3>
                                    <span>Total pumps</span>
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
                            Add Pump
                        </button>
                        {{-- @include('users.partials.user_modal') --}}
                    </div>
                    {{-- <div class="card-body border-bottom">
                        <h4 class="card-title">Search & Filter</h4>
                        <div class="row">
                            <div class="col-md-4 user_pump"></div>
                            <div class="col-md-4 user_plan"></div>
                            <div class="col-md-4 user_status"></div>
                        </div>
                    </div> --}}
                    <div class="card-datatable card-body table-responsive pt-0">
                        {{-- user-list-table --}}
                        <table class="table" id="pumpsTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pumps as $i => $pump)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$pump->name}}</td>
                                        <td>{{$pump->code}}</td>
                                        <td>{{$pump->description}}</td>
                                        <td>{{$pump->created_at}}</td>
                                        <td>
                                            @include('pumps.partials.action_buttons')
                                        </td>
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$pump->id}}" tabindex="0" aria-labelledby="exampleModalLabel{{$pump->id}}" aria-hidden="false">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel{{$pump->id}}">Edit pump</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('pump.update', ['pump' => $pump->id])}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-name">Pump Name</label>
                                                        <input type="text" class="form-control" id="editname" value="{{$pump->name}}" placeholder="eg. Pump 1" name="name" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="code">Pump Code</label>
                                                        <input type="text" class="form-control" id="editcode" placeholder="eg. P1" value="{{$pump->code}}" name="code" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="description">Description</label>
                                                        <input type="text" class="form-control" id="editdescription" placeholder="eg. Describe" value="{{$pump->description}}" name="description" />
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
                    <!-- Modal to add new pump starts-->
                    @include('pumps.partials.pump_modal')
                    @include('pumps.partials.pump_edit_modal')
                    <!-- Modal to add new user Ends-->
                </div>
                <!-- list and filter end -->
            </section>
            <!-- pumps list ends -->

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#pumpsTbl').DataTable();
        $('#btnPop').click(function () {
            // Show the modal
            $('#pumpModal').modal('show');
        });
        $('.btnEdit').on('click', function() {

            var pumpId = $(this).data('pump-id');
            var pump = @json($pumps);
            console.log(pump, pumpId);
            // Find the pump by ID
            var selectedpump = pump.find(u => u.id === pumpId);
            console.log(selectedpump);

            // Populate the modal with pump data
            $('#editname').val(selectedpump.name);
            $('#editcode').val(selectedpump.code);
            $('#editdescription').val(selectedpump.description);
            $('#editpumpId').val(selectedpump.id);
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