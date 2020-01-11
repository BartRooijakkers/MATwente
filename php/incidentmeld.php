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
	<br>
  <div class="container">

					<div class="login">
            <h1 class="form"> Incident Melden </h1>
						 <form action="addincident.php" method="post" class="addUser">
				<br>
					<label for="omschrijving"><b>Omschrijving</b></label><br>
					<input type="text" placeholder="Omschrijf het probleem" name="shortDescription" required><br>

					<label for=""><b>impact</b></label><br>
					<input type="number" placeholder="Hoeveel mensen worden geimpact" name="impact" max="9999" required><br><br>


					<button type="submit" class="btn" name="login_btn">Aanmaken</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
  </div>
</body>
</html>
