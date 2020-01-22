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
            <h1 class="form">Afdeling toevoegen </h1>
            <!-- Begin form -->
		<form action="../functions/adddepartment.php" method="post" class="adddepartment"><br>
					<label for="departmentName"><b>Afdeling Naam</b></label><br>
					<input type="text" placeholder="Vul de naam van de afdeling in" name="departmentName" required><br>
          <label for="location"><b>Locatie</b></label><br>
          <input type="radio" name="location" value="1" required> Intern
          <input type="radio" name="location" value="2"> Extern<br><br>
          <!-- Submit button -->
					<button type="submit" class="btn" name="login_btn">Aanmaken</button>
					<br>
			<br>
			</div>
		</form>
    <!-- Einde formulier -->
  </div>
</body>
</html>
