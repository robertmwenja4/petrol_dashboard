@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white">
        {{ Form::open(['route' => 'give_cash.store', 'id' => 'giveCashForm']) }}

        @include('give_cash.form')

        {{ Form::close() }}
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

        $('#giveCashBtn').click(function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            if (validateForm()) {
                $('#passKeyModal').modal('show');
            } else {
                alert('Please fill out all required fields.');
            }
        });
        //validate form before opening modal
        function validateForm() {
            var pumpSelect = $('#pumpSelect');
            var cashAmount = $('#cashAmount');


            // Perform your validation logic here
            if (
                pumpSelect.val().trim() === '' ||
                cashAmount.val().trim() === ''
            ) {
                return false; // Validation failed
            }

            return true; // Validation passed
        }

        $('#giveCashForm').on('submit', function(e) {

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
                            position: 'top-end',
                            icon: 'success',
                            title: result.msg,
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });

                        var url = "{{ route('print_cash_receipt') }}?id=" + result.data.id;
                        window.open(url, "Receipt", "width=500,height=600");
                        location.reload();
                    } else {
                        $("#modalButton").show();
                        // $("#spinner").hide();


                        Swal.fire({
                            position: 'top-end',
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





            // newUserSidebar.modal('hide');

        });
    </script>
@endsection
