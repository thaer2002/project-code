<?php
ob_start();
session_start();
require_once 'headerPage.php';
require_once "db_connect.php";
require_once "navBar.php";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
else{
    $user_id=-1;
}
$loc_id = $_GET['id'];
if(!isset($_COOKIE[$user_id."_".$loc_id])){
    setcookie($user_id."_".$loc_id,'set', time() + 3600, "/"); 
    mysqli_query($db_conn,"UPDATE `location` SET `vistor`=`vistor`+1 WHERE `loc_id`=$loc_id");
}


$locationData = mysqli_query($db_conn, "SELECT `loc_id`, `loc_name`, `address`, `phone`, `cat_id`, `uni_id`, `lat`, `lng`,`desc`,`vistor` ,`date_added` FROM `location` WHERE `loc_id`=$loc_id and `conf`='yes'");
$locationData = mysqli_fetch_assoc($locationData);
if (!isset($_POST['save'])) {
    $loc_name = $locationData['loc_name'];
    $address = $locationData['address'];
    $phone = $locationData['phone'];
    $lat = $locationData['lat'];
    $lng = $locationData['lng'];
    $desc = $locationData['desc'];
    $vistor=$locationData['vistor'];
    if(empty($vistor)){$vistor=0;}
    $add_map = $locationData['lat'] . " ," . $locationData['lng'];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $date = date("Y/m/d H:i:s a");
        $chHistoryLoc = mysqli_query($db_conn, "SELECT `his_id` FROM `history` WHERE `loc_id`=$loc_id AND `user_id`=$user_id");
        $chHistoryLoc = mysqli_fetch_assoc($chHistoryLoc);
        if (empty($chHistoryLoc)) {
            mysqli_query($db_conn, "INSERT INTO `history`(`loc_id`, `user_id`, `date_added`) VALUES ($loc_id, $user_id, '$date')");
        } else {
            mysqli_query($db_conn, "UPDATE `history` SET  `date_added` = '$date' WHERE `his_id`=$chHistoryLoc[his_id]");
        }
    } else {
        $user_id = -1;
    }
}
// ------------------visitor conuter --------------------------------------



?>
<style>
    .starCard {
        text-align: center;
        max-width: 33rem;
        background: #fff;
        margin: 0 1rem;
        padding: 1rem;
        width: 100%;
    }

    .star {
        font-size: 30px;
        cursor: pointer;
    }

    .one {
        color: rgb(255, 0, 0);
    }

    .two {
        color: rgb(255, 106, 0);
    }

    .three {
        color: rgb(251, 255, 120);
    }

    .four {
        color: rgb(255, 255, 0);
    }

    .five {
        color: rgb(24, 159, 14);
    }
</style>

