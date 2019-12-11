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
$sql = "SELECT user.userID, departments.departmentName, departments.location, user.initials, user.surname, user.middleName, user.sex, user.interncell, user.email FROM user INNER JOIN departments ON user.departmentID = departments.departmentID";

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
      <h1> Configuraties </h1>
	<table class="gebruikers" name="gebruikers">
	<tr>


	  <th> Afdeling</th>
		<th> Gebruiker</th>
    <th> Locatie </th>
    <th> Coniguratie </th>
		<th> Openen </th>



	</tr>
	<?php

	if (mysqli_num_rows($result) > 1){


	  while($row = mysqli_fetch_assoc($result)){
      /* Controleren of department Intern of extern is */
      if ($row["location"] == 1){
        $location = "Intern";

      }
      else{
        $location = "Extern";
      }
      /* Weergeven van de data in het tabel */
	    echo "<tr><td>".$row["departmentName"]."</td>
      <td><a href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>".$location."</td>
      <td>".$row["configuration"]."</td>
			 </tr>";
	  }
	}
	else{
	  echo "Error";
	}
	?>


</table>
</div>



	</body>
</html>
