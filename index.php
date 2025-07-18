<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LIMBAH JAYA BERKAH</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://i.postimg.cc/kX9Z9PQ8/Chat-GPT-Image-May-4-2025-06-27-18-PM.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="AdminLTE_3/plugins/fontawesome-free/css/all.min.css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="AdminLTE_3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE_3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE_3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="AdminLTE_3/dist/css/adminlte.min.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="AdminLTE_3/plugins/daterangepicker/daterangepicker.css" />

    <!-- jQuery -->
    <script src="AdminLTE_3/plugins/jquery/jquery.min.js"></script>

    <!-- daterange picker -->
    <script src="AdminLTE_3/plugins/moment/moment.min.js"></script>
    <script src="AdminLTE_3/plugins/daterangepicker/daterangepicker.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php 
    
    include "app/database.php";

    
    ?>

    <div class="wrapper">
        <!-- Preloader -->
        <?php include "loader.php"; ?>

        <!-- Navbar -->
        <?php include "navbar.php"; ?>
        <!-- /.navbar -->

        <?php include "sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pt-3">

                    <?php 
                
                        if(isset($_GET['page'])){
                            if($_GET['page']=='penjualan'){
                                include "app/get_total_penjualan.php";
                            }
                            include_once "page/".$_GET['page'].".php";
                        }else{
                            include "page/home.php";
                        }

                    ?>

                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include "footer.php"; ?>


    </div>
    <!-- ./wrapper -->

    <?php include "js.php"; ?>

</body>

</html>