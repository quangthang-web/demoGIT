<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="icon" href="img/favicon.png" type="image/png">
    <title>TRMS|| Tìm kiếm giáo viên</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        td {
            border: 2px solid orange;
        }

        th {
            color: #000;
            border: 2px solid orange;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>

<body>

    <?php include_once('includes/header.php'); ?>

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="banner_content text-center">
                            <h2>Chi tiết giáo viên</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if (isset($_POST['search'])) {
                        $sdata = $_POST['searchteacher'];
                    ?>
                        <h4 align="center">Kết quả tìm kiếm theo môn "<?php echo $sdata; ?>"</h4>

                        <div class="card-body">
                            <table class="table table-responsive" border="1">
                                <thead>
                                    <tr>
                                        <th>Số thứ tự</th>
                                        <th>Ảnh</th>
                                        <th>Tên giáo viên</th>
                                        <th>Môn học</th>
                                        <th>Email giáo viên</th>
                                        <th>Số điện thoại giáo viên</th>
                                        <th>Trình độ giáo viên</th>
                                        <th>Địa chỉ giáo viên</th>
                                    </tr>
                                </thead>
                                <?php
                                $sql = "SELECT * from tblteacher where TeacherSub like  '%$sdata%'";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $row) {
                                ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><img src="admin/images/<?php echo $row->Picture; ?>" height="100"></td>
                                            <td><?php echo htmlentities($row->Name); ?></td>
                                            <td><?php echo htmlentities($row->TeacherSub); ?></td>
                                            <td><?php echo htmlentities($row->Email); ?></td>
                                            <td><?php echo htmlentities($row->MobileNumber); ?></td>
                                            <td><?php echo htmlentities($row->Qualifications); ?></td>
                                            <td><?php echo htmlentities($row->Address); ?></td>
                                        </tr>
                                    <?php
                                        $cnt = $cnt + 1;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7" style="color:red; text-align:center">Không tìm thấy bản ghi nào phù hợp với tìm kiếm này</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->

    <?php include_once('includes/footer.php'); ?>

    <!--================ End footer Area  =================-->

    <!--================Contact Success and Error message Area =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/owl-carousel-thumb.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/mail-script.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
</body>

</html>
<?php } ?>