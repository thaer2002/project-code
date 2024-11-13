<?php
function printMsg($msg, $type = "Dark")
{
    if ($type != "success") {
        $type = "";
        $color = " style= 'background-color: red;'";
    } else {
        $color = " style= 'background-color: none;'";
        $type = "alert-$type";
    }
    echo "<div class='alert  $type alert-dismissible fade show text-center'   $color>";
    echo " <button type='button' class='close' data-dismiss='alert'>&times;</button>";
    echo "<strong>$msg</strong>";
    echo "</div>";
}
function registration($username, $email, $password, $confirmPassword, $db_conn)
{
    if (!empty($username)) {
        if (!empty($email)) {
            if (!empty($password)) {
                if (!empty($confirmPassword)) {
                    if ($password == $confirmPassword) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailExest = mysqli_query($db_conn, "SELECT * FROM `user_tbl` WHERE `email`='$email'");
                            $emailExest = mysqli_fetch_assoc($emailExest);
                            if (empty($emailExest)) {
                                $date = date('Y-m-d H:i:s');
                                if (mysqli_query($db_conn, "INSERT INTO `user_tbl`( `username`, `email`, `password`, `date_added`) VALUES ('$username','$email','$password','$date')")) {
                                    printMsg(" تم التسجيل بنجاح ", "success");
                                }
                            } else {
                                printMsg("البريد الإلكتروني المدخل مستخدم من قبل مستخدم اخر");
                            }
                        } else {
                            printMsg(" يجب ادخال بريد الكتروني صالح");
                        }
                    } else {
                        printMsg(" كلمة المرور لا تطابق تأكيد كلمة المرور");
                    }
                } else {
                    printMsg("يجب ادخال تأكيد كلمة المرور");
                }
            } else {
                printMsg("يجب ادخال كلمة المرور");
            }
        } else {
            printMsg("يجب ادخال البريد الإلكتروني");
        }
    } else {
        printMsg("يجب ادخال اسم المستخدم ");
    }
}
function editUser($user_id, $username, $email, $oldPass, $password, $confirmPassword, $db_conn)
{
    $passChnage = true;
    if (!empty($username)) {
        if (!empty($email)) {
            if (!empty($password)) {
                if ($password == $confirmPassword) {
                    $pass = $password;
                } else {
                    printMsg("  كلمة المرور غير مطابقة لتأكيد كلمة المرور  ");
                    $passChnage = false;
                }
            } else {
                $pass = $oldPass;
            }
            if ($passChnage) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailExest = mysqli_query($db_conn, "SELECT * FROM `user_tbl` WHERE `email`='$email' and user_id != $user_id");
                    $emailExest = mysqli_fetch_assoc($emailExest);
                    if (empty($emailExest)) {
                        $date = date('Y-m-d H:i:s');
                        if (mysqli_query($db_conn, "UPDATE `user_tbl`  SET  `username`='$username', `email`='$email', `password`='$pass'  WHERE `user_id` = $user_id")) {
                            printMsg(" تم الحفظ بنجاح ", "success");
                        }
                    } else {
                        printMsg("البريد الإلكتروني المدخل مستخدم من قبل مستخدم اخر");
                    }
                } else {
                    printMsg(" يجب ادخال بريد الكتروني صالح");
                }
            }
        } else {
            printMsg("يجب ادخال البريد الإلكتروني");
        }
    } else {
        printMsg("يجب ادخال اسم المستخدم ");
    }
}
function login($email, $password)
{
    require_once("db_connect.php");
    if (!empty($email)) {
        if (!empty($password)) {
            $loginCheck = mysqli_query($db_conn, "SELECT `user_id`,`usertype`,`blocked` FROM `user_tbl` WHERE `email`='$email' and `password`='$password'");
            $loginCheck = mysqli_fetch_assoc($loginCheck);
            if (!empty($loginCheck)) {
                if ($loginCheck['blocked'] == 'no') {
                    $_SESSION['user_id'] = $loginCheck['user_id'];
                    $_SESSION['usertype'] = $loginCheck['usertype'];
                    date_default_timezone_set("Asia/Kuwait");
                    $date=date("Y/m/d h:i:s a");
                    mysqli_query($db_conn,"UPDATE `user_tbl` SET `last_login`='$date' WHERE `user_id`=$_SESSION[user_id]");
                    if ($_SESSION['usertype'] == 'admin') {
                        header('Location:adminPage.php');
                    } else {
                        header('Location:userPage.php');
                    }
                } else {
                    printMsg("تم تعطيل هذه الحساب");
                }
            } else {
                printMsg("هذا المستخدم غير موجود");
            }
        } else {
            printMsg("يجب ادخال كلمة المرور");
        }
    } else {
        printMsg("يجب ادخال البريد الإلكتروني");
    }
}
function userBlock($userID, $blockType, $db_conn)
{
    if ($blockType == "add") {
        mysqli_query($db_conn, "UPDATE `user_tbl` SET `blocked`='yes'  WHERE `user_id`=$userID");
    } else {
        mysqli_query($db_conn, "UPDATE `user_tbl` SET `blocked`='no'  WHERE `user_id`=$userID");
    }
}
function userConfirm($userID, $confType, $db_conn)
{
    if ($confType == "conf") {
        mysqli_query($db_conn, "UPDATE `user_tbl` SET `confirm`='yes'  WHERE `user_id`=$userID");
    } else {
        mysqli_query($db_conn, "UPDATE `user_tbl` SET `confirm`='no'  WHERE `user_id`=$userID");
    }
}
function addLocation($locName, $db_conn)
{
    if (!empty($locName)) {
        if (mysqli_query($db_conn, "INSERT INTO `location`(`loc_name`) VALUES ('$locName')")) {
            printMsg(" تم إضافة الموقع بنجاح ", "success");
        }
    } else {
        printMsg("يجب ادخال اسم الموقع");
    }
}

