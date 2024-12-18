<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using MD5
    $hashedPassword = md5($password);

    // Assuming your table structure includes columns like 'username' and 'password'
    $sql = "INSERT INTO tbladmin(username, password) VALUES (:username, :password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $query->execute();

    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
        echo '<script>alert("Đã đăng kí tài khoản thành công! Giờ bạn đã có thể đăng nhập!.")</script>';
        echo "<script>window.location.href ='index.php'</script>";
    } else {
        echo '<script>alert("Có lỗi xảy ra. Vui lòng thử lại.")</script>';
    }
}
?>


<!doctype html>
<html class="no-js" lang="en">

<head>

    <title>Nhóm 23 || Admin Login</title>


    <link rel="apple-touch-icon" href="apple-icon.png">



    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-dark" style=" background-image: url('images/home-banner.jpg');">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                </div>
                <div class="login-form">
                    <form action="" method="post" name="login">
                        <h3 class="text-center">ĐĂNG KÍ TÀI KHOẢN</h3>
                        <hr color="red" />

                        <div class="form-group">
                            <label>Tài khoản</label>
                            <input type="text" class="form-control" required="true" name="username">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="password" required="true">
                        </div>
                        <div class="d-flex text-danger justify-content-between mb-2">
                            <a class="text-danger text-decoration-none" href="../index.php">Quay lại trang chủ!!</a>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="submit">Đăng kí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>