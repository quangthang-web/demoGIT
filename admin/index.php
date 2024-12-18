<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['trmsaid'] = $result->ID;
        }
        $_SESSION['login'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
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
                    <h3 style="color:red">Nhóm 23 || HỆ THỐNG QUẢN LÝ GIẢNG VIÊN </h3>
                    <hr color="red" />
                </div>
                <div class="login-form">
                    <form action="" method="post" name="login">
                        <h2 class="text-danger text-center"> Đăng nhập</h2>
                        <hr>
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
                            <a class="text-danger text-decoration-none" href="forgot-password.php">Quên mật khẩu?</a>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="login">Đăng nhập</button>
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