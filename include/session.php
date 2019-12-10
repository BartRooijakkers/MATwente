<?php
session_start();
if(isset($_SESSION['name'])){
	$connect = mysqli_connect("localhost", "root", "", "twente");
	} else {
	$connect = mysqli_connect("localhost", "root", "", "twente");
	}
?>
