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
if($data[6] == 1 ){
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
            <h1 class="form"> Wachtwoord Veranderen </h1>
              <!-- Begin Form -->
						 <form action="../functions/modifypassword.php" method="post" class="addUser">
<!-- Input wachtwoord -->
					<label for="username"><b>Nieuwe wachtwoord</b></label><br>
          <!-- Eisen aan wachtwoord worden gecontrollerd -->
					<input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" placeholder="Vul uw nieuwe wachtwoord in" name="password" required>
          <!-- Verander knop -->
          <br><button type="submit" class="btn" name="login_btn">Veranderen</button><br>
          <!-- minimale vereisten tonen -->
		    <p class="wachtwoord"> Uw wachtwoord moet: minimaal 8 karakters lang zijn & minimaal: 1 hoofdletter, 1 kleine letter, 1 nummer en speciaal teken bevatten </p>
			</div>
		</form>
  </div>
</body>
</html>
