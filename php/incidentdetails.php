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

$id = $_GET["incidentID"];

$sql = "SELECT status.statusName, incident.description, incident.impact, incident.time, responsible.responsibleName, incident.cause, incident.solution, incident.feedback, incident.date, user.userID, user.initials, user.middleName, user.surname, departments.departmentName,departments.location, status.statusName, status.statusImpact, status.urgency FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN user ON user2incident.userID = user.userID INNER JOIN departments ON user.departmentID = departments.departmentID INNER JOIN responsible ON incident.responsibleID = responsible.responsibleID INNER JOIN status ON incident.statusID = status.statusID WHERE incident.incidentID = $id";

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
	<table class="incidentenDetails" name="incidentenDetails">
	<tr>

	  <th> Impact </th>
    <th> Status </th>
		<th> Omschrijving</th>
		<th> Oorzaak </th>
		<th> Oplossing</th>
    <th> Feedback </th>
    <th> Verantwoordelijke </th>
		<th> Tijd (uren)</th>
		<th> Incidentmelder </th>
	 <th> Afdeling </th>
   <th> Datum </th>



	</tr>
  <?php
  if (mysqli_num_rows($result) == 1){


    while($row = mysqli_fetch_assoc($result)){
      $personen = "personen";
      if ($row["impact"] == 1) {
      $personen = " persoon ";
    } else {
      $personen = " personen ";
};

      echo "<tr><td>".$row["impact"].$personen."</td>
      <td>".$row["statusName"]."</td>
      <td>".$row["description"]."</td>
      <td>".$row["cause"]."</td>
      <td>".$row["solution"]."</td>
      <td>".$row["feedback"]."</td>
      <td>".$row["responsibleName"]."</td>
      <td>".$row["time"]."</td>
      <td><a href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>".$row["departmentName"]."</td>
      <td>".$row["date"]."</td>
      </tr>";
    }
  }
  else{
    echo "Error";
  }
  ?>



</table>
<a href="incidenten.php"> <img class= 'return' src=../img/return.png> </a>
</div>



	</body>
</html>
