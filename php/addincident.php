<?php
require '../include/session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$shortDescription = $_POST['shortDescription'];
$impact = $_POST['impact'];
$status = 9;
$user = 1;

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO incident (shortDescription, impact, statusID)
VALUES ('$shortDescription', '$impact', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("configuraties.php");
?>
