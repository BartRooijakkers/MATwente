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
						 <form action="configuratietoevoegen.php" method="post">
				<br>
					<label for="username"><b>Gebruiker</b></label><br>
					<input type="text" placeholder="Vul de Gebruiker in" name="user" required><br>

          <label for="configuratie"><b>Configuratie</b></label><br>
          <input type="radio" name="config" value="Standaard Werkplek" required> <b>Standaard Werkplek</b>
          <input type="radio" name="config" value="Mobiele Werkplek"><b> Mobiele Werkplek</b><br><br>

          <button type="submit" class="btn" name="login_btn">Aanmaken</button>
          <br>
			<label class="error"></label>
			<br>
			</div>
		</form>
		</div>
</body>
</html>
