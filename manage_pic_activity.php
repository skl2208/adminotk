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
    <script type="text/javascript" src="js/manage_pic_activity.js"></script>
    <script type="text/javascript" src="js/upload.js"></script>
</head>

<body>
    <section id="mainmenu">
        <?php include "include/header.php"; ?>
    </section>
    <section class="content">
        <div class="title-head p-2">ระบบคลังภาพ</div>
        <div class="title-head text-end p-2"><button onclick="javascript:Goback();" class="btn btn-cancel">ย้อนกลับ</button></div>
        <div><button class="btn btn-add"><img src="images/icon_gear_white.png" class="icon-picture"> จัดการภาพในคลัง</button></div>
        <div class="d-block">
            <div class="d-inline-block p-2 border-info active"><a href="javascript:activeSection('uploadpicture')" id="choice_1">อัพโหลดภาพ</a></div>
            <div class="d-inline-block p-2 border-info"><a href="javascript:activeSection('albumpicture')" id="choice_2">จัดการภาพในคลัง</a></div>
        </div>

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
        <!-- <section id="albumpicture" class="alter-section position-relative mt-3">
            <div class="container-fluid ps-0 pe-0 ms-0 me-0" style="width:100%">
                <div class="row gx-0 gy-1 showListAlbumPicture" id="showListAlbumPicture">
                    
                </div>
            </div>
            <section class="paging">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center" id="displayPaging">
                    </ul>
                </nav>
            </section>
            <div class="preview">
                 show picture
                <div class="bg-grey" id="showFullAlbumPicture">
                </div>
                <div>
                    <input type="hidden" name="changePictureFromAlbum" id="changePictureFromAlbum" value="">
                    <button type="button" class="btnOK" onclick="change_Picture_FromAlbum(document.getElementById('changePictureFromAlbum').value);"><img src="../images/icon_save.png"> ยืนยันการเปลี่ยนภาพ</button>
                    <button type="button" class="btnCancel" onclick="javascript:albumPicture('none','');"><img src="../images/ic_close.png"> ยกเลิก</button>
                </div>
            </div>
        </section> -->
        <!-- <div class="spinner-border text-info" id="spinner"></div>
        <div id="showToast"></div> -->
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