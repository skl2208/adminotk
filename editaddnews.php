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
    <script type="text/javascript" src="js/editaddnews.js"></script>
</head>
<script src="ckeditor/ckeditor.js"></script>
<!-- <script src="//cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script> -->
<body>
    <section id="mainmenu">
        <?php include "include/header.php"; ?>
    </section>
    <section class="content">
        <div class="title-head p-2">ระบบข่าว</div>
        <div class="title-head text-end p-2"><button onclick="javascript:Goback();" class="btn btn-cancel">ย้อนกลับ</button></div>
        <form method="post" action="#">
            <div class="container shadow-sm" style="background-color:white;padding:10px;">
                <div class="row" id="showallnews">
                    <div class="col-12 text-start mb-2">
                        หัวข้อข่าว headnews
                        <input type="text" name="headnews" id="headnews" class="form-control">
                    </div>
                    <div class="col-12 text-start mb-1">
                        <!-- ภาพประกอบหัวเรื่อง <button class="btn-small btn-add" type="button" onclick="javascript:openAlbum('showpicture.php');">เรียกดูจากคลัง</button> <button type="button" class="btn-small btn-add" onclick="javascript:enterimageurl();">ใส่ URL ของภาพจากอินเตอร์เน็ต</button> -->
                        ภาพประกอบหัวเรื่อง <button class="btn-small btn-add" type="button" data-bs-toggle="modal" data-bs-target="#myModal" onclick="javascript:callpicture();">เรียกดูจากคลัง</button>
                        <!-- <button type="button" class="btn-small btn-add" onclick="javascript:enterimageurl();">ใส่ URL ของภาพจากอินเตอร์เน็ต</button> -->
                        <div class="mt-1 mb-1"><input type="text" name="headimageurl" id="headimageurl" class="form-control" maxlength="300" style="width:800px" placeholder="ใส่ http หรือ https ให้ครบถ้วน เช่น https://anyweb.com/images/image1.png"></div>
                        <img src="" style="max-width:600px;" id="showpicture">
                    </div>
                    <div class="col-12 text-start mb-2">
                        เนื้อหาข่าว
                        <textarea name="content" id="content" class="form-control" rows="15" onchange="this.value=this.value.replace(/'/g,'&quot;');"></textarea>
                        <script>
                        CKEDITOR.replace('content', {
                            contentsCss: 'css/index.css',
                            disableNativeSpellChecker: true,
                            toolbar: [{
                                    name: 'document',
                                    items: ['Source', '-', 'Undo', 'Redo']
                                },
                                {
                                    name: 'basicstyles',
                                    items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
                                },
                                {
                                    name: 'paragraph',
                                    items: ['NumberedList', 'BulletedList', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                                },
                                {
                                    name: 'links',
                                    items: ['Link', 'Unlink', 'Anchor']
                                },
                                {
                                    name: 'insert',
                                    items: ['Image', 'Table', 'HorizontalRule', 'Smiley']
                                },
                                {
                                    name: 'tools',
                                    items: ['Maximize', 'ShowBlocks', 'About']
                                },
                                '/',
                                {
                                    name: 'styles',
                                    items: ['Styles', 'Format', 'Font', 'FontSize']
                                },
                                {
                                    name: 'colors',
                                    items: ['TextColor', 'BGColor']
                                }
                            ]
                        });
                    </script>
                    </div>
                    <div class="col-12 text-start mb-2">
                        สถานะ
                        <select name="status" id="status" class="form-control">
                            <option value="T">กําลังใช้งาน</option>
                            <option value="F">งดใช้งาน</option>
                        </select>
                    </div>
                    <div class="col-12 text-start">
                        <button id="save_bttn" type="button" class="btn btn-save" onclick="javascript:savenews();">บันทึก</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="title" id="title" value="">
            <input type="hidden" name="id" id="id" value="">
        </form>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="myModalLabel">กรุณาเลือกภาพที่ต้องการ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container m-1 p-1">
                        <div class="row" id="bindData">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closemodal">Close</button>
                </div>
                <div class="d-block w-100 text-center" id="snackbar"></div>
            </div>
        </div>
    </div>
    
    <script>
        function callpicture() {
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
                        html += "<div class=\"col-2 border-grey p-1 m-1\">"
                        html += "<div class=\"mt-1 mb-1\"><a href=\"javascript:showpicture('" + element.imageurl + "')\"><img src=\"" + element.imageurl + "\" style=\"width:100%\" ></a> </div>"
                        html += "<div class=\"mt-1 mb-1\"><button class=\"btn btn-add\" type=\"button\" onclick=\"javascript:copylink('" + element.imageurl + "')\">COPY LINK</button></div>";
                        html += "</div>";
                    });

                    $("#bindData").html(html);
                },
            });
        }

        function copylink(link) {
            navigator.clipboard.writeText(link);
            var x = document.getElementById("snackbar");
            x.innerHTML = 'Copied...!';
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 2000);
        }

        function showpicture(imageurl) {
            $("#showpicture").attr("src", imageurl);
            $("#showpicture").addClass("shadow");
            $("#headimageurl").val(imageurl);
            document.getElementById("closemodal").click();
        }

        function savenews() {

            const url = "ws/news/updatenews_ws.php";
            console.log("going to " + url);

            var id = document.getElementById("id").value;
            var headnews = document.getElementById("headnews").value;
            var headimageurl = document.getElementById("headimageurl").value;
            var content = CKEDITOR.instances['content'].getData();
            // console.log(content);
            //======= อะไรที่ต้องกำจัดออกจากข้อมูล หรือเครื่องหมายคำพูดที่ต้องแปลงออกไป ทำตรงนี้ =====//
            content = content.replace(/['"]/g, "\\$&").replace(/[\r\n]+/gm, "");
            // console.log(content);
            var status = document.getElementById("status").value;
            const inputData = "{\"id\": \"" + id + "\",\"headnews\": \"" + headnews.replaceAll(/[\r\n]+/gm, "").replaceAll('"', '\\u201c').replaceAll("'", '\\u201d') + "\",\"headimageurl\": \"" + headimageurl + "\",\"content\": \"" + content + "\",\"status\": \"" + status + "\"}";
            // console.log(inputData);
            const jsoninputData = JSON.parse(inputData);
            // console.log("before enter");
            // console.log(jsoninputData);
            $.ajax({
                url: url,
                method: "POST",
                dataType: "json",
                data: jsoninputData,
                success: function(data) {
                    console.log(data);
                    window.location.href = "mng_news.php";
                },
                error: function(error) {
                    console.log(error);
                    alert("Cannot save data");
                }
            });
        }
    </script>
</body>

</html>