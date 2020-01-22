<?php
/* Controlleren of sessie is aangemaakt */
if(!isset($_SESSION)){
 session_start();
}
/* Wanneer sessie niet gemaakt is wordt de gebruiker terug verwezen naar de inlogpagina*/
if(!isset($_SESSION['user'])){
header("location:../php/index.php");
}
/* Rol van gebruiker oproepen */
$data = $_SESSION['user'];
/* variablen database connectie definiëren */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";
/* Connectie maken met de database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Als connectie is gefaald toon error */
if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
/* Data uit formulier halen */
$question = $_POST['question'];
$answer = $_POST['answer'];
/* Query definiëren */
$sql = "INSERT INTO faq (question, answer)
VALUES ('$question', '$answer')";
/* Als query gelukt is  toon: */
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
      /* Wanneer de query mislukt toont hij: Error */
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    /* redirect naar FAQ*/
header("location:../php/faq.php");
?>
