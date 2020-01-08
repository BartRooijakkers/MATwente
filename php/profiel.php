<?php
 if(!isset($_SESSION)){
	session_start();
 }
$data = $_SESSION['user'];
 ?>
	<!doctype html>
	<html lang="nl">
	<?php include('../include/header.php');?>
		<body>
		<?php include('../include/navigatie.php');?>
			<div class="oudemeldingen">
				<p>Hier staan uw meldingen</p>
				<button type="submit" class="btnp" name="login_btn">details</button>
			</div>
			<div class="gegevens">
				<p class="PG">Persoonlijke gegevens: </p>

		<?php

			echo "<td>"."<p class='profielfields'>Voorletter: </p>".$data[0]."</td>
			<td><br>"."<p class='profielfields'>Tussenvoegsel: </p>".$data[1]."</td>
			<td><br>"."<p class='profielfields'>Achternaam: </p>".$data[2]."</td>
				<td><br>"."<p class='profielfields'>Email: </p>".$data[3]."</td>
				<td><br>"."<p class='profielfields'>intern telefoon nummer: </p>".$data[4]."</td>";

		
		?>
				</p>
			</div>
			<?php include('../include/navigatie.php');?>
			<button type="submit" class="uitloggen" name="uitlog_btn">uitloggen</button>

		</body>
	</html>