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
/* Query definiëren */
$sql = "SELECT configuration.configurationID, user.userID, user.initials, user.surname, departments.departmentName, configuration.configurationName, departments.location
FROM user INNER JOIN departments ON user.departmentID = departments.departmentID
INNER JOIN user2configuration ON user2configuration.userID = user.userID
INNER JOIN configuration ON user2configuration.configurationID = configuration.configurationID";
/* sorteren op: */
if ($_GET['sort'] == 'configuratie')
{ /* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY configuration.configurationID";
}
elseif ($_GET['sort'] == 'departments')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY departments.departmentName";
}
elseif ($_GET['sort'] == 'gebruiker')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY user.surname";
}
elseif ($_GET['sort'] == 'locatie')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY departments.location";
}
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
      <h1> Configuraties </h1>
      <!-- Begin tabel -->
	<table class="gebruikers" name="gebruikers">
	<tr>
    <!-- Aanwijzen van kopjes -->
	  <th> Configuratie<a href="configuraties.php?sort=configuratie"><i class="fas fa-sort-down"></a></th>
		<th> Afdeling<a href="configuraties.php?sort=departments"><i class="fas fa-sort-down"></a></th>
    <th> Gebruiker <a href="configuraties.php?sort=gebruiker"><i class="fas fa-sort-down"></a></th>
    <th> Locatie <a href="configuraties.php?sort=locatie"><i class="fas fa-sort-down"></a></th>
		<th> Openen </th>
	</tr>
	<?php
/* If statement voor het oproepen van rijen uit Database, Als het aantal rijen groter is dan 1 */
	if (mysqli_num_rows($result) > 1){
  /* Als if statement = true dan roept hij de onderstaande rijen op */
	  while($row = mysqli_fetch_assoc($result)){
      /* Controleren of department Intern of extern is */
      if ($row["location"] == 1){
        $location = "Intern";
      }
      else{
        $location = "Extern";
      }
      /* Weergeven van de data in het tabel */
	    echo "<tr><td>".$row["configurationName"]."</td>
      <td>".$row["departmentName"]."</td>
      <td><a class='gebruikers' href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>".$location."</td>
      <td><a href='configuratiedetails.php?configurationID=".$row["configurationID"]."'>"."<i class='fas fa-external-link-alt 1'></i>"."</td>
			 </tr>";
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
