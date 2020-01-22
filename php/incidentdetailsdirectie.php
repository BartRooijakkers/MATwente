<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];
$id = $_GET["incidentID"];
if($data[6] != 3){
  header("location:profiel.php");
}
/* Connectie maken met de database */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
$sql = "SELECT status.statusName, status.statusID, incident.description, incident.impact,
incident.time, responsible.responsibleName, responsible.responsibleID, incident.cause,
incident.solution, incident.feedback, incident.comment, DAYNAME(incident.date),
MONTHNAME(incident.date), DAY(incident.date), user.userID,
 user.initials, user.middleName, user.surname, departments.departmentName, incident.type,
 departments.location, status.statusName, status.statusImpact, status.urgency, MONTHNAME(incident.finishDate), DAY(incident.finishDate), DAYNAME(incident.finishDate)
FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID
INNER JOIN user ON user2incident.userID = user.userID
INNER JOIN departments ON user.departmentID = departments.departmentID
INNER JOIN responsible ON incident.responsibleID = responsible.responsibleID
INNER JOIN status ON incident.statusID = status.statusID WHERE incident.incidentID = $id";
$result = mysqli_query($conn,$sql);
?>

<!doctype html>
<html lang="nl">
<?php include('../include/header.php');?>
<body>
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
          <h1> Incident details </h1>
	<table class="incidentenDetails" name="incidentenDetails">
	<tr>
	  <th> Impact </th>
    <th> Status </th>
		<th> Omschrijving</th>
		<th> Oorzaak </th>
		<th> Oplossing</th>
    <th> Feedback </th>
  </tr>
  <?php
  /* Opening if statement voor laten zien data in tabel */
  if (mysqli_num_rows($result) == 1){
/* Begin van loop voor het weergeven van data in tabel */
    while($row = mysqli_fetch_assoc($result)){
  //Als field feedback leeg is dan toont hij: N.V.//
  if (is_null($row['feedback'])){
     $feedback = "N.V.T";
   }else{
     $feedback = $row["feedback"];
    }
    //Als field cause leeg is dan toont hij: N.V.//
    if (is_null($row['cause'])){
       $cause = "N.V.T";
     }else{
      $cause = $row["cause"];
      }
      //Als field solution leeg is dan toont hij: N.V.//
      if (is_null($row['solution'])){
         $solution = "N.V.T";
       }else{
        $solution = $row["solution"];
        }
        //Als field Description leeg is dan toont hij: N.V.//
        if (is_null($row['description'])){
           $description = "N.V.T";
         }else{
          $description = $row["description"];
          }
          /* Finish datum omzetten */
          /* Het vertalen van dagen uit de database van Engels naar Nederlands */
            $finishday = "";
            if ($row["DAYNAME(incident.finishDate)"] == "Monday"){
              $finishday = "Maandag";
            }
            elseif ($row["DAYNAME(incident.finishDate)"] == "Tuesday") {
              $finishday = "Dinsdag";
            } elseif ($row["DAYNAME(incident.finishDate)"] == "Wednesday") {
                $finishday = "Woensdag";
            } elseif ($row["DAYNAME(incident.finishDate)"] == "Thursday") {
                $finishday = "Donderdag";
            } elseif($row["DAYNAME(incident.finishDate)"] == "Friday") {
                $finishday = "Vrijdag";
            } elseif ($row["DAYNAME(incident.finishDate)"] == "Saturday") {
                $finishday = "Zaterdag";
            } elseif($row["DAYNAME(incident.finishDate)"] == "Sunday") {
                $finishday = "Zondag";
              }
          /* Als datum leeg is, dus het incident nog niet is afgehandeld weergeeft hij niets*/
          if (is_null($row["DAY(incident.finishDate)"] && is_null($row["MONTHNAME(incident.finishDate)"]))){
             $finishDate = " ";
           }else{
             $finishDate = $finishday. " ". $row["DAY(incident.finishDate)"] . " ". $row["MONTHNAME(incident.finishDate)"];
            }
/* Als het meer dan 1 personen betreft is het Personen, als het 1 iemand betreft is het persoon */
      $personen = "personen";
      if ($row["impact"] == 1) {
      $personen = " persoon ";
    } else {
      $personen = " personen ";
};

/* Tijdsberekening, Omzetten van minuten naar Uren */
$time =  $row["time"] / 60;
//status oproepen
$status = $row["statusName"];
//responsible oproepen
$responsible = $row["responsibleName"];
    /* Start datum omzetten */
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
  /* Type omzetten van integer naar string */
  if($row["type"] == 1){
    $type = "Software";
  }
  elseif($row["type"] == 2){
    $type = "Hardware";
  }
  elseif($row["type"] == 3){
    $type = "Nog toe te wijzen";
  }
  /* Weergeven van data uit de database */
      echo "<tr><td>".$row["impact"].$personen."</td>
      <td>".$status."</td>
      <td>".$description."</td>
      <td>".$cause."</td>
      <td>".$solution."</td>
      <td>".$feedback."</td>
      <tr><th> Tijd (uren)</th>
      <th> Verantwoordelijk</th>
      <th> Incidentmelder </th>
      	 <th> Type incident</th>
         <th> Meld datum </th>
         <th> Afrond datum </th>
      	</tr>
      <tr><td>".round($time, 2)." Uren"."</td>
      <td>".$responsible."</td>
      <td><a class='gebruikers' href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>".$type."</td>
      <td>".$day." ".$row["DAY(incident.date)"]." ".$row["MONTHNAME(incident.date)"]."</td>
      <td>".$finishDate."</td>
      </tr>";

      if (is_null($row['comment'])){
         echo" ";
       }else{
         echo"<tr> <th>Commentaar van melder</th></tr> <tr> <td>".$row['comment']."</td></tr>";
        }
    }
  }
  else{
    echo "Error";
  }
  ?>



</table>
<a href="javascript:history.back()">
<button class="backbtn" name="delete_btn">Terug</button>
</a>
</div>
</form>



	</body>
</html>
