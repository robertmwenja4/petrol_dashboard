<div class="form-group row">
    <div class="col-4">
        <label for="shift_name">Shift Name</label>
        <input type="text" value="{{$shift->shift_name}}" name="" id="" class="form-control" disabled>
    </div>
</div>

@include('shifts.partials.add_items')

<button type="submit" class="btn btn-primary mt-3">Update</button>