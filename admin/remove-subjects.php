<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['trmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM tblsubjects WHERE ID = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        echo '<script>alert("Đã xóa môn học.")</script>';
        echo "<script>window.location.href ='manage-subjects.php'</script>";
    } else {
        echo '<script>alert("ID không hợp lệ.")</script>';
    }
}
