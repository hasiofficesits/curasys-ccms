<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('images/icon.ico')); ?>" alt="" height="22">
                <?php echo e(URL::asset('images/viki_icon.png')); ?>

            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('images/black_backg.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('images/icon.ico')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('images/black_backg.png')); ?>" alt="" height="60">
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
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="load_dashboard" class="nav-link" >Stock Dashboard</a>
                            </li>
                            
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="las la-store"></i> <span>Stores</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="stock_list" class="nav-link">Item List</a>
                            </li>
                            <li class="nav-item">
                                <a href="stock_category" class="nav-link">Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="adjustment" class="nav-link">Adjustment</a>
                            </li>
                            <li class="nav-item">
                                <a href="purchase_order" class="nav-link">Purchase Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="grn_page" class="nav-link">GRN</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSuplier" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSuplier">
                        <i class="las la-store"></i> <span>Supplier</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSuplier">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="suplier" class="nav-link">List</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="las la-utensils"></i> <span>Outlets</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="outlet_page" class="nav-link">List</a>
                            </li>
                            <li class="nav-item">
                                <a href="stock_order" class="nav-link">Stock Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="stock_issue" class="nav-link">Stock Issue</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSettings" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSettings">
                        <i class="las la-clipboard-list"></i> <span>Reports</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSettings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="adjsum" class="nav-link">Adjusment Summary</a>
                            </li>
                            <li class="nav-item">
                                <a href="order_sum" class="nav-link">Outlet Order Summary</a>
                            </li>
                            <li class="nav-item">
                                <a href="item_sales" class="nav-link">Sales Summary</a>
                            </li>
                        </ul>
                    </div>
                    
                </li>

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
<?php /**PATH D:\Intern\KARRS-Chamee\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>