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
/* Query definiëren */
$sql = "SELECT userID,initials, surname FROM user";
/* Query opzetten */
$result = mysqli_query($conn,$sql);
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
<br><div class="container">
					<div class="login">
            <!-- Kop text -->
              <h1 class="form"> Configuratie toevoegen </h1>
              <!-- Begin form -->
						 <form action="../functions/addconfig.php" method="post" name="config">
				<br>
					<label for="username"><b>Gebruiker</b></label><br>
          <!-- Begin selecten van gebruiker -->
          <select name='user' required>
            <option value="" selected disabled hidden>Kies een gebruiker</option>
<?php
/* If statement voor het oproepen van rijen uit Database, Als het aantal rijen groter is dan 1 */
          if (mysqli_num_rows($result) > 1){
/* Als if statement = true dan roept hij de onderstaande rijen op */
                while($row = mysqli_fetch_assoc($result)){
                  echo " <option value='".$row["userID"]."'>".$row["initials"].", ".$row['surname']."</option>
                ";
            }
          }
          else{
              /* Wanneer de query mislukt toont hij: Error */
            echo "Error";
          }
          ?>
        </select><br>
        <!-- Selecteren van type configuratie -->
          <label for="configuratie"><b>Configuratie</b></label><br>
          <input type="radio" name="config" value="1" required> <b>Standaard Werkplek</b>
          <input type="radio" name="config" value="2"><b> Mobiele Werkplek</b><br><br>
          <!-- Submit knop -->
          <button type="submit" class="btn" name="login_btn">Aanmaken</button>
          <br>
			<br>
			</div>
		</form>
		</div>
</body>
</html>
