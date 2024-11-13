<?php
    $host='localhost';
    $user='root';
    $pass='';
    $db='web_directory';
    $db_conn=mysqli_connect($host,$user,$pass,$db) or die("Not connected : ".mysqli_error($conn));
    mysqli_query($db_conn,"SET CHARACTER SET utf8");
?>