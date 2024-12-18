<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);

if (strlen($_SESSION['trmsaid']) == 0) {
    header('location:logout.php');
} else {
?>

    <!doctype html>
    <html class="no-js" lang="vi">

    <head>

        <title>Báo cáo TRMS</title>


        <link rel="apple-touch-icon" href="apple-icon.png">



        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

        <link rel="stylesheet" href="assets/css/style.css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


    </head>

    <body>
        <!-- Left Panel -->

        <?php include_once('includes/sidebar.php'); ?>

        <div id="right-panel" class="right-panel">

            <!-- Header-->
            <?php include_once('includes/header.php'); ?>

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Báo cáo giữa các ngày</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="dashboard.php">Bảng điều khiển</a></li>
                                <li><a href="bwdates-report-ds.php">Báo cáo giữa các ngày</a></li>
                                <li class="active">Báo cáo</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content mt-3">
                <div class="animated fadeIn">

                    <div class="row">
                        <div class="col-lg-6">
                            <!-- .card -->

                        </div>
                        <!--/.col-->

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Giữa các ngày</strong><small> Báo cáo</small></div>
                                <form name="bwdatesreport" action="bwdates-reports-details.php" method="post">
                                    <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                                                echo $msg;
                                                                                            }  ?> </p>
                                    <div class="card-body card-block">

                                        <div class="form-group"><label for="company" class=" form-control-label">Từ ngày</label><input type="date" name="fromdate" id="fromdate" class="form-control" required="true"></div>
                                        <div class="form-group"><label for="vat" class=" form-control-label">Đến ngày</label><input type="date" name="todate" class="form-control" required="true"></div>

                                    </div>
                                    <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">
                                            <i class="fa fa-dot-circle-o"></i> Gửi
                                        </button></p>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        </div><!-- /#right-panel -->
        <!-- Right Panel -->

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>

        <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>

    </html>
<?php }  ?>