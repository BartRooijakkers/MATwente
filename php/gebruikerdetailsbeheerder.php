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
/* Oproepen userID */
$id = $_GET["userID"];
/* Query definiëren */
$sql = "SELECT user.initials, user.middleName, user.surname, user.interncell, user.sex, user.email, departments.departmentName, user.departmentID, configuration.configurationName FROM user INNER JOIN departments ON departments.departmentID = user.departmentID INNER JOIN user2configuration ON user.userID = user2configuration.userID INNER JOIN configuration ON configuration.configurationID = user2configuration.configurationID WHERE user.userID = $id";
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
                    <!-- Start form -->
            <form class="edit" action="../functions/modifyuser.php?userID=<?php echo $id?>" method="post">
                        <!-- Start tabel -->
	<table class="gebruikerDetails" name="incidentenDetails">
	<tr>
<!-- Benaming kopjes -->
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
        /* department definiëren */
        $department = $row["departmentName"];
/* Weergeven van de data in het tabel */
      echo "<tr><td>".$row["initials"]."</td>
      <td>".$row["middleName"]."</td>
      <td><input type='text' value=".$row["surname"]." name='surname'></td>
      <td><select name='departmentName' class='selectDepartment'>";
/* Select department */
      if($row["departmentID"]==2){
            echo " <option selected value='2'> CAD </option>";
      }else{
          echo " <option value='2'> CAD </option>";
      }
      if($row["departmentID"]==3){
            echo " <option selected value='3'> Directie </option>";
      }else{
          echo " <option value='3'> Directie </option>";
      }
      if($row["departmentID"]==4){
            echo " <option selected value='4'> Engineering </option>";
      }else{
          echo " <option value='4'> Engineering </option>";
      }
      if($row["departmentID"]==5){
            echo " <option selected value='5'> Financiele Administratie </option>";
      }else{
          echo " <option value='5'> Financiele Administratie </option>";
      }
      if($row["departmentID"]==6){
            echo " <option selected value='6'> HRM </option>";
      }else{
          echo " <option value='6'> HRM </option>";
      }
      if($row["departmentID"]==7){
            echo " <option selected value='7'> ICT </option>";
      }else{
          echo " <option value='7'> ICT </option>";
      }
      if($row["departmentID"]==8){
            echo " <option selected value='8'> Onderzoek </option>";
      }else{
          echo " <option value='8'> Onderzoek </option>";
      }
      if($row["departmentID"]==9){
            echo " <option selected value='9'> Planning </option>";
      }else{
          echo " <option value='9'> Planning </option>";
      }
      if($row["departmentID"]==10){
            echo " <option selected value='10'> Project Planning </option>";
      }else{
          echo " <option value='10'> Project Planning </option>";
      }
      if($row["departmentID"]==11){
            echo " <option selected value='11'> Rapportage </option>";
      }else{
          echo " <option value='11'> Rapportage </option>";
      }
      if($row["departmentID"]==12){
            echo " <option selected value='12'> Secretariaat </option>";
      }else{
          echo " <option value='12'> Secretariaat </option>";
      }
      if($row["departmentID"]==13){
            echo " <option selected value='13'> Verkoop en Marketing </option>";
      }else{
          echo " <option value='13'> Verkoop en Marketing </option>";
      }
/* resterende data oproepen */
      echo"<td><input type='text' value=".$row["interncell"]." name='interncell'></td>";
      echo "<td>";
      /* Geslacht omzetten naar string */
          if ($geslacht == 1) {
          echo "Man";
          } elseif ($geslacht == 2) {
          echo "Vrouw";
          } elseif ($geslacht == 3) {
           echo "Anders";
    }"</td>";
/* resterende data oproepen */
    echo"<td><input type='text' value=".$row["email"]." name='email'></td>
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
<!-- Submit knop -->
<button type="submit" class="btn" name="modify_btn">Aanpassen</button>
</form>
<!-- Terug knop, brengt je naar de vorige pagina -->
<a href="javascript:history.back()">
<button class="backbtn" name="delete_btn">Terug</button>
</a>
<!-- Delete knop-->
<a href="../functions/deleteuser.php?userID=<?php echo $id?>">
<button class="deletebtn" name="delete_btn">Verwijder Gebruiker</button>
</a>
</div>
</body>
</html>
