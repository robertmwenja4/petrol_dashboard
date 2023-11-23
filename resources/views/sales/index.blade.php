@extends('layout.app')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- sale list start -->
                <section class="app-user-list">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="fw-bolder mb-75">{{ $sales->count() }}</h3>
                                        <span>Total sales</span>
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
                                    <span>Paid sale</span>
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
                                    <span>Active sale</span>
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
                                    <span>Pending sale</span>
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
                            Add sale
                        </button> --}}
                        {{-- <a href="{{route('sale.create')}}" class="btn btn-primary">Add sale</a> --}}
                        {{-- @include('sale.partials.user_modal') --}}
                    </div>
                    <div class="card-body border-bottom">
                            {{-- <a href="{{route('sale.create')}}" class="btn btn-primary">Add sale</a> --}}
                            {{-- @include('sale.partials.user_modal') --}}
                        </div>
                         <div class="card-body border-bottom">
                            <h4 class="card-title">Search & Filter</h4>
                            <form action="{{route('sales.search')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 user_role">
                                        <label for="date">Date From</label>
                                        <input type="date" class="form-control" name="date_from">
                                    </div>
                                    <div class="col-md-4 user_plan">
                                        <label for="date_to">Date To</label>
                                        <input type="date" class="form-control" name="date_to">
                                    </div>
                                    <div class="col-md-1 user_status">
                                        <label for="date_to">Print</label>
                                        <button type="submit" class="btn btn-primary ">Print</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-datatable card-body table-responsive pt-0">
                            {{-- user-list-table --}}
                            <table class="table" id="salesTbl">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Sale Type</th>
                                        <th>Customer</th>
                                        <th>LPO No.</th>
                                        <th>Sold By</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Total Price</th>
                                        <th>Date & Time</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $i => $sale)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $sale->type }}</td>
                                            <td>{{ $sale->customer ? $sale->customer->company : '' }}</td>
                                            <td>{{ $sale->lpo_no ? $sale->lpo_no : '' }}</td>
                                            <td>{{ $sale->user ? $sale->user->name : '' }}</td>
                                            <td>{{ +$sale->qty }}</td>
                                            <td>{{ +$sale->rate }}</td>
                                            <td>{{ +$sale->total_price }}</td>
                                            <td>{{ $sale->created_at }}</td>

                                            <td>
                                            {{-- @include('sales.partials.action_buttons') --}}
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
                <!-- sales list ends -->

            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $('#salesTbl').DataTable();
    </script>
@endsection
