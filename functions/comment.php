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
$id = $_GET["incidentID"];
$comment = $_POST["comment"];


if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
  $sql =  "UPDATE incident SET comment = '$comment'
   WHERE incidentID =$id";

if ($conn->query($sql) === TRUE) {
    header("location:../php/mijnincidenten.php?sort=urgency");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
