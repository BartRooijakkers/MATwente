<?php
 require '../include/session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}

$id = $_GET["userID"];

$sql = "SELECT user.initials, user.middleName, user.surname, user.interncell, user.sex, user.email, departments.departmentName FROM user INNER JOIN departments ON departments.departmentID = user.departmentID WHERE user.userID = $id";

$result = mysqli_query($conn,$sql);



?>

<!doctype html>
<html lang="nl">
<?php include('../include/header.php');?>
<body>
	<?php include('../include/navigatie.php');?>
<br>
<br>
<br>
	<div class=table>
          <h1> Gebruiker details </h1>
	<table class="gebruikerDetails" name="incidentenDetails">
	<tr>

	  <th> Initialen </th>
		<th> Tussenvoegsel</th>
		<th> Achternaam </th>
    <th> Afdeling </th>
		<th> Intern Telnr.</th>
    <th> Geslacht </th>
		<th> E-mail </th>



	</tr>
  <?php
  if (mysqli_num_rows($result) == 1){

    while($row = mysqli_fetch_assoc($result)){
      $name = $row["initials"]." ".$row["surname"];
        $geslacht = $row["sex"];

      echo "<tr><td>".$row["initials"]."</td>
      <td>".$row["middleName"]."</td>
      <td>".$row["surname"]."</td>
      <td>".$row["departmentName"]."</td>
      <td>".$row["interncell"]."</td>";
      echo "<td>";
          if ($geslacht == 1) {
          echo "Man";
          } elseif ($geslacht == 2) {
          echo "Vrouw";
          } elseif ($geslacht == 3) {
           echo "Anders";
    }"</td>";

    echo"<td>".$row["email"]."</td>
      </tr>";
    }
  }
  else{
    echo "Error";
  }
  ?>




</table>

<a href="gebruikers.php"> <img class= 'return' src=../img/return.png> </a>
</div>




	</body>
</html>
