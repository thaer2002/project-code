<?php
session_start();
if (isset($_SESSION["usertype"])) {
    if ($_SESSION['usertype'] == "user") {
        $user_id = $_SESSION['user_id'];
    } else {
        header("Location:login.php");
    }
} else {
    header("Location:login.php");
}
require_once 'headerPage.php';
require_once "navBar.php";
require_once "userSideNav.php";
require_once "db_connect.php";
require_once "function.php";
?>

<div id="content">

    <div class="container-fluid" dir="rtl" style="margin-top: 20px; text-align:right; color:white">
        <h2 class="mb-4" style="text-align: center;"> المواقع المفضله </h2>
        <div class="row">
            <?php
            if(isset($_GET['rem'])){
                mysqli_query($db_conn,"DELETE FROM `saved_loc` WHERE `save_indx`=$_GET[rem]");
            }
            $locData = mysqli_query($db_conn, "SELECT  `save_indx`,`saved_loc`.`loc_id`, `loc_name`, `address`, `phone` FROM `saved_loc` 
                                               INNER JOIN  `location` ON  `location`.`loc_id`  =  `saved_loc`.`loc_id` 
                                               WHERE  `saved_loc`.`user_id` = $user_id");     
           
            while ($row = mysqli_fetch_assoc($locData)) {
                $img = "img/location.png";
            ?>
                <div class="col-sm-3" style=" margin-bottom: 20px;">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="<?php echo  $img ?>" style="height: 200px;  padding: 20px; padding-left:60px; padding-right: 60px;">
                        <div class="card-body text-center">
                            <h4 class="card-title text-dark"><?php echo  $row['loc_name'] ?></h4>
                            <p class="card-text text-dark"><?php echo  $row['address'] ?>
                                <br>
                            <p class="card-text text-dark"><?php echo  $row['phone'] ?>
                            </p>
                            <a href="locationDetails.php?id=<?php echo $row['loc_id'] ?>" class="btn btn-primary btn-block"> تفاصيل الموقع </a>
                            <a href="?rem=<?php echo $row['save_indx'] ?>" class="btn btn-danger btn-block">  إزالة من المفضله </a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>