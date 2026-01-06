
<?php $__env->startSection('title'); ?>
KOT Summary
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
        .myClass {
            font-size: 2rem;
        }

        .dx-header-row {
            color: white;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            KOT Summary
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        KOT Summary
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Recipe : </label>
                                <div class="col-sm-8">
                                    <div id="recipe" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                               
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                               
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Start Date : </label>
                                <div class="col-sm-8">
                                    <div id="start_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">End Date : </label>
                                <div class="col-sm-8">
                                    <div id="end_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="row">
                                
                            </div>
                        </div>
                        <div class="col-lg-3 pe-5">
                            <div class="row">
                                <button type="button" id="btn_load_report" class="btn btn-success">Load Report</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table id="otable_recipe_report" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>INV</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Recipe</th>
                                <th>Portion</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text-end"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

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

    
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

    <script>
        var myData = {};
        var recipe = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#start_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
            
        });
        $('#end_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });

        load_recipe();

        $('#recipe').dxSelectBox({
            dataSource: recipe,
            displayExpr: 'name',
            valueExpr: 'code',
            itemTemplate: function(data) {
                return data.code + " - " + data.name;
            },
            searchEnabled: true,
            searchExpr: ["code", "name"],
        });

        function load_recipe() {
            $.ajax({
                url: "<?php echo e(route('load_recipe')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    recipe = response.data
                    $('#recipe').dxSelectBox("instance").option("dataSource", recipe);
                    
                }
            })
        };

        var otable_recipe_report = $("#otable_recipe_report").DataTable({
            
            dom: 'Bfrtip',
            columns: [
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'inv_no',
                    name: 'inv_no',
                },
                {
                    data: 'kot_date',
                    name: 'kot_date',
                },
                {
                    data: 'order_type',
                    name: 'order_type',
                },
                {
                    data: 'recipe',
                    name: 'recipe',
                },
                {
                    data: 'portion',
                    name: 'portion',
                },
                {
                    data: 'qty',
                    name: 'qty',
                    "className": "text-end",
                },
                
            ],
            order: [
                [0, 'desc']
            ],
            "footerCallback": function (row, data, start, end, display) {
                var totalQty = 0;
                for (var i = 0; i < data.length; i++) {

                    totalQty += data[i].qty;

                }
                $(row).find('th').eq(0).html( "Total Qty : "+ totalQty );
            }
        });

        $("#btn_load_report").on('click', function() {
            let start_date = $("#start_date").dxDateBox('instance').option('value');
            let end_date = $("#end_date").dxDateBox('instance').option('value');
            let recipe_code = $('#recipe').dxSelectBox("instance").option("value");
            console.log(recipe_code);

            $("#btn_load_report").attr("disabled", true);

            $.post('<?php echo e(route('load_recipe_report')); ?>',
            {
                "start_date":start_date,
                "end_date":end_date,
                "recipe_code":recipe_code,

            },
            function(res){
                otable_recipe_report.clear();
                otable_recipe_report.rows.add(res.data);
                otable_recipe_report.draw();
                $("#btn_load_report").attr("disabled", false);
            })
        })

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/reports/kot_summary.blade.php ENDPATH**/ ?>