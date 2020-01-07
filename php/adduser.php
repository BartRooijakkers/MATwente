<?php
require '../include/session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$initials    =  $_POST['initials'];
$middlename = $_POST['middleName'];
$surname       =  $_POST['surname'];
$email  =  $_POST['email'];
$interncell = $_POST['nummer'];
$password  =  "test";



if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO user (initials, middleName, surname, email, interncell, password)
VALUES ('$initials', '$middlename', '$surname', '$email', '$interncell', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("gebruikers.php");
?>
