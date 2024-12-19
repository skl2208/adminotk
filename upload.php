<?php
include "include/config.php";

$target_dir = $image_upload_path["upload"];
$name = $_FILES["fileToUpload"]["name"];
$ext = end((explode(".", $name)));


// ====== Get New Name of file ====== //
$newfilename = "img" . date("Ymd") . time() . "." . $ext;
// echo "ชื่อไฟล์ชั่วคราวคือ ".$_FILES["fileToUpload"]["tmp_name"]."<br>";
// echo "ชื่อไฟล์เก่าคือ ".$_FILES["fileToUpload"]["name"]."<br>";
// echo "ชื่อไฟล์ใหม่คือ " . $newfilename . "<br>";
// echo "อ้างอิงไฟล์ใหม่คือ " . "<br>";

// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $newfilename;
// echo $target_file."<br>";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
$url .= "://" . $_SERVER['SERVER_NAME'] . "/adminotk/images/upload/news/" . $newfilename;

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
    </section>
    <?php
    // echo "ปลายทางใหม่คือ ".$target_file."<br>";

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 10000000) {
        echo "<div class=\"col-12 text-center\">";
        echo "<div class=\"mb-3\"><img src=\"images/icon_danger.png\" class=\"icon-picture\"> อัพโหลดไม่สำเร็จ ไฟล์มีขนาดใหญ่เกิน 10mb</div>";
        echo "<button class=\"btn btn-add\" onclick=\"javascript:Goback();\"><img src=\"images/icon_upload_white.png\" class=\"icon-picture\"> กลับไปอัพโหลดภาพเพิ่มเติม</button>";
        echo "</div>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    try {
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                //===== ส่งข้อมูลไป update ในฐานข้อมูล =====//
                $sql = "INSERT INTO image (imageurl,imagename) VALUES ('$url','$target_file')";

                if ($conn->query($sql)) {
                    //successful update
                    echo "<div class=\"col-12 text-center\">";
                    echo "<div class=\"mb-3\"><img src=\"images/icon_ok.png\" class=\"icon-picture\"> อัพโหลดสำเร็จ</div>";
                    echo "<div class=\"mb-3 Prompt-thin\">URL ของภาพนี้คือ  " . $url . " <button class=\"btn btn-add\" onclick=\"javascript:copytext('$url')\">COPY</button></div>";
                    echo "<button class=\"btn btn-add\" onclick=\"javascript:Go('manage_pic.php');\"><img src=\"images/icon_upload_white.png\" class=\"icon-picture\"> กลับไปอัพโหลดภาพเพิ่มเติม</button>";
                    echo "</div>";
                } else {
                    echo "Sorry, there was an error uploading your file.<br>" . $_FILES["file"]["error"];
                }
            } else {
                echo "Sorry, there was an error uploading your file.<br>" . $_FILES["file"]["error"];
            }
        }
    } catch (Exception $e) {
        $uploadOk = 0;
        echo $e->getMessage();
    }
    ?>
    <div id="snackbar"></div>
    <script>
        function copytext(mystring) {
            navigator.clipboard.writeText(mystring);

            var x = document.getElementById("snackbar");
            x.innerHTML = 'Copied...!';
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 2000);
        }
    </script>
</body>

</html>