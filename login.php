<?php
session_start();
require_once 'headerPage.php';
require_once "navBar.php";
?>
<style>
  body {
    background-color: #f8f9fa;
  }

  .login-container {
    margin-top: 50px;
    max-width: 400px;
    background-color: #DFD0B8;
    padding: 20px;
    border-radius: 10px;
    text-align: right;
  }
</style>

<body dir='rtl' style=" background-color: #153448;">

  <!-- Login Form -->
  <div class="container login-container">
    <h2 class="mb-4 text-center">تسجيل دخول</h2>
     <?php 
     if(isset($_POST['login'])){
      require_once("function.php");
      login($_POST['email'], $_POST['password']);
     }
     ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="username">البريد الإلكتروني</label>
        <input type="text" class="form-control" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" placeholder="ادخل البريد الإلكتروني " >
      </div>
      <div class="form-group">
        <label for="password">كلمة المرور</label>
        <input type="password" class="form-control" name="password"  value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>" placeholder="ادخل كلمة المرور" >
      </div>
      <button type="submit" name="login" class="btn btn-primary btn-block" style=" background-color: #153448;">دخول</button>
    </form>
    <p class="mt-3">لا تمتلك حساب ؟ <a href="signup.php">سجل من هنا</a></p>
  </div>
</body>

</html>