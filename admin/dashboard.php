<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['trmsaid'] == 0)) {
    header('location:logout.php');
} else {
?> <?php
    $sql = "SELECT ID from tblsubjects ";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $sublist = $query->rowCount();
    ?>
    <?php
    $sql1 = "SELECT ID from tblteacher ";
    $query1 = $dbh->prepare($sql1);
    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
    $totalteacher = $query1->rowCount();
    ?>
    <!doctype html>
    <html class="no-js" lang="en">

    <head>

        <title>TRMS Admin Dashboard</title>


        <link rel="apple-touch-icon" href="apple-icon.png">


        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


        <link rel="stylesheet" href="assets/css/style.css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    </head>

    <body>


        <?php include_once('includes/sidebar.php'); ?>

        <div id="right-panel" class="right-panel">

            <?php include_once('includes/header.php'); ?>
            <!-- Header-->

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content mt-3">
                <div class="col-md-12 mb-2">
                    <html>

                    <head>
                        <!--Load the AJAX API-->
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            // Load the Visualization API and the corechart package.
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });

                            // Set a callback to run when the Google Visualization API is loaded.
                            google.charts.setOnLoadCallback(drawChart);

                            // Callback that creates and populates a data table,
                            // instantiates the pie chart, passes in the data and
                            // draws it.
                            function drawChart() {

                                // Create the data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Topping');
                                data.addColumn('number', 'Slices');
                                data.addRows([
                                    ['Môn học', <?php echo json_encode($sublist); ?>],
                                    ['Giảng viên', <?php echo json_encode($totalteacher); ?>],
                                ]);

                                // Set chart options
                                var options = {
                                    'title': 'Biểu đổ giữa số lượng giảng viên so với số lượng môn học',
                                    'width': 'w-100',
                                    'height': 300
                                };

                                // Instantiate and draw our chart, passing in some options.
                                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

                                chart.draw(data, options);
                            }
                        </script>
                    </head>

                    <body>
                        <!--Div that will hold the pie chart-->
                        <div id="chart_div"></div>
                    </body>

                    </html>
                </div>
                <div class="col-sm-6 col-lg-6">

                    <div class="card text-white bg-flat-color-4">
                        <div class="card-body pb-0">
                            <div class="dropdown float-right">
                                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                    <div class="dropdown-menu-content">
                                        <a class="dropdown-item" href="manage-subjects.php">Action</a>

                                    </div>
                                </div>
                            </div>

                            <h4 class="mb-0">
                                <span class="count"><?php echo $sublist; ?></span>
                            </h4>
                            <p class="text-light">Tổng số môn học</p>

                            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                                <canvas id="widgetChart4"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
                <!--/.col-->

                <div class="col-sm-6 col-lg-6">
                    <div class="card text-white bg-flat-color-2">
                        <div class="card-body pb-0">
                            <div class="dropdown float-right">
                                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <div class="dropdown-menu-content">
                                        <a class="dropdown-item" href="manage-teacher.php">Action</a>

                                    </div>
                                </div>
                            </div>
                            <?php
                            $sql1 = "SELECT ID from tblteacher ";
                            $query1 = $dbh->prepare($sql1);
                            $query1->execute();
                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                            $totalteacher = $query1->rowCount();
                            ?>
                            <h4 class="mb-0">
                                <span class="count"><?php echo htmlentities($totalteacher); ?></span>
                            </h4>
                            <p class="text-light">Tổng số lượng giảng viên</p>

                            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                                <canvas id="widgetChart2"></canvas>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <a class="btn btn-success d-none text-white d-md-inline-block" onclick="window.print()">IN THỐNG KÊ</a>
                </div>
            </div> <!-- .content -->

        </div><!-- /#right-panel -->
        <!-- Right Panel -->

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>


        <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/widgets.js"></script>
        <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script>
            (function($) {
                "use strict";

                jQuery('#vmap').vectorMap({
                    map: 'world_en',
                    backgroundColor: null,
                    color: '#ffffff',
                    hoverOpacity: 0.7,
                    selectedColor: '#1de9b6',
                    enableZoom: true,
                    showTooltip: true,
                    values: sample_data,
                    scaleColors: ['#1de9b6', '#03a9f5'],
                    normalizeFunction: 'polynomial'
                });
            })(jQuery);
        </script>

    </body>

    </html>
<?php } ?>