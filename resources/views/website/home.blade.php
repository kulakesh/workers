@extends('layouts.master-without-nav')
@section('title')
APBOCWWB
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('body')

    @endsection
    @section('content')
        {{-- @component('components.breadcrumb')
        @slot('li_1') Icons @endslot
        @slot('title') Landing @endslot
    @endcomponent --}}


        <body data-bs-spy="scroll" data-bs-target="#navbar-example">

            <!-- Begin page -->
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
                    <div class="container">
                        <a class="navbar-brand" href="index">
                            <img src="{{ URL::asset('build/images/logo-lg.png') }}" class="card-logo card-logo-dark"
                                alt="logo dark" height="50">
                            <img src="{{ URL::asset('build/images/logo-lg.png') }}" class="card-logo card-logo-light"
                                alt="logo light" height="50">
                        </a>
                        <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="mdi mdi-menu"></i>
                        </button>


                    </div>
                </nav>

                <!-- start hero section -->
                <section class="section pb-0 hero-section" id="hero">
                    <div class="bg-overlay bg-overlay-pattern"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-sm-10">
                                <div class="text-center mt-lg-5 pt-5">
                                    <h1 class="display-6 fw-semibold mb-3 lh-base">Arunachal Pradesh Building & Others
                                            Construction Workers Welfare
                                            Board <span class="text-success">APB&OCWWB </span></h1>
                                    <p class="lead text-muted lh-base">A system to register workers with unique IDs and issue ID cards
                                        which enhances site safety, security and efficiency.</p>

                                    <div class="d-flex gap-2 justify-content-center mt-4">
                                        <a href="/admin" class="btn btn-primary">Admin</a>
                                        <a href="/ac" class="btn btn-success">Accountant</a>
                                        <a href="/select-district" class="btn btn-danger">District</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                         <div class="row">
                            <a href="drivers.zip">Drivers</a>
                         </div>
                    </div>
                    <!-- end container -->
                    
                    <!-- end shape -->
                </section>
                <!-- end hero section -->

            </div>
            <!-- end layout wrapper -->

        </body>
    @endsection
    @section('script')
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ URL::asset('build/js/pages/landing.init.js') }}"></script>
    @endsection
