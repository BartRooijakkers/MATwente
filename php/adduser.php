<?php
require '../include/session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$department = 0;

// Omzetten van gender Van string naar integer
if($_POST['gender'] == "male"){
  $sex = 1;
}
elseif($_POST['gender'] == "female"){
$sex = 2;
}
// Omzetten van department Van string naar integer
if(isset($_POST['department']) && $_POST['department'] == "CAD"){
  $department = 2;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Directie"){
  $department = 3;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Engineering"){
  $department = 4;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Financiele Administratie"){
  $department = 5;
}
elseif(isset($_POST['department']) && $_POST['department'] == "HRM"){
  $department = 6;
}
elseif(isset($_POST['department']) && $_POST['department'] == "ICT"){
  $department = 7;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Onderzoek"){
  $department = 8;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Planning"){
  $department = 9;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Project Planning"){
  $department = 10;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Rapportage"){
  $department = 11;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Secretariaat"){
  $department = 12;
}
elseif(isset($_POST['department']) && $_POST['department'] == "Verkoop en Marketing"){
  $department = 13;
}

$initials    =  $_POST['initials'];
$middlename = $_POST['middleName'];
$surname       =  $_POST['surname'];
$email  =  $_POST['email'];
$interncell = $_POST['nummer'];
$password  =  md5("Welkom0!");




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
