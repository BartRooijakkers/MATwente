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
$id = $_GET["departmentID"];
$sql = "SELECT departments.*, COUNT(user.userID) as number FROM departments
INNER JOIN user ON user.departmentID = departments.departmentID
 WHERE user.userID != 57 AND user.userID != 53 AND departments.departmentID = $id
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
        <form class="edit" action="../functions/modifydepartment.php?departmentID=<?php echo $id?>" method="post">
	<table class="afdelingen" name="afdelingen">
	<tr>
    <th> Afdeling</th>
    <th> Locatie </th>
    <th> Aantal Medewerkers</th>
    <th> Openen </th>



	</tr>
	<?php

	if (mysqli_num_rows($result) >= 1){


	  while($row = mysqli_fetch_assoc($result)){
      /*als $row["number"] = leeg laat 0 zien */
      if($row["number"] == 0 || $row["number"] == NULL){
        $mensen = "0 Medewerkers";
      }
      else{
        $mensen = $row["number"] . " " . "Medewerkers";
      }
      /* Weergeven van de data in het tabel */
	    echo "<tr><td><textarea cols='15' rows='1' name='departmentName'>".$row["departmentName"]." </textarea></td><td>";
      if($row["location"]==1){
            echo "<div class='typeradio'><input type='radio' name='location' value='1' checked><b> Intern </b><br>
            <input type='radio' name='location' value='2'><b>Extern </b></div>";
      }elseif($row["location"]==2){
          echo "  <input type='radio' name='location' value='1'><b> Intern  </b><br>
          <input type='radio' name='location' value='2' checked><b>Extern </b>";
      }
echo"</td>
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
<button type="submit" class="btn" name="modify_btn">Aanpassen</button>
</form>
<a href="javascript:history.back()">
<button class="backbtn1" name="delete_btn">Terug</button>
</a>

<a href="../functions/deletedepartment.php?departmentID=<?php echo $id?>">
<button class="deletebtn1" name="delete_btn">Verwijder Afdeling</button>
</a>
</div>



	</body>
</html>
