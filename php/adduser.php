<?php
require '../include/session.php';

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
$password  =  md5("Welkom0!");
$department = $_POST['department'];




if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO user (initials, middleName, surname, email, interncell, password, sex, departmentID)
VALUES ('$initials', '$middlename', '$surname', '$email', '$interncell', '$password', '$sex', '$department')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("gebruikers.php");
?>
