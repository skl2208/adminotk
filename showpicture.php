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
    <script type="text/javascript" src="js/editpicture.js"></script>
</head>

<body>
    <section class="content">
        <div class="title-head p-2">กรุณาเลือกภาพที่ต้องการ</div>
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
                        html += "</div>";
                    });

                    $("#bindData").html(html);
                },
            });
        });
    </script>
</body>

</html>