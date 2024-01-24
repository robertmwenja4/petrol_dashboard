@extends('layouts.app')

@section('content')

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            {{-- <Button class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#statusModal">
                <i data-feather="circle"></i>Approval Status
            </Button> --}}
            <button type="button" class="btn btn-warning btn-sm mr-1" data-bs-toggle="modal" data-bs-target="#statusModal">
                <i data-feather="edit"></i>
              </button>
            <div class="modal fade" id="statusModal" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">GiveCash Approval</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(['route' => 'give_cash.approve', 'method' => 'POST' ]) }}
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="status">Status</label>
                                <select class="custom-select form-select" name="status" id="status">
                                    @foreach (['pending', 'approved', 'rejected'] as $val)
                                        <option value="{{ $val }}" {{ @$give_cash->status == $val? 'selected' : '' }}>
                                            {{ ucfirst($val) }}
                                        </option>
                                    @endforeach                            
                                </select>
                                <input type="hidden" value="{{ @$give_cash->id }}" name="id" id="">
                                {{-- <input type="hidden" value="status" name="type" id=""> --}}
                            </div>
                            <div class="form-group row mt-2">
                                <label for="status_note">Remark</label>
                                {{ Form::text('approve_note', @$give_cash->approve_note, ['class' => 'form-control', 'placeholder'=>'Give Remarks']) }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{ Form::submit('Update', ['class' => "btn btn-primary"]) }}
                        </div>
                    {{ Form::close() }}
                    </div>
                    
                    
                  </div>
                </div>
              </div>
            <h4>View GiveCash</h4>
            <a href="{{route('give_cash.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Reference No.</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ gen4tid('RC-',$give_cash['tid']) }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Pump</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ @$give_cash->pump['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    User</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ @$give_cash->user['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Shift</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $give_cash->shift['shift_name'] }}</div>
            </div>

            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Status</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ Str::ucfirst($give_cash['status']) }}</div>
            </div>
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Amount</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ number_format($give_cash['amount'], '3') }}</div>
            </div>
        </div>
        @include('give_cash.partials.approval')
    </div>

@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection