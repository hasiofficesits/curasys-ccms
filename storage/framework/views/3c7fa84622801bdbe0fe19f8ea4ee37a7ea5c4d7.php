
<?php $__env->startSection('title'); ?>
Patient
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
        #grid_container {
            height: 150px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Patient
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Add
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row mb-1">
                                <label for="did" class="col-sm-3 col-form-label ">ID :</label>
                                <div class="col-sm-9 ">
                                    <input type="number" class="form-control form-control" id="did"
                                        value="<?php echo e($patient_next_id); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row mb-1">
                                <label for="did" class="col-sm-3 col-form-label ">NIC
                                    :</label>
                                <div class="col-sm-9 ">
                                    <input type="text" class="form-control form-control" id="nic_number"
                                        value="" placeholder="NIC Number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row mb-1">
                                <label for="did" class="col-sm-3 col-form-label ">Pass.No
                                    :</label>
                                <div class="col-sm-9 ">
                                    <input type="text" class="form-control form-control" id="pass_no"
                                        value="" placeholder="Passport Number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted">Personal Details</p>
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group row mb-1">
                                <label for="title" class="col-sm-3 col-form-label ">Name<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9 ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="form-control form-control" id="title">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss.">Miss.</option>
                                                <option value="Ven.">Ven.</option>
                                                <option value="Baby">Baby</option>
                                            </select>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control"
                                                id="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <small class="text-danger" id="nameError"></small>


                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="dob" class="col-sm-3 col-form-label ">Date Of
                                    Birth</label>
                                <div class="col-sm-9">
                                    <div id="dob" class=" form-control"></div>
                                    <small class="text-danger" id="dobError"></small>
                                    
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label for="email"
                                    class="col-sm-3 col-form-label ">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control form-control" id="email"
                                        placeholder="Email">
                                </div>
                            </div>


                            <div class="form-group row mb-1">
                                <label for="email"
                                    class="col-sm-3 col-form-label ">Religion</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control" id="religion"
                                        placeholder="Relegion">
                                        <option value="">No Religion</option>
                                        <option value="Buddhism">Buddhism </option>
                                        <option value="Hinduism">Hinduism</option>
                                        <option value="Muslim"> Islam</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Roman Catholic">Roman Catholic</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">


                            <div class="form-group row mb-1">
                                <label for="gender"
                                    class="col-sm-3 col-form-label ">Gender</label>
                                <div class="col-sm-9">
                                    <div id="gender" class=" form-control"></div>
                                    <small class="text-danger" id="genderError"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label for="email"
                                    class="col-sm-3 col-form-label ">Age</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col">
                                            <div id="ageY" class="form-control"></div>
                                        </div>
                                        <div class="col">
                                            <div id="ageM" class="form-control"></div>
                                        </div>
                                        <div class="col">
                                            <div id="ageD" class="form-control"></div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label for="dob" class="col-sm-3 col-form-label ">Marital
                                    Status</label>
                                <div class="col-sm-9">
                                    <select id="maritalStatus" class="form-control form-control">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                    </select>
                                    
                                </div>
                            </div>

                            

                            <div class="form-group row mb-1">
                                <label for="dob"
                                    class="col-sm-3 col-form-label ">Active</label>
                                <div class="col-sm-9 mt-2">
                                    <div id="isActive"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <p class="text-muted">Home Details</p>
                    <div class="row">
                        <div class="col-md-6">


                            <div class="form-group row mb-0">
                                <label for="did"
                                    class="col-sm-3 col-form-label ">Address</label>
                                <div class="col-sm-9 ">
                                    <input type="text" class="form-control form-control" id="address"
                                        placeholder="Address">

                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group row mb-1">
                                <label for="dob"
                                    class="col-sm-3 col-form-label ">Mobile<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="mobile"
                                        placeholder="Mobile Number">
                                    <small class="text-danger" id="mobileError"></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-muted">Nearest Relative</p>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group row mb-1">
                                <label for="dob" class="col-sm-4 col-form-label ">Guardian
                                    Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control" id="guardner_name"
                                        placeholder="Guardner Name">

                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">

                            <div class="form-group row mb-0">
                                <label for="did" class="col-sm-4 col-form-label ">Contact</label>
                                <div class="col-sm-8 ">
                                    <input type="text" class="form-control form-control"
                                        id="guardner_contact_no" placeholder="Contact Number">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="form-group row mb-0">
                                <label for="did"
                                    class="col-sm-4 col-form-label ">Relationship</label>
                                <div class="col-sm-8 ">
                                    <input type="text" class="form-control form-control"
                                        id="guardner_relationship" placeholder="Relationship with guardner">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-2 p-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="debtor_ledger">
                                <label class="form-check-label" for="debtor_ledger"> Debtor Ledger</label>
                            </div>
                        </div>
                        <div class="col-md-2 p-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="advance_ledger">
                                <label class="form-check-label" for="advance_ledger"> Advance Ledger</label>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <button class="btn btn-md btn-dark" onclick="history.back();">Back</button>
                            <button id="btnAdd_Patient" class="btn btn-primary btn-md"
                                onclick="save_patient()">Save</button>
                        </div>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>
        var myData = {};

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#dob").dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            }, 
        });

        $('#gender').dxSelectBox({
            items: ['Male', "Female"],

        });

        $('#ageY').dxNumberBox({
            format: '#0 Years',
        });
        $('#ageM').dxNumberBox({
            format: '#0 Months',
            min: 0,
            max: 12,
        });
        $('#ageD').dxNumberBox({
            format: '#0 Days',
            min: 0,
            max: 31,
        });

        $('#isActive').dxSwitch({
            value: true,
            switchedOnText: "Yes",
            switchedOffText: "No"
        });

        let exist_id = $("#did").val();

        $("#title").on("change", function() {
            let value = $(this).val();
            if (value === 'Baby') {
                $("#nic_number").val(exist_id);
            }
        })

        $("#nic_number").on("input", function() {
            var year = "";
            var month = "";
            var day = "";
            var xgender = "";
            var NICNo = $(this).val();
            console.log(NICNo)

            if (NICNo.length != 10 && NICNo.length != 12) {
                $("#error").html("Invalid NIC NO");
            } else if (NICNo.length == 10 && !$.isNumeric(NICNo.substr(0, 9))) {
                $("#error").html("Invalid NIC NO");
            } else {
                // Year
                if (NICNo.length == 10) {
                    year = "19" + NICNo.substr(0, 2);
                    dayText = parseInt(NICNo.substr(2, 3));
                } else {
                    year = NICNo.substr(0, 4);
                    dayText = parseInt(NICNo.substr(4, 3));
                }

                // Gender
                if (dayText > 500) {
                    xgender = "Female";
                    dayText = dayText - 500;
                } else {
                    xgender = "Male";
                }

                // Day Digit Validation
                if (dayText < 1 && dayText > 366) {
                    $("#error").html("Invalid NIC NO");
                } else {

                    //Month
                    if (dayText > 335) {
                        day = dayText - 335;
                        month = "12";
                    } else if (dayText > 305) {
                        day = dayText - 305;
                        month = "11";
                    } else if (dayText > 274) {
                        day = dayText - 274;
                        month = "10";
                    } else if (dayText > 244) {
                        day = dayText - 244;
                        month = "09";
                    } else if (dayText > 213) {
                        day = dayText - 213;
                        month = "08";
                    } else if (dayText > 182) {
                        day = dayText - 182;
                        month = "07";
                    } else if (dayText > 152) {
                        day = dayText - 152;
                        month = "06";
                    } else if (dayText > 121) {
                        day = dayText - 121;
                        month = "05";
                    } else if (dayText > 91) {
                        day = dayText - 91;
                        month = "04";
                    } else if (dayText > 60) {
                        day = dayText - 60;
                        month = "03";
                    } else if (dayText < 32) {
                        month = "01";
                        day = dayText;
                    } else if (dayText > 31) {
                        day = dayText - 31;
                        month = "02";
                    }

                    // Show Details
                    $("#gender").dxSelectBox("instance").option('value', xgender);
                    if (xgender == "Male") {
                        $("#title").val("Mr.")
                    } else {
                        $("#title").val("Ms.")
                    }
                    let dDays = day
                    if (day < 10) {
                        dDays = `0${day}`
                    }
                    var ddate = `${year}-${month}-${dDays}`;
                    $("#dob").dxDateBox("instance").option('value', ddate);
                    const date = moment(ddate, 'YYYY-MM-DD')
                    const years = moment().diff(date, 'years')
                    const months = moment().diff(date.add(years, 'years'), 'months', false)
                    const month2s = moment().diff(date, 'months')
                    const days = moment().diff(date.add(month2s, 'months'), 'days', false)


                    $('#ageY').dxNumberBox("instance").option("value", years)
                    $('#ageM').dxNumberBox("instance").option("value", months)
                    $('#ageD').dxNumberBox("instance").option("value", days)
                }
            }
        });

        $("#title").on("change", function() {
            let value = $(this).val();
            if (value === 'Mr.')
                $("#gender").dxSelectBox("instance").option('value', "Male");
            else if (value === 'Ms.' || value === 'Miss.' || value === 'Mrs.') {
                $("#gender").dxSelectBox("instance").option('value', "Female");
            }
        });

        function save_patient() {
            // let formData = new FormData();

            let debtor_acc = 0;
            let advance_acc = 0;

            if ($('#debtor_ledger').prop('checked')) {
                debtor_acc = 1;
            } else {
                debtor_acc = 0;
            }

            if ($('#advance_ledger').prop('checked')) {
                advance_acc = 1;
            } else {
                advance_acc = 0;
            }


            let title = $("#title").val();
            let name = $("#name").val();

            let gender = $("#gender").dxSelectBox("instance").option("value");
            let dob = $("#dob").dxDateBox("instance").option('value');
            let email = $("#email").val();
            let mStatus = $("#maritalStatus").val();
            let religion = $("#religion").val();
            let isActive = $("#isActive").dxSwitch("instance").option("value");
            let address = $("#address").val();
            let mobile = $("#mobile").val();
            let gname = $("#guardner_name").val();
            let gnumber = $("#guardner_contact_no").val();
            let grelationship = $("#guardner_relationship").val();
            let nic_num = $("#nic_number").val();
            let pass_no = $("#pass_no").val();

            data = {
                'debtor_acc': debtor_acc,
                'advance_acc': advance_acc,
                'title': title,
                "FullName": name,
                'email': email,
                "mobile": mobile,
                "gender": gender,
                "religion": religion,
                "isActive": isActive,
                "dob": dob,
                "address": address,
                "nic": nic_num,
                "gname": gname,
                "gnumber": gnumber,
                "grelationship": grelationship,
                "mStatus": mStatus,
                // "did":$("#did")
                "pass_no": pass_no,
            };
            console.log(data)

            $("#nameError").html("");
            $("#genderError").html("");
            $("#dobError").html("");


            $("#btnAdd_Patient").attr("disabled", true);
            $.ajax({
                url: "<?php echo e(route('ajax_save_patient')); ?>",
                method: 'POST',
                data: data,
                // cache: false,
                // contentType: false,
                // processData: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success("Saved!");
                        clear_form()
                        $("#btnAdd_Patient").attr("disabled", false);
                    } else {
                        toastr.error("Invalid data!");
                        toastr.error(response.message);
                        $("#btnAdd_Patient").attr("disabled", false);
                    }
                },

                error: function(err) {
                    if (err.status === 422) {
                        var errors = err.responseJSON.errors
                        console.log(errors)
                        toastr.error("Invalid data!");
                        if (errors.FullName) {
                            $("#nameError").html("Full name is required!")
                            $("#btnAdd_Patient").attr("disabled", false);
                        }
                        if (errors.gender) {
                            $("#genderError").html("Gender is required")
                            $("#btnAdd_Patient").attr("disabled", false);
                        }

                        if (errors.dob) {
                            $("#dobError").html("Date of birth is required")
                            $("#btnAdd_Patient").attr("disabled", false);
                        }


                    }
                }
            })
        };

        function clear_form() {
            $("#name").val('');
            $("#email").val('');
            $("#mobile").val('');
            $("#pass_no").val('');

            $("#gender").dxSelectBox("instance").option("value", "Male");

            $("#isActive").dxSwitch("instance").option("value", true);
            $("#dob").dxDateBox("instance").option("value", '');

            $("#address").val('');

            let title = $("#title").val("Mr.");



            let mStatus = $("#maritalStatus").val();
            let religion = $("#religion").val();
            let isActive = $("#isActive").dxSwitch("instance").option("value");
            let address = $("#address").val();
            let mobile = $("#mobile").val();
            let gname = $("#guardner_name").val();
            let gnumber = $("#guardner_contact_no").val();
            let grelationship = $("#guardner_relationship").val();
            // $("#fileInput").val(null);
            // $("#fileInput")[0].files[0]=null
            $("#nic_number").val('');
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/management/patient/add.blade.php ENDPATH**/ ?>