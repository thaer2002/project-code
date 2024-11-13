<?php
session_start();
require_once 'headerPage.php';
require_once "db_connect.php";
require_once "navBar.php";

if(isset($_GET['uni_id'])){
    $_POST['uni']=$_GET['uni_id'];
    $_POST['filter']="run";
}
if(isset($_GET['cat_id'])){
    $_POST['cat']=$_GET['cat_id'];
    $_POST['filter']="run";
}
?>
<body class="bg-light text-dark">
    <div class="container" dir="rtl" style="margin-top: 20px; text-align:right; ">
        <h2 class="mb-4" style="text-align: center;">  </h2>
        <div class="row">
            <div class="col-sm-4">
                <form action="" method="post">
                    <label> القسم </label>
                    <select name="cat" class="form-control" style="margin-bottom: 30px;border-radius: 0px;">
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
            </div>
            <div class="col-sm-4">
                <label> الجامعة </label>
                <select name="uni" class="form-control" style="margin-bottom: 30px;border-radius: 0px;">
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
            </div>
            <div class="col-sm-4">
                <input type="submit" name="filter" value="تصفية النتائج" class="btn btn-info btn-block" style=" border-radius:0px; margin-top:30px">
            </div>

            </form>

            <?php
            $cond = "WHERE 1=1";
            if (isset($_POST['filter'])) {

                if (!empty($_POST['cat'])) {
                    $cond .= " AND `cat_id` = $_POST[cat]";
                }
                if (!empty($_POST['uni'])) {
                    $cond .= " AND `uni_id` = $_POST[uni]";
                }
            }
            $unvData = mysqli_query($db_conn, "SELECT `loc_id`, `loc_name`, `address`, `phone`, `cat_id`, `uni_id`, `lat`, `lng`, `date_added` FROM `location`  $cond");
            while ($row = mysqli_fetch_assoc($unvData)) {

                $img = "img/location.png";

            ?>
                <div class="col-sm-3" style=" margin-bottom: 20px;">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="<?php echo  $img ?>" style="height: 200px;  padding: 20px; padding-left:60px; padding-right: 60px;">
                        <div class="card-body text-center">
                            <h4 class="card-title text-dark"><?php echo  $row['loc_name'] ?></h4>
                            <p class="card-text text-dark"><?php echo  $row['address'] ?>
                                <br>
                            <p class="card-text text-dark"><?php echo  $row['phone'] ?>
                            </p>
                            <a href="locationDetails.php?id=<?php echo $row['loc_id'] ?>" class="btn btn-primary btn-block"> تفاصيل اكثر </a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    </div>
</body>