<?php
include("koneksi.php");

$table = $_GET['table'];
$id = $_GET['id'];
mysqli_query($mysqli,"DELETE FROM $table WHERE id=$id");

header("Location: ".$_SERVER['HTTP_REFERER']);
?>