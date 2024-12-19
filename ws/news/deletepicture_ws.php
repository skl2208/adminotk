<?php
header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

//======= define variable ======//
$list_picture = [];
$info = array(
    "id" => "",
    "imagename" => "",
    "imageurl" => "",
    "createdate" => "",
);
$my = "F";
if (isset($_POST["id"]) && $_POST["id"] != "") {
    $id = $_POST["id"];

    //====== ไปหาค่าไฟล์จริงใน path ========//

    $sql = "SELECT id,imagename,imageurl,createdate FROM image WHERE id=" . $id;

    $result = $conn->query($sql);

    $info = array(
        "id" => "",
        "imagename" => "",
        "imageurl" => "",
        "createdate" => "",
    );

    $list_picture["status"] = "OK";
    $list_picture["total_rec"] = $result->num_rows;
    $list_picture["message"] = "Deleted Successfully";
    $list_picture["data"] = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $my = $result->num_rows;
            $info["id"] = $row["id"];
            $info["imagename"] = $row["imagename"];
            $info["imageurl"] = $row["imageurl"];
            $info["createdate"] = $row["createdate"];
            array_push($list_picture["data"], $info);
        }

        //===== เมื่อเลือกไฟล์ได้จาก db ก็เข้าขั้นการลบไฟล์นั้นออก =====//
        $sql = "DELETE FROM image WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            //==== ลบไฟล์จาก db ได้แล้ว ====//
            //======== ลบไฟล์ออกจาก storage =======//

            $file = $list_picture["data"][0]["imagename"];
            if (unlink($file)) {
                $list_picture["status"] = "OK";
                // $list_picture["total_rec"] = 0;
                $list_picture["message"] = "Successfully deleted the file id=" . $id . " ,File:" . $file;
            }
        }
    } else {
        $list_picture["status"] = "FAIL";
        $list_picture["total_rec"] = 0;
        $list_picture["message"] = "Cannot delete the picture id=" . $id . ". Not found this element";
    }
}

echo json_encode($list_picture);

$result->close();
$conn->close();
