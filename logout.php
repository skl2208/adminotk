<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["role"]);
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta lang="TH">
<title>ระบบบริหารงาน อ.ต.ก.</title>

<head>
  <link rel="stylesheet" type="text/css" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript" src="jquery-3.6.3/jquery-3.6.3.min.js"></script>
  <script type="text/javascript" src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</head>

<body>
  <br><br><br>
  <div class="d-block w-100 text-center" style="font-size:30px;font-weight:bold">ระบบงาน อ.ต.ก. เวปไซต์</div>
  <br><br><br>
  <div class="d-block w-100 text-center">คุณได้ออกจากระบบงาน อ.ต.ก. เวปไซต์แล้ว</div>
  <br><br><br>
  <div class="d-block w-100 text-center"><button type="button" class="btn btn-add" onclick="window.location.href='login.php'">ไปหน้า Login</div>
  <div class="d-block w-100 text-center" id="snackbar"></div>
  
</body>

</html>