<div class="form-group row">
    <div class="col-3">
        <label for="shift_name">Shift Name</label>
        <input type="text" name="shift_name" value="{{ @$date }}" id="shift_name" placeholder=""
            class="form-control" disabled>
        <input type="text" name="shift_name" value="{{ @$date }}" id="shift_name" placeholder=""
            class="form-control" hidden>
    </div>
</div>


<div class="row col-2 mt-4">

    @if (@$shift)
        <button type="submit" class="btn btn-primary btn-lg mx-2">Update</button>
    @else
        <button type="submit" class="btn btn-primary btn-lg mx-2">Create</button>
    @endif
</div>
