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
/* Get departmentID */
$id = $_GET["departmentID"];

// Omzetten van department Van string naar integer
$departmentName = $_POST["departmentName"];
//oproepen van locatie uit form
$location = $_POST["location"];
/* Als connectie is gefaald toon error */
if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
/* Query definiëren */
$sql = "UPDATE departments SET departmentName = '$departmentName' , location = $location WHERE departmentID =$id";
/* als query is gelukt redirect */
if ($conn->query($sql) === TRUE) {
    header("location:../php/departments.php?sort=department");
} else {
     /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
