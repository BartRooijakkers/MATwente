<?php

session_start();
$con = mysqli_connect('localhost', 'root', '', 'twente');

$lastId = $_SESSION['logId'];
var_dump("LastID", time(), $lastId);

$sql = "UPDATE logintable SET UitlogDate=". "'" . date('Y-m-d H:i:s', time()) . "'" ." WHERE id=".$lastId;
mysqli_query($con, $sql);

session_destroy();
?>