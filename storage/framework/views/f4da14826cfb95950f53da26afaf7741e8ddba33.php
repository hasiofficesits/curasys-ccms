
<?php $__env->startSection('title'); ?>
    Cashier Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboards
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Cashier Dashboard
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">

            <div class="h-100">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    Channelling Revenue</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                    LKR. <span class="counter-value"
                                                        data-target="<?php echo e($monthly_channel_income); ?>"
                                                        data-decimals="2">0.00</span>
                                                </h4>
                                                <a href="" class="text-muted">Monthly Wise</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-success rounded fs-3">
                                                    <i class="bx bx-shopping-bag text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                    Pharmacy Revenue</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">LKR. <span
                                                        class="counter-value" data-target="<?php echo e($monthly_pharmacy_income); ?>"
                                                        data-decimals="2">0.00</span></h4>
                                                <a href="" class="text-muted">Monthly Wise</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded fs-3">
                                                    <i class="bx bx-shopping-bag text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h4>Net Profit</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="column_chart" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]'
                                            class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Today's Channels List</h4>

                                <div class="flex-shrink-0">
                                    <div class="d-flex align-items-center">
                                        <span class="text-muted fs-12 me-2">Select Doctor:</span>
                                        <select class="form-select form-select-sm" style="min-width: 150px;">
                                            <option value="all" selected>All Doctors</option>
                                            <option value="dr_smith">Dr. Sarah Smith</option>
                                            <option value="dr_jones">Dr. Michael Jones</option>
                                            <option value="dr_lee">Dr. Emily Lee</option>
                                            <option value="dr_brown">Dr. David Brown</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Patient Name</th>
                                                <th scope="col">Channel No</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Doctor (Ref)</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">John Doe</h5>
                                                            <span class="text-muted">077-1234567</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">#01</h5>
                                                </td>
                                                <td>
                                                    <span class="text-muted">08:30 AM</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Dr. Sarah Smith</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-warning">Waiting</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">Alice Williams</h5>
                                                            <span class="text-muted">071-9876543</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">#02</h5>
                                                </td>
                                                <td>
                                                    <span class="text-muted">08:45 AM</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Dr. Sarah Smith</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-success">Completed</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">Robert Wilson</h5>
                                                            <span class="text-muted">076-5554444</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">#05</h5>
                                                </td>
                                                <td>
                                                    <span class="text-muted">09:15 AM</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Dr. Michael Jones</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-danger">Cancelled</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">Emily Clark</h5>
                                                            <span class="text-muted">070-1122334</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">#08</h5>
                                                </td>
                                                <td>
                                                    <span class="text-muted">10:00 AM</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Dr. Sarah Smith</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-warning">Waiting</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">Michael K.</h5>
                                                            <span class="text-muted">077-8889999</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">#12</h5>
                                                </td>
                                                <td>
                                                    <span class="text-muted">10:30 AM</span>
                                                </td>
                                                <td>
                                                    <span class="text-primary">Dr. David Brown</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-primary">In Progress</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div
                                    class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Showing <span class="fw-semibold">5</span> of <span
                                                class="fw-semibold">12</span> Appointments
                                        </div>
                                    </div>
                                    <div class="col-sm-auto mt-3 mt-sm-0">
                                        <ul
                                            class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                            <li class="page-item disabled">
                                                <a href="#" class="page-link">←</a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="#" class="page-link">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">→</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('script'); ?>
            <!-- apexcharts -->
            <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
            <script src="<?php echo e(URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
            <script src="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.js')); ?>"></script>
            <!-- dashboard init -->
            <script src="<?php echo e(URL::asset('/assets/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
            <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
            <script>
                function getChartColorsArray(chartId) {
                    if (document.getElementById(chartId) !== null) {
                        var colors = document.getElementById(chartId).getAttribute("data-colors");
                        if (colors) {
                            colors = JSON.parse(colors);
                            return colors.map(function(value) {
                                var newValue = value.replace(" ", "");
                                if (newValue.indexOf(",") === -1) {
                                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                                    if (color) return color.trim();
                                    else return newValue;
                                } else {
                                    return value;
                                }
                            });
                        }
                    }
                    return null; // Return null if no colors found
                }

                // --- Main Chart Logic ---
                document.addEventListener('DOMContentLoaded', function() {
                    // 1. Get the colors from your HTML container
                    var chartColors = getChartColorsArray("column_chart");

                    // 2. Define the chart options with sample data matching the image
                    var options = {
                        chart: {
                            height: 350,
                            type: 'bar',
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                borderRadius: 4 // Gives the bars slightly rounded top corners
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        // Sample Data based on the reference image
                        series: [{
                            name: 'Pharmacy',
                            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                        }, {
                            name: 'Channeling',
                            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                        }, {
                            name: 'Free Cash Flow',
                            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                        }],
                        xaxis: {
                            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                        },
                        yaxis: {
                            title: {
                                text: 'LKR. (thousands)'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        colors: chartColors, // Use the colors parsed from your data-colors attribute
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return "LKR. " + val + " thousands"
                                }
                            }
                        }
                    };

                    // 3. Render the chart
                    var chart = new ApexCharts(document.querySelector("#column_chart"), options);
                    chart.render();
                });
            </script>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/cashier/dashboard/cashier-dashboard.blade.php ENDPATH**/ ?>