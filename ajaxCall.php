<?php
if (isset($_POST['getLog'])) {
    require_once "db_connect.php";
    $aucation_id = $_POST['aucation_id'];
    $result = mysqli_query($db_conn, "SELECT  `username` , `value` FROM `ucation_log` 
    INNER JOIN `user_tbl` ON `user_tbl`.`user_id` = `ucation_log`.`user_id`  WHERE `aucation_id`=$aucation_id ORDER BY `log_id` DESC ");
    while ($row = mysqli_fetch_array($result)) {
        $username = $row['username'];
        $value = $row['value'];

        $return_arr[] = array(
            "username" => $username,
            "value" => $value
        );
    }
    echo json_encode($return_arr);
}
?>
