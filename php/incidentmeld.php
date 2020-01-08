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
						 <form action="adduser.php" method="post" class="addUser">
				<br>
					<label for="omschrijving"><b>Omschrijving</b></label><br>
					<input type="text" placeholder="Omschrijf het probleem" name="shortDescription" required><br>

					<label for=""><b>impact</b></label><br>
					<input type="number" placeholder="Hoeveel mensen worden geimpact" name="impact" max="9999" required><br><br>


					<button type="submit" class="btn" name="login_btn">Aanmaken</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
  </div>
</body>
</html>
