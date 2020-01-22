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

// wachtwoord Encrypten
$password  =  hash("sha256",$_POST['password']);
/* Als connectie is gefaald toon error */
if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
/* pak userID uit sessie */
$id = $data[7];
/* Query definiëren */
$sql =  "UPDATE user SET password ='$password' WHERE userID =$id";
/* als query is gelukt redirect naar profiel*/
if ($conn->query($sql) === TRUE) {
    header("location:../php/profiel.php");
} else {
  /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
