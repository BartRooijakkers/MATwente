<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
$data = $_SESSION['user'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Gegevens oproepen */
$departmentName = $_POST['departmentName'];
$location = $_POST['location'];


if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
  $sql =  "INSERT INTO departments (departmentName, location)
  VALUES ('$departmentName', $location)";

if ($conn->query($sql) === TRUE) {
    header("location:../php/departments.php?sort=departments");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
