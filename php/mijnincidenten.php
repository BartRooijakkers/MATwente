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
/* Roept userID op */
$userID = $data[6];
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
$sql = "SELECT status.urgency, incident.shortDescription, incident.feedback, incident.cause, responsible.responsibleName,
 DAYNAME(incident.date), MONTHNAME(incident.date), DAY(incident.date), incident.comment, incident.incidentID FROM incident INNER JOIN status ON status.statusID = incident.statusID
 INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN responsible ON responsible.responsibleID = incident.responsibleID
 WHERE user2incident.userID  = $data[7]";
/* sorteren op: */
if ($_GET['sort'] == 'urgency')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY status.urgency ASC";
}
elseif ($_GET['sort'] == 'responsible')
{/* Toevoeging aan query wanneer hij sorteren moet */
    $sql .= " ORDER BY responsible.responsibleName DESC";
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
        <h1> Mijn incidenten </h1>
        <?php if(mysqli_num_rows($result) == 0){
          echo "";
        }
        else{ echo"
	<table class='incidenten' name='incidenten'>
	<tr>
	  <th> Urgentie <a href='mijnincidenten.php?sort=urgency'><i class='fas fa-sort-down'></a></th>
		<th> Korte Omschrijving</th>
		<th> Feedback</th>
    <th> Verantwoordelijke <a href='mijnincidenten.php?sort=responsible'><i class='fas fa-sort-down'></a></th>
	 <th> Datum <a href='mijnincidenten.php?sort=date'><i class='fas fa-sort-down'></a></th>
   <th> Opmerking</th>
	</tr>";
}
  ?>
	<?php
  /* If statement voor het oproepen van rijen uit Database, Als het aantal rijen gelijk is of groter is dan 1 */
  if (mysqli_num_rows($result) >= 1){
  /* Als if statement = true dan roept hij de onderstaande rijen op */
        while($row = mysqli_fetch_assoc($result)){
/* incidentID definiëren */
          $incidentID = $row['incidentID'];
/* Als onderstaande velden leeg zijn, Toon: N.V.T */
          if (is_null($row['feedback'])){
	           $feedback = "N.V.T";
           }else{
	           $feedback = $row["feedback"];
            }
            if (is_null($row['comment']) || empty($row['comment'])){
  	           $comment = NULL;
             }else{
  	           $comment = $row["comment"];
              }
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
	           <td>".$feedback."</td>
              <td>".$row["responsibleName"]."</td>
              <td>".$day." ".$row["DAY(incident.date)"]." ".$row["MONTHNAME(incident.date)"]."</td>

              <td><form class='comment' action='../functions/comment.php?incidentID= $incidentID' method='post'>
              <textarea cols=38 rows='3' name='comment'>".$comment." </textarea>
              <button class='commentbtn' name='modify_btn'> Submit </button>
              </form></td>
      			 </tr>";
	  }
	}
	else{
    /* Toon melding wanneer er geem meldingen gemaakt zijn */
	  echo "<h1 class='meldingerror'> U heeft geen gemelde incidenten. </p>";
	}
	?>
</table>
</div>
</body>
</html>
