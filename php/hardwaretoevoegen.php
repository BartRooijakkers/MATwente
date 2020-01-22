<?php
/* Controlleren of sessie is aangemaakt */
if(!isset($_SESSION)){
 session_start();
}
/* Wanneer sessie niet gemaakt is wordt de gebruiker terug verwezen naar de inlogpagina*/
if(!isset($_SESSION['user'])){
header("location:index.php");
}
/* Rol van gebruiker oproepen */
$data = $_SESSION['user'];
/* Controleer rol van de gebruiker, Wanneer gebruiker niet bevoegd is wordt hij terug verwezen naar profiel.php */
if($data[6] != 2 ){
header("location:profiel.php");
}
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
              <h1 class="form"> Hardware toevoegen </h1>
              <!-- Begin Form -->
						 <form action="../functions/addhardware.php" method="post" name="hardware">
				<br>
        <!-- input Merk -->
					<label for="Merk"><b>Merk</b></label><br>
          <input type="text" name="brand" placeholder="Vul het merk van de hardware in" required><br>
  <!-- input Model -->
          <label for="Model"><b>Model</b></label><br>
          <input type="text" name="model" placeholder="Vul het model van de hardware in" required><br>
  <!-- input type -->
          <label for="Type"><b>Type</b></label><br>
          <input type="text" name="type" placeholder="Vul het type hardware in" required><br>
        </select><br>
  <!-- input configuratie-->
          <label for="configuratie"><b>Configuratie</b></label><br>
          <input type="radio" name="config" value="1" required> <b>Standaard Werkplek</b>
          <input type="radio" name="config" value="2"><b> Mobiele Werkplek</b><br><br>
  <!-- submit button -->
          <button type="submit" class="btn" name="login_btn">Aanmaken</button><br><br>
			</div>
		</form>
		</div>
</body>
</html>
