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
$sql = "SELECT userID,initials, surname FROM user";

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
  include('../include/navigatiebeheerder.php');
}
else{
  include('../include/navigatie.php');
}
?>
	<br>
				<div class="container">
					<div class="login">
						 <form action="addconfig.php" method="post" name="config">
				<br>
					<label for="username"><b>Gebruiker</b></label><br>
          <select name='user' required>
<?php
          if (mysqli_num_rows($result) > 1){

                while($row = mysqli_fetch_assoc($result)){
                  echo " <option value='".$row["userID"]."'>".$row["initials"].", ".$row['surname']."</option>
                ";
            }
          }
          else{
            echo "Error";
          }
          ?>



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
