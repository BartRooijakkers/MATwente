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
            <h1 class="form"> Gebruiker toevoegen </h1>
						 <form action="adduser.php" method="post" class="addUser">
				<br>
					<label for="username"><b>Initialen</b></label><br>
					<input type="text" placeholder="Vul de Initialen in" name="initials" required><br>

					<label for=""><b>Tussenvoegsel</b></label><br>
					<input type="text" placeholder="Vul (Indien nodig) de tussenvoegsels in" name="middleName"><br>

          <label for=""><b>Achternaam</b></label><br>
          <input type="text" placeholder="Vul de achternaam in" name="surname" required><br>

					<label for="nummer"><b>Nummer</b></label><br>
					<input type="text" placeholder="Vul het Interne telefoonnummer in" name="nummer" maxlength="3" required><br>

          <label for="geslacht"><b>Geslacht</b></label><br>
          <input type="radio" name="gender" value="male" required> Man
          <input type="radio" name="gender" value="female"> Vrouw<br><br>

          <label for="department"><b>Afdeling</b></label><br>
          <select name="department" required>
                  <option value="">Make a selection</option>
                  <option value="2"> CAD </option>
                  <option value="3"> Directie </option>
                  <option value="4"> Engineering </option>
                  <option value="5"> Financiele Administratie </option>
                  <option value="6"> HRM </option>
                  <option value="7"> ICT </option>
                  <option value="8"> Onderzoek </option>
                  <option value="9"> Planning </option>
                  <option value="10"> Project Planning </option>
                  <option value="11"> Rapportage </option>
                  <option value="12"> Secretariaat </option>
                  <option value="13"> Verkoop en Marketing </option>
                </select><br><br>

					<button type="submit" class="btn" name="login_btn">Aanmaken</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
  </div>
</body>
</html>
