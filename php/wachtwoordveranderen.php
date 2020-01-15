<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];

/* Connectie maken met de database */
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
	<br>
  <div class="container">

					<div class="login">
            <h1 class="form"> Wachtwoord Veranderen </h1>
						 <form action="modifypassword.php" method="post" class="addUser">

					<label for="username"><b>Nieuwe wachtwoord</b></label><br>
					<input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" placeholder="Vul uw nieuwe wachtwoord in" name="password" required>
					<br><button type="submit" class="btn" name="login_btn">Veranderen</button><br>


		    <p class="wachtwoord"> Uw wachtwoord moet: minimaal 8 karakters lang zijn & minimaal: 1 hoofdletter, 1 kleine letter, 1 nummer en speciaal teken bevatten </p>

			</div>
		</form>
  </div>
</body>
</html>
