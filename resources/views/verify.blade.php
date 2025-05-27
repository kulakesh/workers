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
                            <div class="image">
                                <img id="thumb_img" src="{{ URL::asset('storage/photo/'.$registration->photo->first()->img_path) }}" />
                            </div>
                            <div class="row justify-content-center">
                                <h4>{{ $registration->name }}</h4>
                            </div>
                            <div class="table">
                                <table class="real-table">
                                    <tr>
                                        <td>F/Name</td>
                                        <td style="text-align: left">: {{ $registration->father }}</td>
                                    </tr>
                                    <tr>
                                        <td>Regn No</td>
                                        <td style="text-align: left">: {{ $registration->system_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone No</td>
                                        <td style="text-align: left">: {{ $registration->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td style="text-align: left">: {{ $registration->address_t }} 
                                        {{ $registration->city_t }} 
                                        {{ $registration->district_t }}
                                        {{ $registration->state_t }}    
                                        {{ $registration->pin_t }}    
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <p></p>
                            <div class="table">
                                <table class="real-table">
                                    <tr>
                                        <td style="text-align: left"><strong>Gender</strong> : {{ $registration->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><strong>Date Of Birth</strong> : {{ $registration->dob ? \Carbon\Carbon::parse($registration->dob)->format('d/m/Y') : '--' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><strong>Date Of Regn</strong> : {{ $registration->created_at ? \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y') : '--' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><strong>Old Registration No</strong> : {{ $registration->serial }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><strong>Old Registration Date</strong> : {{ $registration->serial_date ? \Carbon\Carbon::parse($registration->serial_date)->format('d/m/Y') : null }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><strong>Blood Group</strong> : {{ $registration->bg }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><strong>Name Of Nominee</strong> : {{ $registration->nominee_names->first()->nominee_name1 }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left"><strong>Parmanent Address</strong> : {{ $registration->address_t }} 
                                        {{ $registration->city_p }}, 
                                        {{ $registration->district_p }},
                                        {{ $registration->state_p }},   
                                        {{ $registration->pin_p }}    
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </div>
                        <!-- end row -->
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

    @endsection
