<?php
/* Connectie maken met de database */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}

$id = $_GET["incidentID"];

$sql = "SELECT status.statusName, incident.description, incident.impact, incident.time, responsible.responsibleName, incident.cause, incident.solution, incident.feedback, DAYNAME(incident.date), MONTHNAME(incident.date), DAY(incident.date), user.userID, user.initials, user.middleName, user.surname, departments.departmentName,departments.location, status.statusName, status.statusImpact, status.urgency FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN user ON user2incident.userID = user.userID INNER JOIN departments ON user.departmentID = departments.departmentID INNER JOIN responsible ON incident.responsibleID = responsible.responsibleID INNER JOIN status ON incident.statusID = status.statusID WHERE incident.incidentID = $id";

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
          <h1> Incident details </h1>
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
  /* Opening if statement voor laten zien data in tabel */
  if (mysqli_num_rows($result) == 1){

/* Begin van loop voor het weergeven van data in tabel */
    while($row = mysqli_fetch_assoc($result)){
/* Als het meer dan 1 personen betreft is het Personen, als het 1 iemand betreft is het persoon */
      $personen = "personen";
      if ($row["impact"] == 1) {
      $personen = " persoon ";
    } else {
      $personen = " personen ";
};

/* Tijdsberekening, Omzetten van minuten naar Uren */
$time =  $row["time"] / 60;

/* Het vertalen van dagen uit de database van Engels naar Nederlands */
  $day = "";
  if ($row["DAYNAME(incident.date)"] == "Monday"){
    $day = "Maandag";
  }
  elseif ($row["DAYNAME(incident.date)"] == "Tuesday") {
    $day = "Dinsdag";
  } elseif ($row["DAYNAME(incident.date)"] == "Wednesday") {
      $day = "Woensdag";
  } elseif ($row["DAYNAME(incident.date)"] == "Thursday") {
      $day = "Donderdag";
  } elseif($row["DAYNAME(incident.date)"] == "Friday") {
      $day = "Vrijdag";
  } elseif ($row["DAYNAME(incident.date)"] == "Saturday") {
      $day = "Zaterdag";
  } elseif($row["DAYNAME(incident.date)"] == "Sunday") {
      $day = "Zondag";
  };

  /* Weergeven van data uit de database */
      echo "<tr><td>".$row["impact"].$personen."</td>
      <td>".$row["statusName"]."</td>
      <td>".$row["description"]."</td>
      <td>".$row["cause"]."</td>
      <td>".$row["solution"]."</td>
      <td>".$row["feedback"]."</td>
      <td>".$row["responsibleName"]."</td>
      <td>".round($time, 2)." uur"."</td>
      <td><a href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>".$row["departmentName"]."</td>
      <td>".$day." ".$row["DAY(incident.date)"]." ".$row["MONTHNAME(incident.date)"]."</td>
      </tr>";
    }
  }
  else{
    echo "Error";
  }
  ?>



</table>
<a href="javascript:history.back()"><img class= 'return' src=../img/return.png></a>
</div>



	</body>
</html>
