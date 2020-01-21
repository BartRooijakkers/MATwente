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
            <h1 class="form">Afdeling toevoegen </h1>
						 <form action="../functions/adddepartment.php" method="post" class="adddepartment">
				<br>
					<label for="departmentName"><b>Afdeling Naam</b></label><br>
					<input type="text" placeholder="Vul de naam van de afdeling in" name="departmentName" required><br>
          <label for="location"><b>Locatie</b></label><br>
          <input type="radio" name="location" value="1" required> Intern
          <input type="radio" name="location" value="2"> Extern<br><br>



					<button type="submit" class="btn" name="login_btn">Aanmaken</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
  </div>
</body>
</html>
