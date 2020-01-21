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
$id = $_GET["departmentID"];

// Omzetten van department Van string naar integer
$departmentName = $_POST["departmentName"];
$location = $_POST["location"];
if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}


$sql = "UPDATE departments SET departmentName = '$departmentName' , location = $location WHERE departmentID =$id";

if ($conn->query($sql) === TRUE) {
    header("location:../php/departments.php?sort=department");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