function deleteLocation($loc_id, $db_conn)
{
    mysqli_query($db_conn, "DELETE FROM `location` WHERE `loc_id` = $loc_id");
}
function addCat($catName, $db_conn)
{
    if (!empty($catName)) {
        if (mysqli_query($db_conn, "INSERT INTO `category`(`cat_name`) VALUES ('$catName')")) {
            printMsg(" تم إضافة التصنيف  بنجاح ", "success");
        }
    } else {
        printMsg("يجب ادخال اسم التصنيف");
    }
}

function deleteCat($cat_id, $db_conn)
{
    mysqli_query($db_conn, "DELETE FROM `category` WHERE `cat_id`=$cat_id");
}
function activeAucation($startDate, $duration)
{
    $valid = false;
    $date1 = strtotime($startDate) + ($duration * 60 * 60);
    $date2 = strtotime("now");
    if ($date1 > $date2) {
        $valid = true;
    }
    return $valid;
}
function uploadImages($ucation_id, $imgs, $db_conn)
{
    foreach ($imgs['name'] as $key => $val) {
        $fileName = basename($imgs['name'][$key]);
        $targetFilePath = "aucation_img/" . $ucation_id . "_" . $fileName;
        $allowTypes = ['jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'jpeg', 'JPEG'];
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($imgs["tmp_name"][$key], $targetFilePath)) {
                mysqli_query($db_conn, "INSERT INTO `ucation_imgs`(`ucation_id`, `path`) VALUES ($ucation_id,'$targetFilePath')");
            }
        }
    }
}

