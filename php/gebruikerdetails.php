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
if($data[6] != 3 ){
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
/* Oproepen userID */
$id = $_GET["userID"];
/* Query definiëren */
$sql = "SELECT user.initials, user.middleName, user.surname, user.interncell, user.sex, user.email, departments.departmentName, configuration.configurationName FROM user INNER JOIN departments ON departments.departmentID = user.departmentID INNER JOIN user2configuration ON user.userID = user2configuration.userID INNER JOIN configuration ON configuration.configurationID = user2configuration.configurationID WHERE user.userID = $id";
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
    <!-- Text kop -->
          <h1> Gebruiker details </h1>
          <!-- Start tabel -->
	<table class="gebruikerDetails" name="incidentenDetails">
	<tr>
<!-- Aanwijzen van kopjes -->
	  <th> Initialen </th>
		<th> Tussenvoegsel</th>
		<th> Achternaam </th>
    <th> Afdeling </th>
		<th> Intern Telnr.</th>
    <th> Geslacht </th>
		<th> E-mail </th>
    <th> Configuratie </th>
	</tr>
  <?php
  /* If statement voor het oproepen van rijen uit Database, Als het aantal rijen gelijk is aan 1 */
  if (mysqli_num_rows($result) == 1){
  /* Als if statement = true dan roept hij de onderstaande rijen op */
    while($row = mysqli_fetch_assoc($result)){
      /* Naam = Initalen + Achternaam */
      $name = $row["initials"]." ".$row["surname"];
      /* Geslacht definiëren */
        $geslacht = $row["sex"];
        /* Weergeven van de data in het tabel */
      echo "<tr><td>".$row["initials"]."</td>
      <td>".$row["middleName"]."</td>
      <td>".$row["surname"]."</td>
      <td>".$row["departmentName"]."</td>
      <td>".$row["interncell"]."</td>";
      /* Geslacht omzetten van integer naar string */
      echo "<td>";
          if ($geslacht == 1) {
          echo "Man";
          } elseif ($geslacht == 2) {
          echo "Vrouw";
          } elseif ($geslacht == 3) {
           echo "Anders";
    }"</td>";
/* Echo volgende rijen */
    echo"<td>".$row["email"]."</td>
      <td>".$row["configurationName"]."</td>
      </tr>";
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
