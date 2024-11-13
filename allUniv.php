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
        <h2 class="mb-4" style="text-align: center;"> الجامعات المضافه </h2>
        <div class="row">

            <?php
            $unvData = mysqli_query($db_conn, "SELECT `uni_id`, `uni_name`, `address`, `img`, `lng`, `lat` FROM `universities`");
            while ($row = mysqli_fetch_assoc($unvData)) {
                $img = $row['img'];
                if (empty($img)) {
                    $img = "un_logo/no-image.png";
                }
            ?>
                <div class="col-sm-3" style=" margin-bottom: 20px;">
                    <div class="card" >
                        <img class="card-img-top img-fluid" src="<?php echo  $img ?>" style="height: 220px;">
                        <div class="card-body text-center">
                            <h4 class="card-title text-dark"  style=" font-size: 18px;"><?php echo  $row['uni_name'] ?></h4>
                            <p class="card-text text-dark"><?php echo  $row['address'] ?></p>
                            
                            <a href="editUniv.php?id=<?php echo $row['uni_id'] ?>" class="btn btn-primary btn-block"> تعديل </a>
                        </div>
                    </div>
                </div>
                
            <?php
            }
            ?>

    </div>
</div>
</div>