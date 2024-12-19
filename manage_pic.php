<?php
session_start();
include "include/checkadmin.php";
?>
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
    <script type="text/javascript" src="js/manage_pic.js"></script>
    <script type="text/javascript" src="js/upload.js"></script>
</head>

<body>
    <section id="mainmenu">
        <?php include "include/header.php"; ?>
    </section>
    <section class="content">
        <div class="title-head p-2">ระบบคลังภาพ</div>
        <div class="title-head text-end p-2"><button onclick="javascript:Goback();" class="btn btn-cancel">ย้อนกลับ</button></div>
        <div><button class="btn btn-add" onclick="javascript:window.location.href='editpicture.php'"><img src="images/icon_gear_white.png" class="icon-picture"> จัดการภาพในคลัง</button></div>
        <section id="uploadpicture" class="alter-section position-relative mt-3">
            <div style="min-height:100px;overflow-y:auto;">
                <img src="images/empty_image.png" style="width:500px;height:auto;border:2px solid gray;margin-bottom:5px" id="showPreviewPicture">
            </div>
            <div>
                <form id="uploadform" method="post" action="upload.php" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" placeholder="เลือกไฟล์">
                    <button class="btn btn-add"><img src="images/icon_upload_white.png" class="icon-picture"> อัพโหลด</button><br>
                </form>
            </div>
        </section>
    </section>
    <script>
        function doCancel() {
            editActivityPicture.close();
        }

        function updateCheckBox(thisobj) {

            if (thisobj.checked) {
                thisobj.value = "Y";
            } else {
                thisobj.value = "N";
            }
        }
        $(function() {
            document.getElementById("editActivityPicture").style.display = "none";
            document.getElementById("albumpicture").style.display = "none";
            document.getElementById("uploadpicture").style.display = "block";
            listActivityAlbum('', 1, '', 'show');
        });
    </script>
    <?php
    $conn->close();
    ?>
</body>

</html>