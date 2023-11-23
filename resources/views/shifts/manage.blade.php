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
                <h2>Close Shift</h2>
            </div>
            <div id="message" class="my-2 px-2"></div>
            <div class="row">
                <div class="mx-auto">
                    {{ Form::button('Close Shift', ['class' => 'btn btn-lg btn-danger col-3 py-2 mx-4 float-end ', 'data-shift-id' => $shift->id, 'onclick' => 'closeShift(this)']) }}
                </div>
            </div>




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
                                <td>{{ $s->user->name }}</td>

                                <td>{{ $s->pump->name }}</td>

                                <td>{{ ucfirst($s->status) }}</td>

                                <td>
                                    <!-- Add a data-shift-id attribute to store the shift ID for the current row -->
                                    {{ Form::button($s->status == 'active' ? 'Logout' : 'Login', ['class' => $s->status == 'active' ? 'btn btn-md btn-success px-4' : 'btn btn-md btn-warning px-4', 'data-shift-id' => $s->id, 'data-user-id' => $s->user->id, 'data-status' => $s->status, 'onclick' => 'loginUser(this)']) }}
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

        function loginUser(button) {


            var userId = $(button).data('user-id');
            var shiftId = $(button).data('shift-id');
            var status = $(button).data('status');

            console.log(userId)
            console.log(shiftId)
            $.ajax({
                method: 'PUT',
                url: 'shifts/login/' + shiftId,
                data: {
                    user_id: userId,
                    status: status,

                    // Add other data as needed
                },
                success: function(response) {
                    console.log(response);
                    // Optionally update the UI or perform other actions on success
                    // Show a success message to the user
                    showMessage(response.message, "success");
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

        function closeShift(button) {


            var shiftId = $(button).data('shift-id');

            $.ajax({
                method: 'POST',
                url: 'shifts/close_shift/' + shiftId,

                success: function(response) {
                    // console.log(response.message);
                    // Optionally update the UI or perform other actions on success
                    // Show a success message to the user
                    showMessage(response.message, "success");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);

                },
                error: function(error) {
                    console.log(error);
                    showMessage(error.responseJSON.message, "danger");

                    // Handle errors or display error messages
                }
            });
        }


        function showMessage(message, color) {
            // Create an element to display the message
            var messageElement = $('<div class="alert alert-' + color + '">' + message + '</div>');

            // Append the message element to the body or another container of your choice
            $('#message').append(messageElement);
        }
    </script>
@endsection
