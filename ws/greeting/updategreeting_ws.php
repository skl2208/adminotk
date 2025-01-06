<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["id"]) && ($_POST["id"] != "")) {
    $id = $_POST["id"];
}
if (isset($_POST["welcometh"]) && ($_POST["welcometh"] != "")) {
    $welcometh = trim($_POST["welcometh"]);
}
if (isset($_POST["welcomeen"]) && ($_POST["welcomeen"] != "")) {
    $welcomeen = trim($_POST["welcomeen"]);
}
if (isset($_POST["status"]) && ($_POST["status"] != "")) {
    $status = trim($_POST["status"]);
}


if (isset($_POST["id"]) && $_POST["id"] != "") {
    //=== ทำการคำนวณหาค่าเดิมของคำทักทาย ===//
    if ($status == "T") {
        //=== ปิดคำทักทายเดิมทุกอันให้หมด ===//
        $sql = "UPDATE greeting SET status='F'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    //=== Update ===//
    $sql = "UPDATE greeting SET welcometh = ?, welcomeen = ?, updatedate=CURRENT_TIMESTAMP(), status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $welcometh, $welcomeen, $status, $id);
} else {
    //=== ทำการคำนวณหาค่าเดิมของคำทักทาย ===//
    if ($status == "T") {
        //=== ปิดคำทักทายเดิมทุกอันให้หมด ===//
        $sql = "UPDATE greeting SET status='F'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    //=== Add ===//
    $sql = "INSERT INTO greeting (welcometh,welcomeen,status) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $welcometh, $welcomeen, $status);
}
$list_result["progress"] = "DONE";
try {
    if ($stmt->execute()) {
        $list_result["status"] = "OK";
        $list_result["message"] = "Insert or Update Successfully";
    } else {
        $list_result["status"] = "ERROR";
    }
} catch (Exception $e) {
    echo $e->getMessage();
    $list_result["status"] = "ERROR";
    $list_result["message"] = $e->getMessage();
}

echo json_encode($list_result);

$conn->close();
