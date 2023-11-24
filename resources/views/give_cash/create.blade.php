@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white">
        {{ Form::open(['route' => 'give_cash.store']) }}

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

        $('.select2').select2();
    </script>
@endsection
