<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/favicon.png') }}" alt="" height="25">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo-white.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/favicon.png') }}" alt="" height="25">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo-white.png') }}" alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    {{-- <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="load_dashboard" class="nav-link" >Dashboard</a>
                            </li>
                            
                        </ul>
                    </div> --}}
                </li> <!-- end Dashboard Menu -->
                @if(Session::get('menu')=="management")

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_management_view" class="nav-link">Dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDoctor" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDoctor">
                            <i class="las la-stethoscope"></i> <span>Doctor</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDoctor">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_doctor" class="nav-link">List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarPatient" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarPatient">
                            <i class="las la-user-injured"></i> <span>Patient</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarPatient">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_patient" class="nav-link">List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarOPD" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarOPD">
                            <i class="las la-user-nurse"></i> <span>OPD Services</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarOPD">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_opd_page" class="nav-link">List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->

                    {{-- <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAcc" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAcc">
                            <i class="las la-cog"></i> <span>Account Settings</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAcc">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_acc_set" class="nav-link">List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu --> --}}

                    <hr class="text-white">

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarUser">
                            <i class="las la-user-shield"></i> <span>User</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarUser">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_users" class="nav-link">List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->

                @endif

                @if(Session::get('menu')=="appointment")
                    
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAppointment" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAppointment">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAppointment">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_appointment_view" class="nav-link">Dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAppointment" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAppointment">
                            <i class="las la-list"></i> <span>Appointment</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAppointment">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_appointment_page" class="nav-link">New Appointment</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSet" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarSet">
                            <i class="las la-cog"></i> <span>Settings</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSet">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_dosage_page" class="nav-link">Dosage List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="load_frequency_page" class="nav-link">Frequency List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                @endif

                @if(Session::get('menu')=="cashier")
                    
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_cashier_view" class="nav-link">Dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAppointment" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAppointment">
                            <i class="las la-list"></i> <span>Appointment</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAppointment">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="cashier_appointment_page" class="nav-link">Book Appointment</a>
                                </li>
                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_complete_page" class="nav-link">Completed Appointment</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSales" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarSales">
                            <i class="las la-receipt"></i> <span>Sales</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSales">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_sales_page" class="nav-link">Sales</a>
                                </li>
                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_due_inv_page" class="nav-link">Due Invoice</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                @endif

                @if(Session::get('menu')=="stock")

                    {{-- <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a> --}}

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_stock_view" class="nav-link">Dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarStock" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarStock">
                            <i class="las la-store"></i> <span>Stock</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarStock">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_stock_item_page" class="nav-link">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="load_stock_location_page" class="nav-link">Location</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarGrn" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarGrn">
                            <i class="las la-inbox"></i> <span>GRN</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarGrn">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_grn_page" class="nav-link">GRN List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarStkReturn" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarStkReturn">
                            <i class="las la-undo"></i> <span>Stock Return</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarStkReturn">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_return_note_page" class="nav-link">List</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    {{-- <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarsales" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarsales">
                            <i class="las la-chart-area"></i> <span>Sales Statistics</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarsales">
                            <ul class="nav nav-sm flex-column">
                                
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu --> --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSetting" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarSetting">
                            <i class="las la-cog"></i> <span>Settings</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSetting">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_category_page" class="nav-link">Stock Category</a>
                                </li>
                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_group_page" class="nav-link">Stock Group</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    
                @endif

                @if(Session::get('menu')=="reports")
                    
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_report_view" class="nav-link">Dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAppointment" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAppointment">
                            <i class="las la-list"></i> <span>Stock</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAppointment">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_current_stock_report" class="nav-link">Stock Summary Report</a>
                                </li>
                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="load_expred_stock_report" class="nav-link">Expired Stock Lot Report</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSales" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarSales">
                            <i class="las la-receipt"></i> <span>Sales</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSales">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Report 1</a>
                                </li>
                            </ul>
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Report 2</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                @endif


                <li class="nav-item">
                    <a class="nav-link menu-link" onclick="logoutAsk()" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="las la-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<!-- Default Modals -->
<div id="logout_modal" class="modal fade fadeInLeft" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-3 bg-light">
                <h5 class="modal-title" style="padding-bottom: 2%" id="myModalLabel">Logout</h5>
                <button type="button" style="padding-bottom: 2%" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <p>Do you wish to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btn_save_recipe" class="btn btn-danger"
                    onclick="logoutCall()">Logout</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    token = $('meta[name="csrf-token"]').attr('content');

    function logoutAsk() {
        $('#logout_modal').modal('show');
    }

    function logoutCall() {
        // document.getElementById("custom_overlay").style.display = "block";
        $('#logout_model').modal('hide');
        $.ajax({
            url: "/logout",
            type: "POST",
            data: {
                _token: token
            },
            success: function(response) {

                window.location = "/"
                document.getElementById("custom_overlay").style.display = "none";
            },
            error: function(error) {
                document.getElementById("custom_overlay").style.display = "none";
                console.log(error);
            }
        });
    }
</script>
