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

$sql = "SELECT status.statusName, status.statusID, incident.description, incident.impact, incident.time, responsible.responsibleName, responsible.responsibleID, incident.cause, incident.solution, incident.feedback, DAYNAME(incident.date), MONTHNAME(incident.date), DAY(incident.date), user.userID, user.initials, user.middleName, user.surname, departments.departmentName,departments.location, status.statusName, status.statusImpact, status.urgency FROM incident INNER JOIN user2incident ON incident.incidentID = user2incident.incidentID INNER JOIN user ON user2incident.userID = user.userID INNER JOIN departments ON user.departmentID = departments.departmentID INNER JOIN responsible ON incident.responsibleID = responsible.responsibleID INNER JOIN status ON incident.statusID = status.statusID WHERE incident.incidentID = $id";

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
            <form class="edit" action="modifyincident.php?incidentID=<?php echo $id?>" method="post">
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
      <td><select name='departmentName' value=".$row["departmentName"]." class='selectDepartment'>
              <option selected='selected' value=".$row["statusID"]."> $status </option>
              <option value='1'> Nog toe te wijzen </option>
              <option value='2'> Kunnen niet werken. orders worden gemist en/of afspraken worden niet gehaald </option>
              <option value='3'> kan niet werken </option>
              <option value='4'> kunnen niet werken met 1 programma </option>
              <option value='5'> kan niet werken met 1 programma </option>
              <option value='6'> er is een workaround aanwezig </option>
              <option value='7'> niet reproduceerbare fout </option>
              <option value='9'> Nog toe te wijzen </option>
              <option value='8'> Afgerond </option>
              <option value='11'> Foutief </option>
              </select></td>
      <td>".$row["description"]."</td>
      <td>".$row["cause"]."</td>
      <td>".$row["solution"]."</td>
      <td>".$row["feedback"]."</td></tr>

      <tr><th> Verantwoordelijke </th>
      		<th> Tijd (uren)</th>
      		<th> Incidentmelder </th>
      	 <th> Afdeling </th>
         <th> Datum </th>
         <th> Terug </th>



      	</tr>
      <tr><td><select name='departmentName' value=".$row["departmentName"]." class='selectDepartment'>";

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

                  if($row["responsibleID"]==3){
                        echo "  <option selected value='4'> Leverancier printer </option>";
                  }else{
                      echo "  <option value='4'> Leverancier printer </option>";
                  }

                  if($row["responsibleID"]==3){
                        echo "      <option selected value='5'> Nog toe te wijzen </option>";
                  }else{
                      echo "      <option value='5'> Nog toe te wijzen </option>";
                  }




echo"
                  </select></td>
      <td>".round($time, 2)." uur"."</td>
      <td><a class='gebruikers' href='gebruikerdetails.php?userID=".$row["userID"]."'>".$row["initials"].", ".$row["surname"]."</td>
      <td>".$row["departmentName"]."</td>
      <td>".$day." ".$row["DAY(incident.date)"]." ".$row["MONTHNAME(incident.date)"]."</td>
      <td><a href='javascript:history.back()'><img class= 'return' src=../img/return.png></a>
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
