<div class="form-group row">
    <div class="col-4">
        <label for="name">Shift Type Name</label>
        <input type="text" name="name" value="{{@$shift_type->name}}" id="name" placeholder="" class="form-control">
    </div>
    <div class="col-4">
        <label for="start_time">Start Time</label>
        <input type="time" name="start_time" value="{{@$shift_type->start_time}}" id="start_time" placeholder="" class="form-control">
    </div>
    <div class="col-4">
        <label for="end_time">End Time</label>
        <input type="time" name="end_time" value="{{@$shift_type->end_time}}" id="end_time" placeholder="" class="form-control">
    </div>
    
</div>


<div class="row col-2 form-group mt-3">

    @if (@$shift_type)
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
    @else
    <button type="submit" class="btn btn-primary btn-lg">Create</button>
    @endif
</div>