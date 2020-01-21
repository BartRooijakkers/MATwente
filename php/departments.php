<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];
if($data[6] == 1 ){
header("location:profiel.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
$sql = "SELECT departments.*, COUNT(user.userID) as number FROM departments
INNER JOIN user ON user.departmentID = departments.departmentID
WHERE user.userID != 57 AND user.userID != 53
GROUP BY departmentName";
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

	<div class="departments">
      <h1 class="afdeling"> Afdelingen </h1>
	<table class="afdelingen" name="afdelingen">
	<tr>
		<th> Afdeling<a href="departments.php?sort=departments"><i class="fas fa-sort-down"></a></th>
    <th> Locatie <a href="departments.php?sort=locatie"><i class="fas fa-sort-down"></a></th>
    <th> Aantal Medewerkers <a href="departments.php?sort=number"><i class="fas fa-sort-down"></a></th>
    <th> Openen </th>



	</tr>
	<?php

	if (mysqli_num_rows($result) > 1){


	  while($row = mysqli_fetch_assoc($result)){
      /* Controleren of department Intern of extern is */
      if ($row["location"] == 1){
        $location = "Intern";

      }
      else{
        $location = "Extern";
      }
      /*als $row["number"] = leeg laat 0 zien */
      if($row["number"] == 0 || $row["number"] == NULL){
        $mensen = "0 Medewerkers";
      }
      else{
        $mensen = $row["number"] . " " . "Medewerkers";
      }
      /* Weergeven van de data in het tabel */
	    echo "<tr><td>".$row["departmentName"]."</td>
      <td>".$location."</td>
      <td>".$mensen."</td>
      	<td><a href='departmentdetails.php?departmentID=".$row["departmentID"]."'>"."<i class='fas fa-external-link-alt'></i>"."</td>
			 </tr>";
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
