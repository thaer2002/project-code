<?php
session_start();
if (isset($_SESSION["usertype"])) {
    if ($_SESSION['usertype'] == "admin") {
        //pass
    } else {
        header("Location:login.php");
    }
} else {
    header("Location:login.php");
}
require_once 'headerPage.php';
require_once "navBar.php";
require_once "adminSidNav.php";
require_once "db_connect.php";
require_once "function.php";
?>

<div id="content">
    <div class="container-fluid" dir="rtl" style="margin-top: 20px; text-align:right; color:white">
        <h2 class="mb-4" style="text-align: center;"> الاقسام المضافه </h2>
        <div class="row">

            <?php
            $unvData = mysqli_query($db_conn, "SELECT `catgory_id`, `catogry_name`, `img` FROM `catogare`");
            while ($row = mysqli_fetch_assoc($unvData)) {
                $img = $row['img'];
                if (empty($img)) {
                    $img = "un_logo/no-image.png";
                }
            ?>
                <div class="col-sm-3" style=" margin-bottom: 20px;">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="<?php echo  $img ?>" style="height: 220px;">
                        <div class="card-body text-center">
                            <h4 class="card-title text-dark"><?php echo  $row['catogry_name'] ?></h4>
                            <a href="editCat.php?id=<?php echo $row['catgory_id'] ?>" class="btn btn-primary btn-block"> تعديل </a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>