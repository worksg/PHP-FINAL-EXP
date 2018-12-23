<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("request invalid");
}

$DELETE_ID = @$_POST["id"];
if ($DELETE_ID == null) {
    die("request invalid");
}

$conn = mysqli_connect('localhost', 'root', "root") or die("连接数据库失败！");
mysqli_set_charset($conn, 'utf8mb4');
$status = mysqli_select_db($conn, "demodb");
if ($status != true) {
    $conn->close();
    die("选择数据库失败！");
}

$info = null;
$sql = "DELETE FROM `demodb`.`Course` WHERE  `cno`='$DELETE_ID'";
$conn->query($sql);
$conn->close();

header("Location: /course.php");