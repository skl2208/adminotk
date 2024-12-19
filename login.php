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
<div class="d-block w-100 text-center" style="font-weight:20px;font-weight:bold">ระบบงาน อ.ต.ก. เวปไซต์</div>
<br><br><br>
<form method="POST" action="#">
  <div class="shadow-sm" style="width:600px;background-color:white;padding:20px;border-radius:5px;margin-left:auto;margin-right:auto">
    <div class="row justify-content-center">
      <div class="d-block">
        User :
        <input type="text" id="user" name="user" class="form-control">
      </div>
      <div class="d-block">
        Password :
        <input type="password" id="password" name="password" class="form-control">
      </div>
      <div class="d-block text-center mt-3">
        <button type="button" class="btn btn-add" onclick="javascript:checkpassword()">Sign In</button>
      </div>
    </div>
  </div>
</form>
<div class="d-block w-100 text-center" id="snackbar"></div>
<script>
  function checkpassword() {
    const user= document.getElementById("user").value;
    const password=document.getElementById("password").value;

    const url = "ws/admin/checkpassword_ws.php";
    const data = "{\"user\":\""+user+"\",\"password\":\""+password+"\"}";
    console.log(data);

    $.ajax({
      url:url,
      data:JSON.parse(data),
      method:"POST",
      dataType:"json",
      success:function(val) {
        console.log(val);
        if(val.status=="OK"){
          //=== รหัสผ่านถูกต้อง ===
          var x = document.getElementById("snackbar");
            x.innerHTML = 'รหัสผ่านถูกต้อง กำลังเปลี่ยนหน้า...';
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
                window.location.href = "index.php";
            }, 2000);
        } else {
          alert("รหัสผ่านไม่ถูกต้อง");
        }
      },error:function(e) {

      }
    });

  }
</script>
</body>
</html>