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
/* Oproepen configurationID */
$id = $_GET["configurationID"];
/* Query definiëren */
$sql = "SELECT configuration.configurationName, hardware.model, hardware.type, hardware.brand FROM configuration INNER JOIN config2hardware ON configuration.configurationID = config2hardware.configurationID INNER JOIN hardware ON config2hardware.hardwareID = hardware.hardwareID WHERE configuration.configurationID = $id ";
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
          <h1> Configuratie details </h1>
    <!-- Tabel start -->
	<table class="configuratieDetails" name="configuratieDetails">
	<tr>
<!-- Aanwijzen van kopjes -->
	  <th> Configuratie </th>
		<th> Hardware type</th>
		<th> Hardware Merk </th>
    <th> Hardware model </th>
	</tr>
  <?php
  /* If statement voor het oproepen van rijen uit Database, Als het aantal rijen gelijk is of groter is dan 1 */
  if (mysqli_num_rows($result) >= 1){
    /* Als if statement = true dan roept hij de onderstaande rijen op */
    while($row = mysqli_fetch_assoc($result)){
        /* Weergeven van de data in het tabel */
      echo "<tr><td>".$row["configurationName"]."</td>
      <td>".$row["type"]."</td>
      <td>".$row["brand"]."</td>
      <td>".$row["model"]."</td>
    </td></tr>";
    }
  }
  else{
    /* Wanneer de query mislukt toont hij: Error */
    echo "Error";
  }
  ?>
</table>
<!-- Terug knop, brengt je naar de vorige pagina -->
<a href="javascript:history.back()">
<button class="backbtn" name="delete_btn">Terug</button>
</a>
</div>
	</body>
</html>
