@extends('layouts.master-without-nav')
@section('title')
    Landing
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #preloader .preloader{
        background-color: #1f2b5b;
        /* background-color: rgb(188, 134, 134); */
        height: 100vh;
        width: 100%;
        position: fixed;
        z-index: 100;
    }
    /********************  Preloader Demo-7 *******************/
    .loader7{width:100px;height:100px;margin:50px auto;position:relative}
    .loader7 .loader-inner-1,.loader7 .loader-inner-2,.loader7 .loader-inner-3,.loader7 .loader-inner-4{display:block;width:20px;height:20px;border-radius:20px;position:absolute}
    .loader7 .loader-inner-1:before,.loader7 .loader-inner-2:before,.loader7 .loader-inner-3:before,.loader7 .loader-inner-4:before{content:"";display:block;width:20px;height:20px;border-radius:20px;position:absolute;right:0;animation-name:loading-7;animation-iteration-count:infinite;animation-direction:normal;animation-duration:1s}
    .loader7 .loader-inner-1{top:0;left:0;transform:rotate(70deg)}
    .loader7 .loader-inner-1:before{background:#3dbdec}
    .loader7 .loader-inner-2{top:0;right:0;transform:rotate(160deg)}
    .loader7 .loader-inner-2:before{background:#3dbdec}
    .loader7 .loader-inner-3{bottom:0;right:0;transform:rotate(-110deg)}
    .loader7 .loader-inner-3:before{background:#3dbdec}
    .loader7 .loader-inner-4{bottom:0;left:0;transform:rotate(-20deg)}
    .loader7 .loader-inner-4:before{background:#3dbdec}
    @keyframes loading-7{
        0%{width:20px;right:0}
        10%{width:100px;right:-100px}
        20%{width:20px;right:-100px}
    }
    </style>
@endsection
@section('body')

    <body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')
    <div id="preloader" class="preloader" style="background-color: #1f2b5b">
        <div class="d-flex justify-content-center" style="margin-top: 20%">
            <div class="row">
                <div class="col-md-12">
                    <div class="loader7">
                        <span class="loader-inner-1"></span>
                        <span class="loader-inner-2"></span>
                        <span class="loader-inner-3"></span>
                        <span class="loader-inner-4"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Begin page -->
        {{-- <div class="page-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10">
                        <div class="text-center mt-lg-5 pt-5">
                            <h1 class="display-6 fw-semibold mb-3 lh-base">User Login Portal
                                <span class="text-info">Sahanya Medical Center </span></h1>
                            <p class="lead text-muted lh-base">Visit the relevent portal for further activities.</p>

                            <div class="d-flex gap-2 justify-content-center mt-4">
                                <a href="{{ route('load_management_view') }}" class="btn rounded-pill btn-lg btn-info btn-animation waves-effect waves-light">
                                    <i class="las la-user-tie"></i> MANAGEMENT</a>

                                <button type="button" id="btn_stk_mng" class="btn rounded-pill btn-lg btn-success btn-animation waves-effect waves-light">
                                <i class="las la-shopping-bag"></i> STOCK MANAGEMENT</button>

                                <button type="button" id="btn_supplier" class="btn rounded-pill btn-lg btn-info btn-animation waves-effect waves-light">
                                <i class="las la-stethoscope"></i> APPOINTMENT</button>

                                <button type="button" id="btn_cashier" class="btn rounded-pill btn-lg btn-success btn-animation waves-effect waves-light">
                                <i class="las la-coins"></i> CASHIER</button>

                            </div>
                        </div>
                    </div>
                </div>
        </div> --}}
        <!-- end layout wrapper -->
        
        <div class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                <div class="bg-overlay" style="background: linear-gradient(90deg, #1f2b5b, #3dbdec); opacity: .9;"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 pt-0">
                                <div class="mb-5 text-white-50">
                                    <h1 class="display-5 coming-soon-text">User Login Portal</h1>
                                    <p class="fs-14 text-white">Visit the relevent portal for further activities.</p>
                                    <div class="mt-4 pt-2">
                                        <a href="{{ route('load_management_view') }}" class="btn rounded-pill btn-lg btn-info btn-animation waves-effect waves-light me-2">
                                            <i class="las la-user-tie"></i> MANAGEMENT</a>

                                        <a href="{{ route('load_stock_view') }}" class="btn rounded-pill btn-lg btn-info btn-animation waves-effect waves-light me-2">
                                            <i class="las la-user-tie"></i> STOCK MANAGEMENT</a>
        
                                        <a href="{{ route('load_appointment_view') }}" class="btn rounded-pill btn-lg btn-info btn-animation waves-effect waves-light me-2">
                                            <i class="las la-stethoscope"></i> APPOINTMENT</a>

                                        <a href="{{ route('load_cashier_view') }}" class="btn rounded-pill btn-lg btn-info btn-animation waves-effect waves-light me-2">
                                            <i class="las la-coins"></i> CASHIER</a>

                                        <a href="{{ route('load_report_view') }}" class="btn rounded-pill btn-lg btn-info btn-animation waves-effect waves-light">
                                            <i class="las la-book"></i> REPORTS</a>
                                    </div>
                                </div>
                                <div class="row justify-content-center mb-0">
                                    <div class="col-xl-4 col-lg-8">
                                        <div>
                                            <img src="{{ URL::asset('assets/images/maintain.svg') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->

        </div>
        <!-- end auth-page-wrapper -->

        
    @endsection
    @section('script')
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{ URL::asset('/assets/libs/swiper/swiper.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/pages/landing.init.js') }}"></script>
        <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var loader = document.getElementById("preloader");
            // window.addEventListener("load", function(){
            //     loader.style.display ="none";
            // })
            setTimeout(() => {
                loader.style.display ="none";
            }, 1500);

        </script>
    @endsection
