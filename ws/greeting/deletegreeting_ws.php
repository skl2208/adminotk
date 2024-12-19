<?php
header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

//======= define variable ======//
$list_picture = [];

if (isset($_POST["id"]) && $_POST["id"] != "") {

    $id = $_POST["id"];

    //===== เมื่อเลือกไฟล์ได้จาก db ก็เข้าขั้นการลบไฟล์นั้นออก =====//
    $sql = "DELETE FROM greeting WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        //==== ลบไฟล์จาก db ได้แล้ว ====//
        //======== ลบไฟล์ออกจาก storage =======//
        $list_result["status"] = "OK";
        $list_result["message"] = "Deleted Greeting ID= " . $id . " Successfully";
    } else {
        $list_result["status"] = "FAIL1";
        $list_result["message"] = "Cannot delete the greeting id=" . $id . ". Not found this element";
    }
} else {
    $list_result["status"] = "FAIL2";
    $list_result["message"] = "Cannot delete the greeting id=" . $id . ". Not found this element";
}

echo json_encode($list_result);

$conn->close();
