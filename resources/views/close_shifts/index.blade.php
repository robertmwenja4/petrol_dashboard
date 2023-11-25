@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- close_shift list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$close_shifts->count()}}</h3>
                                    <span>Total Close Shifts</span>
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
                                    <span>Paid close_shift</span>
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
                                    <span>Active close_shift</span>
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
                                    <span>Pending close_shift</span>
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
                            Add close_shift
                        </button> --}}
                        <a href="{{route('close_shift.create')}}" class="btn btn-primary">Create CloseShift</a>
                        {{-- @include('close_shift.partials.user_modal') --}}
                    </div>
                    <div class="card-body border-bottom">
                        <h4 class="card-title">Search & Filter</h4>
                        <form action="{{route('print.shift')}}" method="post">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-4 user_role">
                                    {{-- <label for="shift">Search Shift</label> --}}
                                    <select name="shift_id" id="shift" class="select2 form-select" data-placeholder="Search Shift" required>
                                        <option value="">Search Shift</option>
                                        @foreach ($shifts as $shift)
                                            <option value="{{$shift->id}}">{{$shift->shift_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 user_plan">

                                    <button type="submit" class="btn btn-primary btn-lg">Print</button>
                                </div>
                                <div class="col-md-4 user_status"></div>
                            </div>
                        </form>
                    </div>
                    <div class="card-datatable card-body table-responsive pt-0">
                        {{-- user-list-table --}}
                        <table class="table" id="close_shiftsTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($close_shifts as $i => $close_shift)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{@$close_shift->shift->shift_name}}</td>
                                        <td>{{$close_shift->created_at}}</td>
                                        <td>{{@$close_shift->shift->status}}</td>
                                        
                                        <td>
                                            @include('close_shifts.partials.action_buttons')
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
            <!-- close_shifts list ends -->

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#close_shiftsTbl').DataTable();
       
    </script>
@endsection