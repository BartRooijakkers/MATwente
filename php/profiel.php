<?php
 require '../include/session.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$user = 2; /* hier moer nog de sesion komen */


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
$sql = "SELECT initials,middleName,surname,email,interncell FROM user WHERE userID =$user";

$result = mysqli_query($conn,$sql);?>
<!doctype html>
<html lang="nl">
	<?php include('../include/header.php');?>
	<body>
		<div class="oudemelding">
			<p>Hier staan u oude meldingen</p>
			<button type="submit" class="btnp" name="login_btn">details</button>
		</div>
		<div class="gegevens">
			<p>Persoonlijke gegevens<br><br>

	<?php
	if (mysqli_num_rows($result) > 0){


	  while($row = mysqli_fetch_assoc($result)){
	    echo "<td>"."Voorletter: ".$row["initials"]."</td>
	    <td><br>"."Tussenvoegsel: ".$row["middleName"]."</td>
	    <td><br>"."Achternaam: ".$row["surname"]."</td>
			<td><br>"."Email: ".$row["email"]."</td>
			<td><br>"."intern telefoon nummer: ".$row["interncell"]."</td>";
	  }
	}
	else{
	  echo "Error";
	}
	?>
			</p>
		</div>
		<?php include('../include/navigatie.php');?>
		<button type="submit" class="uitloggen" name="uitlog_btn">uitloggen</button>

	</body>
</html>
