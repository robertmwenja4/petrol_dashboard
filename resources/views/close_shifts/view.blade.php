@extends('layouts.app')

@section('content')

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View Close Shift</h4>
            <a href="{{route('close_shift.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Shift Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    <b>{{ $close_shift->shift ? date('d/m/Y', strtotime($close_shift->shift['shift_name'])) : '' }}</b></div>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table time-center tfr my_stripe_single" id="closeshiftTbl">
                <thead>
                    <tr class="item_header bg-gradient-directional-blue white ">
                        <th width="5%" class="text-center">User</th>
                        <th width="10%" class="text-center">Pump</th>
                        <th width="10%" class="text-center">Nozzle</th>
                        <th width="10%" class="text-center">Item</th>
                        <th width="15%" class="text-center">Opening Reading</th>
                        <th width="15%" class="text-center">Current Readings</th>
                        <th width="15%" class="text-center">Balance</th>
                        <th width="20%" class="text-center">Amount</th>
                        {{-- <th width="10%" class="text-center">Actions</th>                --}}
                    </tr>
                </thead>
                <tbody>
                    <!-- layout -->
                    
                    @if (isset($close_shift))
                        @foreach ($close_shift->close_shift_items as $i => $item)
                        <tr class="text-center">
                            {{-- <td>{{$i+1}}</td>     --}}
                            <td>{{$item->user ? $item->user->name : ''}}</td>    
                            <td>{{$item->pump ? $item->pump->name : ''}}</td>    
                            <td>{{$item->nozzle ? $item->nozzle->code : ''}}</td>    
                            <td>{{$item->product ? $item->product->name : ''}}</td>      
                            <td>{{number_format($item->open_stock, '3')}}</td> 
                            <td>{{number_format($item->current_stock, '3')}}</td>
                            <td>{{number_format($item->balance, '3')}}</td>
                            <td width="30%">{{number_format($item->amount, '3')}}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    

@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection