<?php 
// connect to datebase
$connect = mysqli_connect('localhost', 'souilmi', 'ELMAHDI', 'simple_blog');
// check connection
if (!$connect) {
    echo 'connection error : ' . mysqli_connect_error();
}
?>