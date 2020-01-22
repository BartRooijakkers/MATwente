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
}?>
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
            <!-- Text kop -->
              <h1 class="form"> Veel gestelde vraag toevoegen </h1>
              <!-- Start form -->
						 <form action="../functions/addfaq.php" method="post" name="hardware">
               <!-- Invoeg Vraag -->
					<label for="Vraag"><b>Vraag</b></label><br>
          <textarea cols="40" rows="5" name="question" placeholder="Vul hier de vraag in"></textarea><br>
          <!-- Invoer antwoord -->
          <label for="Antwoord"><b>Antwoord</b></label><br>
          <textarea cols="40" rows="5" name="answer" placeholder="Vul hier het antwoord in"></textarea>
<!-- Submit button -->
          <button type="submit" class="btn" name="login_btn">Aanmaken</button><br><br>
			</div>
		</form>
		</div>
</body>
</html>
