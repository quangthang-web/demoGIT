<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['trmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>

    <!DOCTYPE html>
    <html class="no-js" lang="vi">

    <head>
        <title>TRMS || Quản lý giảng viên</title>

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
                            <h1>Quản lý Giáo viên</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="dashboard.php">Bảng điều khiển</a></li>
                                <li><a href="manage-teacher.php">Quản lý giảng viên</a></li>
                                <li class="active">Danh sách giảng viên</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Quản lý Giáo viên</strong>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>STT</th>
                                                <th>Ảnh</th>
                                                <th>Tên Giáo viên</th>
                                                <th>Môn Học</th>
                                                <th>Ngày Đăng ký</th>
                                                <th>Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sql = "SELECT * FROM tblteacher";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                        ?>
                                                <tr class="text-center">
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><img width="50" height="50" src="images/<?php echo htmlentities($row->Picture); ?>" alt="err"></td>
                                                    <td class="py-4"><?php echo htmlentities($row->Name); ?></td>
                                                    <td class="py-4"><?php echo htmlentities($row->TeacherSub); ?></td>
                                                    <td class="py-4"><?php echo htmlentities($row->RegDate); ?></td>
                                                    <td class="text-center py-4">
                                                        <a href="edit-teacher-detail.php?editid=<?php echo htmlentities($row->ID); ?>" class="btn btn-success btn-sm rounded text-white d-inline-block" width="50" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                        <a href="remove-teacher.php?id=<?php echo htmlentities($row->ID); ?>" class="btn btn-danger btn-sm rounded text-white d-inline-block " width="50" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                        <?php $cnt = $cnt + 1;
                                            }
                                        } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->

        <!-- Right Panel -->

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>

    </html>
<?php } ?>