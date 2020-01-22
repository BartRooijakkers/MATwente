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
/* Get UserID */
$id = $_GET["userID"];
/* Query definiëren */
$sql = "DELETE FROM user WHERE userID =$id;";
$sql .="UPDATE user2configuration SET userID = 57 WHERE userID =$id;";
$sql .="UPDATE user2incident SET userID = 57 WHERE userID =$id;";
/* als query is uitgevoerd redirect */
if ($conn->multi_query($sql) === TRUE) {
    header("location:../php/gebruikers.php?sort=department");
} else {
  /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
