<?php
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

$geslacht = " TEST "
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
	<table class="incidentenDetails" name="incidentenDetails">
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
      echo "<tr><td>".$row["initials"]."</td>
      <td>".$row["middleName"]."</td>
      <td>".$row["surname"]."</td>
      <td>".$row["departmentName"]."</td>
      <td>".$row["interncell"]."</td>
      <td>".$geslacht."</td>
      <td>".$row["email"]."</td>
      </tr>";
    }
  }
  else{
    echo "Error";
  }
  ?>




</table>
<a href="gebruikers.php"> <img class= 'return' src=../return.png> </a>
</div>




	</body>
</html>
