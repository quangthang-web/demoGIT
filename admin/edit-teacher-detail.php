<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['trmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $eid = $_GET['editid'];
        $tname = $_POST['tname'];
        $email = $_POST['email'];
        $mobnum = $_POST['mobilenumber'];
        $address = $_POST['address'];
        $quali = $_POST['qualifications'];
        $tsubjects = $_POST['tsubjects'];
        $tdate = $_POST['joiningdate'];

        $sql = "UPDATE tblteacher SET Name=:tname, Email=:email, MobileNumber=:mobilenumber, Qualifications=:qualifications, Address=:address, TeacherSub=:tsubjects, JoiningDate=:joiningdate WHERE ID=:eid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':tname', $tname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':qualifications', $quali, PDO::PARAM_STR);
        $query->bindParam(':mobilenumber', $mobnum, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':tsubjects', $tsubjects, PDO::PARAM_STR);
        $query->bindParam(':joiningdate', $tdate, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Chi tiết Giáo viên đã được cập nhật")</script>';
    }
?>

    <!DOCTYPE html>
    <html class="no-js" lang="vi">

    <head>
        <title>TRMS|| Cập nhật Giáo viên</title>

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
                            <h1>Cập nhật Chi tiết Giáo viên</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="dashboard.php">Bảng điều khiển</a></li>
                                <li><a href="manage-teacher.php">Cập nhật Giáo viên</a></li>
                                <li class="active">Cập nhật</li>
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
                                    <strong class="card-title">Cập nhật Chi tiết Giáo viên</strong>
                                </div>
                                <form name="" method="post" action="" enctype="multipart/form-data">

                                    <div class="card-body card-block">
                                        <?php
                                        $eid = $_GET['editid'];
                                        $sql = "SELECT * FROM tblteacher WHERE ID=$eid";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                        ?>
                                                <div class="form-group">
                                                    <label for="company" class="form-control-label">Tên Giáo viên</label>
                                                    <input type="text" name="tname" value="<?php echo $row->Name; ?>" class="form-control" id="tname" required="true">
                                                </div>

                                                <div class="form-group">
                                                    <label for="company" class="form-control-label">Ảnh Giáo viên</label>&nbsp;
                                                    <img src="images/<?php echo $row->Picture; ?>" width="100" height="100" value="<?php echo $row->Picture; ?>">
                                                    <a href="changeimage.php?editid=<?php echo $row->ID; ?>"> &nbsp; Chỉnh sửa Ảnh</a>
                                                </div>

                                                <div class="form-group">
                                                    <label for="street" class="form-control-label">Email Giáo viên</label>
                                                    <input type="text" name="email" value="<?php echo $row->Email; ?>" id="email" class="form-control" required="true">
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="city" class="form-control-label">Bằng cấp Giáo viên (Phân cách bởi dấu phẩy)</label>
                                                            <input type="text" name="qualifications" id="qualifications" value="<?php echo $row->Qualifications; ?>" class="form-control" required="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="city" class="form-control-label">Số điện thoại Giáo viên</label>
                                                            <input type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $row->MobileNumber; ?>" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="city" class="form-control-label">Môn học của Giáo viên</label>
                                                            <select type="text" name="tsubjects" id="tsubjects" value="" class="form-control" required="true">
                                                                <option value="<?php echo $row->TeacherSub; ?>"><?php echo $row->TeacherSub; ?></option>
                                                                <?php
                                                                $sql2 = "SELECT * FROM tblsubjects";
                                                                $query2 = $dbh->prepare($sql2);
                                                                $query2->execute();
                                                                $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                                foreach ($result2 as $row1) {
                                                                ?>
                                                                    <option value="<?php echo htmlentities($row1->Subject); ?>"><?php echo htmlentities($row1->Subject); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="city" class="form-control-label">Địa chỉ Giáo viên</label>
                                                            <textarea type="text" name="address" id="address" class="form-control" rows="5" cols="12" required="true"><?php echo $row->Address; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="city" class="form-control-label">Ngày vào làm</label>
                                                            <input type="date" name="joiningdate" id="joiningdate" value="<?php echo $row->JoiningDate; ?>" class="form-control" required="true">
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php $cnt = $cnt + 1;
                                            }
                                        } ?>

                                        <p style="text-align: center;">
                                            <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Cập nhật</button>
                                        </p>
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
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>

    </html>
<?php }  ?>