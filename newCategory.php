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
    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right; color:white">
        <h2 class="mb-4" style="text-align: center;"> إضافة قسم </h2>
        <div class="row">
        <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label>اسم القسم</label>
                    <input type="text" name="cat_name" value="<?php if (isset($_POST['cat_name'])) {
                                                                    echo $_POST['cat_name'];
                                                                } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                    
                    <label > تحميل  صورة للقسم </label>
                    <input type="file" name="imgs" accept=".jpg, .png, .jpeg, .gif" class="form-control" style="margin-bottom: 30px; border-radius: 0px;" />


                    <button type="submit" name="save" class="btn btn-info  btn-block">حفظ</button>
                    <?php
                    if (isset($_POST['save'])) {
                        saveCat($_POST['cat_name'],$_FILES['imgs'], $db_conn);
                        echo "<meta http-equiv='refresh' content=\"0;URL='categories.php'\" />";
                    }
                    ?>
                </form>
            </div>
            
        </div>
    </div>
</div>
