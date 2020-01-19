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
$brand = $_POST['brand'];
$model = $_POST['model'];
$type = $_POST['type'];
$config = $_POST['config'];

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO hardware (model, type, brand)
VALUES ('$model', '$type','$brand')";

if ($conn->query($sql) === TRUE) {
  $last_id = mysqli_insert_id($conn);
  $sql1 = "INSERT INTO config2hardware (hardwareID, configurationID) VALUES ('$last_id', '$config');";
  mysqli_query( $conn, $sql1);
    header("location:../php/configuraties.php?sort=departments");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
