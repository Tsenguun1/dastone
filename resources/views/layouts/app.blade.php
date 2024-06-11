<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dastone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <link rel="stylesheet" href="/css/app.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/form.place.css" rel="stylesheet" type="text/css" />
    <link href="/assets/dastone/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="left-sidenav">
        <div class="brand">
            <a href="{{ route('viewplace') }}" class="logo">
                <span>
                    <img src="/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <img src="/assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                    <img src="/assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark" style="height: 40px;">
                </span>
            </a>
        </div>
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li>
                    <a href="javascript: void(0);"> <i data-feather="work" class="align-self-center menu-icon"></i><span>Хүний нөөц</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="{{ route('viewplace') }}"><i class="ti-control-record"></i>Газар нэгж</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('viewposition') }}"><i class="ti-control-record"></i>Албан тушаал</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('viewemployee') }}"><i class="ti-control-record"></i>Ажилтны бүртгэл</a></li>
                    </ul>
                </li>
                <hr class="hr-dashed hr-menu">
            </ul>
        </div>
    </div>
    
        @yield('content')
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/feather.min.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>
    <script src="/assets/js/moment.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/plugins/apex-charts/apexcharts.min.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
    <script src="/assets/pages/jquery.analytics_dashboard.init.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>
