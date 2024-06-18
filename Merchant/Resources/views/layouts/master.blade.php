<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Mерчант менежмент</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/dastone/assets/images/favicon.ico">
        <!-- Plugins css -->
        <link href="/assets/dastone/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/plugins/huebee/huebee.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
        <link href="/assets/dastone/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- Sweet Alert -->
        <link href="/assets/dastone/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="/assets/dastone/plugins/animate/animate.css" rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="/assets/dastone/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/plugins/nestable/jquery.nestable.min.css" rel="stylesheet" />
        <script src="/assets/dastone/assets/js/jquery.min.js"></script>
        <script src="/assets/dastone/plugins/nestable/jquery.nestable.min.js"></script>
        <link href="/assets/dastone/plugins/datatables/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/dastone/plugins/datatables/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="/assets/dastone/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

    
@yield('css')

        <style type="text/css">
            .app-menu-container {
                z-index: 99999;
                position: fixed;
                top: 46px;
                left: 13%;
                box-shadow: 0 2px 6px rgb(0 0 0 / 16%);
                background-color: #fff;
                border-radius: 8px;
                width: 300px;
                transition-property: height;
                transition-duration: .5s;
                overflow: hidden;
            }
            .app-search {
                height: 54px;
                box-shadow: 0 1px 3px rgb(0 0 0 / 16%);
                padding: 12px 20px;
            }
            .search-box {
                width: 90%;
                height: 30px;
                border-radius: 4px;
                border: 1px solid #ccc;
                text-align: center;
                font-family: nes-awesome,sans-serif;
                line-height: 30px;
            }
            .app-content {
                display: flex;
                flex-wrap: wrap;
                padding-top: 20px;
                padding-bottom: 20px;
                justify-content: center;
                overflow-y: auto;
                max-height: 80vh;
            }
            .app-menu-sortable {
                touch-action: none;display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-auto-flow: row;
            }
            .app-item-row {
                display: flex;
                flex-direction: column;
                width: 88px;
                height: 100px;
                user-select: none;
                cursor: pointer;
            }
            .svg-icon {
                width: 50px;
                height: 50px;
                -webkit-user-drag: none;
                margin: auto;
            }
            .app-text {
                font-size: 13px;
                line-height: 13px;
                color: #676c7b;
                width: 83px;
                height: 44px;
                text-align: center;
                padding-top: 3px;
                overflow: hidden;
            }

        </style>
    </head>

    <body class="dark-topbar" style="display:block">
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <!-- LOGO -->
            <div class="brand">
                <a href="/localweb" class="logo">
                    <span>
                        <img src="/assets/dastone/assets/images/logobgno.png" alt="logo-small" class="logo-sm">
                    </span>
                </a>
            </div>
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar>
                <ul class="metismenu left-sidenav-menu">
                    <li class="menu-label mt-0"><a href="/sms" class="active"><span>Mерчант менежмент</span></a></li>
                    <li>
                        <a href="/merchant">
                            <i data-feather="edit" class="align-self-center menu-icon"></i>
                            <span>Mерчант бүртгэл</span>
                           
                        </a>
                        <!-- <a href="/sms/report">
                            <i data-feather="file-text" class="align-self-center menu-icon"></i>
                            <span>Mессеж мэдээ тайлан</span>
                        </a> -->
                        <!-- <ul class="nav-second-level" aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="/cardsystem/register/printed"><i class="ti-control-record">
                            </i>Хэвлэгдсэн карт</a></li>
                            <li class="nav-item"><a class="nav-link" href="/cardsystem/register/huraagdsan"><i class="ti-control-record">
                            </i>Хураагдсан карт</a></li> 
                            <li class="nav-item"><a class="nav-link" href="/cardsystem/other/reg"><i class="ti-control-record">
                            </i>Бусад банкны картын бүртгэл</a></li>
                            <li class="nav-item"><a class="nav-link" href="/cardsystem/register/gologdol"><i class="ti-control-record">
                            </i>Гологдол карт бүртгэх</a></li>
                        </ul> -->
                    </li>
                </ul>
            </div>
        </div>
        <!-- end left-sidenav-->
        
        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">            
                <!-- Navbar -->
                <nav class="navbar-custom navbar-expand-lg navbar-dark bg-primary mb-2">    
                    <ul class="list-unstyled topbar-nav float-end mb-0">  
                        <li class="dropdown">
                            <div class="app-search-topbar">
                                <input autocomplete="off" type="search" name="search" id="search" class="from-control top-search mb-0" placeholder="Хайх...">
                                <button type="submit"><i class="ti-search"></i></button>
                            </div> 
                            <div id="search_dropdown_box" class="dropdown-menu dropdown-menu-end" style="width:301px">
                            </div>
                        </li>                      


                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" style="color: white" data-bs-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <span class="ms-1 nav-user-name hidden-sm">{{Auth::user()->firstname}}</span> &nbsp; 
                                @if(Auth::user()->picture_link != "") 
                                <img src="http://172.16.200.7/files/{{Auth::user()->picture_link}}" alt="profile-user" class="rounded-circle" height="45"/>   
                                @else 
                                <img src="/assets/dastone/assets/images/users/icon{{Auth::user()->sex}}.png" alt="profile-user" class="rounded-circle" height="45"/>   
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/logout"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Гарах</a>
                            </div>
                        </li>
                    </ul><!--end topbar-nav-->
        
                    <ul class="list-unstyled topbar-nav mb-0">
                        <li>
                            <button class="nav-link button-menu-mobile" style="color: white;">
                                <i data-feather="menu" class="align-self-center topbar-icon"></i>
                            </button>
                        </li> 
                        <div class="navbar-custom-menu">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu">
                                <a href="/">
                                    <span><i data-feather="home" class="align-self-center hori-menu-icon"></i>Нүүр хуудас</span>
                                </a>                
                            </li><!--end has-submenu-->

                            <li class="has-submenu">
                                <a href="#">
                                    <span><i data-feather="grid" class="align-self-center hori-menu-icon"></i>Програмын жагсаалт</span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <?php 
                                            $programs = \Modules\Blog\Entities\DbHelper::instance()->getPrograms();
                                        ?>
                                        <div class="app-menu-container">
                                            <div class="app-search">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <input class="search-box" placeholder="🔎 Аппликейшн хайх">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="app-content">
                                                <div activeitemclass="sortable-item active"  dir="ltr" class="app-menu-sortable">
                                                    
                                                    <?php $i = 0; $end = 1;?>
                                                        @foreach ($programs as $pro_item)
                                                        <div style="border: 1px solid transparent; width: 88px; height: 100px; user-select: none;">
                                                            <div  class="app-item-row">
                                                                @if($pro_item->pro_id >= 10000 && $pro_item->out_link!="")
                                                                <a target="blank" href="{{$pro_item->out_link}}">
                                                                @else  
                                                                <a target="blank" href="/access/{{$pro_item->pro_id}}">
                                                                @endif   
                                                                <?php 
                                                                    $img_path = "/assets/dastone/assets/images/app_icons/".$pro_item->perm_id.".png";
                                                                    ?>
                                                                    <img class="svg-icon" src="{{file_exists(public_path().$img_path) ? $img_path : "/assets/dastone/assets/images/app_icons/default.png"}}" alt="..."><br/>
                                                                    
                                                                </a>
                                                                <div class="app-text">{{$pro_item->pro_name}}</div>
                                                            </div> 
                                                        </div>
                                                        <?php $i++; $end++;?>
                                                         
                                                        @endforeach
                                                        @if($i <= 4 && $end > 0)
                                                         </div>
                                                        @endif

                                                </div>
                                            </div>
                                        </div>
                                    </li> 

                                </ul><!--end submenu-->
                            </li><!--end has-submenu--> 

                            <li class="has-submenu">
                                <a href="#">
                                    <span><i data-feather="book-open" class="align-self-center hori-menu-icon"></i>Сургалт</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="/localweb/content/list/13"><i class="ti ti-minus"></i>Гарын авлага</a></li>           
                                    <li><a href="/localweb/video"><i class="ti ti-minus"></i>Кино сан</a></li>
                                    <li><a href="/localweb/content/list/14"><i class="ti ti-minus"></i>Дотоод сургалт</a></li>                           
                                    <li><a href="/localweb/content/list/15"><i class="ti ti-minus"></i>Гадаад сургалт</a></li>
                                    <li><a href="/localweb/content/list/15"><i class="ti ti-minus"></i>Гадаад сургалт</a></li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->


                            <li class="has-submenu">
                                <a href="#">
                                    <span><i data-feather="file-plus" class="align-self-center hori-menu-icon"></i>Мэдээлэл</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="/localweb/content/list/10"><i class="ti ti-minus"></i>Мэдээ мэдээлэл</a></li>                                    
                                    <li><a href="/localweb/content/list/33"><i class="ti ti-minus"></i>Мэдээллийн аюулгүй байдал</a></li>
                                </ul>
                            </li><!--end has-submenu-->

                            <li class="has-submenu">
                                <a href="/localweb/contact/list">
                                    <span><i data-feather="phone" class="align-self-center hori-menu-icon"></i>Утасны жагсаалт</span>
                                </a>
                            </li><!--end has-submenu-->
                            <!--end has-submenu-->
                        </ul><!-- End navigation menu -->
                    </div> <!-- end navigation -->
                </div>
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->
            <!-- Page Content-->
            <div class="page-content">
                <div class="modal fade bd-example-modal-lg" id="exampleModalLarge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div>
                                <div class="d-flex justify-content-center" >
                                <div class="spinner-grow thumb-md text-purple" role="status" id="employee_load_spinner" style="display: none"></div> 
                                </div>                    
                            </div>
                            <div id="empDetailModal">
                                
                            </div>
                        </div><!--end modal-content-->
                    </div><!--end modal-dialog-->
                </div><!--end modal-->
                @yield('content')
                <footer class="footer text-center text-sm-start">
                    <div class="boxed-footer">© <script>
                        document.write(new Date().getFullYear())
                        </script> Тээвэр хөгжлийн банк 
                        <span class="text-muted d-none d-sm-inline-block float-end">Created by Мэдээллийн Технологийн Газар</span>
                    </div>
                </footer>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->


        <!-- jQuery  -->
        <script src="/assets/dastone/assets/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-chained/1.0.1/jquery.chained.min.js"></script>
        <script src="/assets/dastone/plugins/select2/select2.min.js"></script>
        <script src="/assets/dastone/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/dastone/assets/js/metismenu.min.js"></script>
        <script src="/assets/dastone/assets/js/waves.js"></script>
        <script src="/assets/dastone/assets/js/feather.min.js"></script>
        <script src="/assets/dastone/assets/js/simplebar.min.js"></script>
        <script src="/assets/dastone/assets/js/moment.js"></script>

        <!-- Plugins js -->
        
       
        <script src="/assets/dastone/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="/assets/dastone/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

        <!-- Plugins js -->
        <script src="/assets/dastone/plugins/huebee/huebee.pkgd.min.js"></script>
       

        <script src="/assets/dastone/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/dataTables.bootstrap5.min.js"></script>
        <!-- Buttons examples -->
        <script src="/assets/dastone/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/buttons.bootstrap5.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/jszip.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/pdfmake.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/vfs_fonts.js"></script>
        <script src="/assets/dastone/plugins/datatables/buttons.html5.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/buttons.print.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="/assets/dastone/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="/assets/dastone/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="/assets/dastone/assets/pages/jquery.datatable.init.js"></script>

        <!-- Sweet-Alert  -->
        <script src="/assets/dastone/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="/assets/dastone/assets/pages/jquery.sweet-alert.init.js"></script>


        @yield('javascript')
      

        <script type="text/javascript">
            $(function () {
                $('#search').on("input", function () {
                    var search_input = this.value;
                    $("#search_dropdown_box").removeClass("show");
                    if (search_input.length > 1) {
                        $("#search_dropdown_box").addClass("show");
                        //$("#tab_spinner").show();
                        //jQuery("").html("");
                        $.post('/localweb/search/request/json', {
                            val_input: search_input,
                            _token: '{{ csrf_token() }}'
                        }, function (data) {
                            //$("#tab_spinner").hide();
                            jQuery("#search_dropdown_box").html(data.data);
                        }, 'json');
                    }
                });
            });
            function getEmpDetail(empid) {
                jQuery("#empDetailModal").html("");
                $("#employee_load_spinner").show();
                $.post('/localweb/user/info/detail/json', {
                    _empid: empid,
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    $("#employee_load_spinner").hide();
                    jQuery("#empDetailModal").html(data.data);
                }, 'json');
            }
        </script>
       
        <script src="/assets/dastone/assets/js/app.js"></script>
        
    </body>

</html>