<div class="form-group row">
    <div class="col-4">
        <label for="shift">Shift Search</label>
        <select name="shift_id" id="shift" class="select2 form-select" data-placeholder="Search Shift" required>
            <option value="">Search Shift</option>
            @foreach ($shifts as $shift)
                <option value="{{$shift->id}}" {{$shift->id == @$close_shift->shift_id ? 'selected' : ''}}>{{$shift->shift_name}}</option>
            @endforeach
        </select>
    </div>
</div>
@include('close_shifts.partials.add_items')

<div class="row col-2 form-group mt-3">

    @if (@$close_shift)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>
