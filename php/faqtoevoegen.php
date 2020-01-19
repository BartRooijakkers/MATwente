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
              <h1 class="form"> Veel gestelde vraag toevoegen </h1>
						 <form action="../functions/addfaq.php" method="post" name="hardware">
					<label for="Merk"><b>Vraag</b></label><br>
          <textarea cols="40" rows="5" name="question" placeholder="Vul hier de vraag in"></textarea><br>

          <label for="Model"><b>Antwoord</b></label><br>
          <textarea cols="40" rows="5" name="answer" placeholder="Vul hier het antwoord in"></textarea>


          <button type="submit" class="btn" name="login_btn">Aanmaken</button>
          <br>
			<label class="error"></label>
			<br>
			</div>
		</form>
		</div>
</body>
</html>
