  <!-- BEGIN: Main Menu-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-semi-dark/index.html"><span class="brand-logo">
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

    @php
    $segment1 = Request::segment(1);
    $segment2 = Request::segment(2);
@endphp
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span></a>
                    </li>
                    <li ><a class="d-flex align-items-center" href="dashboard-ecommerce.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">eCommerce</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Academics  Module</span><i data-feather="more-horizontal"></i>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate" data-i18n="User">School Settings</span></a>
                <ul class="menu-content">
                    <li class="{{ ($segment1 == 'stream') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('stream.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Stream</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'subject') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('subject.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Subject </span></a>
                    </li>
                    <li class="{{ ($segment1 == 'schoolsubject') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('schoolsubject.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">School Subject </span></a>
                    </li>
                    <li class="{{ ($segment1 == 'allocationconfig') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('allocationconfig.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Allocation Config </span></a>
                    </li>
                    <li class="{{ ($segment1 == 'countysubcounty') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('countysubcounty.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">County & SubCounty </span></a>
                    </li>

                
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Student Master</span></a>
                <ul class="menu-content">
                    <li class="{{ ($segment1 == 'student' &&  $segment2 == '') ||($segment1 == 'student' &&  $segment2 == 'edit') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('student.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Manage</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'studentimport' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('studentimport')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Import</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'studsubjectalloc' || $segment1 == 'subjectallocation' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('studsubjectalloc.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Subject Allocation</span></a>
                    </li>

                    
              
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='user-plus'></i><span class="menu-title text-truncate" data-i18n="User">Staff Master</span></a>
                <ul class="menu-content">
                    <li class="{{ ($segment1 == 'staff' &&  $segment2 == '') ||($segment1 == 'staff' &&  $segment2 == 'edit') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('staff.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Manage</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'teachersubjectalloc' || $segment1 == 'teachersubjectallocation' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('teachersubjectalloc.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Subject Allocation</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'classteacher' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('classteacher.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Class Teacher</span></a>
                    </li>

                    
                </ul>
            </li>
          
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"> <i data-feather='tool'></i><span class="menu-title text-truncate" data-i18n="User">Academic Settings</span></a>
                <ul class="menu-content">
                    <li class="{{ ($segment1 == 'academicyear') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('academicyear.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Academic Year</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'schoolterm') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('schoolterm.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">School Term</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'grades' ) ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('grades.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Grade Remarks</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'meangrade' || $segment1 == 'filtermeangrade' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('meangrade.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Mean Grade</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'subjectgrade' || $segment1 == 'filtersubjectgrade'  ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('subjectgrade.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Subject Grades</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'subjectremarks'  ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('subjectremarks.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Subject Remarks</span></a>
                    </li>
                   
               

                     
                </ul>
            </li>

            
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='paperclip'></i><span class="menu-title text-truncate" data-i18n="User">Exams Center</span></a>
                <ul class="menu-content">
                    
                    <li class="{{ ($segment1 == 'exams'  ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('exams.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Exams</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'marks' || $segment1 == 'filterstudent'   ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('marks.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add Marks</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'results' || $segment1 == 'meritbystream' || $segment1 == 'subjectstreamanalysis' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('results.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Exam Analysis</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'generatereportcard' || $segment1 == 'filterreportcard' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('generatereportcard.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Gen. Report Card</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'viewreportcard' || $segment1 == 'showreportcard' ) ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('viewreportcard')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Print Report Card</span></a>
                    </li>

                     
                </ul>
            </li>

           
           
            
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='layers'></i><span class="menu-title text-truncate" data-i18n="User">Institutions</span></a>
                <ul class="menu-content">
                    <li class="{{ ($segment1 == 'institution' &&  $segment2 == '') ||($segment1 == 'institution' &&  $segment2 == 'edit') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('institution.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Manage</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'institution' &&  $segment2 == 'create') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('institution.create')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add</span></a>
                    </li>
              
                </ul>
            </li>

            
            <li class=" nav-item {{ ($segment1 == 'roles') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('roles')}}"><i data-feather="shield"></i><span class="menu-title text-truncate" data-i18n="Todo">Roles &amp; Permission </span></a> </li> 

            <li class=" navigation-header"><span data-i18n="User Interface">Tender Module</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item {{ ($segment1 == 'tendercategorymaster') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('tendercategorymaster.index')}}"><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Tender Category</span></a>
            </li>
            <li class=" nav-item {{ ($segment1 == 'requirement') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('requirement.index')}}"><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Tender Requirement</span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Tender Master</span></a>
                <ul class="menu-content">
                    <li class="{{ ($segment1 == 'tendermaster' &&  $segment2 == '') ||($segment1 == 'tendermaster' &&  $segment2 == 'edit') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('tendermaster.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Manage</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'tendermaster' &&  $segment2 == 'create') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('tendermaster.create')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Add</span></a>
                    </li>
              
                </ul>
            </li>
            <li class=" navigation-header"><span data-i18n="User Interface">Finance Module</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item {{ ($segment1 == 'studentreceipt' || $segment1 == 'filterstudentfees') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('studentreceipt.index')}}"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Todo">Collect Fees </span></a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate" data-i18n="User">Account Settings</span></a>
                <ul class="menu-content">
                    <li class="{{ ($segment1 == 'financialyear') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('financialyear.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Financial Year </span></a>
                    </li> 
                    <li class="{{ ($segment1 == 'accountgroup') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('accountgroup.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Account Group</span></a>
                    </li>
                    <li class="{{ ($segment1 == 'votehead') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('votehead.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Voteheads </span></a>
                    </li>
                    <li class="{{ ($segment1 == 'chartsofaccount') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('chartsofaccount.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Charts Of Accounts </span></a>
                    </li>
                    <li class="{{ ($segment1 == 'feesstructure' || $segment1 == 'filterfees') ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('feesstructure.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Fees Structure </span></a>
                    </li> 
                                  
                </ul>
            </li>
            <li class=" nav-item {{ ($segment1 == 'studentinvoicing'|| $segment1 == 'showstudentinvoices' || $segment1 == 'showfeesitem') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('studentinvoicing.index')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Todo">Student Invoicing</span></a>
            </li>
            
            <li class=" navigation-header"><span data-i18n="User Interface">Transport</span><i data-feather="more-horizontal"></i>
            </li>

            <li class=" nav-item {{ ($segment1 == 'transportzones') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('transportzones.index')}}"><i data-feather='move'></i><span class="menu-title text-truncate" data-i18n="Todo">Transport Zones </span></a> </li>
            <li class=" nav-item {{ ($segment1 == 'vehicle') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('vehicle.index')}}"><i data-feather='truck'></i><span class="menu-title text-truncate" data-i18n="Todo">Vehicles </span></a> </li> 
            <li class=" nav-item {{ ($segment1 == 'transportallocation' ||$segment1 == 'transalloc') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('transportallocation.index')}}"><i data-feather='plus'></i><span class="menu-title text-truncate" data-i18n="Todo">Allocate Students </span></a> </li>   


            <li class=" navigation-header"><span data-i18n="User Interface">Cocurricular</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item {{ ($segment1 == 'cocurricular') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('cocurricular.index')}}"><i data-feather='dribbble'></i><span class="menu-title text-truncate" data-i18n="Todo">Cocurricular </span></a> </li>
            <li class=" nav-item {{ ($segment1 == 'cocurricularallocation' ||$segment1 == 'cocurricalloc') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('cocurricularallocation.index')}}"><i data-feather='plus'></i><span class="menu-title text-truncate" data-i18n="Todo">Allocate Students </span></a> </li>   
             --}}

        </ul>
    </div>
</div>
<!-- END: Main Menu-->