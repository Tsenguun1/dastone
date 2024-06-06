
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dastone - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- jvectormap -->
        <link href="plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/form.place.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="">
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <!-- LOGO -->
            <div class="brand">
                <a href="index.php" class="logo">
                    <span>
                        <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                        <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                    </span>
                </a>
            </div>
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar>
                <ul class="metismenu left-sidenav-menu">
                    <li>
                        <a href="javascript: void(0);"> <i data-feather="work" class="align-self-center menu-icon"></i><span>Хүний нөөц</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="place.php"><i class="ti-control-record"></i>Газар нэгж</a></li>
                            <li class="nav-item"><a class="nav-link" href="#.php"><i class="ti-control-record"></i>Албан тушаал</a></li> 
                            <li class="nav-item"><a class="nav-link" href="worker.php"><i class="ti-control-record"></i>Ажилтны бүртгэл</a></li> 
                        </ul>
                    </li>
                    <hr class="hr-dashed hr-menu">                           
                </ul>
            </div>
        </div>
        <!-- end left-sidenav-->

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">            
                <!-- Navbar -->
                <nav class="navbar-custom">   
                    <ul class="list-unstyled topbar-nav mb-0">                        
                        <h4 class="page-title" style="margin: 10px; ">Ажилтны бүртгэл </h4>
                            <button class=" btn btn-sm btn-soft-primary" onclick="showForm()" style="margin: 10px; margin-top: 30px;">+ Шинээр бүртгэх</button>
                            <!-- Worker regisration form container -->

                            <div >
                                <h4>Ажилтан бүртгэх шалгах</h4>
                                    <form action="submit_form.php registration-form.php" method="POST" enctype="multipart/form-data">
                                        <div >
                                            <label   for="first_name">Эцэг/эхийн нэр:</label>
                                            <input  type="text" id="first_name" name="first_name" required>
                                        </div>
                                        <div>

                                            <label   for="last_name">Өөрийн нэр:</label>
                                            <input  type="text" id="last_name" name="last_name" required>
                                        </div>
                                        <div>
                                            
                                            <label  for="reg_number">Регистрийн дугаар:</label>
                                            <input  type="text" id="reg_number" name="reg_number" required>
                                        </div>
                                        <div>
                                        <label  for="department">Газар нэгж:</label>
                                            <select id="department" name="department">
                                                <option  value="Гүйцэтгэх захирал">Гүйцэтгэх захирал</option>
                                                <option  value="Санхүүгийн алба">Санхүүгийн алба</option>
                                                <!-- Add other options as needed -->
                                            </select>
                                        </div>  
                                            
                                        <div>
                                            <label  for="position">Албан тушаал:</label>
                                            <select id="position" name="position">
                                                <option value="Хөрөнгө оруулалт хариуцсан дэд захирал">Хөрөнгө оруулалт хариуцсан дэд захирал</option>
                                                <!-- Add other options as needed -->
                                            </select>
                                        </div>
                                            
                                        <div>

                                            <label  for="email">Цахим шуудан:</label>
                                            <input  type="email" id="email" name="email" required>
                                        </div>

                                            <div>
                                                <label class="form-label " for="gender">Хүйс:</label>
                                                <input class="chooseMaleOrFemale" type="radio" id="male" name="gender" value="Эрэгтэй" required>
                                                <label  for="male">Эрэгтэй</label>
                                                <input class="chooseMaleOrFemale" type="radio" id="female" name="gender" value="Эмэгтэй">
                                                <label  for="female">Эмэгтэй</label>
                                            </div>
                                            <div>
                                                <label  for="birth_date">Төрсөн огноо:</label>
                                                <input  type="date" id="birth_date" name="birth_date" required>
                                            </div>
                                            <div>
                                            <label  for="hire_date">Ажилд орсон огноо:</label>
                                            <input  type="date" id="hire_date" name="hire_date" required>

                                            </div>
                                            <div>
                                            <label  for="mobile_phone">Гар утас:</label>
                                            <input  type="text" id="mobile_phone" name="mobile_phone" required>

                                            </div>
                                            <div>
                                            <label  for="home_phone">Гэрийн утас:</label>
                                            <input  type="text" id="home_phone" name="home_phone">

                                            </div>
                                            <div>
                                            <label  for="office_phone">Албан утас:</label>
                                            <input  type="text" id="office_phone" name="office_phone">

                                            </div>
                                            <div>
                                            <label  for="photo">Ажилтны зураг:</label>
                                            <input  type="file" id="photo" name="photo">

                                            </div>                                    
                                            <label  for="note">Тэмдэглэл:</label>
                                            <textarea id="note" name="note"></textarea>

                                            <div class="row">
                                                        <div class="col-sm-10 ms-auto">
                                                            <button type="submit" class="btn btn-primary">Хадгадах</button>
                                                            <button type="button" class="btn btn-danger" onclick="cancelForm()">Болих</button>
                                                        </div>
                                                    </div> 
                                            
                                        </form>
                                    </div>
                    
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->
        </div>
        <!-- end page-wrapper -->

        <!-- jQuery  -->
        <script src="assets/js/form.place.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>
        <script src="assets/js/moment.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <script src="plugins/apex-charts/apexcharts.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
        <script src="assets/pages/jquery.analytics_dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>   
    </body>
</html>