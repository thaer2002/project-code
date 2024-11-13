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
?>
<div id="content">
    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right; color:white">
        <div class="container signup-container">
            <h2 class="mb-4" style="text-align: center;">تسجيل مستخدم جديد</h2>
            <?php
            if (isset($_POST['reg'])) {
                require_once("function.php");
                require_once("db_connect.php");
                registration($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $db_conn);
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" class="form-control" name="username" value="<?php if (isset($_POST['username'])) {
                                                                                        echo $_POST['username'];
                                                                                    } ?>" placeholder="اختر اسم المستخدم">
                </div>
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="text" class="form-control" name="email" value="<?php if (isset($_POST['email'])) {
                                                                                    echo $_POST['email'];
                                                                                } ?>" placeholder="ادخل البريد الإلكتروني">
                </div>
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['password'])) {
                                                                                            echo $_POST['password'];
                                                                                        } ?>" placeholder="اختر كلمة المرور">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control" name="confirmPassword" value="<?php if (isset($_POST['confirmPassword'])) {
                                                                                                    echo $_POST['confirmPassword'];
                                                                                                } ?>" placeholder="تأكيد كلمة المرور">
                </div>
                <button type="submit" class="btn btn-info" name="reg">إضافة</button>
            </form>
        </div>
    </div>
</div>