<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Fuel Management Solution">
    <meta name="keywords" content="fuel, management, solution">
    <meta name="author" content="PIXINVENT">
    <title>ORYX</title>
    <link rel="apple-touch-icon" href="{{asset('core/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('core/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/all.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('core/assets/css/bootstrap.min.css')}}"> --}}
    <!-- END: Vendor CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')}}">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('core/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('core/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav bookmark-icons">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
                </ul>
                {{-- <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
                        <div class="bookmark-input search-input">
                            <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                            <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                            <ul class="search-list search-list-bookmark"></ul>
                        </div>
                    </li>
                </ul> --}}
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a>
                        {{-- <a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div> --}}
                </li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                    <div class="search-input">
                        <div class="search-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                        <div class="search-input-close"><i data-feather="x"></i></div>
                        <ul class="search-list search-list-main"></ul>
                    </div>
                </li>
                {{-- <li class="nav-item dropdown dropdown-cart me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span class="badge rounded-pill bg-primary badge-up cart-item-count">6</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">My Cart</h4>
                                <div class="badge rounded-pill badge-light-primary">4 Items</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="{{asset('core/app-assets/images/pages/eCommerce/1.png')}}" alt="donuts" width="62">
                                <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                    <div class="media-heading">
                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Apple watch 5</a></h6><small class="cart-item-by">By Apple</small>
                                    </div>
                                    <div class="cart-item-qty">
                                        <div class="input-group">
                                            <input class="touchspin-cart" type="number" value="1">
                                        </div>
                                    </div>
                                    <h5 class="cart-item-price">$374.90</h5>
                                </div>
                            </div>
                            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="{{asset('core/app-assets/images/pages/eCommerce/7.png')}}" alt="donuts" width="62">
                                <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                    <div class="media-heading">
                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Google Home Mini</a></h6><small class="cart-item-by">By Google</small>
                                    </div>
                                    <div class="cart-item-qty">
                                        <div class="input-group">
                                            <input class="touchspin-cart" type="number" value="3">
                                        </div>
                                    </div>
                                    <h5 class="cart-item-price">$129.40</h5>
                                </div>
                            </div>
                            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="{{asset('core/app-assets/images/pages/eCommerce/2.png')}}" alt="donuts" width="62">
                                <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                    <div class="media-heading">
                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iPhone 11 Pro</a></h6><small class="cart-item-by">By Apple</small>
                                    </div>
                                    <div class="cart-item-qty">
                                        <div class="input-group">
                                            <input class="touchspin-cart" type="number" value="2">
                                        </div>
                                    </div>
                                    <h5 class="cart-item-price">$699.00</h5>
                                </div>
                            </div>
                            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="{{asset('core/app-assets/images/pages/eCommerce/3.png')}}" alt="donuts" width="62">
                                <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                    <div class="media-heading">
                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iMac Pro</a></h6><small class="cart-item-by">By Apple</small>
                                    </div>
                                    <div class="cart-item-qty">
                                        <div class="input-group">
                                            <input class="touchspin-cart" type="number" value="1">
                                        </div>
                                    </div>
                                    <h5 class="cart-item-price">$4,999.00</h5>
                                </div>
                            </div>
                            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="{{asset('core/app-assets/images/pages/eCommerce/5.png')}}" alt="donuts" width="62">
                                <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                    <div class="media-heading">
                                        <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> MacBook Pro</a></h6><small class="cart-item-by">By Apple</small>
                                    </div>
                                    <div class="cart-item-qty">
                                        <div class="input-group">
                                            <input class="touchspin-cart" type="number" value="1">
                                        </div>
                                    </div>
                                    <h5 class="cart-item-price">$2,999.00</h5>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-menu-footer">
                            <div class="d-flex justify-content-between mb-1">
                                <h6 class="fw-bolder mb-0">Total:</h6>
                                <h6 class="text-primary fw-bolder mb-0">$10,999.00</h6>
                            </div><a class="btn btn-primary w-100" href="app-ecommerce-checkout.html">Checkout</a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">5</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                                <div class="badge rounded-pill badge-light-primary">6 New</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list"><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar"><img src="{{asset('core/app-assets/images/portrait/small/avatar-s-15.jpg')}}" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar"><img src="{{asset('core/app-assets/images/portrait/small/avatar-s-3.jpg')}}" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content">MD</div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                    </div>
                                </div>
                            </a>
                            <div class="list-item d-flex align-items-center">
                                <h6 class="fw-bolder me-auto mb-0">System Notifications</h6>
                                <div class="form-check form-check-primary form-switch">
                                    <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                                    <label class="form-check-label" for="systemNotification"></label>
                                </div>
                            </div><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to high CPU usage</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-success">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">Sales report</span>&nbsp;generated</p><small class="notification-text"> Last month sales report generated</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-warning">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">High memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server using high memory</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all notifications</a></li>
                    </ul>
                </li> --}}
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{auth()->user()->name}}</span><span class="user-status">{{auth()->user()->role->name}}</span></div><span class="avatar"><img class="round" src="{{asset('core/app-assets/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        {{-- <a class="dropdown-item" href="page-profile.html"><i class="me-50" data-feather="user"></i> Profile</a><a class="dropdown-item" href="app-email.html"><i class="me-50" data-feather="mail"></i> Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="me-50" data-feather="check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="me-50" data-feather="message-square"></i> Chats</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50" data-feather="settings"></i> Settings</a><a class="dropdown-item" href="page-pricing.html"><i class="me-50" data-feather="credit-card"></i> Pricing</a><a class="dropdown-item" href="page-faq.html"><i class="me-50" data-feather="help-circle"></i> FAQ</a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="me-50" data-feather="power"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <ul class="main-search-list-defaultlist d-none">
        <li class="d-flex align-items-center"><a href="#">
                <h6 class="section-label mt-75 mb-0">Files</h6>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="me-75"><img src="{{asset('core/app-assets/images/icons/xls.png')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                    </div>
                </div><small class="search-data-size me-50 text-muted">&apos;17kb</small>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="me-75"><img src="{{asset('core/app-assets/images/icons/jpg.png')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div><small class="search-data-size me-50 text-muted">&apos;11kb</small>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="me-75"><img src="{{asset('core/app-assets/images/icons/pdf.png')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div><small class="search-data-size me-50 text-muted">&apos;150kb</small>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="me-75"><img src="{{asset('core/app-assets/images/icons/doc.png')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                    </div>
                </div><small class="search-data-size me-50 text-muted">&apos;256kb</small>
            </a></li>
        <li class="d-flex align-items-center"><a href="#">
                <h6 class="section-label mt-75 mb-0">Members</h6>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                <div class="d-flex align-items-center">
                    <div class="avatar me-75"><img src="{{asset('core/app-assets/images/portrait/small/avatar-s-8.jpg')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                <div class="d-flex align-items-center">
                    <div class="avatar me-75"><img src="{{asset('core/app-assets/images/portrait/small/avatar-s-1.jpg')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                <div class="d-flex align-items-center">
                    <div class="avatar me-75"><img src="{{asset('core/app-assets/images/portrait/small/avatar-s-14.jpg')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                <div class="d-flex align-items-center">
                    <div class="avatar me-75"><img src="{{asset('core/app-assets/images/portrait/small/avatar-s-6.jpg')}}" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div>
            </a></li>
    </ul>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="{{url('dashboard')}}"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                        <h2 class="brand-text">ORYX</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="d-flex align-items-center" href="{{route('dashboard.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">Activity</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Users Information</span><i data-feather="more-horizontal"></i>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shield"></i><span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">Roles &amp; Permission</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('role.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Roles">Roles</span></a>
                        </li>
                        {{-- <li><a class="d-flex align-items-center" href="app-access-permission.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Permission">Permission</span></a> --}}
                        </li>
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('user.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>

                    </ul>
                </li>

                <li class=" navigation-header"><span data-i18n="User Activities">User Activities</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Shifts">Shifts</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('shift.shifts_admin')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        {{-- <li><a class="d-flex align-items-center" href="{{route('user_allocation.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shift">Shift Allocation</span></a>
                        </li> --}}
                        <li><a class="d-flex align-items-center" href="{{route('close_shift.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="CLose Shift">CLose Shift</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="GiveCash">GiveCash</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('give_cash.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Manage</span></a>
                        </li>
                        {{-- <li><a class="d-flex align-items-center" href="{{route('user_allocation.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shift">Shift Allocation</span></a>
                        </li> --}}
                        {{-- <li><a class="d-flex align-items-center" href="{{route('close_shift.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="CLose Shift">CLose Shift</span></a>
                        </li> --}}
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Sales">Sales</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Sales Report">Sales Report</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('sale.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Products">Products</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Pumps">Pumps</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('pump.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{route('nozzle.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Nozzle">Nozzle</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Manage Products">Products</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('product.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Fuel Prices">Fuel Prices</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('product_price.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Fuel Prices">Stock Adjustment</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('stock_adjustment.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Purchases">Purchases</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="pie-chart"></i><span class="menu-title text-truncate" data-i18n="Manage Purchase">Purchase</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('purchase.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Customers">Customers</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="pie-chart"></i><span class="menu-title text-truncate" data-i18n="Manage Customers">Customers</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('customer.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="{{route('customer.create')}}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Add Customer">Add Customer</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <main class="py-4">
        
        @yield('content')
    </main>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2023<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">ORYX</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('core/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('core/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <script src="{{asset('core/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/forms/cleave/cleave.min.js')}}"></script>
    <script src="{{asset('core/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js')}}"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('core/app-assets/js/core/app-menu.js')}}"></script>
    {{-- <script src="{{asset('core/app-assets/js/core/jquery.min.js')}}"></script> --}}
    <script src="{{asset('core/app-assets/js/core/app.js')}}"></script>
    {{-- <script src="{{asset('core/assets/js/bootstrap.bundle.min.js')}}"></script> --}}
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('core/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <script src="{{asset('core/app-assets/js/scripts/pages/app-user-list.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
@yield('extra-scripts')
<!-- END: Body-->

</html>
