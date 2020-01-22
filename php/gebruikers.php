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
$sql = "SELECT user.userID, departments.departmentName, user.initials, user.surname, user.middleName, user.sex, user.interncell, user.email
FROM user INNER JOIN departments ON user.departmentID = departments.departmentID
WHERE user.userID != 57 ";
/* sorteren op: */
if ($_GET['sort'] == 'initials')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY user.initials ASC";
}
elseif ($_GET['sort'] == 'surname')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY user.surname ASC";
}
elseif ($_GET['sort'] == 'department')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY departments.departmentName ASC";
}
elseif ($_GET['sort'] == 'interncell')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY user.interncell ASC";
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
      <h1> Gebruikers </h1>
      <!-- Begin tabel -->
	<table class="gebruikers" name="gebruikers">
	<tr>
      <!-- Aanwijzen van kopjes -->
	  <th>Initialen<a href="gebruikers.php?sort=initials"><i class="fas fa-sort-down"></a></th>
		<th> Tussenvoegsel</th>
		<th> Achternaam <a href="gebruikers.php?sort=surname"><i class="fas fa-sort-down"></a></th>
	  <th> Afdeling <a href="gebruikers.php?sort=department"><i class="fas fa-sort-down"></a></th>
		<th> E-mail </th>
		<th> Intern Tel.nr<a href="gebruikers.php?sort=interncell"><i class="fas fa-sort-down"></a></th>
		<th> Openen </th>
	</tr>
	<?php
  /* If statement voor het oproepen van rijen uit Database, Als het aantal rijen groter is dan 1 */
	if (mysqli_num_rows($result) > 1){
/* Als if statement = true dan roept hij de onderstaande rijen op */
	  while($row = mysqli_fetch_assoc($result)){
      /* Data oproepen */
	    echo "<tr><td>".$row["initials"]."</td>
			<td>".$row["middleName"]."</td>
	    <td>".$row["surname"]."</td>
	    <td>".$row["departmentName"]."</td>
			<td>".$row["email"]."</td>
			<td>".$row["interncell"]."</td>";
      /* If user type = 2 dan kom je op de editbare pagina */
      if($data[6] == 2){
        echo"<td><a href='gebruikerdetailsbeheerder.php?userID=".$row["userID"]."'>"."<i class='fas fa-external-link-alt'></i>"."</td>
        </tr>";
      }
      else
      echo"
			<td><a href='gebruikerdetails.php?userID=".$row["userID"]."'>"."<i class='fas fa-external-link-alt'></i>"."</td>
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
