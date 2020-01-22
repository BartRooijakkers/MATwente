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
            <h1 class="form"> Incident Melden </h1>
            <!-- Begin Form -->
						 <form action="../functions/addincident.php" method="post" class="addUser"><br>
               <!-- Input omschrijving -->
					<label for="omschrijving"><b>Omschrijving</b></label><br>
					<input type="text" placeholder="Omschrijf het probleem" name="shortDescription" required><br>
     <!-- Input impact -->
					<label for="impact"><b>Hoeveel mensen hebben er last van?</b></label><br>
					<input type="number" placeholder="Vul aantal in" name="impact" max="9999" required><br><br>
     <!-- submit button-->
					<button type="submit" class="btn" name="login_btn">Aanmaken</button><br><br>
			</div>
		</form>
  </div>
</body>
</html>
