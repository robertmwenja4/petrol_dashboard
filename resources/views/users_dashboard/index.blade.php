@extends('layouts.app')

@section('content')
    <div class="text-center text-white d-flex flex-column justify-content-center align-items-center">
        <h1 class="mt-4">
            Welcome to
            <span>Sales Portal</span>
        </h1>
        <p class="h3 font-weight-light mt-4 ">Select an option to proceed.</p>

        <div class="row m-5">

            <div class="col-sm-4">
                <div class="card text-bg-success" style="width: 18rem;">
                    <h3 class="mt-2">Shift Management</h3>
                    <div class="card-body">
                        <h4 class="card-text">Create Shift</h4>
                        <a href="/user_shift" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-bg-primary" style="width: 18rem;">
                    <h3 class="mt-2">Invoice Sale</h3>
                    <div class="card-body">

                        <h4 class="card-text">Make an incoive sale.</h4>
                        <a href="/user_sale" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-bg-danger " style="width: 18rem;">
                    <h3 class="mt-2">Give Cash</h3>
                    <div class="card-body ">
                        <h4 class="card-text">Record cash received</h4>
                        <a href="/user_cash" class="stretched-link"></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
