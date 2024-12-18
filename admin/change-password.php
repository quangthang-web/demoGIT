<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['trmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['trmsaid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $sql = "SELECT ID FROM tbladmin WHERE ID=:adminid and Password=:cpassword";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminid', $adminid, PDO::PARAM_STR);
        $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "UPDATE tbladmin SET Password=:newpassword WHERE ID=:adminid";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':adminid', $adminid, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();

            echo '<script>alert("Mật khẩu của bạn đã được thay đổi thành công")</script>';
        } else {
            echo '<script>alert("Mật khẩu hiện tại của bạn không đúng")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="vi">

<head>
    <title>CCMS Thay Đổi Mật Khẩu</title>
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        function checkpass() {
            if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                alert('Mật khẩu mới và Xác nhận mật khẩu không khớp');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <?php include_once('includes/sidebar.php'); ?>
    <div id="right-panel" class="right-panel">
        <?php include_once('includes/header.php'); ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Thay Đổi Mật Khẩu</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Bảng điều khiển</a></li>
                            <li><a href="change-password.php">Thay Đổi Mật Khẩu</a></li>
                            <li class="active">Thay Đổi</li>
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
                            <div class="card-header"><strong>Thay Đổi</strong><small> Mật Khẩu</small></div>
                            <form name="changepassword" method="post" onsubmit="return checkpass();" action="">
                                <div class="card-body card-block">
                                    <div class="form-group"><label for="company" class=" form-control-label">Mật Khẩu Hiện Tại</label><input type="password" name="currentpassword" id="currentpassword" class="form-control" required=""></div>
                                    <div class="form-group"><label for="vat" class=" form-control-label">Mật Khẩu Mới</label><input type="password" name="newpassword" class="form-control" required=""></div>
                                    <div class="form-group"><label for="street" class=" form-control-label">Xác Nhận Mật Khẩu</label><input type="password" name="confirmpassword" id="confirmpassword" value="" class="form-control"></div>
                                </div>
                                <div class="card-footer">
                                    <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Thay Đổi</button></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>