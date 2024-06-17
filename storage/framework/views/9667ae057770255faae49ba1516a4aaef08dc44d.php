<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dastone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/form.place.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datatables/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="left-sidenav">
        <div class="brand">
            <a href="<?php echo e(route('viewplace')); ?>" class="logo">
                <span>
                    <img src="/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
                <span>
                    <img src="/assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                    <img src="/assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark"
                        style="height: 40px;">
                </span>
            </a>
        </div>
        <div class="menu-content h-100" data-simplebar>
            <ul class="metismenu left-sidenav-menu">
                <li>
                    <a href="javascript: void(0);"> <i data-feather="work"
                            class="align-self-center menu-icon"></i><span>Хүний нөөц</span><span class="menu-arrow"><i
                                class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('viewplace')); ?>"><i
                                    class="ti-control-record"></i>Газар нэгж</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('viewposition')); ?>"><i
                                    class="ti-control-record"></i>Албан тушаал</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('viewemployee')); ?>"><i
                                    class="ti-control-record"></i>Ажилтны бүртгэл</a></li>
                    </ul>
                </li>
                <hr class="hr-dashed hr-menu">
            </ul>
        </div>
    </div>

    <div class="page-wrapper">
        <!-- Page Content-->
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>
    <script src="/assets/js/moment.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>

    <script src=/assets/js/jquery.min.js"></script>
    <script src=/assets/js/bootstrap.bundle.min.js"></script>
    <script src=/assets/js/metismenu.min.js"></script>
    <script src=/assets/js/waves.js"></script>
    <script src=/assets/js/feather.min.js"></script>
    <script src=/assets/js/simplebar.min.js"></script>
    <script src=/assets/js/moment.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap5.min.js"></script>


    <!-- Buttons examples -->
    <script src="/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables/buttons.bootstrap5.min.js"></script>
    <script src="/plugins/datatables/jszip.min.js"></script>
    <script src="/plugins/datatables/pdfmake.min.js"></script>
    <script src="/plugins/datatables/vfs_fonts.js"></script>
    <script src="/plugins/datatables/buttons.html5.min.js"></script>
    <script src="/plugins/datatables/buttons.print.min.js"></script>
    <script src="/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="/assets/pages/jquery.datatable.init.js"></script>
</body>

</html>


<?php /**PATH C:\Users\pc\Documents\GitHub\dastoneTest\dastone\resources\views/layouts/app.blade.php ENDPATH**/ ?>