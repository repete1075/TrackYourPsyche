<!--Analyze-->
<?php 

session_start();

if (isset($_SESSION['username'])&& isset($_SESSION['userID'])) {
  $userid=$_SESSION['userID'];
  $username=$_SESSION['username'];
 ?>
<html>
  <head>
  <title>Track Your Psyche</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var jsonData=$.ajax({
          url:"getData.php",
          dataType:"json",
          async:false
        }).responseText;

        //create data table from JSON data from server
        var data= new google.visualization.DataTable(jsonData);

        //draw chart
        // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 800, height: 400});
      }
    </script>
  </head>

  <body>
  <div id="page-container">
            <div id="content-wrap">
  <header>Track Your Psyche</header>

<nav>
    <ul>
        <li><a href="maincust.php">Home</a></li>
        <li><a href="track.php">Track</a></li>
        <li><a href="add.php">Add</a></li>
        <li><a href="analyze.php">Analyze</a></li>
        <li>Hello <span class="usersname"><?php echo $_SESSION['username'];?> </span> &emsp;|&emsp;<a href="main.html">Logout</a></li>
    </ul>
</nav>
    <!--Div that will hold the pie chart-->
    <div id="chart_div" style="width: 900px; height: 500px"></div>
    </div>
            <footer id="footer">
                <h3><a href="helppage.html">Need Help? Visit our help desk!</a></h3>
            </footer>
        </div>
  </body>
</html>
<?php }?>