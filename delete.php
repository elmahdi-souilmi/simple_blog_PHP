<?php 
include 'config/db_connect.php';
 $id  = $_GET["id"];
 $sql = "DELETE FROM post WHERE  id= $id ";
    //get result
    $result = mysqli_query($connect, $sql);
    header('location: postByUser.php');
?>