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
  include('../include/navigatiebeheerder.php');
}
else{
  include('../include/navigatie.php');
}
?>
<br>
<br>
<br>
	<div class=table>
      <h1> Veel Gestelde Vragen </h1>

	<?php

	if (mysqli_num_rows($result) >= 1){


	  while($row = mysqli_fetch_assoc($result)){

      /* Weergeven van de data in het tabel */
	    echo "
      	  <label class='vraag'>".$row["question"]."<label><br>
      <label class='antwoord'>".$row["answer"]."<label><br>";
	  }
	}
	else{
	  echo "Error";
	}
	?>


</div>



	</body>
</html>