<body class="bg-light text-dark">

    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right;">
        <h2 class="mb-4" style="text-align: center;"> عرض بيانات موقع </h2>
        <div class="row">
            <div class="col-sm-6">

                <label>اسم الموقع</label>
                <label style=" color: blue; height:45px; font-size: 20px; margin-bottom:30px" class="form-control"><strong><?php echo $loc_name ?></strong></label>
                <label> العنوان </label>
                <label style=" color: blue; height:45px; font-size: 20px; margin-bottom:30px" class="form-control"><strong><?php echo $address ?></strong></label>

                <label> رقم هاتف للتواصل</label>
                <label style=" color: blue; height:45px; font-size: 20px; margin-bottom:30px" class="form-control"><strong><?php echo $phone ?></strong></label>

                <label> تفاصيل عن الموقع </label>
                <label style=" color: blue; height:auto; min-height:90px; font-size: 20px; margin-bottom:30px" class="form-control"><strong><?php echo $desc ?> </strong></label>
                <input type="hidden" id="add_map" value="<?php echo $add_map; ?>" class="form-control" style="margin-bottom: 30px;border-radius: 0px; width:80%; float:right" required>
                <input type="hidden" name="lat" id="lat" value="<?php echo $lat; ?>" />


                <input type="hidden" name="lng" id="lng" value="<?php echo $lng; ?>" />
                <div class="form-group text-center" style=" cursor: pointer;">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $lat ?>, <?php echo $lng ?>" target="_blank">
                                <img src="img/gmap.png" height="60" width="60"><br>
                                <label><strong>عرض على جوجل</strong></label>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="https://www.google.com/maps/dir/?api=1&query=<?php echo $lat ?>, <?php echo $lng ?>" target="_blank">
                                <img src="img/direction.png" height="60" width="60"><br>
                                <label><strong>عرض الاتجاهات</strong></label>
                            </a>
                        </div>
                        <?php
                        if (isset($_GET['save'])) {
                            if (isset($_SESSION['user_id'])) {
                                $user_id = $_SESSION['user_id'];
                                $saved_id = $_GET['save'];
                                mysqli_query($db_conn, "INSERT INTO `saved_loc`( `user_id`, `loc_id`) VALUES ($user_id,$saved_id)");
                            } else {
                                header("Location:login.php");
                            }
                        }
                        ?>
                        <?php
                        $saved = false;
                        if (isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                            $chakingSave = mysqli_query($db_conn, "SELECT * FROM `saved_loc` WHERE `user_id`= $user_id  and  `loc_id`=$loc_id");
                            $chakingSave = mysqli_fetch_assoc($chakingSave);
                            if (!empty($chakingSave)) {
                                $saved = true;
                            }
                        }
                        ?>
                        <?php
                        if (!$saved) {
                        ?>
                            <div class="col-sm-4">
                                <a href="?save=<?php echo $loc_id ?>&id=<?php echo $loc_id ?>">
                                    <img src="img/save.png" height="60" width="60"><br>
                                    <label><strong> حفظ الموقع </strong></label>
                                </a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-sm-4">
                                <a href="#">
                                    <img src="img/save.png" height="60" width="60"><br>
                                    <label><strong> تم الحفظ </strong></label>
                                </a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 text-center" style=" width: 100vw; height: 80vh; margin-top: 30px;">
                <div class="row">
                    <div class="col-sm-6 text-center">
                        <label class="badge badge-secondary btn-block" style=" padding: 10px; font-size: 20px;">تقييم الزوار </label>
                        <br>
                        <?php
                        $avgRate = mysqli_query($db_conn, "SELECT sum(`rate`) as s, count(`rev_id`) as c FROM `review`  WHERE `loc_id` =$loc_id");
                        $avgRate = mysqli_fetch_assoc($avgRate);
                        if (!empty($avgRate)) {
                            if ($avgRate['c'] != 0) {
                                $avgRate = round($avgRate['s'] / $avgRate['c']);
                            } else {
                                $avgRate = 0;
                            }
                        } else {
                            $avgRate = 0;
                        }

                        ?>
                        <?php
                        for ($i = 1; $i <= $avgRate; $i++) {
                            echo " <span class='fa fa-star' style='color: orange;  font-size:25px; padding:5px;'></span>";
                        }
                        for ($i = $avgRate  + 1; $i <= 5; $i++) {
                            echo " <span class='fa fa-star' style=' font-size:25px; padding:5px;'></span>";
                        }
                        ?>


                    </div>
                    <div class="col-sm-6 text-center">
                        <label class="badge badge-secondary btn-block" style=" padding: 10px; font-size: 20px;"> عدد الزوار </label>
                        <br>
                        <label class="badge badge-warning btn-block" style=" padding: 10px; font-size: 20px;"> <?php echo $vistor ?> </label>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                    <input type="text" name="blog" class="form-control" data-toggle="modal" data-target="#myModal" style="border-radius: 20px; height: 50px; max-height: 50px" readonly placeholder="    اضف او عدل تعليقك   " />
                <?php
                } else {
                ?>
                    <a href="login.php" class="btn btn-info">سجل لإضافة تعليق</a>
                <?php
                }
                ?>
                <div  style=" max-height: 350px; overflow-y: scroll; padding:10px; margin-top:20px">
                    <?php
                    if (isset($_GET['del_comment'])) {
                        mysqli_query($db_conn, "DELETE FROM `review` WHERE `rev_id`=$_GET[del_comment]");
                        echo "<meta http-equiv='refresh' content=\"0;URL='locationDetails.php?id=$loc_id'\" />";
                    }
                    $comment = mysqli_query($db_conn, "SELECT `rev_id`, `content`,`rate`, `review`.`date_added`, `review`.`user_id`, `loc_id`,`username` FROM `review` 
                     INNER JOIN `user_tbl` ON `user_tbl`.`user_id` = `review`.`user_id` 
                        WHERE `loc_id`=$loc_id  ORDER BY `rev_id` DESC") or die(mysqli_error($db_conn));
                    while ($comment_row = mysqli_fetch_array($comment)) {
                    ?>
                        <div class="card" style="border-radius: 30px; overflow: hidden;margin-top: 10px;">
                            <div class="card-header" dir="ltr">
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <?php echo $comment_row['username'] ?>
                                    </div>
                                    <div class='col-sm-6'>
                                        <label class="text-muted" dir="ltr">( <?php echo $comment_row['date_added']  ?> )</label><br>

                                    </div>
                                    <div class='col-sm-3'>
                                        <?php
                                        if ($user_id == $comment_row['user_id']) {
                                        ?>
                                            <a href="?id=<?php echo $loc_id ?>&del_comment=<?php echo $comment_row['rev_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true" style="font-size: 25px;"></i></a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class='row'>
                                    <div class='col-sm-12'>
                                        <?php echo  $comment_row['content'] ?><br>
                                        <?php
                                        for ($i = 1; $i <= $comment_row['rate']; $i++) {
                                            echo " <span class='fa fa-star' style='color: orange; padding:5px;'></span>";
                                        }
                                        for ($i = $comment_row['rate'] + 1; $i <= 5; $i++) {
                                            echo " <span class='fa fa-star'></span>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> إضافة/ تعديل تعليق </h4>

            </div>

            <?php
            $findComment = mysqli_query($db_conn, "SELECT `rev_id`, `content`, `rate` FROM `review` WHERE `user_id`=$user_id AND  `loc_id`=$loc_id");
            $findComment = mysqli_fetch_assoc($findComment);
            if (!empty($findComment)) {
                if (!isset($_POST['post'])) {
                    $_POST['txt'] = $findComment['content'];
                    $_POST['ratev'] = $findComment['rate'];
                }
            }
            ?>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <textarea name="txt" class="form-control " style="height: 100px;" placeholder="ادخل تعليقك هنا  " required /><?php
                                                                                                                                    if (isset($_POST['txt'])) {
                                                                                                                                        echo $_POST['txt'];
                                                                                                                                    }
                                                                                                                                    ?></textarea>
                    <br>
                    <body>
                        <div class="starCard">
                            <span onclick="gfg(1)" class="star">★
                            </span>
                            <span onclick="gfg(2)" class="star">★
                            </span>
                            <span onclick="gfg(3)" class="star">★
                            </span>
                            <span onclick="gfg(4)" class="star">★
                            </span>
                            <span onclick="gfg(5)" class="star">★
                            </span>
                            <h4 id="output" style=" font-size: 25px;">
                                Rating is: 0/5
                            </h4>
                            <input type="hidden" id="ratev" name="ratev" value="<?php
                                                                                if (isset($_POST['ratev'])) {
                                                                                    echo $_POST['ratev'];
                                                                                }
                                                                                ?>" required>
                            <script>
                                $(document).ready(function() {
                                    gfg(<?php echo $_POST['ratev'] ?>);
                                });
                            </script>
                        </div>

                    </body>

                    </html>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" name="post" class="btn btn-primary"> &nbsp; &nbsp; &nbsp; &nbsp;حفظ &nbsp; &nbsp; &nbsp; &nbsp;</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"> &nbsp;&nbsp;&nbsp;اغلاق &nbsp; &nbsp; &nbsp;</button>
            </div>
            </form>
            <?php
            if (isset($_POST['post'])) {
                $txt = mysqli_real_escape_string($db_conn, $_POST['txt']);
                date_default_timezone_set("Asia/Kuwait");
                $date = date("Y/m/d H:i:s");
                $user =  $_SESSION['user_id'];
                $rate = $_POST['ratev'];
                if (empty($findComment)) {
                    mysqli_query($db_conn, "INSERT INTO `review`( `content`,`rate`, `date_added`, `user_id`, `loc_id`) VALUES ('$txt','$rate','$date','$user','$loc_id')") or die(mysqli_error($db_conn));
                    echo "<meta http-equiv='refresh' content=\"0;URL='locationDetails.php?id=$loc_id'\" />";
                } else {
                    mysqli_query($db_conn, "UPDATE `review` SET  `content`='$txt', `rate`=$rate  WHERE `rev_id`= $findComment[rev_id] ") or die(mysqli_error($db_conn));
                    echo "<meta http-equiv='refresh' content=\"0;URL='locationDetails.php?id=$loc_id'\" />";
                }
            }
            ?>
        </div>
    </div>
</div>
<script>
    let stars =
        document.getElementsByClassName("star");
    let output =
        document.getElementById("output");

    // Funtion to update rating
    function gfg(n) {
        remove();
        for (let i = 0; i < n; i++) {
            if (n == 1) cls = "one";
            else if (n == 2) cls = "two";
            else if (n == 3) cls = "three";
            else if (n == 4) cls = "four";
            else if (n == 5) cls = "five";
            stars[i].className = "star " + cls;
        }
        document.getElementById("ratev").value = n;
        output.innerText = "Rating is: " + n + "/5";
    }

    // To remove the pre-applied styling
    function remove() {
        let i = 0;
        while (i < 5) {
            stars[i].className = "star";
            i++;
        }
    }
</script>