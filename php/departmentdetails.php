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
/* Oproepen departmentID */
$id = $_GET["departmentID"];
/* Opzetten Query */
$sql = "SELECT departments.*, COUNT(user.userID) as number FROM departments
INNER JOIN user ON user.departmentID = departments.departmentID
 WHERE user.userID != 57 AND user.userID != 53 AND departments.departmentID = $id
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
          <!-- Form start -->
        <form class="edit" action="../functions/modifydepartment.php?departmentID=<?php echo $id?>" method="post">
    <!-- Tabel start -->
	<table class="afdelingen" name="afdelingen">
	<tr>
    <!-- Aanwijzen van kopjes -->
    <th> Afdeling</th>
    <th> Locatie </th>
    <th> Aantal Medewerkers</th>
	</tr>
	<?php
 /* If statement voor het oproepen van rijen uit Database, Als het aantal rijen gelijk is of groter is dan 1 */
	if (mysqli_num_rows($result) >= 1){
  /* Als if statement = true dan roept hij de onderstaande rijen op */
	  while($row = mysqli_fetch_assoc($result)){
      /*als $row["number"] = leeg laat 0 zien */
      if($row["number"] == 0 || $row["number"] == NULL){
        $mensen = "0 Medewerkers";
      }
      else{
        $mensen = $row["number"] . " " . "Medewerkers";
      }
      /* Weergeven van de data in het tabel */
	    echo "<tr><td><textarea cols='15' rows='1' name='departmentName'>".$row["departmentName"]." </textarea></td><td>";
      if($row["location"]==1){
            echo "<div class='typeradio'><input type='radio' name='location' value='1' checked><b> Intern </b><br>
            <input type='radio' name='location' value='2'><b>Extern </b></div>";
      }elseif($row["location"]==2){
          echo "  <input type='radio' name='location' value='1'><b> Intern  </b><br>
          <input type='radio' name='location' value='2' checked><b>Extern </b>";
      }
echo"</td>
      <td>".$mensen."</td>
			 </tr>";
	  }
	}
	else{
        /* Wanneer de query mislukt toont hij: Error */
	  echo "Error";
	}
	?>
</table>
<!-- Submit knop -->
<button type="submit" class="btn" name="modify_btn">Aanpassen</button>
</form>
<!-- Terug knop, brengt je naar de vorige pagina -->
<a href="javascript:history.back()">
<button class="backbtn1" name="delete_btn">Terug</button>
</a>
<!-- Delete knop, Verwijdert department -->
<a href="../functions/deletedepartment.php?departmentID=<?php echo $id?>">
<button class="deletebtn1" name="delete_btn">Verwijder Afdeling</button>
</a>
</div>
	</body>
</html>
