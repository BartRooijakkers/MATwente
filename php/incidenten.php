<?php
/* Controlleren of sessie is aangemaakt */
if(!isset($_SESSION)){
 session_start();
}
/* Wanneer sessie niet gemaakt is wordt de gebruiker terug verwezen naar de inlogpagina*/
if(!isset($_SESSION['user'])){
header("location:index.php");
}
/* Rol van gebruiker oproepen */
$data = $_SESSION['user'];
/* Controleer rol van de gebruiker, Wanneer gebruiker niet bevoegd is wordt hij terug verwezen naar profiel.php */
if($data[6] == 1 ){
header("location:profiel.php");
}
/* variablen database connectie definiëren */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";
/* Connectie maken met de database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Als connectie is gefaald toon error */
if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
/* Query definiëren */
$sql = "SELECT incident.impact, incident.incidentID, incident.shortDescription, incident.cause, incident.solution, incident.feedback, status.urgency, status.statusName, user.initials, user.surname, incident.time,  departments.departmentName, DAYNAME(incident.date), MONTHNAME(incident.date), DAY(incident.date) FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN user ON user2incident.userID = user.userID INNER JOIN status ON incident.statusID = status.statusID INNER JOIN departments ON user.departmentID = departments.departmentID";
/* sorteren op: */
if ($_GET['sort'] == 'urgency')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY status.urgency ASC";
}
elseif ($_GET['sort'] == 'time')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY incident.time DESC";
}
elseif ($_GET['sort'] == 'date')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY incident.date DESC";
}
/* Query opzetten */
$result = mysqli_query($conn,$sql);
?>
<!doctype html>
<html lang="nl">
<!-- Het includen van de header -->
	<?php include('../include/header.php');?>
<body>
  <!-- Het includen van de navigatie gebaseerd op rol -->
	<?php
if($data[6] == 2){
  include('../include/navigatiebeheerder.php');
}
elseif($data[6] == 3){
  include('../include/navigatiedirectie.php');
}
else{
  include('../include/navigatie.php');
}
?>
	<div class=table>
    <!-- Kop text -->
        <h1> Incidenten </h1>
        <!-- Begin tabel -->
	<table class="gebruikers" name="incidenten">
	<tr>
    <!-- Aanwijzen van kopjes -->
	  <th> Urgentie <a href="incidenten.php?sort=urgency"><i class="fas fa-sort-down"></a></th>
		<th> Korte Omschrijving</th>
		<th> Oorzaak </th>
		<th> Tijd (uren)<a href="incidenten.php?sort=time"><i class="fas fa-sort-down"></a></th>
	 <th> Melder</th>
   <th> Datum <a href="incidenten.php?sort=date"><i class="fas fa-sort-down"></a></th>
		<th> Openen </th>
	</tr>
	<?php
/* If statement voor het oproepen van rijen uit Database, Als het aantal rijen groter is dan 1 */
  if (mysqli_num_rows($result) > 1){
  /* Als if statement = true dan roept hij de onderstaande rijen op */
        while($row = mysqli_fetch_assoc($result)){
/* Als onderstaande velden leeg zijn, Toon: N.V.T */
          if (is_null($row['feedback'])){
             $feedback = "N.V.T";
           }else{
             $feedback = $row["feedback"];
            }
            if (is_null($row['cause'])){
               $cause = "N.V.T";
             }else{
              $cause = $row["cause"];
              }
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
                echo "<p class='geen'>Afgehandeld</p>";
              }elseif ($urgency == 6) {
                echo "<p class='nttw'>Nog toe te wijzen</p>";
              }elseif ($urgency == 7) {
                echo "<p class='fout'>Foutief</p>";
              }"</td>";
        /* Weergeven van data uit de database */
        echo"<td>".$row["shortDescription"]."</td>
	           <td>".$cause."</td>
			       <td>".round($time, 2)." uur"."</td>
      			 <td>".$row["initials"].", ".$row["surname"]."</td>
              <td>".$day." ".$row["DAY(incident.date)"]." ".$row["MONTHNAME(incident.date)"]."</td>
      			 <td>";
             if($data[6] == 2){
            echo"   <a href='incidentdetails.php?incidentID=".$row["incidentID"]."'>"."<i class='fas fa-external-link-alt 1'></i>"."</td>
      			 </tr>";
           }
           elseif($data[6] == 3){
             echo"   <a href='incidentdetailsdirectie.php?incidentID=".$row["incidentID"]."'>"."<i class='fas fa-external-link-alt 1'></i>"."</td>
       			 </tr> ";
           }
	  }
	}
	else{
        /* Wanneer de query mislukt toont hij: Error */
	  echo "Error, Geen incidenten aangetroffen";
	}
	?>
</table>
</div>
</body>
</html>
