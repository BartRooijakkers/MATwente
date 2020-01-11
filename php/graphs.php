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

$userID = $data[6];

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection Failed " . mysqli_connect_error());
}
//Datum graph query
$sql = "SELECT YEAR(incident.date),DAYNAME(incident.date), MONTHNAME(incident.date), DAY(incident.date), COUNT(*) as number FROM incident GROUP BY date";
//Geslacht graph query
$sql1 = "SELECT sex, count(*) as number from user GROUP BY sex";
//Afdeling graph query
$sql2 = "SELECT departments.departmentName, COUNT(incident.incidentID) AS number FROM USER
 INNER JOIN user2incident ON user.userID = user2incident.userID
 INNER JOIN incident ON user2incident.incidentID = incident.incidentID
 INNER JOIN departments ON departments.departmentID = user.departmentID
 GROUP BY departments.departmentName";
 // Type incident graph query
 $sql3 = "SELECT incident.type, COUNT(*) AS number FROM incident GROUP BY incident.type";
 // Incidenten per Configuraties query
 $sql4 = "SELECT configuration.configurationName, COUNT(config2incident.incidentID) AS number FROM config2incident
 INNER JOIN configuration ON configuration.configurationID = config2incident.configurationID
 GROUP BY configuration.configurationName";
 //datum oproep
$result = mysqli_query($conn,$sql);
//Geslacht oproep
$result1 = mysqli_query($conn,$sql1);
//Afdeling oproep
$result2 = mysqli_query($conn,$sql2);
//Type incident oproep
$result3 = mysqli_query($conn,$sql3);
// incidente per configuraties oproep
$result4 = mysqli_query($conn,$sql4);

?>

<html>
  <head>
    <script src="https://kit.fontawesome.com/85544c20de.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart for Sarah's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawDateChart);

      // Draw the pie chart for the Anthony's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawGeslachtChart);

      //Tekent Afdeling grafiek
          google.charts.setOnLoadCallback(drawAfdelingChart);

      //Tekent Type incident grafiek
        google.charts.setOnLoadCallback(drawtypeIncidentChart);

      //Tekent incidente per configuraties grafiek
      google.charts.setOnLoadCallback(drawconfiguratiesChart);
      // Callback that draws the pie chart for Sarah's pizza.
      function drawDateChart() {
        var data = google.visualization.arrayToDataTable([
          ['Datum', 'Meldingen'],
          <?php
           while($row = mysqli_fetch_array($result))
           {    $day = "";
               if ($row["DAYNAME(incident.date)"] == "Monday"){
                 $day = "Maandag";
               }
               elseif ($row["DAYNAME(incident.date)"] == "Tuesday") {
                 $day = "Dinsdag";
               } elseif ($row["DAYNAME(incident.date)"] == "Wednesday") {
                   $day = "Woensdag";
               } elseif ($row["DAYNAME(incident.date)"] == "Thursday") {
                   $day = "Donderdag";
               } elseif($row["DAYNAME(incident.date)"] == "Friday") {
                   $day = "Vrijdag";
               } elseif ($row["DAYNAME(incident.date)"] == "Saturday") {
                   $day = "Zaterdag";
               } elseif($row["DAYNAME(incident.date)"] == "Sunday") {
                   $day = "Zondag";
               };
             $date = $day ." ". $row["DAY(incident.date)"] ." ". $row["MONTHNAME(incident.date)"];
                echo "['".$date."', ".$row["number"]."],";
           }
           ?>
        ]);

        var options = {
          title: 'Incidenten per datum',
          hAxis: {title: 'Datum',  titleTextStyle: {color: '#333'}},
          curveType: 'function',
          vAxis: {minValue: 0},
           pointSize: 10,
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      // Callback that draws the pie chart for Anthony's pizza.
      function drawGeslachtChart()
      {
           var data = google.visualization.arrayToDataTable([
                     ['Gender', 'Number'],
                     <?php
                     while($row = mysqli_fetch_array($result1))
                     {
                       if ($row["sex"] == 1) {
                     $geslacht = "Mannen";
                     } elseif ($row["sex"] == 2) {
                     $geslacht = "Vrouwen";
                     } elseif ($row["sex"] == 3) {
                      $geslacht = "Anders";
                    }
                          echo "['".$geslacht."', ".$row["number"]."],";
                     }
                     ?>
                ]);
           var options = {
                 title: 'Percentage van Mannelijk & Vrouwelijk Medewerkers',
                 //is3D:true,
                pieHole: 0.4,
                colors: ['#2092e8', '#d212e3']
                };
           var chart = new google.visualization.PieChart(document.getElementById('pieSex'));
           chart.draw(data, options);
      }

      function drawAfdelingChart()
      {
           var data = google.visualization.arrayToDataTable([
                     ['Afdeling', 'Aantal Incidenten'],
                     <?php
                     while($row = mysqli_fetch_array($result2))
                     {
                          echo "['".$row["departmentName"]."', ".$row["number"]."],";
                     }
                     ?>
                ]);
           var options = {
                 title: 'Aantal gemelde incidenten per afdeling',
                 is3D:true,
                };
           var chart = new google.visualization.PieChart(document.getElementById('pieAfdeling'));
           chart.draw(data, options);
      }

      function drawtypeIncidentChart()
      {
           var data = google.visualization.arrayToDataTable([
                     ['Type incident', 'Aantal Incidenten'],
                     <?php
                     while($row = mysqli_fetch_array($result3))
                     {
                       if ($row["type"] == 1) {
                     $type = "Software";
                   } elseif ($row["type"] == 2) {
                     $type = "Hardware";
                     }
                     elseif ($row["type"] == 3) {
                       $type = "Nog niet toegewezen";
                       }
                          echo "['".$type."', ".$row["number"]."],";
                     }
                     ?>
                ]);
           var options = {
                 title: 'Type incidenten',
                 //is3D:true,
                pieHole: 0.4
                };
           var chart = new google.visualization.PieChart(document.getElementById('pieType'));
           chart.draw(data, options);
      }

      function drawconfiguratiesChart()
      {
           var data = google.visualization.arrayToDataTable([
                     ['Configuratie', 'Aantal Incidenten'],
                     <?php
                     while($row = mysqli_fetch_array($result4))
                     {
                          echo "['".$row["configurationName"]."', ".$row["number"]."],";
                     }
                     ?>
                ]);
           var options = {
                 title: 'Aantal gemelde incidenten per configuratie',
                // is3D:true,
                colors: ['#ed7b18','#7499B4']

                };
           var chart = new google.visualization.PieChart(document.getElementById('pieConfiguraties'));
           chart.draw(data, options);
      }

    </script>
    <title>MA Twente</title>
    <meta charset="UTF-8">
    <meta name="description" content="dit is het MA Twente project">
    <meta name="keywords" content="aplicatie voor MA Twente ">
    <meta name="author" content="Wesley van de Slikke,Bart Rooijakkers, Casey Kruijer">
    <meta name="viewport"content="width=device-witdth, initial-scale=1-0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navigatie.css">
  </head>
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
    <!--Table and divs that hold the pie charts-->
      <div class="tableGraphs">
            <h1> Statistieken</h1>

        <div id="chart_div" style="border: 1px solid #ccc"></div>
        <div id="pieAfdeling" style="border: 1px solid #ccc"></div>
        <div id="pieConfiguraties" style="border: 1px solid #ccc"></div>
        <div id="pieType" style="border: 1px solid #ccc"></div>
        <div id="pieSex" style="border: 1px solid #ccc"></div>


  </div>
  </body>
</html>