@extends('layouts.user')

@section('content')
    <div class="col-md-6 mx-4 mb-2">
        <div class="card ">
            <div class="card-header">
                <h4>Shift Details</h4>

            </div>
            <div class="card-body">
                <h4>Shift Name : {{ $shift->shift_name }} - {{ $shift->shift_type->name }}</h4>
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
            <form id="closeShiftForm" action="{{ route('shift.close_shift') }}" method="POST">
                @csrf
                @include('sales.passkey_modal')
                <div class="row">
                    {{ Form::hidden('shift_id', $shift->id) }}
                    <div class="mx-auto">
                        {{ Form::button('Close Shift', ['class' => 'btn btn-lg btn-danger col-3 py-2 mx-4 float-end ', 'id' => 'closeShiftBtn']) }}
                    </div>
                </div>

            </form>


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
                                <td>{{ @$s->user->name }}</td>

                                <td>{{ $s->pump ? $s->pump->name : '' }}</td>

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
        $('#closeShiftBtn').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            $('#passKeyModal').modal('show');
        });
        $('#closeShiftForm').on('submit', function(e) {

            e.preventDefault();

            var data = $(this).serialize();
            // $("#spinner").show();
            $("#modalButton").hide();
            $.ajax({
                method: "post",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result.success == true) {

                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });

                        // var url = "{{ route('print_invoice') }}?id=" + result.data.id;
                        // window.open(url, "Receipt", "width=500,height=600");
                        location.reload();
                    } else {
                        $("#modalButton").show();
                        // $("#spinner").hide();


                        Swal.fire({
                            position: 'top',
                            title: 'Error!',
                            text: result.msg,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });

                    }
                }
            });

        });

        function showMessage(message, color) {
            // Create an element to display the message
            var messageElement = $('<div class="alert alert-' + color + '">' + message + '</div>');

            // Append the message element to the body or another container of your choice
            $('#message').append(messageElement);
        }
    </script>
@endsection
