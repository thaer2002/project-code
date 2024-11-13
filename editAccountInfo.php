<?php
session_start();
require_once "db_connect.php";
if (isset($_SESSION["usertype"])) { 
    $user_id = $_SESSION['user_id'];
    $userData = mysqli_query($db_conn, "SELECT `username`, `password` FROM `user_tbl` WHERE `user_id`=$user_id");
    $userData = mysqli_fetch_array($userData);
   
  
} else {
  header("Location:login.php");
}
require_once 'headerPage.php';
require_once "navBar.php";
if($_SESSION['usertype']=='admin'){require_once "adminSidNav.php";}else{require_once "userSideNav.php";}
require_once "function.php";
?>
<div id="content">
  <div class="container text-light" dir="rtl" style="margin-top: 20px; text-align:right">
    <div class="container signup-container">
      <h2 class="mb-4" style="text-align: center;"> تعديل معلومات الحساب</h2>
      <?php
      if (isset($_POST['save'])) {
        updateUserData($user_id, $_POST['username'],$_FILES['img'], $userData['password'], $_POST['password'], $_POST['confirmPassword'], $db_conn);
      }
      ?>
      <form action="" method="POST" enctype="multipart/form-data">
          <!------------------ Edit Confirmation box  ------------>
          <div class="modal fade text-dark" id="confirmEdit">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">تأكيد الحفظ </h4>
                                </div>
                                <div class="modal-body">
                                    هل انت متأكد من حفظ التعديلات ؟
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="save" class="btn btn-primary ">حفظ</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
        <div class="form-group">
          <label for="username">اسم المستخدم</label>
          <input type="text" class="form-control" name="username" value="<?php if (isset($_POST['username'])) {
                                                                            echo $_POST['username'];
                                                                          } else {
                                                                            echo $userData['username'];
                                                                          } ?>" placeholder="اختر اسم المستخدم">
        </div>
        <div class="form-group">
          <label for="image">الصوره الشخصيه</label>
          <input type="file" class="form-control" name="img" value=""  accept=".jpg, .png, .jpeg, .gif" >
        </div>
        <div class="form-group">
          <label for="password">كلمة المرور الجديده</label>
          <input type="password" class="form-control" name="password" value="" placeholder="--بدون تغيير --">
        </div>
        <div class="form-group">
          <label for="confirmPassword">تأكيد كلمة المرور الجديده</label>
          <input type="password" class="form-control" name="confirmPassword" value="" placeholder="--بدون تغيير --">
        </div>
        </form>
        <button class="btn btn-info" data-toggle="modal" data-target="#confirmEdit">حفظ</button>
      
    </div>
  </div>
</div>