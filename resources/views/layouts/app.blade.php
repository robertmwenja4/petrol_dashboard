<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('include.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('include.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
        <!-- BEGIN: Content-->
        <div class="app-content content ">
    @yield('content')
        </div>
    <!-- END: Content-->
    @include('include.footer')
    @yield('extra-scripts')

</body>
<!-- END: Body-->

</html>