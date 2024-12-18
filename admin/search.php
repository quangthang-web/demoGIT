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
        <title>TRMS || Tìm kiếm theo tên môn học</title>

        <link rel="apple-touch-icon" href="apple-icon.png">
        <link rel="shortcut icon" href="favicon.ico">

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
                            <h1>Tìm kiếm Giáo viên</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="dashboard.php">Bảng điều khiển</a></li>
                                <li><a href="search.php">Tìm kiếm Giáo viên</a></li>
                                <li class="active">Giáo viên</li>
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
                                    <strong class="card-title">Tìm kiếm Giáo viên</strong>
                                </div>

                                <form name="search" method="post" style="padding-top: 20px">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <div class="form-group row">
                                                    <label class="col-4 col-form-label" for="example-email" style="padding-left: 50px"><strong>Tìm kiếm theo Tên hoặc Môn học</strong></label>
                                                    <div class="col-6">
                                                        <input id="searchdata" type="text" name="searchdata" required="true" class="form-control">
                                                    </div>
                                                </div>
                                                <p style="text-align: center;">
                                                    <button type="submit" class="btn btn-primary btn-sm" name="search" id="submit">
                                                        <i class="fa fa-dot-circle-o"></i> Tìm kiếm
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                if (isset($_POST['search'])) {
                                    $sdata = $_POST['searchdata'];
                                ?>
                                    <h4 align="center">Kết quả tìm kiếm cho "<?php echo $sdata; ?>"</h4>

                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>S.NO</th>
                                                    <th>Tên Giáo viên</th>
                                                    <th>Môn học</th>
                                                    <th>Ngày đăng ký</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $sql = "SELECT * FROM tblteacher WHERE Name LIKE '%$sdata%' OR TeacherSub LIKE '%$sdata%'";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($row->Name); ?></td>
                                                        <td><?php echo htmlentities($row->TeacherSub); ?></td>
                                                        <td><?php echo htmlentities($row->RegDate); ?></td>
                                                        <td><a href="edit-teacher-detail.php?editid=<?php echo htmlentities($row->ID); ?>">Chỉnh sửa chi tiết</a></td>
                                                    </tr>
                                                <?php
                                                    $cnt = $cnt + 1;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="8">Không tìm thấy bản ghi nào phù hợp với tìm kiếm này</td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                <?php } ?>
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
<?php }  ?>