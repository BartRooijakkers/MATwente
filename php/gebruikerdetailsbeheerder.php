<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}

$id = $_GET["userID"];

$sql = "SELECT user.initials, user.middleName, user.surname, user.interncell, user.sex, user.email, departments.departmentName, configuration.configurationName FROM user INNER JOIN departments ON departments.departmentID = user.departmentID INNER JOIN user2configuration ON user.userID = user2configuration.userID INNER JOIN configuration ON configuration.configurationID = user2configuration.configurationID WHERE user.userID = $id";

$result = mysqli_query($conn,$sql);



?>

<!doctype html>
<html lang="nl">
<?php include('../include/header.php');?>
<body>
	<?php
if($data[6] == 2){
  include('../include/navigatiebeheerder.php');
}
elseif($data[6] == 3){
  include('../include/navigatiebeheerder.php');
}
else{
  include('../include/navigatie.php');
}
?>
<br>
<br>
<br>
	<div class=table>
          <h1> Gebruiker details </h1>
            <form class="edit" action="<?php$_SERVER['PHP_SELF'];?>" method="post">
	<table class="gebruikerDetails" name="incidentenDetails">
	<tr>

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
  if (mysqli_num_rows($result) == 1){

    while($row = mysqli_fetch_assoc($result)){
      $name = $row["initials"]." ".$row["surname"];
        $geslacht = $row["sex"];
        $department = $row["departmentName"];

      echo "<tr><td>".$row["initials"]."</td>
      <td>".$row["middleName"]."</td>
      <td><input type='text' value=".$row["surname"]." name='surname'></td>
      <td><select name='departmentName' value=".$row["departmentName"]." class='selectDepartment' form='edit'>
              <option selected='selected' value=".$row["departmentName"]."> $department </option>
              <option value='CAD'> CAD </option>
              <option value='Directie'> Directie </option>
              <option value='Engineering'> Engineering </option>
              <option value='Financiele Administratie'> Financiele Administratie </option>
              <option value='HRM'> HRM </option>
              <option value='ICT'> ICT </option>
              <option value='Onderzoek'> Onderzoek </option>
              <option value='Planning'> Planning </option>
              <option value='Project planning'> Project Planning </option>
              <option value='Rapportage'> Rapportage </option>
              <option value='Secretariaat'> Secretariaat </option>
              <option value='Verkoop en Marketing'> Verkoop en Marketing </option>
              </select></td>
      <td><input type='text' value=".$row["interncell"]." name='interncell'></td>";
      echo "<td>";
          if ($geslacht == 1) {
          echo "Man";
          } elseif ($geslacht == 2) {
          echo "Vrouw";
          } elseif ($geslacht == 3) {
           echo "Anders";
    }"</td>";

    echo"<td>".$row["email"]."</td>
      <td>".$row["configurationName"]."</td>
      </tr>";
    }
  }
  else{
    echo "Error";
  }
  ?>




</table>
</form>
<a href="javascript:history.back()"><img class= 'return' src=../img/return.png></a>
</div>







	</body>
</html>
