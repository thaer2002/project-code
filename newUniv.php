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
 <meta charset="UTF-8">
<div id="content">
    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right; color:white">
        <h2 class="mb-4" style="text-align: center;"> إضافة جامعة </h2>
        <div class="row">
            <div class="col-sm-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label>اسم الجامعة</label>
                    <input type="text" name="uni_name"   pattern="[\u0600-\u06FF\s]+"   title="مسموح احرف  عربي  فقط"  value="<?php if (isset($_POST['uni_name'])) {
                                                                    echo $_POST['uni_name'];
                                                                } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                    
                    <label> العنوان </label>
                    <input type="text" name="address" value="<?php if (isset($_POST['address'])) {
                                                                    echo $_POST['address'];
                                                                } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                    <label > تحميل شعار الجامعة </label>
                    <input type="file" name="imgs" accept=".jpg, .png, .jpeg, .gif" class="form-control" style="margin-bottom: 30px; border-radius: 0px;" />


                    <label> الموقع على الخريطه (خط الطول , دائرة العرض)</label>
                    <input type="text" name="add_map" id="add_map" value="<?php if (isset($_POST['add_map'])) {
                                                                                echo $_POST['add_map'];
                                                                            } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px; width:80%; float:right" required>
                    <button type="button" name="get" onclick="initialize()" class="btn btn-info" style=" border-radius: 0px; width: 20%; float:left ; clear:left">بحث</button>
                    
                    <input type="hidden" name="lat" id="lat" value="<?php if (isset($_POST['lat'])) {
                                                                        echo $_POST['lat'];
                                                                    } ?>" />
                    <input type="hidden" name="lng" id="lng" value="<?php if (isset($_POST['lng'])) {
                                                                        echo $_POST['lng'];
                                                                    } ?>" />

                    <button type="submit" name="save" class="btn btn-info  btn-block">حفظ</button>
                    <?php
                    if (isset($_POST['save'])){
                        addUniversty($_POST['uni_name'], $_POST['address'], $_POST['lat'], $_POST['lng'], $_FILES['imgs'], $db_conn);
                        echo "<meta http-equiv='refresh' content=\"0;URL='allUniv.php'\" />";
                    }
                    ?>
                </form>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6" id="map_canvas"  style=" width: 20%; height: 100vh;">

            </div>
        </div>
    </div>
</div>

<?php include "googleMap.php" ?>

<script>
function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8);
};
</script>