@extends('layouts.master-without-nav')
@section('title')
    Accountant Login
@endsection
@section('content')


    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

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
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index" class="d-inline-block auth-logo">
                                    <img src="{{ URL::asset('build/images/logo-lg.png') }}" alt="" height="50">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Accountant</h5>
                                    <p class="text-muted">Login to Your Account.</p>
                                </div>
                                <p class="text-center small">Enter your user email & password to login</p>
                                @if (Session::has('errors'))
                                    <p class="text-danger text-center small">{{ Session::get('errors') }}</p>
                                @endif
                                @if (Session::has('success'))
                                    <p class="text-success text-center small">{{ Session::get('success') }}</p>
                                @endif
                                <div class="p-2 mt-4">
                                    <form action="{{ route('accountant.login') }}" method="post">
                                    @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="username" required autofocus>
                                        </div>

                                        <div class="mb-3">
                                            {{--
                                            <div class="float-end">
                                                <a href="auth-pass-reset-basic" class="text-muted">Forgot
                                                    password?</a>
                                            </div>
                                            --}}
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="password" class="form-control pe-5 password-input" id="password" required>
                                                <button 
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" 
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> {{ config('app.name') }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
