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


// wachtwoord Encrypten
$password  =  hash("sha256",$_POST['password']);

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}
$id = $data[7];

$sql =  "UPDATE user SET password ='$password' WHERE userID =$id";

if ($conn->query($sql) === TRUE) {
    header("location:profiel.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
