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
}?>
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
              <h1 class="form"> Hardware toevoegen </h1>
						 <form action="../functions/addhardware.php" method="post" name="hardware">
				<br>
					<label for="Merk"><b>Merk</b></label><br>
          <input type="text" name="brand" placeholder="Vul het merk van de hardware in" required><br>

          <label for="Model"><b>Model</b></label><br>
          <input type="text" name="model" placeholder="Vul het model van de hardware in" required><br>

          <label for="Type"><b>Type</b></label><br>
          <input type="text" name="type" placeholder="Vul het type hardware in" required><br>

        </select><br>

          <label for="configuratie"><b>Configuratie</b></label><br>
          <input type="radio" name="config" value="1" required> <b>Standaard Werkplek</b>
          <input type="radio" name="config" value="2"><b> Mobiele Werkplek</b><br><br>

          <button type="submit" class="btn" name="login_btn">Aanmaken</button>
          <br>
			<label class="error"></label>
			<br>
			</div>
		</form>
		</div>
</body>
</html>
