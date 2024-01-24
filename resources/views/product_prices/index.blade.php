@extends('layouts.app')

@section('content')
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
                                    <h3 class="fw-bolder mb-75">{{$product_prices->count()}}</h3>
                                    <span>Total product_prices</span>
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
                            Add Product Price
                        </button>
                        {{-- @include('users.partials.user_modal') --}}
                    </div>
                    {{-- <div class="card-body border-bottom">
                        <h4 class="card-title">Search & Filter</h4>
                        <div class="row">
                            <div class="col-md-4 user_product_price"></div>
                            <div class="col-md-4 user_plan"></div>
                            <div class="col-md-4 user_status"></div>
                        </div>
                    </div> --}}
                    <div class="card-datatable card-body table-responsive pt-0">
                        {{-- user-list-table --}}
                        <table class="table" id="product_pricesTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Category</th>
                                    <th>From Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_prices as $i => $product_price)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{ucfirst($product_price->category)}}</td>
                                        <td>{{date('d/m/Y', strtotime($product_price->from_date))}}</td>
                                        <td>{{$product_price->end_date ? date('d/m/Y', strtotime($product_price->end_date)) : ''}}</td>
                                        <td>{{ucfirst($product_price->status)}}</td>
                                        <td>{{number_format($product_price->price, '3')}}</td>
                                        <td>
                                            @include('product_prices.partials.action_buttons')
                                        </td>
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$product_price->id}}" tabindex="0" aria-labelledby="exampleModalLabel{{$product_price->id}}" aria-hidden="false">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel{{$product_price->id}}">Edit product_price</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('product_price.update', ['product_price' => $product_price->id])}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-name">Product Category</label>
                                                        <select name="category" id="category" class="form-control">
                                                            @foreach (['diesel','petrol','kerosine'] as $item)
                                                                <option value="{{$item}}" {{$item == $product_price->category ? 'selected':''}}>{{ucfirst($item)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="date">From Date</label>
                                                        <input type="date" class="form-control" id="date" value="{{$product_price->from_date}}" placeholder="e" name="from_date" />
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="price">Price per Litre</label>
                                                        <input type="text" class="form-control" id="price" value="{{$product_price->price}}" placeholder="0.00" name="price" />
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
                    @include('product_prices.partials.product_price_modal')
                    @include('product_prices.partials.product_price_edit_modal')
                    <!-- Modal to add new user Ends-->
                </div>
                <!-- list and filter end -->
            </section>
            <!-- product_prices list ends -->

        </div>
    </div>

@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#product_pricesTbl').DataTable();
        $('#btnPop').click(function () {
            // Show the modal
            $('#product_priceModal').modal('show');
        });
        $('.btnEdit').on('click', function() {

            var product_priceId = $(this).data('product_price-id');
            var product_price = @json($product_prices);
            console.log(product_price, product_priceId);
            // Find the product_price by ID
            var selectedproduct_price = product_price.find(u => u.id === product_priceId);
            console.log(selectedproduct_price);

            // Populate the modal with product_price data
            $('#editname').val(selectedproduct_price.name);
            $('#editcode').val(selectedproduct_price.code);
            $('#editdescription').val(selectedproduct_price.description);
            $('#editproduct_priceId').val(selectedproduct_price.id);
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