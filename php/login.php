<?php
  if(!isset($_SESSION)){
	session_start();
  }
// Database Instellingen
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "twente";
$username = $_POST['username'];
$password = $_POST['password'];
// Connectie variabele
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
// SQL: alles van de gebruikers
$sql = "SELECT * FROM user WHERE email = '{$username}' AND password = '{$password}'";
// Query de database
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
// Als er meer dan 0 resulta(a)t(en) zijn.
if($resultCheck > 0){
  // Stop de column als array in het variabele $row.
  if($row = mysqli_fetch_assoc($result)){
    // Laat de achternaam zien

	$_SESSION['user'] = [$row['initials'], $row['middleName'], $row['surname'], $row['email'], $row['interncell']];
  }
  
}
header('Location: profiel.php');
?>