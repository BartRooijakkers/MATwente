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
$sql = "SELECT incident.impact, incident.incidentID, incident.shortDescription, incident.cause, incident.solution, incident.feedback, status.urgency, status.statusName, user.initials, user.surname, incident.time,  departments.departmentName, DAYNAME(incident.date), MONTHNAME(incident.date), DAY(incident.date) FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN user ON user2incident.userID = user.userID INNER JOIN status ON incident.statusID = status.statusID INNER JOIN departments ON user.departmentID = departments.departmentID";

if ($_GET['sort'] == 'urgency')
{
    $sql .= " ORDER BY status.urgency";
}
elseif ($_GET['sort'] == 'time')
{
    $sql .= " ORDER BY incident.time";
}
elseif ($_GET['sort'] == 'date')
{
    $sql .= " ORDER BY incident.date";
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
        <h1> Incidenten </h1>
	<table class="incidenten" name="incidenten">
	<tr>


	  <th> Urgentie <a href="incidenten.php?sort=urgency"><i class="fas fa-sort"></a></th>
		<th> Korte Omschrijving</th>
		<th> Oorzaak </th>
		<th> Tijd (uren)<a href="incidenten.php?sort=time"><i class="fas fa-sort"></a></th>
	 <th> Melder</th>
   <th> Datum <a href="incidenten.php?sort=date"><i class="fas fa-sort"></a></th>
		<th> Openen </th>



	</tr>
	<?php

  if (mysqli_num_rows($result) > 1){

        while($row = mysqli_fetch_assoc($result)){

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

          /* Het vertalen van urgency naar daadwerkelijke text, */
          $urgency = $row["urgency"];
          echo "<tr><td>";
              if ($urgency == 1) {
              echo "<p class='nuAfhandelen' >Nu Afhandelen</p>";
              } elseif ($urgency == 2) {
              echo "<p class='urgent'> Urgent</p>";
              } elseif ($urgency == 3) {
               echo "<p class='afhandelen'> Afhandelen</p>";
              } elseif ($urgency == 4) {
              echo "<p class='wacht'>Wacht</p>";
              } elseif ($urgency == 5) {
                echo "<p class='geen'>Geen</p>";
              }"</td>";


        /* Weergeven van data uit de database */
        echo"<td>".$row["shortDescription"]."</td>
	           <td>".$row["cause"]."</td>
			       <td>".round($time, 2)." uur"."</td>
      			 <td>".$row["initials"].", ".$row["surname"]."</td>
              <td>".$day." ".$row["DAY(incident.date)"]." ".$row["MONTHNAME(incident.date)"]."</td>
      			 <td><a href='incidentdetails.php?incidentID=".$row["incidentID"]."'>"."<i class='fas fa-external-link-alt 1'></i>"."</td>
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
