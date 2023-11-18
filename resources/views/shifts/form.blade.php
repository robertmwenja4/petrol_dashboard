<div class="form-group row">
    <div class="col-6">
        <label for="shift_name">Shift Name</label>
        <input type="text" name="shift_name" value="{{@$shift->shift_name}}" id="shift_name" placeholder="Day Shift" class="form-control">
    </div>
</div>
@include('shifts.partials.add_items')

<div class="row col-2">

    @if ($shift)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>