@extends('layouts.master')
@section('title')
    Stock Group
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
            Settings
        @endslot
        @slot('title')
            Stock Group
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_group"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Group</button>
                        </div>
                    </div>
                    <table id="otable_group" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- add_group_modal -->
    <div id="add_group_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="code" placeholder="Ex:- MDI001">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="group"
                                        placeholder="Enter group name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_group" onclick="save_group()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_group_modal -->
    <div id="update_group_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="group_id">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_code" placeholder="Ex:- MDI001">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_group"
                                        placeholder="Enter group name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_group" onclick="update_group()"
                        class="btn btn-primary">Update</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask active -->
    <div id="ask_active_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Active Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="group_id">
                    <h5 class="modal-title">Do You Want to Active the Group ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_group()" class="btn btn-success">Active</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask in active -->
    <div id="ask_inactive_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Inactive Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="group_id">
                    <h5 class="modal-title">Do You Want to Inactive the Group ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_group()" class="btn btn-danger">Inactive</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
        var myData = {};

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var otable_group = $("#otable_group").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "{{ route('load_stock_group_grid') }}",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'ID',
                    name: 'ID',
                    "width": "25px",
                },
                {
                    data: 'Code',
                    name: 'Code',
                },
                {
                    data: 'GroupName',
                    name: 'GroupName',
                },
                {
                    data: 'action',
                    name: 'action',
                    "width": "100px",
                },
            ],
            order: [
                [0, 'desc']
            ],

            'drawCallback': function() {
                $('table tbody tr td').css('padding-top', '1px');
                $('table tbody tr td').css('font-size', '14px');
                $('table tbody tr td').css('padding-bottom', '1px');
            }
        });
        
        $("#btn_add_group").on('click', function() {
            $("#add_group_modal").modal("show");
        });

        function save_group() {
            let group = $("#group").val();
            let code = $("#code").val();

            if (group == "") {
                toastr.error("Group Name Required");
                $("#btn_save_group").attr("disabled", false);
            }

            $("#btn_save_group").attr("disabled", true);

            $.ajax({
                "url": "{{ route('save_new_group') }}",
                "method": "POST",
                "data": {
                    "group": group,
                    "code": code
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Group Added Successfully");
                        otable_group.ajax.reload();
                        $("#add_group_modal").modal("hide");
                        clear_form();
                        $("#btn_save_group").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_group").attr("disabled", false);
                    }
                },
            });
        };

        function clear_form() {
            $("#group").val('');
            $("#code").val('');
        };

        $('#otable_group tbody').on('click', '.btn-edit', function() {

            var data = otable_group.row($(this).parents('tr')).data();
            console.log(data);

            $("#group_id").val(data.ID);
            $("#edit_code").val(data.Code);
            $("#edit_group").val(data.GroupName);

            $("#update_group_modal").modal("show");
        });

        function update_group() {
            let group_id = $("#group_id").val();
            let edit_code = $("#edit_code").val();
            let edit_group = $("#edit_group").val();

            if (edit_group == "") {
                toastr.error("Group Name Required");
                $("#btn_update_group").attr("disabled", false);
            }

            $("#btn_update_group").attr("disabled", true);

            $.ajax({
                "url": "{{ route('update_stock_group') }}",
                "method": "POST",
                "data": {
                    "group_id": group_id,
                    "edit_code": edit_code,
                    "edit_group":edit_group
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Category Updated Successfully");
                        otable_group.ajax.reload();
                        $("#update_group_modal").modal("hide");
                        clear_update_form();
                        $("#btn_update_group").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_group").attr("disabled", false);
                    }
                },
            });
        };

        function clear_update_form() {
            $("#group_id").val('');
            $("#edit_code").val('');
            $("#edit_group").val('');
        };

        $('#otable_group tbody').on('click', '.btn-active', function() {

            var data = otable_group.row($(this).parents('tr')).data();

            if (data.IsDelete == 0) {
                $("#group_id").val(data.ID);
                $("#ask_inactive_modal").modal("show");
            } else if (data.IsDelete == 1) {
                $("#group_id").val(data.ID);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_group() {
            let group_id = $("#group_id").val();

            $.ajax({
                url:"{{ route('active_group_from_id') }}",
                method:"POST",
                data:{
                    "group_id":group_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_group.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#group_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_group() {
            let group_id = $("#group_id").val();

            $.ajax({
                url:"{{ route('inactive_group_from_id') }}",
                method:"POST",
                data:{
                    "group_id":group_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_group.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#group_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };
    </script>
@endsection
