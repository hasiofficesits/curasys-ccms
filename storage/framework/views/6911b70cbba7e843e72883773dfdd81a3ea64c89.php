
<?php $__env->startSection('title'); ?> Management Dashboard <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Dashboards <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Management Dashboard <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="mt-3 mt-lg-0">
                             <form action="javascript:void(0);">
                                <div class="row g-3 mb-0 align-items-center">
                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control border-0 dash-filter-picker shadow"
                                                data-provider="flatpickr" data-range-date="true"
                                                data-date-format="d M, Y"
                                                data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                            <div class="input-group-text bg-primary border-primary text-white">
                                                <i class="ri-calendar-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Doctors</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo e($doctor_count); ?>">0</span></h4>
                                    <a href="load_doctor" class="text-decoration-underline">View Doctors</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="bx bx-plus-medical text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Patients</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo e($patient_count); ?>">0</span></h4>
                                    <a href="load_patient" class="text-decoration-underline">View patients</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                        <i class="bx bx-user text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">OPD Services</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo e($opd_service_count); ?>">0</span></h4>
                                    <a href="load_opd_page" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning rounded fs-3">
                                        <i class="bx bxs-building text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Current Users</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo e($user_count); ?>">0</span></h4>
                                    <a href="load_users" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-sitemap text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header align-items-center d-flex">
                            <h5 class="card-title mb-0 flex-grow-1">Patient Arrival Summary</h5>
                            <div class="flex-shrink-0">
                                <select class="form-select form-select-sm" id="chartYearFilter">
                                    <?php
                                        $currentYear = date('Y');
                                        $startYear = $currentYear - 4; 
                                    ?>
                                    <?php for($i = $currentYear; $i >= $startYear; $i--): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($i == $currentYear ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div><div class="card-body">
                            <div id="patient_arrival_chart" data-colors='["--vz-primary", "--vz-success", "--vz-warning"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Doctors by Speciality</h4>
                        </div>
                        <div class="card-body">
                            <div id="doctor_speciality_chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>

<script>
    // Color Array
    function getChartColorsArray(chartId) {
        if (document.getElementById(chartId) !== null) {
            var colors = document.getElementById(chartId).getAttribute("data-colors");
            if (colors) {
                colors = JSON.parse(colors);
                return colors.map(function (value) {
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
        return null;
    }

    var chartDom = document.getElementById('patient_arrival_chart');
    var chart = null; 

    if(chartDom){
        var chartColors = getChartColorsArray("patient_arrival_chart");
        
        var initialData = <?php echo json_encode($chartData ?? [], 15, 512) ?>; 

        var options = {
            series: [{
                name: 'Patients Arrived',
                data: initialData
            }],
            chart: {
                height: 350,
                type: 'bar', 
                toolbar: { show: false }
            },
            colors: chartColors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                    borderRadius: 4
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: { title: { text: 'Count' } },
            grid: { borderColor: '#f1f1f1' }
        };

        chart = new ApexCharts(document.querySelector("#patient_arrival_chart"), options);
        chart.render();
    }

    var yearFilter = document.getElementById('chartYearFilter');
    if(yearFilter) {
        yearFilter.addEventListener('change', function() {
            var selectedYear = this.value;

            fetch("<?php echo e(route('get.patient.chart.data')); ?>?year=" + selectedYear)
                .then(response => response.json())
                .then(data => {
                    if(chart) {
                        chart.updateSeries([{
                            name: 'Patients Arrived',
                            data: data
                        }]);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    }

    var specialityDom = document.getElementById('doctor_speciality_chart');
    
    if(specialityDom){
        // Get data from Laravel
        var specialityLabels = <?php echo json_encode($specialityLabels, 15, 512) ?>;
        var specialityCounts = <?php echo json_encode($specialityCounts, 15, 512) ?>;

        var options = {
            series: specialityCounts,
            labels: specialityLabels,
            chart: {
                type: 'donut',
                height: 350,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '45%',
                        labels: {
                            show: true,
                            total: {
                                showAlways: true,
                                show: true,
                                label: 'Total Doctors',
                                fontSize: '15px',
                                fontWeight: 600,
                                color: '#495057',
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom'
            },
            // You can customize colors here or let ApexCharts pick them
            colors: ['#405189', '#0ab39c', '#f7b84b', '#f06548', '#299cdb'], 
        };

        var chartSpeciality = new ApexCharts(document.querySelector("#doctor_speciality_chart"), options);
        chartSpeciality.render();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/management/dashboard/management-dashboard.blade.php ENDPATH**/ ?>