<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
$data = $_SESSION['user'];
if($data[6] != 2 ){
header("location:../php/profiel.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
$id = $_GET["departmentID"];

$sql = "DELETE FROM departments WHERE departmentID =$id;";
$sql .="UPDATE user SET departmentID = 15 WHERE departmentID =$id;";


if ($conn->multi_query($sql) === TRUE) {
    header("location:../php/departments.php?sort=department");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
