@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- give_cash list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$give_cashs->count()}}</h3>
                                    <span>Total GiveCashs</span>
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
                    
                    <div class="card-datatable card-body table-responsive pt-0">
                        {{-- user-list-table --}}
                        <table class="table" id="give_cashsTbl">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Reference No.</th>
                                    <th>Pump</th>
                                    <th>User</th>
                                    <th>Shift</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($give_cashs as $i => $give_cash)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{gen4tid('RC-',$give_cash->tid)}}</td>
                                        <td>{{$give_cash->pump ? $give_cash->pump->name : ''}}</td>
                                        <td>{{$give_cash->user ? $give_cash->user->name : ''}}</td>
                                        <td>{{$give_cash->shift ? $give_cash->shift->shift_name : ''}}</td>
                                        <td>{{ucfirst($give_cash->status)}}</td>
                                        <td>{{$give_cash->amount}}</td>
                                        
                                        <td>
                                            @include('give_cash.partials.action_buttons')
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
            <!-- give_cashs list ends -->

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script>
       $.ajaxSetup({headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }});
        $('#give_cashsTbl').DataTable();
       
    </script>
@endsection