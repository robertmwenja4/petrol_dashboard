@extends('layouts.app')

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            @if (session('flash_success'))
                <div class="alert bg-success alert-dismissible m-1" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {!! session('flash_success') !!}
                </div>
            @endif
            @if (session('flash_error'))
                <div class="alert bg-danger alert-dismissible m-1" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error!</strong> {!! session('flash_error') !!}
                </div>
            @endif
        </div>
        <div class="content-body">
            <!-- stock_adjustment list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{ $stock_adjustments->count() }}</h3>
                                    <span>Total StockAdjustments</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-header">
                        {{-- <button type="button" id="btnPop" class="btn btn-primary" style="margin-right: 0;">
                            Add stock_adjustment
                        </button> --}}
                        <a href="{{ route('stock_adjustment.create') }}" class="btn btn-primary">Add StockAdjustment</a>
                        {{-- @include('stock_adjustment.partials.user_modal') --}}
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
                        <table class="table" id="stock_adjustmentsTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Previous Qty</th>
                                    <th>Current Qty</th>
                                    <th>Date/Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stock_adjustments as $i => $stock_adjustment)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $stock_adjustment->product ? $stock_adjustment->product->name : '' }}</td>
                                        <td>{{ $stock_adjustment->previous_qty }}</td>
                                        <td>{{ $stock_adjustment->current_qty }}</td>
                                        <td> {{ date('d/m/Y', strtotime($stock_adjustment->created_at)) }}--{{ date('h:m A', strtotime($stock_adjustment->created_at)) }}
                                        </td>

                                        <td>
                                            @include('stock_adjustments.partials.action_buttons')
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
            <!-- stock_adjustments list ends -->

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
        $('#stock_adjustmentsTbl').DataTable();
    </script>
@endsection
