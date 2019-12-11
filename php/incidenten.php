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
$sql = "SELECT incident.impact, incident.incidentID, incident.shortDescription, incident.cause, incident.solution, incident.feedback, status.urgency, status.statusName, user.initials, user.surname, incident.time, departments.departmentName FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN user ON user2incident.userID = user.userID INNER JOIN status ON incident.statusID = status.statusID INNER JOIN departments ON user.departmentID = departments.departmentID ORDER BY status.urgency ASC";

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


	  <th> Urgentie </th>
		<th> Korte Omschrijving</th>
		<th> Oorzaak </th>
		<th> Oplossing</th>
		<th> Tijd (uren)</th>
		<th> Afdeling </th>
	 <th> Melder </th>
		<th> Openen </th>



	</tr>
	<?php

  if (mysqli_num_rows($result) > 1){

        while($row = mysqli_fetch_assoc($result)){
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

              $time =  $row["time"] / 60;

        echo"<td>".$row["shortDescription"]."</td>
	           <td>".$row["cause"]."</td>
	           <td>".$row["solution"]."</td>
			       <td>".round($time, 2)."</td>
			       <td>".$row["departmentName"]."</td>
      			 <td>".$row["initials"].", ".$row["surname"]."</td>
      			 <td><a href='incidentdetails.php?incidentID=".$row["incidentID"]."'>"."<img class= 'open' src=../img/open.png>"."</td>
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
