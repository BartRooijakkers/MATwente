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
					<label for="username"><b>Initialen</b></label><br>
					<input type="text" placeholder="Vul de Initialen in" name="initials" required><br>

					<label for=""><b>Tussenvoegsel</b></label><br>
					<input type="text" placeholder="Vul (Indien nodig) de tussenvoegsels in" name="middleName"><br>

          <label for=""><b>Achternaam</b></label><br>
          <input type="text" placeholder="Vul de achternaam in" name="surname" required><br>

					<label for="E-mail"><b>E-mail</b></label><br>
					<input type="text" placeholder="Vul de e-mail in" name="email" required><br>

					<label for="nummer"><b>Nummer</b></label><br>
					<input type="text" placeholder="Vul het Interne telefoonnummer in" name="nummer" maxlength="3" required><br>

          <label for="geslacht"><b>Geslacht</b></label><br>
          <input type="radio" name="gender" value="male" required> Man
          <input type="radio" name="gender" value="female"> Vrouw<br><br>

          <label for="department"><b>Afdeling</b></label><br>
          <select name="department" form="addUser" required>
                  <option value="" selected disabled hidden>Kies Hier</option>
                  <option value="CAD"> CAD </option>
                  <option value="Directie"> Directie </option>
                  <option value="Engineering"> Engineering </option>
                  <option value="Financiele Administratie"> Financiele Administratie </option>
                  <option value="HRM"> HRM </option>
                  <option value="ICT"> ICT </option>
                  <option value="Onderzoek"> Onderzoek </option>
                  <option value="Planning"> Planning </option>
                  <option value="Project planning"> Project Planning </option>
                  <option value="Rapportage"> Rapportage </option>
                  <option value="Secretariaat"> Secretariaat </option>
                  <option value="Verkoop en Marketing"> Verkoop en Marketing </option>
                  </select>

					<button type="submit" class="btn" name="login_btn">Aanmaken</button>
					<br>

			<label class="error"></label>
			<br>
			</div>
		</form>
  </div>
</body>
</html>
