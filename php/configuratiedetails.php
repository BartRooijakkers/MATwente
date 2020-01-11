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

$id = $_GET["configurationID"];

$sql = "SELECT configuration.configurationName, hardware.model, hardware.type, hardware.brand FROM configuration INNER JOIN config2hardware ON configuration.configurationID = config2hardware.configurationID INNER JOIN hardware ON config2hardware.hardwareID = hardware.hardwareID WHERE configuration.configurationID = $id ";

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
          <h1> Configuratie details </h1>
	<table class="configuratieDetails" name="configuratieDetails">
	<tr>

	  <th> Configuratie </th>
		<th> Hardware type</th>
		<th> Hardware Merk </th>
    <th> Hardware model </th>




	</tr>
  <?php
  if (mysqli_num_rows($result) >= 1){

    while($row = mysqli_fetch_assoc($result)){
      echo "<tr><td>".$row["configurationName"]."</td>
      <td>".$row["type"]."</td>
      <td>".$row["brand"]."</td>
      <td>".$row["model"]."</td>
    </td></tr>";
    }
  }
  else{
    echo "Error";
  }
  ?>




</table>
<a href="javascript:history.back()"><img class= 'return' src=../img/return.png></a>
</div>




	</body>
</html>
