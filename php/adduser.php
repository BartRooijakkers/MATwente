<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Omzetten van gender Van string naar integer
if($_POST['gender'] == "male"){
  $sex = 1;
}
elseif($_POST['gender'] == "female"){
$sex = 2;
}
// Omzetten van department Van string naar integer

$initials    =  $_POST['initials'];
$middlename = $_POST['middleName'];
$surname       =  $_POST['surname'];
$email  =  $_POST['email'];
$interncell = $_POST['nummer'];
$password  =  hash("sha256","Welkom0!");
$department = $_POST['department'];

if($department == "7"){
  $userType = "2";
}
elseif($department == "3"){
  $userType = "3";
}
else{
  $userType = "1";
}



if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO user (initials, middleName, surname, email, interncell, password, sex, departmentID,userType)
VALUES ('$initials', '$middlename', '$surname', '$email', '$interncell', '$password', '$sex', '$department', '$userType')";

if ($conn->query($sql) === TRUE) {
    header("location:gebruikertoevoegen.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("gebruikers.php");
?>
