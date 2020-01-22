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
$sql = "SELECT departments.*, COUNT(user.userID) as number FROM departments
INNER JOIN user ON user.departmentID = departments.departmentID
WHERE user.userID != 57 AND user.userID != 53
GROUP BY departmentName";
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
	<div class="departments">
      <!-- Kop text -->
      <h1 class="afdeling"> Afdelingen </h1>
            <!-- Begin tabel -->
	<table class="afdelingen" name="afdelingen">
	<tr>
        <!-- Aanwijzen van kopjes -->
		<th> Afdeling<a href="departments.php?sort=departments"><i class="fas fa-sort-down"></a></th>
    <th> Locatie <a href="departments.php?sort=locatie"><i class="fas fa-sort-down"></a></th>
    <th> Aantal Medewerkers <a href="departments.php?sort=number"><i class="fas fa-sort-down"></a></th>
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
      /*als $row["number"] = leeg laat 0 zien */
      if($row["number"] == 0 || $row["number"] == NULL){
        $mensen = "0 Medewerkers";
      }
      else{
        $mensen = $row["number"] . " " . "Medewerkers";
      }
      /* Weergeven van de data in het tabel */
	    echo "<tr><td>".$row["departmentName"]."</td>
      <td>".$location."</td>
      <td>".$mensen."</td>
      	<td><a href='departmentdetails.php?departmentID=".$row["departmentID"]."'>"."<i class='fas fa-external-link-alt'></i>"."</td>
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
