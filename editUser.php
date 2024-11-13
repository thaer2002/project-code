<?php
session_start();
require_once 'headerPage.php';
require_once "navBar.php";
require_once "db_connect.php";
require_once "function.php";
require_once "adminSidNav.php";
if (isset($_SESSION["usertype"])){
  if($_SESSION['usertype']=="admin"){
     $id=$_GET['user_id'];
     $userData=mysqli_query($db_conn,"SELECT `user_id`, `username`, `email`, `password` FROM `user_tbl` WHERE `user_id`=$id");
     $userData=mysqli_fetch_assoc($userData);
     if(!isset($_POST['reg'])){
        $_POST['username']=$userData['username'];
        $_POST['email']=$userData['email'];
     }
     $pass= $userData['password'];
    }else{
     header("Location:login.php");
  }
}else{
  header("Location:login.php");
}

?>
    <div id="content" >
    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right; color:white" >
    <div class="container signup-container">
    <h2 class="mb-4" style="text-align: center;">تسجيل مستخدم جديد</h2>
    <?php
    if (isset($_POST['reg'])) {
      require_once("function.php");
      require_once("db_connect.php");
      editUser($id,$_POST['username'], $_POST['email'],$pass, $_POST['password'], $_POST['confirmPassword'], $db_conn);
    }
    ?>
    <form action="" method="POST">
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
                                    <button type="submit" name="reg" class="btn btn-primary ">حفظ</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!------------ delete Confirmation box  --------------->
      <div class="form-group">
        <label for="username">اسم المستخدم</label>
        <input type="text" class="form-control" name="username" readonly style="background-color: silver;"  value="<?php if (isset($_POST['username'])) {
                                                                          echo $_POST['username'];
                                                                        } ?>" placeholder="اختر اسم المستخدم">
      </div>
      <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input type="text" class="form-control" name="email" readonly  style="background-color: silver;"  value="<?php if (isset($_POST['email'])) {
                                                                      echo $_POST['email'];
                                                                    } ?>" placeholder="ادخل البريد الإلكتروني">
      </div>
      <div class="form-group">
        <label for="password">كلمة المرور</label>
        <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['password'])) {
                                                                              echo $_POST['password'];
                                                                            } ?>" placeholder=" -- لا تغيير -- ">
      </div>
      <div class="form-group">
        <label for="confirmPassword">تأكيد كلمة المرور</label>
        <input type="password" class="form-control" name="confirmPassword" value="<?php if (isset($_POST['confirmPassword'])) {
                                                                                    echo $_POST['confirmPassword'];
                                                                                  } ?>"  placeholder=" -- لا تغيير -- ">
      </div>
      </form>
      <button class="btn btn-info " data-toggle="modal" data-target="#confirmEdit">&nbsp;حفظ &nbsp;</button>
    
    
    </div>
    </div>
</div>
