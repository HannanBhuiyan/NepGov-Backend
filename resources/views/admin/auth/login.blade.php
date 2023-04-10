
<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Login</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/dark-style.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/transparent-style.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('backend') }}/assets/colors/color1.css" />

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('backend') }}/assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="{{ asset('backend') }}/assets/uploads/brand/footer-logo.webp" class="header-brand-img" alt="">
                        
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        
                        
                            <span class="login100-form-title pb-5">
                                Login admin
                            </span>
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs text-center d-block pb-2">
                                            <li class="mx-0">Email Admin</li>
                                        </ul>
                                    </div>
                                </div> 
                                    <form action="{{ route('adminLogin') }}" method="post">
                                        @csrf
                                        <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0 @error('email') is-invalid @enderror" name="email" type="text" placeholder="Email" value="{{ old('email') }}">
                                            
                                            {{-- @error('username') 
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span> 
                                            @enderror --}}

                                            @error('email') 
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span> 
                                            @enderror


                                        </div>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0 @error('password') is-invalid
                                            @enderror" name="password" value="{{ old('password') }}" type="password" placeholder="Password">
                                            @error('password') 
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span> 
                                            @enderror
                                        </div>
                                        <div class="text-end pt-4">
                                            <p class="mb-0"><a href="{{route('forget.password.get')}}" class="text-primary ms-1">Forgot Password?</a></p>
                                        </div>
                                        <div class="container-login100-form-btn">                                                        
                                            <button style="border: none" type="submit" class="login100-form-btn btn-primary" >Login</button>
                                        </div>
                                        {{-- <div class="text-center pt-3">
                                            <p class="text-dark mb-0">Not a member?<a href="{{ route('register') }}" class="text-primary ms-1">Sign UP</a></p>
                                        </div>  --}}
                                    </form>  
                                </div>
                            </div>

                     
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('backend') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{ asset('backend') }}/assets/js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{ asset('backend') }}/assets/js/generate-otp.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('backend') }}/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('backend') }}/assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('backend') }}/assets/js/custom.js"></script>

</body>

</html>