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
        <h2 class="mb-4" style="text-align: center;">قائمة المستخدمين </h2>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered text-light">
                    <thead>
                        <tr style="text-align: center; background-color: #DAFFFB;" class="text-dark">
                            <th>إسم المستخدم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ التسجيل</th>
                            <th></th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['un_conf'])) {
                            userConfirm($_GET['un_conf'], 'un_conf', $db_conn);
                        }
                        if (isset($_GET['add_block'])) {
                            userBlock($_GET['add_block'], "add", $db_conn);
                        }
                        if (isset($_GET['remove_block'])) {
                            userBlock($_GET['remove_block'], "remove", $db_conn);
                        }
                        $userData = mysqli_query($db_conn, "SELECT `user_id`, `username`, `email`, `confrm_img`,`blocked`,`date_added` FROM `user_tbl` 
                                                                WHERE  `usertype`='user' ORDER BY `user_id` DESC");
                        while ($row = mysqli_fetch_assoc($userData)) {
                            echo "<tr style='text-align: center;'>";
                            echo "<td>$row[username]</td>";
                            echo "<td>$row[email]</td>";
                            echo "<td>$row[date_added]</td>";
                            echo "<td><a href='editUser.php?user_id=$row[user_id]' class='btn btn-info'>تعديل</a></td>";
                            $block = "<a href='?add_block=$row[user_id]' class='btn btn-danger'>تعطيل الحساب</a>";
                            if ($row['blocked'] == 'yes') {
                                $block = "<a href='?remove_block=$row[user_id]' class='btn btn-info'>تفعيل الحساب</a>";
                            }
                            echo "<td>$block</td>";

                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>