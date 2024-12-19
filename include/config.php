<?php

$servername = "localhost";
$username = "cp187059_admin";
$password = "7QhZD, ]i[^!o";
$dbname = "cp187059_sk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

mysqli_set_charset($conn, "utf8");

// Check connection

if ($conn->connect_error) {

  die("ไม่สามารถเชื่อมต่อฐานข้อมูล : " . $conn->connect_error);

} 
$baseHTTP = "http://";

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {

  $baseHTTP = "https://";

}
$baseURL = $_SERVER['SERVER_NAME']."/";

//============= z.com (Developing) Configuration ===========
$image_upload_path = array(
  // "upload" => "/home/cp187059/public_html/hotspot/images/upload/news/",
  "upload" => "/home/cp187059/public_html/hotspot/adminotk/images/upload/news/",
  // "upload" => "public_html/hotspot/adminotk/assets/images/upload/news/",
  // "upload" => "images/upload/news/",
);
//============= Production Configuration ===========

// $image_url_path = array(

//   "upload" => "assets/images/upload/news/",
// );
?>
