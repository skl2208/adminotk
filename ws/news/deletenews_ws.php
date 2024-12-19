<?php
header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

//======= define variable ======//
$list_news = [];

$my = "F";
if (isset($_POST["id"]) && $_POST["id"] != "") {
    $id = $_POST["id"];

    //===== เมื่อเลือกไฟล์ได้จาก db ก็เข้าขั้นการลบไฟล์นั้นออก =====//
    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {

        //======== ลบไฟล์ออกจาก storage =======//
        $list_news["status"] = "OK";
        $list_news["total_rec"] = 1;
        $list_news["message"] = "News id=" . $id . ". has been deleted successfully";

    }
} else {
    $list_news["status"] = "FAIL";
    $list_news["total_rec"] = 0;
    $list_news["message"] = "Cannot delete the picture id=" . $id . ". Not found this element";
}


echo json_encode($list_news);

$conn->close();
