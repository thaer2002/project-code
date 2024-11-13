<?php
session_start();
require_once 'headerPage.php';
require_once "navBar.php";
require_once "adminSidNav.php";
require_once "db_connect.php";
require_once "function.php";
if (isset($_SESSION["usertype"])) {
    if ($_SESSION['usertype'] == "admin") {
        $uiv_id = $_GET['id'];
        $uiv_data = mysqli_query($db_conn, "SELECT `uni_id`, `uni_name`, `address`, `img`, `lng`, `lat` FROM `universities` WHERE `uni_id`=$uiv_id");
        $uiv_data = mysqli_fetch_assoc($uiv_data);
        if (!isset($_POST['save'])) {
            $_POST['uni_name'] = $uiv_data['uni_name'];
            $_POST['address'] =  $uiv_data['address'];
            $_POST['lat'] =  $uiv_data['lat'];
            $_POST['lng'] =  $uiv_data['lng'];
            $_POST['add_map'] = $uiv_data['lat'] . ", " .  $uiv_data['lng'];
        }
        $img = $uiv_data['img'];
        if (empty($img)) {
            $img = "un_logo/no-image.png";
        }
    } else {
        header("Location:login.php");
    }
} else {
    header("Location:login.php");
}

?>

<div id="content">
    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right; color:white">
        <h2 class="mb-4" style="text-align: center;"> تعديل جامعة </h2>
        <div class="row">
            <div class="col-sm-6">
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
                    <!------------ delete Confirmation box  --------------->
                    <div class="modal fade text-dark" id="confirmDelete">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">تأكيد الحذف </h4>
                                </div>
                                <div class="modal-body">
                                    هل انت متأكد من الحذف  ؟
                                </div>
                                <div class="modal-footer text-right">
                                    <button type="submit" name="delete" class="btn btn-primary ">حذف</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------------->
                    <label>اسم الجامعة</label>
                    <input type="text" name="uni_name" pattern="[\u0600-\u06FF\s]+" title="مسموح احرف  عربي  فقط" value="<?php if (isset($_POST['uni_name'])) {
                                                                                                echo $_POST['uni_name'];
                                                                                            } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                    <label> العنوان </label>
                    <input type="text" name="address" value="<?php if (isset($_POST['address'])) {
                                                                    echo $_POST['address'];
                                                                } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                    <label> تحميل شعار الجامعة <a href="<?php echo $img ?>" target="_blank" class="btn btn-link">الصوره الحاليه</a></label>
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

                </form>

                <button class="btn btn-info  btn-block" data-toggle="modal" data-target="#confirmEdit">حفظ</button>
                <button  class="btn  btn-danger  btn-block"   data-toggle="modal" data-target="#confirmDelete">حذف</button>
                <br><br>
                <?php
                if (isset($_POST['save'])) {
                    updateUniversty($uiv_id, $_POST['uni_name'], $_POST['address'], $_POST['lat'], $_POST['lng'], $_FILES['imgs'], $img, $db_conn);
                }
                if (isset($_POST['delete'])) {
                    mysqli_query($db_conn, "DELETE FROM `universities` WHERE `uni_id`= $uiv_id");
                    echo "<meta http-equiv='refresh' content=\"0;URL='allUniv.php'\" />";
                }
                ?>

            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6" id="map_canvas" style=" width: 20%; height: 100vh;">

            </div>
        </div>
    </div>
</div>
<?php include "googleMap.php" ?>

