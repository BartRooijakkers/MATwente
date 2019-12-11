<?php
 require '../include/session.php';
 ?>
<!doctype html>
<html lang="nl">
	<?php include('../include/header.php');?>
<body>
	<?php include('../include/navigatie.php');?>
	<br>
				<div class="container">
					<div class="login">
						 <form action="gebruikertoevoegen.php" method="post">
				<br>
					<label for="username"><b>Gebruiker</b></label><br>
					<input type="text" placeholder="Vul uw Gebruikersnaam in" name="username" required><br>

					<label for="password"><b>Wachtwoord</b></label><br>
					<input type="password" placeholder="Vul uw wachtwoord in" name="password" required><br>
					
					<label for="password"><b>e-mail</b></label><br>
					<input type="password" placeholder="Vul uw e-mail in" name="password" required><br>
					
					<label for="password"><b>Nummer</b></label><br>
					<input type="password" placeholder="Vul uw nummer in" name="password" required><br>

					<button type="submit" class="btn" name="login_btn">Aanmaken</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
		</div>
</body>
</html>
