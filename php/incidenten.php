<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
$sql = "SELECT incident.incidentID, incident.shortDescription, incident.cause, incident.solution, incident.feedback, status.statusID, status.statusName, user.initials, user.surname, incident.time, departments.departmentName FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN user ON user2incident.userID = user.userID INNER JOIN status ON incident.statusID = status.statusID INNER JOIN departments ON user.departmentID = departments.departmentID";

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


	  <th> status</th>
		<th> Korte Omschrijving</th>
		<th> Oorzaak </th>
		<th> Oplossing</th>
		<th> Tijd </th>
		<th> Afdeling </th>
	 <th> Melder </th>
		<th> Openen </th>



	</tr>
	<?php

	if (mysqli_num_rows($result) > 1){


	  while($row = mysqli_fetch_assoc($result)){
	    echo "<tr><td>".$row["statusName"]."</td>
			<td>".$row["shortDescription"]."</td>
	    <td>".$row["cause"]."</td>
	    <td>".$row["solution"]."</td>
			<td>".$row["time"]."</td>
			<td>".$row["departmentName"]."</td>
			<td>".$row["initials"].", ".$row["surname"]."</td>
			<td><a href='incidentdetails.php?id=".$row["incidentID"]."'>"."<img class= 'open' src=../open.png>"."</td>
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
