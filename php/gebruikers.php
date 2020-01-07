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
$sql = "SELECT user.userID, departments.departmentName, user.initials, user.surname, user.middleName, user.sex, user.interncell, user.email FROM user INNER JOIN departments ON user.departmentID = departments.departmentID";

if ($_GET['sort'] == 'initials')
{
    $sql .= " ORDER BY user.initials ASC";
}
elseif ($_GET['sort'] == 'surname')
{
    $sql .= " ORDER BY user.surname ASC";
}
elseif ($_GET['sort'] == 'department')
{
    $sql .= " ORDER BY departments.departmentName ASC";
}
elseif ($_GET['sort'] == 'interncell')
{
    $sql .= " ORDER BY user.interncell ASC";
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
      <h1> Gebruikers </h1>
	<table class="gebruikers" name="gebruikers">
	<tr>


	  <th>Initialen<a href="gebruikers.php?sort=initials"><i class="fas fa-sort-down"></a></th>
		<th> Tussenvoegsel</th>
		<th> Achternaam <a href="gebruikers.php?sort=surname"><i class="fas fa-sort-down"></a></th>
	  <th> Afdeling <a href="gebruikers.php?sort=department"><i class="fas fa-sort-down"></a></th>
		<th> E-mail </th>
		<th> Intern Tel.nr<a href="gebruikers.php?sort=interncell"><i class="fas fa-sort-down"></a></th>
		<th> Openen </th>



	</tr>
	<?php

	if (mysqli_num_rows($result) > 1){


	  while($row = mysqli_fetch_assoc($result)){
	    echo "<tr><td>".$row["initials"]."</td>
			<td>".$row["middleName"]."</td>
	    <td>".$row["surname"]."</td>
	    <td>".$row["departmentName"]."</td>
			<td>".$row["email"]."</td>
			<td>".$row["interncell"]."</td>
			<td><a href='gebruikerdetails.php?userID=".$row["userID"]."'>"."<i class='fas fa-external-link-alt'></i>"."</td>
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
