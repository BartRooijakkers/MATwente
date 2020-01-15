<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];
if($data[6] != 2 ){
header("location:profiel.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
$id = $_GET["userID"];

$sql = "DELETE FROM user WHERE userID =$id;";
$sql .="DELETE FROM user2configuration WHERE userID = $id;";
$sql .="UPDATE user2incident SET userID = 57 WHERE userID =$id;";

if ($conn->multi_query($sql) === TRUE) {
    header("location:gebruikers.php?sort=department");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
