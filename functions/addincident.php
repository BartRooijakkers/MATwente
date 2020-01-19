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

$shortDescription = $_POST['shortDescription'];
$impact = $_POST['impact'];
$status = 9;
$user = $data[7];
$config = $data[8];
$type = 3;
$responsible = 5;

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO incident (shortDescription, impact, statusID, type, responsibleID)
VALUES ('$shortDescription', '$impact', '$status','$type', '$responsible');";





if ($conn->multi_query($sql) === TRUE) {
  $last_id = mysqli_insert_id($conn);
  $sql1 = "INSERT INTO user2incident (userID, incidentID) VALUES ('$user', '$last_id');";
  $sql1 .= "INSERT INTO config2incident(configurationID, incidentID) VALUES('$config', '$last_id')";
     header("Location:../php/mijnincidenten.php?sort=urgency");
    $conn->multi_query($sql1);

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
