<?php
include 'functions.php';
// if (empty($_SESSION['login']))
//     header("location:login.php");
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPK BLT DD Mojokerto</title>

    <!-- Custom fonts for this template-->
    <link href="assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets2/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="assets2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/exporting.js"></script>
    <script src="assets/js/highcharts-3d.js"></script>
    <script src="assets/js/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href=" ">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SPK DD <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="?">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php if ($_SESSION['login']) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="?m=atribut">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Atribut</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Data Warga</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Components :</h6>
                            <a class="collapse-item" href="?m=alternatif">List Data Warga</a>
                            <a class="collapse-item" href="?m=rel_alternatif">Nilai Kriteria</a>
                        </div>
                    </div>
                </li>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="?m=hitung">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Perhitungan</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Tables -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Hasil SPK</span></a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="aksi.php?act=logout">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Logout</span></a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="?m=hitung">
                        <span>Perhitungan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?m=login">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Login</span></a>
                </li>
            <?php endif ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Custom Text Color Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <?php
                                    if (!$_SESSION['login'] && !in_array($mod, array('', 'home', 'hitung', 'login')))
                                        $mod = 'login';

                                    if (file_exists($mod . '.php'))
                                        include $mod . '.php';
                                    else
                                        include 'home.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2021</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!--Core JavaScript-->
            <script src="assets2/vendor/jquery/jquery.min.js"></script>
            <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets2/vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="assets2/js/sb-admin-2.min.js"></script>
            <!-- <script src="assets2/vendor/chart.js/Chart.min.js"></script> -->
            <!-- <script src="assets2/js/demo/chart-area-demo.js"></script> -->
            <!-- <script src="assets2/js/demo/chart-pie-demo.js"></script> -->
            <script src="assets2/vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="assets2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="assets2/js/demo/datatables-demo.js"></script>
</body>

</html>