<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta lang="TH">
<title>ระบบบริหารงาน อ.ต.ก. | ระบบผู้ใช้งาน</title>

<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="jquery-3.6.3/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <section id="mainmenu">
        <?php include "include/header.php"; ?>
    </section>
    <section class="content">
        <div class="title-head p-2">ผู้ใช้งาน</div>
        <div class="title-head text-end p-2"><button onclick="javascript:Goback();" class="btn btn-cancel">ย้อนกลับ</button></div>
        <form method="post" action="#">
            <div class="container shadow-sm" style="background-color:white;padding:10px;">
                <div class="row" id="showallnews">
                    <div class="col-12 text-center mb-2">
                        ID : <span id="id_show" name="id_show"></span>
                    </div>
                    <div class="col-12 text-start mb-2">
                        User
                        <input type="text" name="user" id="user" class="form-control">
                    </div>
                    <div class="col-12 text-start mb-2">
                        Role
                        <input type="text" name="role" id="role" class="form-control">
                    </div>
                    <div class="col-12 text-start mb-2">
                        สถานะ
                        <select name="status" id="status" class="form-control">
                            <option value="T">กําลังใช้งาน</option>
                            <option value="F">งดใช้งาน</option>
                        </select>
                    </div>
                    <div class="col-12 text-start mb-2">
                        Reset รหัสผ่าน
                        <input type="text" name="password" id="password" class="form-control" placeholder="รหัสผ่าน">
                    </div>
                    <div class="col-12 text-start">
                        <button id="save_bttn" type="button" class="btn btn-save" onclick="javascript:saveuser();">บันทึก</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="">
        </form>
    </section>
    <script>
        $(function() {

            //================== ดึงข้อมูลจากฐานข้อมูล =================//
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');

            //================== ดึงข้อมูลจากฐานข้อมูล =================//
            if (id != "" && id != null) {
                var url = "ws/admin/showuser_ws.php?id=" + id;
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {

                        //===== ทำการ bind ค่าลงในหน้าเวป =====//
                        $("#id").val(data.data[0].id);
                        $("#id_show").html(data.data[0].id);
                        $("#user").val(data.data[0].user);
                        $("#role").val(data.data[0].role);
                        $("#password").val(data.data[0].password);
                        $("#status").val(data.data[0].status);

                        if (data.data[0].status == 'T') {
                            $("#status").prop("checked", true);
                        } else {
                            $("#status").prop("checked", false);
                        }
                    },
                    error: function(error) {
                        console.log("error! " + JSON.stringify(error));
                    }
                });
            } else {
                console.log("new record");
            }

        });


        function saveuser() {

            const url = "ws/admin/updateaccount_ws.php";
            console.log("going to " + url);

            const id = document.getElementById("id").value;
            console.log("done");
            if (id != "" && id != null) {
                //==== update ====
                const user = document.getElementById("user").value;
                const role = document.getElementById("role").value;
                const password = document.getElementById("password").value;
                const status = document.getElementById("status").value;

                const inputData = "{\"id\": \"" + id + "\",\"user\":\"" + user + "\",\"role\": \"" + role + "\",\"password\":\"" + password + "\" ,\"status\": \"" + status + "\"}";
                console.log(inputData);
                const jsoninputData = JSON.parse(inputData);
                console.log("before enter");
                console.log(jsoninputData);
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: jsoninputData,
                    success: function(data) {
                        console.log(data);
                        window.location.href = "mng_admin.php";
                    },
                    error: function(val) {
                    }
                });
            } else {
                //==== insert ====
                const user = document.getElementById("user").value;
                const role = document.getElementById("role").value;
                const password = document.getElementById("password").value;
                const status = document.getElementById("status").value;

                const inputData = "{\"user\":\"" + user + "\",\"role\":\"" + role + "\",\"password\":\"" + password + "\",\"status\":\"" + status + "\"}";
                console.log(inputData);
                const jsoninputData = JSON.parse(inputData);
                console.log("before enter");
                console.log(jsoninputData);
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: jsoninputData,
                    success: function(data) {
                        console.log(data);
                        window.location.href = "mng_admin.php";
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Cannot save data");
                    }
                });
            }

        }
    </script>
</body>

</html>