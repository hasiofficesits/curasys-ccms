@extends('layouts.master')
@section('title')
Expired Stock Lot Report
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .myClass {
            font-size: 2rem;
        }
        .dx-header-row {  
            color: white;  
        } 
        #grid_container {
            height: 150px;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        Expired Stock Lot Report
        @endslot
        @slot('title')
        Expired Stock Lot Report
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="colFormLabel" class="col-form-label">Item : </label>
                            <div id="pharma_item" class="form-control-sm"></div>
                        </div>
                        <div class="col-lg-2">
                            <label for="colFormLabel" class="col-form-label">Suppliers : </label>
                            <div id="pharma_supplier" class="form-control-sm"></div>
                        </div>
                        <div class="col-lg-2">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">From :</label>
                            <div id="from_date" class="form-control-sm"></div>
                        </div>
                        <div class="col-lg-2">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">To :</label>
                            <div id="to_date" class="form-control-sm"></div>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-1">
                            <button id="btn_loadReport" class="btn btn-primary btn-md w-100" style="margin-top:35px;">Load</button>
                        </div>
                        <div class="col-lg-1">
                            <button id="btn_exportReport" class="btn btn-warning btn-md w-100" style="margin-top:35px;">Export</button>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <table id="otable_expiredStock_report" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item Name</th>
                                        <th>Expired Date</th>
                                        <th>Qty</th>
                                        <th>Supplier</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script>
        var myData = {
            pharma_item: '',
            pharma_supplier: '',
            from_date: '',
            to_date: ''
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#from_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
        });
        $('#to_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
        });
        $('#pharma_item').dxSelectBox({
            dataSource: new DevExpress.data.DataSource({
                load: function() {
                    return $.getJSON("{{ route('load_stock_item_to_dropdown') }}");
                }
            }),
            displayExpr: 'Pharma_name',
            valueExpr: 'ID',
            placeholder: 'Select a medicine...',
            searchEnabled: true,
            showClearButton: true,
            width: '100%'
        });
        $('#pharma_supplier').dxSelectBox({
            dataSource: new DevExpress.data.DataSource({
                load: function() {
                    return $.getJSON("{{ route('load_supplier_to_dropdown') }}");
                }
            }),
            displayExpr: 'Company',
            valueExpr: 'ID',
            placeholder: 'Select a supplier...',
            searchEnabled: true,
            showClearButton: true,
            width: '100%'
        });

        var otable_expiredStock_report = $("#otable_expiredStock_report").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "{{ route('load_expired_report_grid') }}",
                type: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [
                { data: 'ID',name: 'ID',"width": "25px",},
                { data: 'stock_item.Pharma_name',name: 'Item Name',},
                { data: 'Exp_date',name: 'Expred Date',},
                { data: 'QTY',name: 'Quentity',},
                { data: 'supplier.Company',name: 'Supplier',},
            ],
            order: [[0, 'desc']],
            drawCallback: function() {
                $('table tbody tr td').css('padding-top', '1px');
                $('table tbody tr td').css('font-size', '14px');
                $('table tbody tr td').css('padding-bottom', '1px');
            }
        });

        $("#btn_loadReport").on('click', function() {
            let itemId = $("#pharma_item").dxSelectBox("instance").option("value");
            let supplierId = $("#pharma_supplier").dxSelectBox("instance").option("value");
            let from_date = $('#from_date').dxDateBox("instance").option("value");
            let to_date = $('#to_date').dxDateBox("instance").option("value");

            myData = {
                pharma_item: itemId,
                pharma_supplier: supplierId,
                from_date: from_date,
                to_date: to_date
            };
            // console.log(myData);
            

            otable_expiredStock_report.ajax.reload();
        });

        $('#btn_exportReport').on('click', function() {
            let itemId = $("#pharma_item").dxSelectBox("instance").option("value");
            let supplierId = $("#pharma_supplier").dxSelectBox("instance").option("value");
            let from_date = $('#from_date').dxDateBox("instance").option("value");
            let to_date = $('#to_date').dxDateBox("instance").option("value");

            let query = $.param({
                pharma_item: itemId,
                pharma_supplier: supplierId,
                from_date: from_date,
                to_date: to_date
            });

            window.location.href = "{{ route('export_expired_lot_stock') }}" + "?" + query;
        });
    </script>
@endsection
