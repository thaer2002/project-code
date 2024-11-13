<?php
session_start();
require_once 'headerPage.php';
require_once "navBar.php";
require_once "adminSidNav.php";
require_once "db_connect.php";
require_once "function.php";
if (isset($_SESSION["usertype"])) {
    if ($_SESSION['usertype'] == "admin") {
        $cat_id = $_GET['id'];
        $cat_data = mysqli_query($db_conn, "SELECT `catgory_id`, `catogry_name`, `img` FROM `catogare` WHERE `catgory_id`=$cat_id");
        $cat_data = mysqli_fetch_assoc($cat_data);
        if (!isset($_POST['save'])) {
            $_POST['cat_name'] = $cat_data['catogry_name'];
        }
        $img = $cat_data['img'];
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
        <h2 class="mb-4" style="text-align: center;"> تعديل قسم </h2>
        <div class="row">
            <div class="col-sm-3"></div>
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

                    <label>اسم القسم</label>
                    <input type="text" name="cat_name" value="<?php if (isset($_POST['cat_name'])) {
                                                                    echo $_POST['cat_name'];
                                                                } ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px;" required>

                    <label> تحميل صورة للقسم <a href="<?php echo $img ?>" target="_blank" class="btn btn-link">الصوره الحاليه </a></label>
                    <input type="file" name="imgs" accept=".jpg, .png, .jpeg, .gif" class="form-control" style="margin-bottom: 30px; border-radius: 0px;" />

                </form>
                <button class="btn btn-info  btn-block" data-toggle="modal" data-target="#confirmEdit">حفظ</button>
                <button class="btn  btn-danger  btn-block" data-toggle="modal" data-target="#confirmDelete">حذف</button>
                <?php
                if (isset($_POST['save'])) {
                    updateCat($cat_id, $_POST['cat_name'], $_FILES['imgs'], $img, $db_conn);
                    echo "<meta http-equiv='refresh' content=\"0;URL='categories.php'\" />";
                }
                if (isset($_POST['delete'])) {
                    mysqli_query($db_conn, "DELETE FROM `catogare` WHERE `catgory_id`=$cat_id");
                    echo "<meta http-equiv='refresh' content=\"0;URL='categories.php'\" />";
                }
                ?>

            </div>
        </div>
    </div>
</div>