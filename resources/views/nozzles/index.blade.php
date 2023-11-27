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
                                    <h3 class="fw-bolder mb-75">{{$nozzles->count()}}</h3>
                                    <span>Total nozzles</span>
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
                            Add nozzle
                        </button>
                        {{-- @include('users.partials.user_modal') --}}
                    </div>
                    {{-- <div class="card-body border-bottom">
                        <h4 class="card-title">Search & Filter</h4>
                        <div class="row">
                            <div class="col-md-4 user_nozzle"></div>
                            <div class="col-md-4 user_plan"></div>
                            <div class="col-md-4 user_status"></div>
                        </div>
                    </div> --}}
                    <div class="card-datatable card-body table-responsive pt-0">
                        {{-- user-list-table --}}
                        <table class="table" id="nozzlesTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Pump</th>
                                    <th>Product</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nozzles as $i => $nozzle)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$nozzle->name}}</td>
                                        <td>{{$nozzle->pump ? $nozzle->pump->name : ''}}</td>
                                        <td>{{$nozzle->product ? $nozzle->product->name : ''}}</td>
                                        <td>{{$nozzle->created_at}}</td>
                                        <td>
                                            @include('nozzles.partials.action_buttons')
                                        </td>
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$nozzle->id}}" tabindex="0" aria-labelledby="exampleModalLabel{{$nozzle->id}}" aria-hidden="false">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel{{$nozzle->id}}">Edit Nozzle</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('nozzle.update', ['nozzle' => $nozzle->id])}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-name">Nozzle Name</label>
                                                        <input type="text" class="form-control" value="{{$nozzle->name}}" id="name" placeholder="eg. nozzle 1" name="name" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="code">Code</label>
                                                        <input type="text" class="form-control" value="{{$nozzle->code}}" id="code" placeholder="eg. code" name="code" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="pump">Pump Name</label>
                                                        <select name="pump_id" id="pump-{{$nozzle->id}}" class=" form-select">
                                                            @foreach ($pumps as $pump)
                                                                <option value="{{$pump->id}}" {{$pump->id == $nozzle->pump_id ? 'selected': ''}}>{{$pump->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="Product">Product</label>
                                                        <select name="product_id" id="product-{{$nozzle->id}}" class=" form-select">
                                                            @foreach ($products as $product)
                                                                <option value="{{$product->id}}" {{$product->id == $nozzle->product_id ? 'selected': ''}}>{{$product->name}}</option>
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
                    <!-- Modal to add new nozzle starts-->
                    @include('nozzles.partials.nozzle_modal')
                    @include('nozzles.partials.nozzle_edit_modal')
                    <!-- Modal to add new user Ends-->
                </div>
                <!-- list and filter end -->
            </section>
            <!-- nozzles list ends -->

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#nozzlesTbl').DataTable();
        $('.select2').select2();
        $('#btnPop').click(function () {
            // Show the modal
            $('#nozzleModal').modal('show');
        });
        $('.btnEdit').on('click', function() {

            var nozzleId = $(this).data('nozzle-id');
            var nozzle = @json($nozzles);
            // console.log(nozzle, nozzleId);
            // Find the nozzle by ID
            var selectednozzle = nozzle.find(u => u.id === nozzleId);
            // console.log(selectednozzle);

            // Populate the modal with nozzle data
            $('#editname').val(selectednozzle.name);
            $('#editcode').val(selectednozzle.code);
            $('#editdescription').val(selectednozzle.description);
            $('#editnozzleId').val(selectednozzle.id);
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