
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
          <select name="department" required>
                  <option value="">Make a selection</option>
                  <option value="2"> CAD </option>
                  <option value="3"> Directie </option>
                  <option value="4"> Engineering </option>
                  <option value="5"> Financiele Administratie </option>
                  <option value="6"> HRM </option>
                  <option value="7"> ICT </option>
                  <option value="8"> Onderzoek </option>
                  <option value="9"> Planning </option>
                  <option value="10"> Project Planning </option>
                  <option value="11"> Rapportage </option>
                  <option value="12"> Secretariaat </option>
                  <option value="13"> Verkoop en Marketing </option>
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
