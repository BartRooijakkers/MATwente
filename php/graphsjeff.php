<?php
if(!isset($_SESSION)){
 session_start();
}
if(!isset($_SESSION['user'])){
header("location:index.php");
}
$data = $_SESSION['user'];
if($data[6] != 3 ){
header("location:profiel.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twente";

$userID = $data[6];

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}

 $sql5 = "SELECT user.initials, user.surname, COUNT(incident.incidentID) AS number
 FROM user INNER JOIN user2incident ON user.userID = user2incident.userID
 INNER JOIN incident ON user2incident.incidentID = incident.incidentID
 GROUP BY user.surname";
 //datum oproep

$result5 = mysqli_query($conn,$sql5);

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ["Element", "Density", { role: "style" } ],
          <?php
          while($row = mysqli_fetch_array($result5))
          {
            $name = $row['initials'] . ", ". $row['surname'];
               echo "['".$name."', ".$row["number"]."],";
          }
          ?>
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                         { calc: "stringify",
                           sourceColumn: 1,
                           type: "string",
                           role: "annotation" },
                         2]);

        var options = {
          title: "Density of Precious Metals, in g/cm^3",
          width: 600,
          height: 400,
          bar: {groupWidth: "95%"},
          legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
    </script>
  <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
  </body>
</html>
