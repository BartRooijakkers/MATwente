<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];
if($data[6] != 2 ){
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
$id = $_GET["incidentID"];
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
            <form class="edit" action="../functions/modifyincident.php?incidentID=<?php echo $id?>" method="post">
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
  /* Weergeven van data uit de database */
      echo "<tr><td>".$row["impact"].$personen."</td>
      <td><select name='statusID' class='selectstatus'>";
                  if($row["statusID"]==1){
                        echo " <option selected value='1'> Niemand kan nog werken </option>";
                  }else{
                      echo " <option value='1'> Niemand kan nog werken </option>";
                  }
                  if($row["statusID"]==2){
                        echo " <option selected value='2'> Kunnen niet werken. orders worden gemist </option>";
                  }else{
                      echo "  <option value='2'> Kunnen niet werken. orders worden gemist </option>";
                  }
                  if($row["statusID"]==3){
                        echo " <option selected value='3'> kan niet werken </option>";
                  }else{
                      echo " <option value='3'> kan niet werken </option>";
                  }
                  if($row["statusID"]==4){
                        echo " <option selected value='4'> kunnen niet werken met 1 programma </option>";
                  }else{
                      echo "  <option value='4'> kunnen niet werken met 1 programma </option>";
                  }
                  if($row["statusID"]==5){
                        echo "   <option selected value='5'> kan niet werken met 1 programma </option>";
                  }else{
                      echo "     <option value='5'> kan niet werken met 1 programma </option>";
                  }
                  if($row["statusID"]==6){
                        echo "     <option selected value='6'> er is een workaround aanwezig </option>";
                  }else{
                      echo "       <option value='6'> er is een workaround aanwezig </option>";
                  }
                  if($row["statusID"]==7){
                        echo "     <option selected value='7'> niet reproduceerbare fout </option>";
                  }else{
                      echo "           <option value='7'> niet reproduceerbare fout </option>";
                  }
                  if($row["statusID"]==9){
                        echo "     <option selected value='9'> Nog toe te wijzen </option>";
                  }else{
                      echo "           <option value='9'> Nog toe te wijzen </option>";
                  }
                  if($row["statusID"]==8){
                        echo "     <option selected value='8'> Afgerond </option>";
                  }else{
                      echo "           <option value='8'> Afgerond </option>";
                  }
                  if($row["statusID"]==11){
                        echo "     <option selected value='11'> Foutief </option>";
                  }else{
                      echo "           <option value='11'> Foutief </option>";
                  }
echo"
      <td><textarea cols='40' rows='5' name='description'>".$description." </textarea></td>
      <td><textarea cols='20' rows='5' name='cause'>".$cause." </textarea></td>
      <td><textarea cols='25' rows='5' name='solution'>".$solution." </textarea></td>
      <td><textarea cols='25' rows='5' name='feedback'>".$feedback." </textarea></td>
      <tr>      <th> Tijd (uren)</th>
      <th> Verantwoordelijk</th>
      <th> Incidentmelder </th>
      	 <th> Type incident</th>
         <th> Meld datum </th>
         <th> Afrond datum </th>
      	</tr>
      <tr>    <td><input type='number' step='0.1'max='999' value=".round($time, 2)." name='time'</td>
      <td><select name='responsibleID' class='selectDepartment'>";
                  if($row["responsibleID"]==1){
                        echo "  <option selected='selected' value='1'> MaTW - ICT Afdeling </option>";
                  }else{
                      echo "  <option value='1'> MaTW - ICT Afdeling </option>";
                  }
                  if($row["responsibleID"]==2){
                        echo "  <option selected value='2'> Hosting Provider </option>";
                  }else{
                      echo "  <option value='2'> Hosting Provider </option>";
                  }
                  if($row["responsibleID"]==3){
                        echo "  <option selected value='3'> MaLoZ - ICT Afdeling </option>";
                  }else{
                      echo "  <option value='3'> MaLoZ - ICT Afdeling </option>";
                  }
                  if($row["responsibleID"]==4){
                        echo "  <option selected value='4'> Leverancier printer </option>";
                  }else{
                      echo "  <option value='4'> Leverancier printer </option>";
                  }
                  if($row["responsibleID"]==5){
                        echo "      <option selected value='5'> Nog toe te wijzen </option>";
                  }else{
                      echo "      <option value='5'> Nog toe te wijzen </option>";
                  }

echo"
                  </select></td>

      <td><a class='gebruikers' href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>";
      if($row["type"]==3){
            echo "<div class='typeradio'><input type='radio' name='type' value='1'><b> Software </b><br>
            <input type='radio' name='type' value='2'><b>Hardware </b></div>";
      }elseif($row["type"]==2){
          echo "  <input type='radio' name='type' value='1'><b> Software  </b><br>
          <input type='radio' name='type' value='2' checked><b>Hardware </b>";
      }
      elseif($row["type"] == 1){
        echo"<div class='typeradio'>
        <input type='radio' name='type' value='1' checked><b> Software </b><br>
        <input type='radio' name='type' value='2'><b> Hardware </b></div>";
      }
      echo"</td>
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
<button type="submit" class="btn" name="modify_btn">Aanpassen</button>
<a href="javascript:history.back()">
<button class="backbtn" name="delete_btn">Terug</button>
</a>
</div>
</form>



	</body>
</html>
