@extends('layouts.app')
@section('extra-css')
    <style>
        .custom-grid {
            display: grid;
            grid-gap: 15px;
            /* Adjust the gap between columns as needed */
        }

        @media (max-width: 575.98px) {

            /* For extra small screens (up to 575.98px), set a height of 100px */

            .custom-grid .item {
                height: 350px;
                grid-template-columns: repeat(1, 1fr);
            }
        }

        @media (min-width: 576px) and (max-width: 1092.98px) {

            /* For small screens, display 1 columns */
            .custom-grid .item {
                grid-template-columns: repeat(1, 1fr);
                height: 350px;
            }
        }

        @media (min-width: 1193px) {

            /* For medium screens and larger, display three columns */
            .custom-grid {
                grid-template-columns: repeat(3, 1fr);
                height: 300px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="app-content content">


        <form action="{{ route('sale.store') }}" method="POST">
            @csrf
            @include('sales.form')
        </form>


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
