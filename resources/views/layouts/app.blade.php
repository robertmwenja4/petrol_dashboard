<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Oryx') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('core/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('core/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('core/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('core/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('core/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Oryx') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown text-background-white">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('core/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
    <script src="{{ asset('core/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
    {{-- <script src="{{ asset('core/app-assets/js/core/jquery.min.js') }}"></script> --}}
    @yield('extra-scripts')
</body>


</html>
