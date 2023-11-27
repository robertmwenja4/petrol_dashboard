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
            <!-- Customer list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$customers->count()}}</h3>
                                    <span>Total Customers</span>
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
                                    <span>Paid Customer</span>
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
                                    <span>Active Customer</span>
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
                                    <span>Pending Customer</span>
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
                        {{-- <button type="button" id="btnPop" class="btn btn-primary" style="margin-right: 0;">
                            Add customer
                        </button> --}}
                        <a href="{{route('customer.create')}}" class="btn btn-primary">Add customer</a>
                        {{-- @include('Customer.partials.user_modal') --}}
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
                        <table class="table" id="customersTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>VRN</th>
                                    <th>TIN</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $i => $customer)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$customer->company}}</td>
                                        <td>{{$customer->phone_number}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{$customer->vrn}}</td>
                                        <td>{{$customer->tin}}</td>
                                        
                                        <td>
                                            @include('customers.partials.action_buttons')
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal to add new user starts-->
                     <!-- Modal to add new user Ends-->
                </div>
                <!-- list and filter end -->
            </section>
            <!-- customers list ends -->

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#customersTbl').DataTable();
       
    </script>
@endsection