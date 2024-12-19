<?php
session_start();
include "include/checkadmin.php";
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta lang="TH">
<title>ระบบบริหารงาน อ.ต.ก. | ข้อความทักทาย</title>

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
    <div class="title-head p-2">ผู้ใช้งาน</div>
    <div class="container margin-left:50px shadow-sm" style="background-color:white;padding:10px;border-radius:5px">
      <div class="row" id="showallgreeting">
        <div class="col-12 text-end">
          <button class="btn btn-add" onclick="window.location.href='editaddaccount.php'">เพิ่มบัญชี</button>
        </div>
        <div class="col-12 text-end mb-1">
          <hr>
        </div>
        <div class="col-1 text-end mb-1">
          ID
        </div>
        <div class="col-4 text-start mb-1">
          User
        </div>
        <div class="col-4 text-start mb-1">
          บทบาท
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
  <script>
    $(function() {
      //================== ดึงข้อมูลจากฐานข้อมูล =================//
      var url = "ws/admin/showuser_ws.php";
      $.ajax({
        url: url,
        method: "GET",
        success: function(data) {
          var jsonData = JSON.parse(data);
          var myData = jsonData.data;
          //===== ทำการ bind ค่าลงในหน้าเวป =====//
          var html = "";
          for (var i = 0; i < myData.length; i++) {
            console.log(myData[i].status);
            html += '<div class="col-1 text-end">' + myData[i].id + '</div>';
            html += '<div class="col-4 text-start">' + myData[i].user + '</div>';
            html += '<div class="col-4 text-start d-block" style="overflow:hidden;text-overflow:ellipsis;">' + myData[i].role + '</div>';
            html += '<div class="col-2 text-start">' + (myData[i].status == 'T' ? 'กำลังใช้งาน' : 'งดใช้งาน') + '</div>';
            html += '<div class="col-1 text-center"><button class="btn-small btn-save" onclick="window.location.href=\'editaddaccount.php?id=' + myData[i].id + '\'">แก้ไข</button> </div>';
            html += "<div class=\"col-12\"><hr></div>";
          }
          $("#showallgreeting").append(html);

        }
      });
    });

  </script>
</body>

</html>