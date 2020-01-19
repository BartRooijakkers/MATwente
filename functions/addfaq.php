<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
$data = $_SESSION['user'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$question = $_POST['question'];
$answer = $_POST['answer'];

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO faq (question, answer)
VALUES ('$question', '$answer')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("location:../php/faq.php");
?>
