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

// Omzetten van gender Van string naar integer
if($_POST['gender'] == "male"){
  $sex = 1;
}
elseif($_POST['gender'] == "female"){
$sex = 2;
}
// Omzetten van department Van string naar integer

$initials    =  strtoupper($_POST['initials']);
$middlename = $_POST['middleName'];
$surname       =  ucfirst($_POST['surname']);
$interncell = $_POST['nummer'];
$password  =  hash("sha256","Welkom0!");
$department = $_POST['department'];

if ($department == "4"){
  $config = "2";
}
elseif($department == "8"){
    $config = "2";
}
elseif($department == "9"){
    $config = "2";
}
else{
  $config = "1";
}

if($department == "7"){
  $userType = "2";
}
elseif($department == "3"){
  $userType = "3";
}
else{
  $userType = "1";
}
// Department Name toezeggen
if($department == 2){
  $departmentName ="cad";
}
elseif($department == 3){
  $departmentName ="directie";
}
elseif($department == 4){
  $departmentName ="engineering";
}
elseif($department == 5){
  $departmentName ="Financieleadministratie";
}
elseif($department == 6){
  $departmentName ="hrm";
}
elseif($department == 7){
  $departmentName ="ict";
}
elseif($department == 8){
  $departmentName ="onderzoek";
}
elseif($department == 9){
  $departmentName ="planning";
}
elseif($department == 10){
  $departmentName ="projectplanning";
}
elseif($department == 11){
  $departmentName ="rapportage";
}
elseif($department == 12){
  $departmentName ="secretariaat";
}
elseif($department == 13){
  $departmentName ="verkoopenmarketing";
}
$email  =  $_POST['initials'] .$_POST['surname'] ."@".$departmentName. ".matwente.com";

if (!$conn) {
 die("Connection Failed " . mysqli_connect_error());
}

$sql = "INSERT INTO user (initials, middleName, surname, email, interncell, password, sex, departmentID,userType)
VALUES ('$initials', '$middlename', '$surname', '$email', '$interncell', '$password', '$sex', '$department', '$userType');";

if ($conn->query($sql) === TRUE) {
  $last_id = mysqli_insert_id($conn);
  $sql1 = "INSERT INTO user2configuration (userID, configurationID) VALUES ('$last_id', '$config');";
  mysqli_query( $conn, $sql1);
    header("location:gebruikertoevoegen.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
