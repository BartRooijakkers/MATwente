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
$sql = "SELECT question, answer FROM faq";

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

	<div class=table>
      <h1> Veel Gestelde Vragen </h1>
<table class="faq">
	<?php

	if (mysqli_num_rows($result) >= 1){


	  while($row = mysqli_fetch_assoc($result)){

      /* Weergeven van de data in het tabel */
	    echo "
      	 <tr><td class='vraag'><p class='vraag'>".$row["question"]."</p></td></tr>
      <tr><td class='antwoord'><p class='antwoord'>".$row["answer"]."</p></td</tr>";
	  }
	}
	else{
	  echo "Error";
	}
	?>

</table>
</div>



	</body>
</html>
