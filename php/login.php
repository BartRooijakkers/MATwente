<?php
 require '../include/sesion.php';
 ?>
<!doctype html>
<html lang="nl">
<?php include('../include/header.php');?>
	<body>


				<div class="container">
					<div class="login">
						 <form action="login.php" method="post">
				<br>

					<label for="username"><b>E-mail</b></label><br>
					<input type="text" placeholder="Vul uw E-mail in" name="username" required><br>

					<label for="password"><b>Wachtwoord</b></label><br>
					<input type="password" placeholder="Voer wachtwoord in" name="password" required><br>

					<button type="submit" class="btn" name="login_btn">Login</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
		</div>

	</body>
</html>
