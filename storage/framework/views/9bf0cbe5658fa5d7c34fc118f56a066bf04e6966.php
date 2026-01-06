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
                    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                    
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="las la-bell"></i> <span>Counter</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link">Take Away</a>
                            </li>
                            <li class="nav-item">
                                <a href="dinein_page" class="nav-link">Dinein</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="las la-store"></i> <span>Stores</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="kitchen_page" class="nav-link">Kitchen</a>
                            </li>
                            <li class="nav-item">
                                <a href="counter_page" class="nav-link">Counter</a>
                            </li>
                            <li class="nav-item">
                                <a href="transferin_page" class="nav-link">Transfer In</a>
                            </li>
                            <li class="nav-item">
                                <a href="adjustment_page" class="nav-link">Stock Adjustment</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="las la-utensils"></i> <span>Kitchen</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="kot_dashboard" class="nav-link">KOT Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached" class="nav-link">KOT List</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column" class="nav-link">Balance Stock</a>
                            </li>
                        </ul>
                    </div>
                    
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="las la-user-friends"></i> <span>People</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal" class="nav-link">Customer</a>
                            </li>
                            <li class="nav-item">
                                <a href="employee_page" class="nav-link">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column" class="nav-link">Supplier</a>
                            </li>
                        </ul>
                    </div>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="las la-sliders-h"></i> <span>Setting</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="tables_page" class="nav-link">Table</a>
                            </li>
                            <li class="nav-item">
                                <a href="category_page" class="nav-link">Stock Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="recipe_page" class="nav-link">Recipe</a>
                            </li>
                            <li class="nav-item">
                                <a href="recipe_type_page" class="nav-link">Recipe Type</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column" class="nav-link">Menu Card</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column" class="nav-link">Account</a>
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
                                <a href="invo_summary" class="nav-link">Invoice Summary</a>
                            </li>
                            <li class="nav-item">
                                <a href="kot_summary" class="nav-link">KOT Summary</a>
                            </li>
                            <li class="nav-item">
                                <a href="adj_summary" class="nav-link">Adjustment Summary</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Summary II</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Summary III</a>
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
<?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>