<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../lh.jpg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Academic Information System | Dashboard </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/css/bootstrap-grid.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/css/bootstrap-reboot.css" rel="stylesheet" />
    <link href="../assets/css/colors.css" rel="stylesheet" id="themecolor" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <!-- BEGIN PAGE LEVEL STYLE -->
    <link rel="stylesheet" href="pvrlite/assets/plugins/amcharts/export.css" type="text/css" media="all" />
    <link href="../assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="../assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
     <link href="../assets/plugins/inputmask/css/inputmask.css" rel="stylesheet" />
     <link href="../assets/plugins/bootstrap-table/bootstrap-table.css" rel="stylesheet" />
     <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
     <link href="../assets/plugins/custombox/custombox.min.css" rel="stylesheet" />
     
    <!-- END PAGE LEVEL STYLE -->
    <!-- BEGIN: load jquery -->
    <script src="../js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="../js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="../js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script src="../js/setup.js" type="text/javascript"></script>
    <!-- END: load jqplot -->
    
    <link rel="stylesheet" href="../js/development-bundle/themes/base/jquery.ui.all.css" type="text/css">
    <script type="text/javascript" src="../js/development-bundle/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="../js/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script type="text/javascript" src="../js/development-bundle/ui/jquery.ui.widget.js"></script>

    
    <script src="../js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
            
            $('.datatable').dataTable({
                'iDisplayLength': 50
            });
            
            $('#menu2').tabify();
        });
    </script>
    
    <style>
        .error {
            font-size:small; 
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border-color: #eed3d7;
            color: #b94a48; 
        }
        
        .menu2 { 
            padding: 0; 
            clear: both; 
        }
        
        .menu2 li { 
            display: inline; 
        }
        
        .menu2 li a { 
            background: #ccf; 
            padding: 10px; 
            float:left; 
            border-right: 1px solid #ccf; 
            border-bottom: none; 
            text-decoration: none; 
            color: #000; 
            font-weight: bold;
        }
        
        .menu2 li.active a { 
            background: #eef; 
        }
        
        .content2 { 
            float: left; 
            clear: both; 
            border: 1px solid #ccf; 
            border-top: none; 
            border-left: none; 
            background: #eef; 
            padding: 10px 20px 20px; 
            width: 96%; 
        }
    </style>
    
    <script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>
    <style id="clock-animations"></style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<!--Body Begins-->
<body>

<div class="wrapper">
    <?php include 'menu.php'; ?>
    <!--Begin Main Panel-->
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" data-color="purple" class="btn btn-fill btn-round btn-icon d-none d-lg-block">
                            <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                            <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown dropdown-slide">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">account_box</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="?mod=ubah_password">
                                    <i class="material-icons align-middle">account_circle</i> Ubah Password
                                </a> 
                                <a href="../logout.php" class="dropdown-item">
                                    <i class="material-icons align-middle">power_settings_new</i> Log out
                                </a>
                            </div> 
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <?php include "konten.php"; ?> 


<!--Begin Footer-->
        <footer class="footer">
            <div class="container">
                <nav>
                    <ul class="footer-menu d-none d-sm-block">
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                T&C
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                Privacy policy
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                Website
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-center">
                        © <span id="writeCopyrights"></span>
                        <a href="http://www.unipdu.ac.id/" target="_blank">UNIPDU</a> 2019
                    </p>
                </nav>
            </div>
        </footer>
        <!--End Footer-->
    </div>
    <!--EndMain Panel-->
</div>
<!--End wrapper-->

<!-- begin scroll to top btn -->
<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-scroll-to-top btn-sm animated invisible text-light" data-color="purple" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</body>
<!--End Body-->
<!--   Core JS Files   -->
<script src="../assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="../assets/plugins/pace/pace.min.js"></script>
<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/plugins/waitMe/waitMe.min.js"></script>
<script src="../assets/js/pvr_lite_app.js" id="appjs"></script>

<!-- PVR Lite DEMO, don't include it in your project! -->
<script src="../assets/js/pvr_lite_demo.js" type="text/javascript"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-66289183-8"></script>
<!-- BEGIN PAGE LEVEL JS -->
<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="../assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="../assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/js/pvr_lite_responsive_demo.js"></script>

<script src="../assets/plugins/sparkline/jquery.sparkline.js" type="text/javascript"></script>
<script src="../assets/plugins/chartjs/Chart.min.js"></script>
<script src="../assets/plugins/countup/countUp.min.js"></script>
<script src="../assets/plugins/amcharts/amcharts.js"></script>
<script src="../assets/plugins/amcharts/serial.js"></script>
<script src="../assets/plugins/amcharts/export.min.js"></script>
<script src="../assets/plugins/amcharts/none.js"></script>
<script src="../assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
<script src="../assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../assets/plugins/real-shadow/realShadow.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/plugins/typeit/typeit.js"></script>
<script src="../assets/js/pvr_lite_dashboard_v1.js"></script>
<script src="../assets/plugins/custombox/custombox.min.js" type="text/javascript"></script>
<script src="../assets/plugins/custombox/custombox.legacy.min.js" type="text/javascript"></script>
<script src="../assets/js/pvr_lite_modals.js" type="text/javascript"></script>
<script src="../assets/js/pvr_lite_form_input_mask.js"></script>
<script src="../assets/plugins/inputmask/js/jquery.inputmask.bundle.min.js"></script>
<script src="../assets/plugins/bootstrap-table/bootstrap-table.js"></script>
<script src="../assets/plugins/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
<script src="../assets/plugins/bootstrap-table/extensions/export/tableExport.js"></script>
<script src="../assets/plugins/select2/js/select2.min.js"></script>
<script src="../assets/js/pvr_lite_select2.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- Javascript Delete -->
    <script>
        function confirm_delete(delete_url){
            $("#modal_delete").modal('show', {backdrop: 'static'});
            document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>
</html>