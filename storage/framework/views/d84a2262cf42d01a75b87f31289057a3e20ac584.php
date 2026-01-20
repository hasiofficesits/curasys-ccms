
<?php $__env->startSection('title'); ?>
Sales Report
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
        Sales Report
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Sales Report
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Date Range Filter -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="from_date" class="col-form-label">From Date</label>
                            <input class="form-control form-control-sm" type="date" id="from_date" value="<?php echo e(date('Y-m-01')); ?>">
                        </div>
                        <div class="col-lg-2">
                            <label for="to_date" class="col-form-label">To Date</label>
                            <input class="form-control form-control-sm" type="date" id="to_date" value="<?php echo e(date('Y-m-d')); ?>">
                        </div>
                        <div class="col-lg-2">
                            <label for="status_filter" class="col-form-label">Status</label>
                            <select class="form-select form-select-sm" id="status_filter">
                                <option value="">All</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Partial">Partial</option>
                            </select>
                        </div>
                        <div class="col-lg-4"></div>
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
                            <table id="salesReportTable" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Code</th>
                                        <th>Date</th>
                                        <th>Customer ID</th>
                                        <th>Type</th>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>Net Amount</th>
                                        <th>Tax</th>
                                        <th>Gross Amount</th>
                                        <th>Paid</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded via AJAX -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align:right">Total:</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
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
    let dataTable;
    
    // Initialize DataTable
    function initializeDataTable() {
        dataTable = $('#salesReportTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    title: 'Sales Report',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    title: 'Sales Report',
                    className: 'btn btn-danger btn-sm',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    title: 'Sales Report',
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
            order: [[2, 'desc']], // Sort by date descending
            
            // IMPORTANT: Map columns to data properties
            columns: [
                { data: 'invno' },          // Invoice No
                { data: 'code' },           // Code
                { data: 'date' },           // Date
                { data: 'cusid' },          // Customer ID
                { data: 'type' },           // Type
                { data: 'total' },          // Total
                { data: 'dis_val' },        // Discount
                { data: 'net' },            // Net Amount
                { data: 'tax' },            // Tax
                { data: 'gross' },          // Gross Amount
                { data: 'pay' },            // Paid
                { data: 'balance' },        // Balance
                { data: 'status' }          // Status
            ],
            
            columnDefs: [
                {
                    targets: [5, 6, 7, 8, 9, 10, 11], // Numeric columns
                    className: 'dt-body-right',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return formatNumber(data);
                        }
                        return data;
                    }
                },
                {
                    targets: 2, // Date column
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return formatDate(data);
                        }
                        return data;
                    }
                },
                {
                    targets: 12, // Status column
                    render: function(data, type, row) {
                        let badgeClass = 'badge ';
                        switch(data) {
                            case 'Paid':
                                badgeClass += 'bg-success';
                                break;
                            case 'Unpaid':
                                badgeClass += 'bg-danger';
                                break;
                            case 'Partial':
                                badgeClass += 'bg-warning';
                                break;
                            default:
                                badgeClass += 'bg-secondary';
                        }
                        return '<span class="' + badgeClass + '">' + data + '</span>';
                    }
                }
            ],
            footerCallback: function(row, data, start, end, display) {
                let api = this.api();
                
                // Calculate totals for each numeric column
                [5, 6, 7, 8, 9, 10, 11].forEach(function(colIndex) {
                    let total = api
                        .column(colIndex, { page: 'current' })
                        .data()
                        .reduce(function(a, b) {
                            return parseFloat(a || 0) + parseFloat(b || 0);
                        }, 0);
                    
                    // Update footer
                    $(api.column(colIndex).footer()).html(formatNumber(total));
                });
                
                // Count total rows
                let totalCount = api.rows({ page: 'current' }).count();
                $(api.column(0).footer()).html('Total (' + totalCount + ' rows):');
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
        const fromDate = $('#from_date').val();
        const toDate = $('#to_date').val();
        const status = $('#status_filter').val();
        
        if (!fromDate || !toDate) {
            toastr.error('Please select both dates');
            return;
        }
        
        $.ajax({
            url: '<?php echo e(route("sales.report.data")); ?>',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                from_date: fromDate,
                to_date: toDate,
                status: status
            },
            beforeSend: function() {
                $('#btn_loadReport').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
            },
            success: function(response) {
                if (response.success) {
                    // Clear existing data
                    if (dataTable) {
                        dataTable.clear();
                        dataTable.rows.add(response.data).draw();
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
        if (!dataTable || dataTable.data().count() === 0) {
            toastr.warning('No data to export');
            return;
        }
        
        // Trigger Excel export
        $('.buttons-excel').click();
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/reports/stock/sales-report.blade.php ENDPATH**/ ?>