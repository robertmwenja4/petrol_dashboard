<!-- Modal -->
<div class="modal fade" id="passKeyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Enter Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- {{ Form::password('pass_key', null, ['placeholder' => 'Enter your password', 'class' => 'form-control', 'id' => 'passKey']) }} --}}
                <input type="password" name="pass_key" id="passKey" class="form-control" placeholder="Enter your password">
            </div>
            <div class="modal-footer justify-content-center">
                {{ Form::submit('Proceed', ['class' => 'btn btn-md btn-success col-6', 'id' => 'modalButton']) }}
            </div>
        </div>
    </div>
</div>
