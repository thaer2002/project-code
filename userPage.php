<?php
session_start();
if (isset($_SESSION["usertype"])) {
   if ($_SESSION['usertype'] == "user") {
      require_once "db_connect.php";
      $user_id = $_SESSION['user_id'];
      $userData = mysqli_query($db_conn, "SELECT `confirm`,`profile_image`,`username`,`last_login`   FROM `user_tbl` WHERE `user_id`=$user_id");
      $userData = mysqli_fetch_array($userData);
   } else {
      header("Location:login.php");
   }
} else {
   header("Location:login.php");
}
require_once 'headerPage.php';
require_once "navBar.php";
require_once "userSideNav.php";
require_once "function.php";
?>
<div id="content" dir="rtl">
   <div class="container">
      <div class="row">
         <div id="content" dir="rtl">
            <div class="container" style="margin-top: 20px;">
               <div class="row">
                  <div class="col-md-3 "></div>
                  <div class="col-md-6 ">
                     <div class="card" style="border-radius: 20px;">
                        <div class="card-body text-center">
                           <div class="row">
                              <div class="col-sm-5">
                                 <img src="<?php echo $userData['profile_image'] ?>" style="width: 130px; height: 130px;">
                              </div>
                              <div class="col-sm-7">
                                 <h3 class="card-title"> اهلا بك من جيد</h3>
                                 <p class="card-text"> <?php echo $userData['username'] ?></p>
                                 <p class="card-text text-muted"><?php echo date("Y  l, F") ?></p>
                                 <p class="card-text text-muted"><strong>وقت الدخول : </strong><strong dir="ltr"><?php echo $userData['last_login'] ?></strong></p>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