function deleteImage($img_id, $db_conn)
{
    mysqli_query($db_conn, "DELETE FROM `ucation_imgs` WHERE `img_id`=$img_id");
}
function getCatName($cat_id, $db_conn)
{
    $catName = mysqli_query($db_conn, "SELECT `cat_name` FROM `category` WHERE  `cat_id`=$cat_id");
    $catName = mysqli_fetch_assoc($catName);
    return $catName["cat_name"];
}
function getLocName($loc_id, $db_conn)
{
    $locName = mysqli_query($db_conn, "SELECT `loc_name` FROM `location` WHERE  `loc_id`=$loc_id");
    $locName = mysqli_fetch_assoc($locName);
    return $locName["loc_name"];
}
function  updateUserData($user_id, $username, $profileImg, $oldPass, $newPass, $confPass, $db_conn)
{
    if (!empty($username)) {
        if (!empty($newPass)) {
            if ($newPass == $confPass) {
                $pass = $newPass;
                mysqli_query($db_conn, "UPDATE `user_tbl` SET `username`='$username',`password`='$pass' WHERE `user_id`=$user_id");
                if (!empty($profileImg)) {
                    $fileName = $profileImg['name'];
                    $allowTypes = ['jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'jpeg', 'JPEG'];
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypes)) {
                        $targetFilePath = "profile_img/" . $user_id . "." . $fileType;
                        move_uploaded_file($profileImg["tmp_name"], $targetFilePath);
                        mysqli_query($db_conn, "UPDATE `user_tbl` SET `profile_image`='$targetFilePath' WHERE `user_id`=$user_id");
                    }
                }
                printMsg(" تم التعديل  بنجاح ", "success");
            } else {
                printMsg("كلمة المرور لا تطابق تأكيد كلمة المرور");
            }
        } else {
            $pass = $oldPass;
            mysqli_query($db_conn, "UPDATE `user_tbl` SET `username`='$username',`password`='$pass' WHERE `user_id`=$user_id");
            if (!empty($profileImg)) {
                $fileName = $profileImg['name'];
                $allowTypes = ['jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'jpeg', 'JPEG'];
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    $targetFilePath = "profile_img/" . $user_id . "." . $fileType;
                    move_uploaded_file($profileImg["tmp_name"], $targetFilePath);
                    mysqli_query($db_conn, "UPDATE `user_tbl` SET `profile_image`='$targetFilePath' WHERE `user_id`=$user_id");
                }
            }
            printMsg(" تم التعديل  بنجاح ", "success");
        }
    } else {
        printMsg("يجب ادخال اسم المسخدم");
    }
}
function addUniversty($name, $address, $lat, $lng, $img, $db_conn)
{


    if (!empty($img['name'])) {
        $nextId = mysqli_query($db_conn, "show table status from `web_directory` like 'universities'");
        $nextId = mysqli_fetch_assoc($nextId);
        $nextId = $nextId["Auto_increment"];
        $fileName = basename($img['name']);
        $targetFilePath = "un_logo/" .  $nextId . "_" . $fileName;
        $allowTypes = ['jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'jpeg', 'JPEG'];
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
            move_uploaded_file($img["tmp_name"], $targetFilePath);
        } else {
            $targetFilePath = "";
        }
    } else {
        $targetFilePath = "";
    }

    if (!is_numeric($name)) {
        mysqli_query($db_conn, "INSERT INTO `universities`( `uni_name`, `address`,`img`, `lng`, `lat`) 
    VALUES ('$name','$address','$targetFilePath',$lng, $lat)");
    } else {
        printMsg("اسم الجامعة يجب ان يكون قيمة نصيه");
    }
}

function updateUniversty($id, $name, $address, $lat, $lng, $img, $oldImg, $db_conn)
{

    if (!empty($img['name'])) {

        $fileName = basename($img['name']);
        $targetFilePath = "un_logo/" .  $id . "_" . $fileName;
        $allowTypes = ['jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'jpeg', 'JPEG'];
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
            move_uploaded_file($img["tmp_name"], $targetFilePath);
        } else {
            $targetFilePath = $oldImg;
        }
    } else {
        $targetFilePath = $oldImg;
    }

    if (!is_numeric($name)) {
        mysqli_query($db_conn, "UPDATE  `universities` SET `uni_name`='$name',
                                                       `address`='$address',
                                                       `img`='$targetFilePath',
                                                       `lng`=$lng,
                                                       `lat`= $lat
                                                        WHERE `uni_id` =$id");
        echo "<meta http-equiv='refresh' content=\"0;URL='allUniv.php'\" />";
    } else {
        printMsg("اسم الجامعة يجب ان يكون قيمة نصيه");
    }
}
function saveCat($cat_name, $img, $db_conn)
{
    if (!empty($img['name'])) {
        $nextId = mysqli_query($db_conn, "show table status from `web_directory` like 'catogare'");
        $nextId = mysqli_fetch_assoc($nextId);
        $nextId = $nextId["Auto_increment"];
        $fileName = basename($img['name']);
        $targetFilePath = "cat_img/" .  $nextId . "_" . $fileName;
        $allowTypes = ['jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'jpeg', 'JPEG'];
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
            move_uploaded_file($img["tmp_name"], $targetFilePath);
        } else {
            $targetFilePath = "";
        }
    } else {
        $targetFilePath = "";
    }

    mysqli_query($db_conn, "INSERT INTO `catogare`(`catogry_name`,`img`) VALUES ('$cat_name','$targetFilePath')") or die(mysqli_error($db_conn));
}
function updateCat($cat_id, $catName, $newImg, $oldImg, $db_conn)
{
    if (!empty($newImg['name'])) {
        $fileName = basename($newImg['name']);
        $targetFilePath = "cat_img/" .  $cat_id . "_" . $fileName;
        $allowTypes = ['jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'jpeg', 'JPEG'];
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
            move_uploaded_file($newImg["tmp_name"], $targetFilePath);
        } else {
            $targetFilePath = $oldImg;
        }
    } else {
        $targetFilePath = $oldImg;
    }
    mysqli_query($db_conn, "UPDATE `catogare` SET `catogry_name`='$catName',`img`='$targetFilePath'  WHERE `catgory_id`= $cat_id ") or die(mysqli_error($db_conn));
}
function  saveLocation($loc_name, $address, $cat, $uni, $phone, $lat, $lng, $desc,$conf,$user_id, $db_conn)
{
    $date = date("Y-m-d");
    mysqli_query($db_conn, "INSERT INTO `location`( `loc_name`, `address`, `phone`, `cat_id`, `uni_id`, `lat`, `lng`,`desc`, `date_added`,`conf`,`user_id`)
                            VALUES ('$loc_name','$address',' $phone',$cat,$uni,$lat,$lng,'$desc','$date','$conf','$user_id')");
}

function updateLocation($loc_id, $loc_name, $address, $cat, $uni, $phone, $lat, $lng, $desc, $db_conn)
{
    $desc = mysqli_real_escape_string($db_conn, $desc);
    mysqli_query($db_conn, "UPDATE `location` SET  `loc_name`='$loc_name',
                                                   `address`='$address',
                                                   `phone`='$phone',
                                                   `cat_id`=$cat,
                                                   `uni_id`=$uni,
                                                   `lat`=$lat,
                                                   `lng`=$lng,
                                                   `desc`='$desc'
                                                    WHERE `loc_id`=$loc_id");
}
