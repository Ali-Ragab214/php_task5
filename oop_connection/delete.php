<?php
require "index.php";

$id = (int)$_GET['id'];
$database->delete("users", $id);

header("location: allusers.php");
exit;
?>