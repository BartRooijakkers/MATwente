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
// haal data uit formulier
$surname       =  ucfirst($_POST['surname']);
$interncell = $_POST['interncell'];
$department = $_POST['departmentName'];
$email = $_POST['email'];
/* geef rol mee vanuit department */
if($department == "7"){
  $userType = "2";
}
elseif($department == "3"){
  $userType = "3";
}
else{
  $userType = "1";
}
/* Als connectie is gefaald toon error */
if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
/* pak userID uit de URl */
$id = $_GET["userID"];
/* Query definiëren */
$sql = "UPDATE user SET surname = '$surname' , departmentID = $department , interncell = $interncell, email = '$email' WHERE userID =$id";
/* als query is gelukt redirect naar gebruikers */
if ($conn->query($sql) === TRUE) {
    header("location:../php/gebruikers.php?sort=department");
} else {
      /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
