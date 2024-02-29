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
            <!-- shift_type list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{ $shift_types->count() }}</h3>
                                    <span>Total Shift Types</span>
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
                            Add shift_type
                        </button> --}}
                        <a href="{{ route('shift_type.create') }}" class="btn btn-primary">Add ShiftType</a>
                        {{-- @include('shift_type.partials.user_modal') --}}
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
                        <table class="table" id="shift_typesTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Shift Type Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shift_types as $i => $shift_type)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $shift_type->name }}</td>
                                        <td>{{ $shift_type->start_time }}</td>
                                        <td>{{ $shift_type->end_time }}</td>
                                        <td>
                                            @include('shift_types.partials.action_buttons')
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
            <!-- shift_types list ends -->

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
        $('#shift_typesTbl').DataTable();
    </script>
@endsection
