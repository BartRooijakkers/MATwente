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
/* Als connectie is gefaald toon error */
if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
/* Get departmentID */
$id = $_GET["departmentID"];
/* Query definiëren */
$sql = "DELETE FROM departments WHERE departmentID =$id;";
$sql .="UPDATE user SET departmentID = 15 WHERE departmentID =$id;";
/*waneer query voltooid is redirect*/
if ($conn->multi_query($sql) === TRUE) {
    header("location:../php/departments.php?sort=department");
} else {
  /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
