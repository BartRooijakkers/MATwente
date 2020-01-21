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

$sql = "SELECT departmentID,departmentName FROM departments";

$result = mysqli_query($conn,$sql);

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
						 <form action="../functions/adduser.php" method="post" class="addUser">
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
                  <option value="" selected disabled hidden>Kies een afdeling</option>
                  <?php
                            if (mysqli_num_rows($result) > 1){

                                  while($row = mysqli_fetch_assoc($result)){
                                    echo " <option value='".$row["departmentID"]."'>".$row["departmentName"]."</option>
                                  ";
                              }
                            }
                            else{
                              echo "Error";
                            }
                            ?>
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
