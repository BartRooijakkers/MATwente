<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$user = $_POST['user'];
$config = $_POST['config'];

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO user2configuration (userID, configurationID)
VALUES ('$user', '$config')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("location: configuraties.php?sort=departments");
?>
