@extends('layouts.app')

@section('content')
    <div class="app-content content  mx-5 p-5 align-middle">

        <div class="card">
            <div class="card-header">
                <h4>Create Shift</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('shift.store') }}" method="POST">
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

        const Form = {
            shifts: @json(@$shift),
            rowIds: 0,
            tableRow: $('#shiftTbl tbody tr:first').html(),

            init() {
                $.ajaxSetup(config.ajax);

                if (this.shifts) {
                    const request = this.shifts;
                } else {

                }
                // $('#shiftTbl tbody tr:first').remove();



                $('#addstock').click(this.addItem);
                $('#shiftTbl').on('click', '.remove', this.removeRow);


            },
            addItem() {
                Form.rowIds++;
                let i = Form.rowIds;
                const html = Form.tableRow.replace(/-0/g, '-' + i);
                $('#shiftTbl tbody').append('<tr>' + html + '</tr>');
                // $('#shiftTbl').on('change','.deduct', deduct);
            },
            removeRow() {
                const $tr = $(this).parents('tr:first');
                $tr.remove();
            }

        };

        $(() => Form.init());
    </script>
@endsection
