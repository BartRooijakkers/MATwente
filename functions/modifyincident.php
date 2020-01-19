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

$id = $_GET["incidentID"];

$conn = mysqli_connect($servername, $username, $password, $dbname);


// wachtwoord Encrypten
$description = $_POST['description'];
$time= $_POST['time'] * 60;
$responsible = $_POST['responsibleID'];
$cause = $_POST['cause'];
$solution = $_POST['solution'];
$feedback = $_POST['feedback'];
$status = $_POST['statusID'];
$type =$_POST['type'];
if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

if($status == 8 || $status == 11){

$sql =  "UPDATE incident SET statusID = $status, description = '$description', time = $time,
responsibleID = $responsible, cause = '$cause', solution = '$solution', feedback = '$feedback', type = $type, finishDate = CURRENT_TIMESTAMP
 WHERE incidentID =$id";
}
 else{
   $sql =  "UPDATE incident SET statusID = $status, description = '$description', time = $time,
   responsibleID = $responsible, cause = '$cause', solution = '$solution', feedback = '$feedback', type = $type, finishdate = NULL
    WHERE incidentID =$id";
 }

if ($conn->query($sql) === TRUE) {
    header("location:../php/incidenten.php?sort=urgency");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
