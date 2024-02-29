@extends('layouts.user')

@section('content')
    <div class="app-content content  mx-5 p-5 align-middle">

        <div class="card">
            <div class="card-header">
                <h4>Create Shift</h4>

            </div>
            <div class="card-body">
                <form id="shiftForm" action="{{ route('shifts.store_shift') }}" method="POST">
                    @csrf
                    @include('shifts.form')
                </form>
            </div>
        </div>

    </div>
@endsection

@section('extra-scripts')
    <script type="text/javascript">
        config = {
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
        };
        $('.select2').select2();
        $('#createShiftBtn').click(function(event) {
            event.preventDefault();
            if (validateForm()) {
                $('#passKeyModal').modal('show');
            } else {
                Swal.fire({
                    position: 'top',
                    title: 'Error!',
                    text: 'Please select time so as to proceed.',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }
        });
        $('#shiftForm').on('submit', function(e) {

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

                        console.log(result.data);
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

        function validateForm() {
            var timeSelect = $('#timeSelect');
            // Perform your validation logic here
            if (
                timeSelect.val().trim() === ''
            ) {
                return false; // Validation failed
            }

            return true; // Validation passed
        }
    </script>
@endsection
