@extends('layout.app')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card">
        <div class="card-header">
            <h4>View shift</h4>
            <a href="{{route('shift.index')}}" class="btn btn-primary">List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 border-blue-grey border-lighten-5  p-1">
                    Shift Name</div>
                <div class="col border-blue-grey border-lighten-5  p-1 font-weight-bold">
                    {{ $shift['shift_name'] }}</div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table time-center tfr my_stripe_single" id="shiftTbl">
                    <thead>
                        <tr class="item_header bg-gradient-directional-blue white ">
                            <th width="15%" class="text-center">Name</th>
                            <th width="10%" class="text-center">Clock In</th>
                            <th width="10%" class="text-center">Clock Out</th>             
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($shift))
                            @foreach ($shift_items as $i => $item)
                                <tr class="text-center">
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>{{$item->start_time}}</td> 
                                    <td>{{$item->end_time}}</td> 
                                    
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('extra-scripts')
    <script>
       
    </script>
@endsection