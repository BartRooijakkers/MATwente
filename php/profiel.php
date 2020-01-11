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
    else{
      include('../include/navigatie.php');
    }
    ?>
			<div class="gegevens">
				<p class="PG">Persoonlijke gegevens: </p>


		<?php

			echo "<td>"."<p class='profielfields'>Voorletter: </p>".$data[0]."</td>
			<td><br>"."<p class='profielfields'>Tussenvoegsel: </p>".$data[1]."</td>
			<td><br>"."<p class='profielfields'>Achternaam: </p>".$data[2]."</td>
      <td><br>"."<p class='profielfields'>Afdeling: </p>".$data[5]."</td>
			<td><br>"."<p class='profielfields'>Email: </p>".$data[3]."</td>
			<td><br>"."<p class='profielfields'>intern telefoon nummer: </p>".$data[4]."</td>";


		?>
				</p>
			</div>


		</body>
	</html>
