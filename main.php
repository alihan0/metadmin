<?php 
session_start();
ob_start();

if(!isset($_SESSION['login'])){
    header("location:index.php");
}
require "config/db.php";
$account = $db->query("SELECT * FROM accounts WHERE id = '{$_SESSION['uid']}'")->fetch(PDO::FETCH_ASSOC);





$sorgu1 = $db->prepare("SELECT COUNT(*) FROM orders");
$sorgu1->execute();
$say1 = $sorgu1->fetchColumn();

$sorgu2 = $db->prepare("SELECT COUNT(*) FROM orders WHERE status = 1");
$sorgu2->execute();
$say2 = $sorgu2->fetchColumn();


$Fiyat=$db->prepare("SELECT SUM(total_price) AS takma_ad FROM orders");
$Fiyat->execute();
$FiyatYaz= $Fiyat->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="tr">
<head>
        
        <meta charset="utf-8" />
        <title>Metatige</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo-ikon.png">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/libs/toastr/build/toastr.min.css">
        


         <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php
                include 'inc/topbar.php';
                include 'inc/sidebar.php';
            ?>

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?php

                        $p = @$_GET['page'];
                        $dir = "view/".$p.".php";

                        if($p){
                            if(file_exists($dir)){
                                include $dir;
                            }else{
                                include "view/404.php";
                            }
                        }else{
                            include 'view/dashboard.php';
                        }

                        ?>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?php include 'inc/footer.php'; ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
        <script src="assets/js/pages/form-repeater.int.js"></script>
        <script src="assets/libs/toastr/build/toastr.min.js"></script>
        <script src="assets/js/pages/toastr.init.js"></script>
         <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
         <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
         <script src="assets/js/pages/datatables.init.js"></script> 
         <script src="assets/libs/select2/js/select2.min.js"></script>
         <script src="assets/js/pages/form-advanced.init.js"></script>
        
        <script src="assets/js/app.js"></script>
        <script type="text/javascript">

        </script>
    </body>
</html>
