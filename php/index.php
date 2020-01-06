<?php
 require '../include/session.php';

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


				<div class="container">
					<div class="login">
					<img src="../img/loginavatar.png" class="avatar">

						 <form action="profiel.php" method="post">
				<br>
					<label for="username"><b>E-mail</b></label><br>
					<input type="text" placeholder="Vul uw E-mail in" name="username" required><br>

					<label for="password"><b>Wachtwoord</b></label><br>
					<input type="password" placeholder="Voer wachtwoord in" name="password" required><br>

					<button class="btn" name="login_btn">Login</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
		</div>

	</body>
</html>
