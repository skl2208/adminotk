<?php
session_start();
include "include/checkadmin.php";
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta lang="TH">
<title>ระบบบริหารงาน อ.ต.ก. | ข่าวสาร</title>

<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="jquery-3.6.3/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mng_news.js"></script>
</head>

<body>
  <section id="mainmenu">
  <?php include "include/header.php"; ?>
  </section>
  <section class="content">
    <div class="title-head p-2">ระบบข่าว</div>
    <div class="container margin-left:50px shadow-sm" style="background-color:white;padding:10px;border-radius:5px">
      <div class="row" id="showallnews">
        <div class="col-12 text-end"><button class="btn btn-add" onclick="window.location.href='editaddnews.php'">เพิ่มข่าวหรือกิจกรรม</button></div>
        <div class="col-12 text-end mb-1">
          <hr>
        </div>
        <div class="col-1 text-end mb-1">
          ID
        </div>
        <div class="col-5 text-start mb-1">
          headnews
        </div>
        <div class="col-3 text-start mb-1">
          URL ภาพ 
        </div>
        <div class="col-2 text-start mb-1">
          สถานะ
        </div>
        <div class="col-1 text-center mb-1">
          Action
        </div>
        <div class="col-12 text-start mb-1">
          <hr>
        </div>
      </div>
    </div>
  </section>
</body>
</html>