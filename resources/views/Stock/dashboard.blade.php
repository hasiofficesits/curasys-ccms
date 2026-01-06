@extends('layouts.master')
@section('title') Stock Dashboard @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Stock Dashboard @endslot
@endcomponent
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
                                            <div
                                                class="input-group-text bg-primary border-primary text-white">
                                                <i class="ri-calendar-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    {{-- <div class="col-auto">
                                        <button type="button" class="btn btn-soft-success"><i
                                                class="ri-add-circle-line align-middle me-1"></i>
                                            Add Product</button>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <button type="button"
                                            class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                class="ri-pulse-line"></i></button>
                                    </div>
                                    <!--end col--> --}}
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Products</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                            class="counter-value" data-target="{{$pharma_item_count}}">{{ $pharma_item_count }}</span>
                                    </h4>
                                    <a href="/load_stock_item_page" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="bx bx-store-alt text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Low Stock Products</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                            class="counter-value" data-target="{{$low_stock}}">{{$low_stock}}</span></h4>
                                    <a href="/load_stock_item_page" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning rounded fs-3">
                                        <i class="bx bx-message-alt-error text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Out of Stock</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                            class="counter-value" data-target="{{$out_of_stock_item_count}}">{{$out_of_stock_item_count}}</span>
                                    </h4>
                                <a href="/load_stock_item_page" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-danger rounded fs-3">
                                        <i class="bx bx-cart text-danger"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p
                                        class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Sales This Month</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">LKR <span
                                            class="counter-value" data-target="{{$get_invoice_total}}">{{ number_format($get_invoice_total, 2) }}</span>
                                    </h4>
                                    <a href="" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-wallet text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            {{-- Chart area --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Monthly Sales</h4>
                        </div>
                        <div class="card-body">
                            <div id="Monthly_sales_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Stock distribution by category</h4>
                        </div>
                        <div class="card-body">
                            <div id="simple_pie_chart"
                            data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                            class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    var sales_data = [];

    load_sales_to_chart();

    // get colors array from the string
    function getChartColorsArray(chartId) {
        if (document.getElementById(chartId) !== null) {
            var colors = document.getElementById(chartId).getAttribute("data-colors");
            if (colors) {
                colors = JSON.parse(colors);
                return colors.map(function(value) {
                    var newValue = value.replace(" ", "");
                    if (newValue.indexOf(",") === -1) {
                        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                        if (color) return color;
                        else return newValue;;
                    } else {
                        var val = value.split(',');
                        if (val.length == 2) {
                            var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                            rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                            return rgbaColor;
                        } else {
                            return newValue;
                        }
                    }
                });
            }
        }
    }

    // Column with Datalabels

    var chartColumnDatatalabelColors = getChartColorsArray("Monthly_sales_chart");

    function load_sales_to_chart() {
        $.ajax({
            url: "{{ route('load_sales_to_chart') }}",
            method: "GET",
            success: function(response) {
                sales_data = response.data
                // console.log(sales_data)
                
                if (chartColumnDatatalabelColors) {
                    var options = {
                        chart: {
                            height: 350,
                            type: 'bar',
                            toolbar: {
                                show: false,
                            }
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    position: 'top', // top, center, bottom
                                },
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function(val) {
                                return val; // Remove the "%" sign since your data is not in percentage format
                            },
                            offsetY: -20,
                            style: {
                                fontSize: '12px',
                                colors: ["#adb5bd"]
                            }
                        },
                        series: [{
                            name: 'Sales', // Change the name to something relevant
                            data: sales_data // Use the dynamic data here
                        }],
                        colors: chartColumnDatatalabelColors,
                        grid: {
                            borderColor: '#f1f1f1',
                        },
                        xaxis: {
                            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], // Months
                            position: 'top',
                            labels: {
                                offsetY: -18,
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        colorFrom: '#D8E3F0',
                                        colorTo: '#BED1E6',
                                        stops: [0, 100],
                                        opacityFrom: 0.4,
                                        opacityTo: 0.5,
                                    }
                                }
                            },
                            tooltip: {
                                enabled: true,
                                offsetY: -35,
                            }
                        },
                        fill: {
                            gradient: {
                                shade: 'light',
                                type: "horizontal",
                                shadeIntensity: 0.25,
                                gradientToColors: undefined,
                                inverseColors: true,
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: [50, 0, 100, 100]
                            },
                        },
                        yaxis: {
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                show: false,
                                formatter: function(val) {
                                    return val; // Remove the "%" sign since your data is not in percentage format
                                }
                            }
                        },
                        title: {
                            text: 'Monthly Sales Trends', // Update the title
                            floating: true,
                            offsetY: 330,
                            align: 'center',
                            style: {
                                color: '#444'
                            },
                            style: {
                                fontWeight: 500,
                            },
                        },
                    };

                    var chart = new ApexCharts(
                        document.querySelector("#Monthly_sales_chart"),
                        options
                    );

                    chart.render();
                }
            }
        })
    }

    var chartPieBasicColors = getChartColorsArray("simple_pie_chart");
    if(chartPieBasicColors){
    var options = {
        series: [44, 55, 13, 43, 22],
        chart: {
            height: 300,
            type: 'pie',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        legend: {
            position: 'bottom'
        },
        dataLabels: {
            dropShadow: {
                enabled: false,
            }
        },
        colors: chartPieBasicColors
    };

    var chart = new ApexCharts(document.querySelector("#simple_pie_chart"), options);
    chart.render();
    }
</script>
@endsection
