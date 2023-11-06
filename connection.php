<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ssbss_official";

$conn = mysqli_connect($hostname, $username, $password, $dbname) or die();

// for($i = 0; $i<30; $i++){
//     $news_title = "News Title ".$i;
//     $notice_title = "Notice Title ".$i;
//     $news_src = "Something news src".$i;
//     $thumbnail = "image.jpg";
//     $notice_src = "something notice src".$i;
//     $upload_date = "2023-2-2";
//     $type = "news";
//     $sql = "INSERT INTO news (title, src, thumbnail, upload_date, type) VALUES ('$news_title','$news_src','$thumbnail','$upload_date','$type')";
//     $result = mysqli_query($conn,$sql);
//     $type = "notice";
//     $sql = "INSERT INTO news (title, src, thumbnail, upload_date, type) VALUES ('$notice_title','$notice_src','$thumbnail','$upload_date','$type')";
//     $result = mysqli_query($conn,$sql);
// }
 ?>