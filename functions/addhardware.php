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
$type = $_POST['type'];
$model = $_POST['model'];
$brand = $_POST['brand'];
/* Query definiëren */
$sql = "INSERT INTO hardware (model, type, brand)
VALUES ('$model', '$type','$brand')";
/* Als query gelukt is  voer volgende queries uit*/
if ($conn->query($sql) === TRUE) {
  $last_id = mysqli_insert_id($conn);
  $sql1 = "INSERT INTO config2hardware (hardwareID, configurationID) VALUES ('$last_id', '$config');";
  mysqli_query( $conn, $sql1);
  /* Als query gelukt is redirect naar configuraties */
    header("location:../php/configuraties.php?sort=departments");
} else {
  /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
