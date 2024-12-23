<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta lang="TH">
<title>ระบบบริหารงาน อ.ต.ก. | คลังภาพ</title>

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
        <div class="title-head p-2"><a href="manage_pic.php">ระบบคลังภาพ</a> | จัดการภาพในคลัง</div>

        <div class="container m-1 p-1">
            <div class="row" id="bindData">
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            console.log("ready");
            //======== เรียกดูฐานข้อมูลภาพ =========//
            const url = "ws/news/showallpicture_ws.php";
            console.log("going to..." + url);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    console.log(data.data[0]);
                    console.log(data.data[1]);



                    // console.log(myData[0]);
                    //===== ทำการ bind ค่าลงในหน้าเวป =====//

                    var html = "";
                    data.data.forEach(element => {
                        html += "<div class=\"col-2 border-grey p-1 m-1\">";
                        html += "<div class=\"mt-1 mb-1\"><a href=\"javascript:showpicture(" + element.id + ")\"><img src=\"" + element.imageurl + "\" style=\"width:100%\" ></a> </div>"
                        html += "<div class=\"text-center\"><a href=\"javascript:deletepicture(" + element.id + ")\"><img src=\"images/icon_delete.png\" style=\"width:25px\" ></a></div></div>";
                    });

                    $("#bindData").append(html);
                },
            });
        });

        function deletepicture(id) {
            if (confirm("คุณต้องการลบ " + id)) {
                //=== delete picture then go back ===//
                var url = "ws/news/deletepicture_ws.php"
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType:"json",
                    data: {id:id},
                    success: function(data) {
                        console.log(data.status);
                        if(data.status=="OK"){
                            //===success===
                            window.location.href = "editpicture.php";
                        }
                        // var jsonData = JSON.parse(data);
                        // var myData = jsonData.data;
                        // console.log(myData[0]);
                        //===== ทำการ bind ค่าลงในหน้าเวป =====//
                    }, error: function(data) {
                        alert("ไม่สามารถลบไฟล์ได้");
                    }
                });
            } else {
                //=== go back ===//
            }
        }
    </script>
</body>

</html>