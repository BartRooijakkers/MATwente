<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
$sql = "SELECT user.userID, departments.departmentName, user.initials, user.surname, user.middleName, user.sex, user.interncell, user.email FROM user INNER JOIN departments ON user.departmentID = departments.departmentID";

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
	<table class="incidenten" name="incidenten">
	<tr>


	  <th> Initialen</th>
		<th> Tussenvoegsel</th>
		<th> Achternaam </th>
	  <th> Afdeling </th>
		<th> E-mail </th>
		<th> Intern Tel.nr</th>
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
			<td><a href='gebruikerdetails.php?id=".$row["userID"]."'>"."<img class= 'open' src=../open.png>"."</td>
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
