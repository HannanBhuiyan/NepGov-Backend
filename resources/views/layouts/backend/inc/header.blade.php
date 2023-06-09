<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="nepgov, news, voting">

    {{-- for facebook --}}
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="@yield('topicname')" />


    {{-- for twitter --}}
    <meta name="twitter:title" content="{{ config('app.name') }}">
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:description" content="@yield('topicname')">
 
 

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>NepGov</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">

    <!-- STYLE CSS -->
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/dark-style.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/transparent-style.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/skin-modes.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet" />


    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('backend') }}/assets/colors/color1.css" />

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">

    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    
    <style>
        .cke_chrome,input,select,textarea, .bootstrap-tagsinput{
            border: 1px solid #777777 !important;
        }
        .bootstrap-tagsinput input{
            border: none !important;
        }
        .mult-select-tag .wrapper {
            padding: 0 !important;
        }

        @media screen and (max-width: 1400px) {
            a.btn{
                margin-bottom: 17px !important;
            } 
        }
       
    </style>

    @yield('links')

</head>
