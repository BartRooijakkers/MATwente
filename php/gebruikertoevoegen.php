<?php
/* Controlleren of sessie is aangemaakt */
if(!isset($_SESSION)){
 session_start();
}
/* Wanneer sessie niet gemaakt is wordt de gebruiker terug verwezen naar de inlogpagina*/
if(!isset($_SESSION['user'])){
header("location:index.php");
}
/* Rol van gebruiker oproepen */
$data = $_SESSION['user'];
/* Controleer rol van de gebruiker, Wanneer gebruiker niet bevoegd is wordt hij terug verwezen naar profiel.php */
if($data[6] != 2 ){
header("location:profiel.php");
}
/* variablen database connectie definiëren */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";
/* Connectie maken met de database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
/* Als connectie is gefaald toon error */
if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
/* Query definiëren */
$sql = "SELECT departmentID,departmentName FROM departments WHERE departmentID != 15";
/* Query opzetten */
$result = mysqli_query($conn,$sql);
?>
<!doctype html>
<html lang="nl">
<!-- Het includen van de header -->
	<?php include('../include/header.php');?>
<body>
  <!-- Het includen van de navigatie gebaseerd op rol -->
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
                  <!-- Kop text -->
            <h1 class="form"> Gebruiker toevoegen </h1>
            <!-- Begin form -->
						 <form action="../functions/adduser.php" method="post" class="addUser">
				<br>
            <!-- input initialen -->
					<label for="username"><b>Initialen</b></label><br>
					<input type="text" placeholder="Vul de Initialen in" name="initials" required><br>
  <!-- input tussenvoegsel -->
					<label for=""><b>Tussenvoegsel</b></label><br>
					<input type="text" placeholder="Vul (Indien nodig) de tussenvoegsels in" name="middleName"><br>
  <!-- input achternaam -->
          <label for=""><b>Achternaam</b></label><br>
          <input type="text" placeholder="Vul de achternaam in" name="surname" required><br>
  <!-- input nummer -->
					<label for="nummer"><b>Nummer</b></label><br>
					<input type="text" placeholder="Vul het Interne telefoonnummer in" name="nummer" maxlength="3" required><br>
  <!-- input geslacht -->
          <label for="geslacht"><b>Geslacht</b></label><br>
          <input type="radio" name="gender" value="male" required> Man
          <input type="radio" name="gender" value="female"> Vrouw<br><br>
  <!-- input Afdeling -->
          <label for="department"><b>Afdeling</b></label><br>
          <!-- Begin select for department -->
          <select name="department" required>
                  <option value="" selected disabled hidden>Kies een afdeling</option>
                  <?php
                    /* If statement voor het oproepen van rijen uit Database, Als het aantal rijen groter is dan 1 */
                            if (mysqli_num_rows($result) > 1){
  /* Als if statement = true dan roept hij de onderstaande rijen op */
                                  while($row = mysqli_fetch_assoc($result)){
                                    /* Departments oproepen */
                                    echo " <option value='".$row["departmentID"]."'>".$row["departmentName"]."</option>
                                  ";
                              }
                            }
                            else{
                                 /* Wanneer de query mislukt toont hij: Error */
                              echo "Error";
                            }
                            ?>
</select><br><br>
<!-- Submit button -->
					<button type="submit" class="btn" name="login_btn">Aanmaken</button><br><br>
			</div>
		</form>
  </div>
</body>
</html>
