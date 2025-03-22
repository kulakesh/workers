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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">Select District</h4>
                                <div class="row">
                                    @foreach ($district_names as $district_name)
                                    <div class="col-lg-3 mb-2">
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop{{ $district_name->id }}" type="button" class="btn btn btn-soft-primary waves-effect waves-light dropdown-toggle material-shadow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $district_name->name }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop{{ $district_name->id }}">
                                                <li><a class="dropdown-item" href="/dt">RO Login</a></li>
                                                <li><a class="dropdown-item" href="/op">Operator Login</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
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
