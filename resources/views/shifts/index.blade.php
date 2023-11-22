@extends('layouts.app')

@section('content')
    <div class="col-md-6 mx-4 mb-2">
        <div class="card ">
            <div class="card-header">
                <h4>Shift Details</h4>

            </div>
            <div class="card-body">
                <h4>Shift Name : {{ $shift->shift_name }}</h4>
                <h4>Created By : {{ $shift->user->name }}</h4>

            </div>
        </div>
    </div>

    <div class="content-body  mx-1 p-4">


        <!-- list and filter start -->
        <div class="card">
            <div class="card-header">
                <h2>Shift Allocation</h2>
            </div>
            <div id="message" class="my-3 px-2"></div>
            <div class="card-body table-responsive">
                {{-- user-list-table --}}
                <table class="table table-bordered" id="shiftsTbl">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="50%">User</th>
                            <th width="15%">Pump</th>
                            <th width="15%">Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($shift->items as $i => $s)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    {{ Form::select('user_id', $users, @$s->user_id, ['placeholder' => 'Select User...', 'class' => 'select2 form-select']) }}

                                </td>
                                <td>{{ $s->pump->name }}</td>

                                <td>{{ ucfirst($s->status) }}</td>

                                <td>
                                    <!-- Add a data-shift-id attribute to store the shift ID for the current row -->
                                    {{ Form::button($s->status == 'active' ? 'Unassign' : 'Assign', ['class' => $s->status == 'active' ? 'btn btn-md btn-warning px-4' : 'btn btn-md btn-success px-4', 'data-shift-id' => $s->id, 'data-status' => $s->status, 'onclick' => 'assignUser(this)']) }}
                                    {{-- <a class="btn btn-md btn-success px-4" data-shift-id="{{ $s->id }}"
                                        href="{{ route('shift.edit', $s->id) }}">Assign</i></a> --}}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- Modal to add new user starts-->
            @include('shifts.partials.shift_modal')
            @include('shifts.partials.shift_edit_modal')
            <!-- Modal to add new user Ends-->
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $('#shiftsTbl').DataTable();
        $('.select2').select2();

        function assignUser(button) {
            var user_Id = $(button).closest('tr').find('select[name="user_id"]').val();

            var shiftId = $(button).data('shift-id');
            var status = $(button).data('status');

            console.log(user_Id)
            console.log(shiftId)
            $.ajax({
                method: 'PUT',
                url: 'shifts/update/' + shiftId,
                data: {
                    user_id: user_Id,
                    status: status,

                    // Add other data as needed
                },
                success: function(response) {
                    console.log(response);
                    // Optionally update the UI or perform other actions on success
                    // Show a success message to the user
                    showMessage('Assignment successful');
                    setTimeout(function() {
                        location.reload();
                    }, 500);

                },
                error: function(error) {
                    console.log(error);
                    // Handle errors or display error messages
                }
            });
        }


        function showMessage(message) {
            // Create an element to display the message
            var messageElement = $('<div class="alert alert-success">' + message + '</div>');

            // Append the message element to the body or another container of your choice
            $('#message').append(messageElement);

            // Optionally, set a timeout to remove the message after a certain duration
            // setTimeout(function() {
            //     messageElement.remove();
            // }, 5000); // 5000 milliseconds (adjust as needed)
        }
    </script>
@endsection
