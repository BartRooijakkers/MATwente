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
/* variablen database connectie definiëren */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";
/* Connectie maken met de database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Als connectie is gefaald toon error */
if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
/* Data uit formulier halen */
$shortDescription = $_POST['shortDescription'];
$impact = $_POST['impact'];
$status = 9;
$user = $data[7];
$config = $data[8];
$type = 3;
$responsible = 5;
/* Query definiëren */
$sql = "INSERT INTO incident (shortDescription, impact, statusID, type, responsibleID)
VALUES ('$shortDescription', '$impact', '$status','$type', '$responsible');";
/* Als query gelukt is  voer volgende queries uit*/
if ($conn->multi_query($sql) === TRUE) {
  $last_id = mysqli_insert_id($conn);
  $sql1 = "INSERT INTO user2incident (userID, incidentID) VALUES ('$user', '$last_id');";
  $sql1 .= "INSERT INTO config2incident(configurationID, incidentID) VALUES('$config', '$last_id')";
    /* Als query gelukt is redirect naar mijnincidenten */
     header("Location:../php/mijnincidenten.php?sort=urgency");
    $conn->multi_query($sql1);
} else {
  /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
