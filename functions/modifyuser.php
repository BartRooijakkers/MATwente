<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
$data = $_SESSION['user'];
if($data[6] != 2 ){
header("location:../php/profiel.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


// Omzetten van department Van string naar integer
$surname       =  ucfirst($_POST['surname']);
$interncell = $_POST['interncell'];
$department = $_POST['departmentName'];
$email = $_POST['email'];

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
$id = $_GET["userID"];

$sql = "UPDATE user SET surname = '$surname' , departmentID = $department , interncell = $interncell, email = '$email' WHERE userID =$id";

if ($conn->query($sql) === TRUE) {
    header("location:../php/gebruikers.php?sort=department");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
