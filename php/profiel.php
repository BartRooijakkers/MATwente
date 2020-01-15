<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}


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
    elseif($data[6] == 1){
      include('../include/navigatie.php');
    }
    ?>
			<div class="login">
				<p class="PG">Persoonlijke gegevens: </p>


		<?php

			echo "<td>"."<p class='profielfields'>Voorletter: </p>"."<p class='persooninfo'>".$data[0]."</p>"."</td>
			<td>"."<p class='profielfields'>Tussenvoegsel: </p>"."<p class='persooninfo'>".$data[1]."</p>"."</td>
			<td>"."<p class='profielfields'>Achternaam: </p>"."<p class='persooninfo'>".$data[2]."</p>"."</td>
      <td>"."<p class='profielfields'>Afdeling: </p>"."<p class='persooninfo'>".$data[5]."</p>"."</td>
			<td>"."<p class='profielfields'>Email: </p>"."<p class='persooninfo'>".$data[3]."</p>"."</td>
			<td>"."<p class='profielfields'>intern telefoon nummer: </p>"."<p class='persooninfo'>".$data[4]."</p>"."</td>";


		?>
			  <a href="wachtwoordveranderen.php"> <button class="btn">Wachtwoord Wijzigen </button> </a><br>
        <a href="sessionend.php"> <button class="btn">   Uitloggen  </button> </a>
			</div>


		</body>
	</html>
