
<?php $__env->startSection('title'); ?>
Day Report
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: right;
        }
        .dataTables_wrapper .dataTables_length {
            float: left;
        }
        .dataTables_wrapper .dataTables_info {
            float: left;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
        }
        table.dataTable thead th {
            border-bottom: 2px solid #405189;
            color: white;
            background-color: #405189;
        }
        table.dataTable tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table.dataTable tbody tr:hover {
            background-color: #e9ecef;
        }
        .badge {
            padding: 0.4em 0.8em;
            font-size: 0.85em;
        }
        .summary-card {
            border-left: 4px solid #405189;
        }
        .column-visibility {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .column-visibility .form-check {
            display: inline-block;
            margin-right: 15px;
            margin-bottom: 5px;
        }
        #summaryCards {
            margin-bottom: 20px;
        }
        .card-counter {
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-counter i {
            font-size: 3rem;
            opacity: 0.5;
        }
        .card-counter .count-numbers {
            font-size: 2rem;
            font-weight: bold;
        }
        .card-counter .count-name {
            font-size: 1rem;
            opacity: 0.8;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Day Report
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Day Report
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Date Filter -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="report_date" class="col-form-label">Select Date</label>
                            <input class="form-control form-control-sm" type="date" id="report_date" value="<?php echo e(date('Y-m-d')); ?>">
                        </div>
                        <div class="col-lg-8"></div>
                        <div class="col-lg-1">
                            <button id="btn_loadReport" class="btn btn-primary btn-md w-100" style="margin-top:32px;">
                                Load
                            </button>
                        </div>
                        <div class="col-lg-1">
                            <button id="btn_exportReport" class="btn btn-warning btn-md w-100" style="margin-top:32px;">
                                Export
                            </button>
                        </div>
                    </div>

                    <!-- DataTable -->
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <table id="otable_day_report" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Item Count</th>
                                        <th>Total Amount</th>
                                        <th>Discount</th>
                                        <th>Net Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via AJAX -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right">Total:</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    
    <!-- JSZip for Excel Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    
    <!-- PDFMake for PDF Export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function() {
            let otable_day_report;
            
            // Initialize DataTable
            function initializeDataTable() {
                otable_day_report = $('#otable_day_report').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            title: 'Day Report',
                            className: 'btn btn-success btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            title: 'Day Report',
                            className: 'btn btn-danger btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            title: 'Day Report',
                            className: 'btn btn-info btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fas fa-columns"></i> Columns',
                            className: 'btn btn-secondary btn-sm'
                        }
                    ],
                    pageLength: 50,
                    lengthMenu: [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
                    order: [[0, 'desc']], // Sort by invoice number descending
                    
                    // IMPORTANT: Map columns to data properties
                    columns: [
                        { data: 'invno' },           // Invoice No
                        { data: 'date' },            // Date
                        { data: 'cusid' },           // Customer
                        { data: null },              // Item Count (will be calculated)
                        { data: 'total' },           // Total Amount
                        { data: 'dis_val' },         // Discount
                        { data: 'net' }              // Net Amount
                    ],
                    
                    columnDefs: [
                        {
                            targets: 3, // Item Count - placeholder
                            render: function(data, type, row) {
                                return '-'; // You can calculate this if you have the data
                            }
                        },
                        {
                            targets: [4, 5, 6], // Numeric columns
                            className: 'dt-body-right',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return formatNumber(data);
                                }
                                return data;
                            }
                        },
                        {
                            targets: 1, // Date column
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return formatDate(data);
                                }
                                return data;
                            }
                        }
                    ],
                    footerCallback: function(row, data, start, end, display) {
                        let api = this.api();
                        
                        // Calculate totals for numeric columns (skip item count)
                        [4, 5, 6].forEach(function(colIndex) {
                            let total = api
                                .column(colIndex, { page: 'current' })
                                .data()
                                .reduce(function(a, b) {
                                    return parseFloat(a || 0) + parseFloat(b || 0);
                                }, 0);
                            
                            // Update footer
                            $(api.column(colIndex).footer()).html(formatNumber(total));
                        });
                        
                        // Count total rows for item count column
                        let totalCount = api.rows({ page: 'current' }).count();
                        $(api.column(3).footer()).html(totalCount);
                        
                        // Update first column footer
                        $(api.column(0).footer()).html('Total (' + totalCount + ' invoices):');
                    },
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "Showing 0 to 0 of 0 entries",
                        infoFiltered: "(filtered from _MAX_ total entries)",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    },
                    initComplete: function() {
                        // Add refresh button to DataTable buttons
                        let refreshButton = $('<button>')
                            .addClass('btn btn-primary btn-sm ms-2')
                            .html('<i class="fas fa-sync-alt"></i> Refresh')
                            .on('click', function() {
                                loadReport();
                            });
                        
                        $('.dt-buttons').append(refreshButton);
                    }
                });
            }
            
            // Format number with commas
            function formatNumber(num) {
                if (num == null || num === '') return '0.00';
                return parseFloat(num).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
            
            // Format date
            function formatDate(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-GB');
            }
            
            // Load Report Data
            function loadReport() {
                const reportDate = $('#report_date').val();
                
                if (!reportDate) {
                    toastr.error('Please select a date');
                    return;
                }
                
                $.ajax({
                    url: '<?php echo e(route("load_day_report_grid")); ?>',
                    method: 'GET',
                    data: {
                        from_date: reportDate,
                        to_date: reportDate  // Same date for single day report
                    },
                    beforeSend: function() {
                        $('#btn_loadReport').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
                    },
                    success: function(response) {
                        if (response.success !== false) {
                            // Clear existing data
                            if (otable_day_report) {
                                otable_day_report.clear();
                                otable_day_report.rows.add(response.data).draw();
                            } else {
                                initializeDataTable();
                            }
                            
                            toastr.success('Report loaded successfully');
                        } else {
                            toastr.error(response.message || 'Error loading report');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Error loading report');
                        console.error(xhr);
                    },
                    complete: function() {
                        $('#btn_loadReport').prop('disabled', false).html('Load');
                    }
                });
            }
            
            // Export Button
            $('#btn_exportReport').click(function() {
                const reportDate = $('#report_date').val();
                
                if (!reportDate) {
                    toastr.error('Please select a date');
                    return;
                }
                
                if (!otable_day_report || otable_day_report.data().count() === 0) {
                    toastr.warning('No data to export');
                    return;
                }
                
                // Use server-side export
                window.location.href = '<?php echo e(route("export_day_report_excel")); ?>' + 
                    '?from_date=' + reportDate + 
                    '&to_date=' + reportDate;
            });
            
            // Load Report Button
            $('#btn_loadReport').click(function() {
                loadReport();
            });
            
            // Initialize DataTable on page load
            initializeDataTable();
            
            // Load initial data
            loadReport();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/reports/stock/day-report.blade.php ENDPATH**/ ?>