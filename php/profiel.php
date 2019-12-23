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
$sql = "SELECT initials,middleName,surname,email,interncell FROM user WHERE userID =20";

$result = mysqli_query($conn,$sql);?>

<!doctype html>
<html lang="nl">
	<?php include('../include/header.php');?>
	<body>
		<div class="oudemeldingen">
			<p>Hier staan uw meldingen</p>
			<button type="submit" class="btnp" name="login_btn">details</button>
		</div>
		<div class="gegevens">
			<p class="PG">Persoonlijke gegevens: </p>

	<?php
	if (mysqli_num_rows($result) > 0){


	  while($row = mysqli_fetch_assoc($result)){
	    echo "<td>"."<p class='profielfields'>Voorletter: </p>".$row["initials"]."</td>
	    <td><br>"."<p class='profielfields'>Tussenvoegsel: </p>".$row["middleName"]."</td>
	    <td><br>"."<p class='profielfields'>Achternaam: </p>".$row["surname"]."</td>
			<td><br>"."<p class='profielfields'>Email: </p>".$row["email"]."</td>
			<td><br>"."<p class='profielfields'>intern telefoon nummer: </p>".$row["interncell"]."</td>";
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
