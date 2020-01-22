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
/* Connectie maken met de database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Als connectie is gefaald toon error */
if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
?>
<!doctype html>
<html lang="nl">
<!-- Het includen van de header -->
	<?php include('../include/header.php');?>
<body>
  <!-- Het includen van de navigatie gebaseerd op rol -->
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
              <!-- Kop text -->
            <h1 class="form"> Wat wilt u toevoegen? </h1>
  <!-- Knop naar gebruiker toevoegen -->
          <a href="gebruikertoevoegen.php">
            <button class="list" name="login_btn">Gebruiker toevoegen</button>
          </a>
            <!-- Knop naar afdeling toevoegen -->
          <a href="afdelingtoevoegen.php">
            <button class="list" name="login_btn">Afdeling toevoegen</button>
              <!-- Knop naar Configuratie toevoegen -->
          <a href="configuratietoevoegen.php">
            <button class="list" name="login_btn">Configuratie toevoegen</button>
          </a>
            <!-- Knop naar Hardware toevoegen -->
          <a href="hardwaretoevoegen.php">
            <button class="list" name="login_btn">Hardware toevoegen</button>
          </a>
            <!-- Knop naar Faq toevoegen -->
          <a href="faqtoevoegen.php">
            <button class="list" name="login_btn">Veel gestelde vragen toevoegen</button>
          </a>
			</div>
  </div>
</body>
</html>
