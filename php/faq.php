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
/* Query definiëren */
$sql = "SELECT question, answer FROM faq";
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
	<div class=table>
          <!-- Kop text -->
      <h1> Veel Gestelde Vragen </h1>
          <!-- Begin tabel -->
<table class="faq">
	<?php
 /* If statement voor het oproepen van rijen uit Database, Als het aantal rijen gelijk is of groter is dan 1 */
	if (mysqli_num_rows($result) >= 1){
  /* Als if statement = true dan roept hij de onderstaande rijen op */
	  while($row = mysqli_fetch_assoc($result)){
      /* Weergeven van de data in het tabel */
	    echo "
      	 <tr><td class='vraag'><p class='vraag'>".$row["question"]."</p></td></tr>
      <tr><td class='antwoord'><p class='antwoord'>".$row["answer"]."</p></td</tr>";
	  }
	}
	else{
     /* Wanneer de query mislukt toont hij: Error */
	  echo "Error";
	}
	?>
</table>
</div>
</body>
</html>
