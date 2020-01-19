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
/* Connectie maken met de database */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
?>
<!doctype html>
<html lang="nl">
	<?php include('../include/header.php');?>
<body>
	<?php
if($data[6] == 2){
  include('../include/navigatiebeheerder.php');
}
elseif($data[6] == 3){
  include('../include/navigatiedirectie.php');
}
else{
  include('../include/navigatie.php');
}
?>
	<br>
  <div class="container">

					<div class="login">
            <h1 class="form"> Wat wilt u toevoegen? </h1>

          <a href="gebruikertoevoegen.php">
            <button class="list" name="login_btn">Gebruiker toevoegen</button>
          </a>
          <a href="configuratietoevoegen.php">
            <button class="list" name="login_btn">Configuratie toevoegen</button>
          </a>
          <a href="hardwaretoevoegen.php">
            <button class="list" name="login_btn">Hardware toevoegen</button>
          </a>
          <a href="faqtoevoegen.php">
            <button class="list" name="login_btn">Veel gestelde vragen toevoegen</button>
          </a>

			</div>
  </div>
</body>
</html>
