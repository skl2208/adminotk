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
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <section id="mainmenu">
        <?php include "include/header.php"; ?>
    </section>
    <section class="content">
        <div class="title-head p-2">ระบบข้อความทักทาย</div>
        <div class="title-head text-end p-2"><button onclick="javascript:Goback();" class="btn btn-cancel">ย้อนกลับ</button></div>
        <form method="post" action="#">
            <div class="container shadow-sm" style="background-color:white;padding:10px;">
                <div class="row" id="showallnews">
                    <div class="col-12 text-start mb-2">
                        คำทักทายภาษาไทย
                        <input type="text" name="welcometh" id="welcometh" class="form-control">
                    </div>
                    <div class="col-12 text-start mb-2">
                        คำทักทายภาษาอังกฤษ
                        <input type="text" name="welcomeen" id="welcomeen" class="form-control">
                    </div>
                    <div class="col-12 text-start mb-2">
                        สถานะ
                        <select name="status" id="status" class="form-control">
                            <option value="T">กําลังใช้งาน</option>
                            <option value="F">งดใช้งาน</option>
                        </select>
                    </div>
                    <div class="col-12 text-start">
                        <button id="save_bttn" type="button" class="btn btn-save" onclick="javascript:savegreeting();">บันทึก</button>
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
            console.log(id);

            //================== ดึงข้อมูลจากฐานข้อมูล =================//
            if (id != "" && id != null) {
                var url = "ws/greeting/showgreeting_ws.php?id=" + id;
                console.log("url = " + url);
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {

                        //===== ทำการ bind ค่าลงในหน้าเวป =====//
                        $("#id").val(data.data[0].id);
                        $("#welcometh").val(data.data[0].welcometh);
                        $("#welcomeen").val(data.data[0].welcomeen);
                        $("#status").val(data.data[0].status);

                        if (data.data[0].status == 'T') {
                            $("#status").prop("checked", true);
                        } else {
                            $("#status").prop("checked", false);
                        }
                    }
                });
            } else {
                console.log("new record");
            }

        });


        function savegreeting() {

            const url = "ws/greeting/updategreeting_ws.php";
            console.log("going to " + url);

            const id = document.getElementById("id").value;

            if (id != "" && id != null) {
                //==== update ====
                const welcometh = document.getElementById("welcometh").value;
                const welcomeen = document.getElementById("welcomeen").value;
                const status = document.getElementById("status").value;

                const inputData = "{\"id\": \"" + id + "\",\"welcometh\":\"" + welcometh.replaceAll(/[\r\n]+/gm, "").replaceAll('"', '\\u201c').replaceAll("'", '\\u201d') + "\",\"welcomeen\": \"" + welcomeen.replaceAll(/[\r\n]+/gm, "").replaceAll('"', '\\u201c').replaceAll("'", '\\u201d') + "\",\"status\": \"" + status + "\"}";
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
                        window.location.href = "mng_greeting.php";
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Cannot save data");
                    }
                });
            } else {
                //==== insert ====
                const welcometh = document.getElementById("welcometh").value;
                const welcomeen = document.getElementById("welcomeen").value;
                const status = document.getElementById("status").value;

                const inputData = "{\"welcometh\":\"" + welcometh.replaceAll(/[\r\n]+/gm, "").replaceAll('"', '\\u201c').replaceAll("'", '\\u201d') + "\",\"welcomeen\": \"" + welcomeen.replaceAll(/[\r\n]+/gm, "").replaceAll('"', '\\u201c').replaceAll("'", '\\u201d') + "\",\"status\": \"" + status + "\"}";
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
                        window.location.href = "mng_greeting.php";
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