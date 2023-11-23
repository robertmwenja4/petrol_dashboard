<div class="table-responsive mt-3">
    <table class="table time-center tfr my_stripe_single" id="shiftTbl">
        <thead>
            <tr class="item_header bg-gradient-directional-blue white ">
                <th width="15%" class="text-center">Name</th>
                <th width="10%" class="text-center">User</th>
                <th width="10%" class="text-center">Shift</th>
                <th width="10%" class="text-center">Pump</th>
                <th width="10%" class="text-center">Actions</th>               
            </tr>
        </thead>
        <tbody>
            <!-- layout -->
            <tr>
                <td>
                    <input type="text" class="form-control name" name="name[]" id="name-0">
                </td>
                <td>
                    <select name="user_id" id="user_id" class="select form-select">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}" {{$user->id == $item->user_id? 'selected':''}}></option>
                        @endforeach
                    </select>
                </td>
                <td><input type="time" class="form-control end_time" id="end_time-0" name="end_time[]"></td> 
                <td><button type="button" class="btn btn-danger remove" id="remove"><i data-feather="trash"></i></button></td>
                <input type="hidden" name="id[]" value="0">

            </tr>
            @if (isset($shift))
                @foreach ($shift->items as $i => $item)
                    <tr>
                        <td>
                            <input type="text" value="{{ $item->name }}" class="form-control name" name="name[]" id="name-{{$i}}">
                        </td>
                        <td>
                            <select name="user_id" id="user_id" class="select form-select">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{$user->id == $item->user_id? 'selected':''}}></option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="pump_id" id="pump_id" class="select form-select">
                                @foreach ($pumps as $pump)
                                    <option value="{{$pump->id}}" {{$pump->id == $item->pump_id? 'selected':''}}></option>
                                @endforeach
                            </select>
                        </td>
                        <td><button type="button" class="btn btn-danger remove" id="remove"><i data-feather="trash"></i></button></td>
                        <input type="hidden" value="{{ $item->id }}" name="id[]" id="id-{{$i}}">
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<a href="javascript:" class="btn btn-success mb-3" aria-label="Left Align" id="addstock"><i data-feather="plus"></i> Add Row</a>