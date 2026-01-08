@extends('layouts.master')
@section('title') Management Dashboard @endsection
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6">
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
                                            class="counter-value" data-target="{{$stock_item_count}}">0</span>
                                    </h4>
                                    <a href="load_stock_item_page" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="bx bx-store-alt text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
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
                                            class="counter-value" data-target="{{$low_stock_count}}">0</span></h4>
                                    <a href="load_stock_item_page" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning rounded fs-3">
                                        <i class="bx bx-message-alt-error text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
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
                                            class="counter-value" data-target="{{$out_of_stock_count}}">0</span>
                                    </h4>
                                <a href="load_stock_item_page" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-danger rounded fs-3">
                                        <i class="bx bx-cart text-danger"></i>
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
                            <h4 class="card-title mb-0 flex-grow-1">Product Lot Status (Qty by Lot)</h4>
                            
                            <div class="flex-shrink-0">
                                <select class="form-select form-select-sm" id="productLotFilter" style="min-width: 200px;">
                                    <option value="" selected disabled>Select a Product...</option>
                                    @foreach($products_list as $product)
                                        <option value="{{ $product->ID }}">{{ $product->Pharma_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div id="lot_status_chart" data-colors='["--vz-info"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Inventory by Dosage Type</h4>
                        </div>
                        <div class="card-body">
                            <div id="dosage_pie_chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

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

    var lotChart = null;
    var lotChartDom = document.getElementById('lot_status_chart');

    if (lotChartDom) {
        var lotColors = getChartColorsArray("lot_status_chart"); // Uses your existing helper

        var lotOptions = {
            series: [{
                name: 'Quantity',
                data: []
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    distributed: true, 
                    borderRadius: 4
                }
            },
            dataLabels: { enabled: true },
            colors: lotColors,
            xaxis: {
                categories: [],
                title: { text: 'Batch Number' }
            },
            yaxis: {
                title: { text: 'Available Quantity' }
            },
            noData: {
                text: 'Select a product to view lots',
                align: 'center',
                verticalAlign: 'middle',
                style: { fontSize: '16px' }
            }
        };

        lotChart = new ApexCharts(document.querySelector("#lot_status_chart"), lotOptions);
        lotChart.render();
    }

    var productSelect = document.getElementById('productLotFilter');
    
    if (productSelect) {
        productSelect.addEventListener('change', function() {
            var productId = this.value;

            // Fetch data from Laravel
            fetch("{{ route('get.lot.chart.data') }}?product_id=" + productId)
                .then(response => response.json())
                .then(response => {
                    // Update Chart
                    lotChart.updateOptions({
                        xaxis: {
                            categories: response.labels
                        },
                        series: [{
                            name: 'Quantity',
                            data: response.data
                        }]
                    });
                })
                .catch(error => console.error('Error fetching lot data:', error));
        });
    }

    var dosageChartDom = document.getElementById('dosage_pie_chart');
    
    if(dosageChartDom){
        var dosageLabels = @json($dosageLabels);
        var dosageCounts = @json($dosageCounts);

        var options = {
            series: dosageCounts,
            labels: dosageLabels,
            chart: {
                type: 'pie',
                height: 350,
            },
            colors: ['#405189', '#0ab39c', '#f7b84b', '#f06548', '#299cdb'], // Custom colors
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                dropShadow: { enabled: false }
            }
        };

        var chartDosage = new ApexCharts(document.querySelector("#dosage_pie_chart"), options);
        chartDosage.render();
    }
</script>

@endsection