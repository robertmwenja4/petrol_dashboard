<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-status-label">GiveCash Approval Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['route' => 'give_cash.approve', 'method' => 'POST' ]) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="custom-select" name="status" id="status">
                            @foreach (['pending', 'approved', 'rejected'] as $val)
                                <option value="{{ $val }}" {{ @$give_cash->status == $val? 'selected' : '' }}>
                                    {{ ucfirst($val) }}
                                </option>
                            @endforeach                            
                        </select>
                        <input type="hidden" value="{{ @$give_cash->id }}" name="id" id="">
                        <input type="hidden" value="status" name="type" id="">
                    </div>
                    <div class="form-group">
                        <label for="status_note">Status Note</label>
                        {{ Form::text('approve_note', @$give_cash->approve_note, ['class' => 'form-control']) }}
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