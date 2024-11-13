<?php
session_start();
require_once 'headerPage.php';
require_once "navBar.php";
if ($_SESSION['usertype'] == 'admin') {
    require_once "adminSidNav.php";
} else {
    require_once "userSideNav.php";
}
require_once "db_connect.php";
require_once "function.php";
if (isset($_SESSION["usertype"])) {

    $loc_id = $_GET['id'];
    $locationData = mysqli_query($db_conn, "SELECT `loc_id`, `loc_name`, `address`, `phone`, `cat_id`, `uni_id`, `lat`, `lng`,`desc`, `date_added` FROM `location` WHERE `loc_id`=$loc_id");
    $locationData = mysqli_fetch_assoc($locationData);
    if (!isset($_POST['save'])) {
        $_POST['loc_name'] = $locationData['loc_name'];
        $_POST['address'] = $locationData['address'];
        $_POST['cat'] = $locationData['cat_id'];
        $_POST['uni'] = $locationData['uni_id'];
        $_POST['phone'] = $locationData['phone'];
        $_POST['lat'] = $locationData['lat'];
        $_POST['lng'] = $locationData['lng'];
        $_POST['desc'] = $locationData['desc'];
        $_POST['add_map'] = $locationData['lat'] . " ," . $locationData['lng'];
    }
} else {
    header("Location:login.php");
}

?>

<div id="content">
    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right; color:white">
        <h2 class="mb-4" style="text-align: center;"> تعديل بيانات موقع </h2>
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
                                    هل انت متأكد من الحذف ؟
                                </div>
                                <div class="modal-footer text-right">
                                    <button type="submit" name="delete" class="btn btn-primary ">حذف</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------------->
                    <label>اسم الموقع</label>
                    <input type="text" name="loc_name" value="<?php if (isset($_POST['loc_name'])) {
                                                                    echo $_POST['loc_name'];
                                                                } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                    <label> العنوان </label>
                    <input type="text" name="address" value="<?php if (isset($_POST['address'])) {
                                                                    echo $_POST['address'];
                                                                } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                    <label> القسم </label>
                    <select name="cat" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                        <option value="">::إختر القسم::</option>
                        <?php
                        $selcted = "";
                        if (!empty($_POST['cat'])) {
                            $selcted = $_POST['cat'];
                        }
                        $catData = mysqli_query($db_conn, "SELECT `catgory_id`, `catogry_name` FROM `catogare`");
                        while ($row = mysqli_fetch_assoc($catData)) {
                            if ($selcted == $row['catgory_id']) {
                                echo "<option  value='$row[catgory_id]' selected >$row[catogry_name]</option>";
                            } else {
                                echo "<option  value='$row[catgory_id]' >$row[catogry_name]</option>";
                            }
                        }
                        ?>
                    </select>

                    <label> الجامعة </label>
                    <select name="uni" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>
                        <option value="">::إختر الجامعة::</option>
                        <?php
                        $selcted = "";
                        if (!empty($_POST['uni'])) {
                            $selcted = $_POST['uni'];
                        }
                        $catData = mysqli_query($db_conn, "SELECT `uni_id`, `uni_name`  FROM `universities`");
                        while ($row = mysqli_fetch_assoc($catData)) {
                            if ($selcted == $row['uni_id']) {
                                echo "<option  value='$row[uni_id]' selected >$row[uni_name]</option>";
                            } else {
                                echo "<option  value='$row[uni_id]' >$row[uni_name]</option>";
                            }
                        }
                        ?>
                    </select>
                    <label> رقم هاتف للتواصل</label>
                    <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) {
                                                                echo $_POST['phone'];
                                                            } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;">

                    <label> تفاصيل عن الموقع </label>
                    <textarea name="desc" class="form-control" style="margin-bottom: 30px;border-radius: 0px; height: 150px;"><?php if (isset($_POST['desc'])) {
                                                                                                                                    echo $_POST['desc'];
                                                                                                                                } ?></textarea>

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
                <button class="btn  btn-danger  btn-block" data-toggle="modal" data-target="#confirmDelete">حذف</button>
                <?php
                if (isset($_POST['save'])) {
                    updateLocation($loc_id, $_POST['loc_name'], $_POST['address'], $_POST['cat'], $_POST['uni'], $_POST['phone'], $_POST['lat'], $_POST['lng'], $_POST['desc'], $db_conn);
                    if ($_SESSION["usertype"] == 'admin') {
                        echo "<meta http-equiv='refresh' content=\"0;URL='allLocation.php'\" />";
                    } else {
                        echo "<meta http-equiv='refresh' content=\"0;URL='userAllLocation.php'\" />";
                    }
                }
                if (isset($_POST['delete'])) {
                    mysqli_query($db_conn, "DELETE FROM `location` WHERE `loc_id`=$loc_id");
                    if ($_SESSION["usertype"] == 'admin') {
                        echo "<meta http-equiv='refresh' content=\"0;URL='allLocation.php'\" />";
                    } else {
                        echo "<meta http-equiv='refresh' content=\"0;URL='userAllLocation.php'\" />";
                    }
                }
                ?>

            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6" id="map_canvas" style=" width: 20%; height: 100vh;">

            </div>
        </div>
    </div>
</div>
<?php include "googleMap.php" ?>