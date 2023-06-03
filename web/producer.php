<!DOCTYPE php>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="producer.css" />
  </head>
  <style>
/* for consumption info content */
@media(min-width :900px){
  div#consumption-p.content {
  width: 40%;
  transform: translateX(-50%);
  }
}
@media(max-width:434px){
  div.content{ 
    transform: translateX(8%);
   }
}
h1#g1.g1-style {
  text-align: center;
  border-bottom: 1px solid #000;
  padding-bottom: 10px;
}
  .echo {
  text-align: center;
  font-size: xx-large;
  transform: translateY(15px);
}
#total{
  border-top: 1px solid black;
  padding-top: 25px;
  color: #ad1010;
  font-weight: bold;
}
div#consumption-p.content{
  padding: 20px;
}
</style>
  <body>
    <header class="producer" id="header">
      <ul>
        <li>
          <a href="#" id="logo">SNautomation</a>
        </li>
        <li><a href="#" id="home-p" onclick="loadContent('Home')">Home </a></li>
        <li><a href="#" id="signOut">Sign Out</a></li>
      </ul>
    </header>

    <div id="menu">
      <ul>
        <li>
          <div class="list" id="list1">
            <a href="#" onclick="loadContent('Airconditioner')"
              >Airconditioner</a
            >
          </div>
        </li>
        <li>
          <div class="list">
            <a href="#" onclick="loadContent('Alarm')">Alarm System</a>
          </div>
        </li>
        <li>
          <div class="list">
            <a href="#" onclick="loadContent('Blinds')">Blinds</a>
          </div>
        </li>
        <li>
          <div class="list">
            <a href="#" onclick="loadContent('Oven')">Oven</a>
          </div>
        </li>
        <li>
          <div class="list">
            <a href="#" onclick="loadContent('Thermostat')">Thermostat</a>
          </div>
        </li>
        <li>
          <div class="list">
            <a href="#" onclick="loadContent('Vacuum')">Vacuum Cleaner</a>
          </div>
        </li>
        <li>
          <div class="list" id="consumption">
            <a href="#" onclick="loadContent('Consumption')">Consumption</a>
          </div>
        </li>
      </ul>
    </div>

    <div class="content" id="home"></div>
    <div class="content" id="airconditioner"></div>
    <div class="content" id="alarm"></div>
    <div class="content" id="blinds"></div>
    <div class="content" id="oven"></div>
    <div class="content" id="thermostat"></div>
    <div class="content" id="vacuum"></div>
    <div class="content" id="consumption-p"></div>

    <script>
      var currentContent = null;

      function loadContent(page) {
        var contentDiv;
        if (page === "Home") {
          contentDiv = document.getElementById("home");
          contentDiv.innerHTML = "aaaaa";
        } else if (page === "Airconditioner") {
          contentDiv = document.getElementById("airconditioner");
          contentDiv.innerHTML = "a";
        } else if (page === "Alarm") {
          contentDiv = document.getElementById("alarm");
          contentDiv.innerHTML = "b";
        } else if (page === "Blinds") {
          contentDiv = document.getElementById("blinds");
          contentDiv.innerHTML = "c";
        } else if (page === "Oven") {
          contentDiv = document.getElementById("oven");
          contentDiv.innerHTML = "d";
        } else if (page === "Thermostat") {
          contentDiv = document.getElementById("thermostat");
          contentDiv.innerHTML = "e";
        } else if (page === "Vacuum") {
          contentDiv = document.getElementById("vacuum");
          contentDiv.innerHTML = "f";
        } else {
          contentDiv = document.getElementById("consumption-p");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">CONSUMPTION</h1>
      <div id="consumption-text">
      <?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web-home-automation";

$connection = new mysqli($servername, $username, $password, $dbname);

// Connection control
if ($connection->connect_error) { 
  die("Database connection failed: " .
      $connection->connect_error); } 
      // Take data using sql query 
      $sql = "SELECT AirCons, AlarmCons, LightCons, ThermCons, OvenCons, VacuumCons
              FROM `Consumption` 
              WHERE ConsumptionID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "<div class='echo'> Air Condition Consumption: ".$row['AirCons'] . "<br/><br /></div>"; 

      echo "<div class='echo'> Alarm System Consumption: ".$row['AlarmCons'] ."<br /><br /></div>"; 

      echo "<div class='echo'> Lights Consumption: ".$row['LightCons'] ."<br /><br /></div>";
      
      echo "<div class='echo'>Thermostat Consumption: ".$row['ThermCons'] ."<br /><br /></div>";

      echo "<div class='echo'> Oven Consumption: ".$row['OvenCons'] ."<br /><br /></div>";

      echo "<div class='echo'> Vacuum Cleaning Consumption: ".$row['VacuumCons'] ."<br /><br /></div>";

      //total concumption
      $total = $row['AirCons'] + $row['AlarmCons'] + $row['LightCons'] + $row['ThermCons'] + $row['OvenCons'] + $row['VacuumCons'];
  echo "<div class='echo' id='total'> Total Consumption: " . $total . "</div>";
    } else {
         echo "Sonuç bulunamadı."; } 
      
      // close
      $connection->close(); 
      ?>
      </div>`;
      
    }

        // hidden older content.
        if (currentContent !== null) {
          currentContent.style.display = "none";
        }

        // show new content.
        contentDiv.style.display = "block";
        currentContent = contentDiv;
      }
      loadContent("Home");
    </script>
  </body>
    </php>
