<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
$data = $_SESSION['user'];

// Database Instellingen
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "twente";
$username = $_POST['username'];
$password = $_POST['password'];
// Connectie variabele
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

$password = hash("sha256",$password);
// SQL: alles van de gebruikers
$sql = "SELECT user.*, departments.departmentName, user2configuration.configurationID FROM user
INNER JOIN departments ON user.departmentID = departments.departmentID
INNER JOIN user2configuration ON user.userID = user2configuration.userID
WHERE user.email = '{$username}' AND user.password = '{$password}'";
// Query de database
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
// Als er meer dan 0 resulta(a)t(en) zijn.
if($resultCheck > 0){
  // Stop de column als array in het variabele $row.
  if($row = mysqli_fetch_assoc($result)){
    // Laat de achternaam zien
	$_SESSION['user'] = [$row['initials'], $row['middleName'], $row['surname'], $row['email'], $row['interncell'], $row['departmentName'], $row['userType'], $row['userID'], $row['configurationID']];
	header('Location: ../php/profiel.php');
  }

}
else{
	header('Location:../php/index.php?error');
}
?>
