<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>
<!doctype html>
<html lang="nl">
<?php include('../include/header.php');?>
  <script src="https://kit.fontawesome.com/292c831ebb.js" crossorigin="anonymous"></script>
	<body>
				<div class="container">
					<div class="login">
					<?php
					if(isset($_GET['error'])){
						echo "Er is een fout in u email of wachtwoord.";
						}
						?>
					<i class="fas fa-user-tie"></i>

						 <form action="login.php" method="post">
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
