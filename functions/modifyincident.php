<?php
/* Controlleren of sessie is aangemaakt */
if(!isset($_SESSION)){
 session_start();
}
/* Wanneer sessie niet gemaakt is wordt de gebruiker terug verwezen naar de inlogpagina*/
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
/* Rol van gebruiker oproepen */
$data = $_SESSION['user'];
/* Controleer Rechten */
if($data[6] != 2 ){
header("location:../php/profiel.php");
}
/* variablen database connectie definiëren */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";
/* Connectie maken met de database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Get ID */
$id = $_GET["incidentID"];
/* Haal data uit formulier */
$description = $_POST['description'];
$time= $_POST['time'] * 60;
$responsible = $_POST['responsibleID'];
$cause = $_POST['cause'];
$solution = $_POST['solution'];
$feedback = $_POST['feedback'];
$status = $_POST['statusID'];
$type =$_POST['type'];
/* Als connectie is gefaald toon error */
if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
/* verschillende queries voor verschillende statussen */
if($status == 8 || $status == 11){
/* Query definiëren als incident is afgerond*/
$sql =  "UPDATE incident SET statusID = $status, description = '$description', time = $time,
responsibleID = $responsible, cause = '$cause', solution = '$solution', feedback = '$feedback', type = $type, finishDate = CURRENT_TIMESTAMP
 WHERE incidentID =$id";
}
 else{
   /* Query definiëren wanneer query niet is afgerond */
   $sql =  "UPDATE incident SET statusID = $status, description = '$description', time = $time,
   responsibleID = $responsible, cause = '$cause', solution = '$solution', feedback = '$feedback', type = $type, finishdate = NULL
    WHERE incidentID =$id";
 }
/* als query is gelukt redirect */
if ($conn->query($sql) === TRUE) {
    header("location:../php/incidenten.php?sort=urgency");
} else {
      /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
