<?php

header("Access-Control-Allow-Origin: *");

include "../../include/config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["id"]) && ($_POST["id"] != "")) {
    $id = $_POST["id"];
} else {
    $id = "";
}

if (isset($_POST["user"]) && ($_POST["user"] != "")) {
    $user = trim($_POST["user"]);
} else {
    $user = "";
}
if (isset($_POST["role"]) && ($_POST["role"] != "")) {
    $role = trim($_POST["role"]);
} else {
    $role = "";
}
if (isset($_POST["password"]) && ($_POST["password"] != "")) {
    $enpassword = trim($_POST["password"]);
} else {
    $enpassword = "";
}
if (isset($_POST["status"]) && ($_POST["status"] != "")) {
    $status = $_POST["status"];
} else {
    $status = "";
}

$list_result["inputdata"] = $id . "," . $user . "," . $role . "," . $enpassword . "," . $status;

if ($id != "") {
    //=== Update ===//
    $sql = "UPDATE account SET user = ?, password = ?, role = ?, updatedate = CURRENT_TIMESTAMP(), status = ? WHERE id = ?";

    $list_result["sql"] = $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $user, $enpassword, $role, $status, $id);
} else {
    //=== Add ===//
    $sql = "INSERT INTO account (user,password,role,  status) VALUES (?,?,?,?)";
    $list_result["id"] = $id;
    $list_result["sql"] = $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $user, $enpassword, $role, $status);
}
$list_result["progress"] = "DONE";
try {
    if ($stmt->execute()) {
        $list_result["status"] = "OK";
        $list_result["message"] = "Insert or Update Successfully";
    } else {
        $list_result["status"] = "ERROR";
        $list_result["message"] = "Cannot Insert or Update";
    }
} catch (Exception $e) {
    echo $e->getMessage();
    $list_result["status"] = "ERROR";
    $list_result["message"] = $e->getMessage();
}

echo json_encode($list_result);

$conn->close();
