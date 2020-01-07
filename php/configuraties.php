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
$sql = "SELECT configuration.configurationID, user.userID, user.initials, user.surname, departments.departmentName, configuration.configurationName, departments.location FROM user INNER JOIN departments ON user.departmentID = departments.departmentID INNER JOIN user2configuration ON user2configuration.userID = user.userID INNER JOIN configuration ON user2configuration.configurationID = configuration.configurationID";

if ($_GET['sort'] == 'configuratie')
{
    $sql .= " ORDER BY configuration.configurationID";
}
elseif ($_GET['sort'] == 'departments')
{
    $sql .= " ORDER BY departments.departmentName";
}
elseif ($_GET['sort'] == 'gebruiker')
{
    $sql .= " ORDER BY user.surname";
}
elseif ($_GET['sort'] == 'locatie')
{
    $sql .= " ORDER BY departments.location";
}

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


	  <th> Configuratie<a href="configuraties.php?sort=configuratie"><i class="fas fa-sort"></a></th>
		<th> Afdeling<a href="configuraties.php?sort=departments"><i class="fas fa-sort"></a></th>
    <th> Gebruiker <a href="configuraties.php?sort=gebruiker"><i class="fas fa-sort"></a></th>
    <th> Locatie <a href="configuraties.php?sort=locatie"><i class="fas fa-sort"></a></th>
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
	    echo "<tr><td>".$row["configurationName"]."</td>
      <td>".$row["departmentName"]."</td>
      <td><a class='gebruikers' href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>".$location."</td>
      <td><a href='configuratiedetails.php?configurationID=".$row["configurationID"]."'>"."<i class='fas fa-external-link-alt 1'></i>"."</td>
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
