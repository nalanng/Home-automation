<!DOCTYPE php>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="consumer.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    </head>
<style>
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
  top: 140px;
}
div.chartStyle {
  height: 300;
}
.datetime-container {
  position: absolute;
  top:-270px;
  right: 10px;
  font-size: 18px;
  color: #000;
  text-align: center;
  }    
.temp-container{
  display: flex;
  width: 60%;
  transform: translate(20px,-100px);
}
.temp{
  flex: 1;
  margin: 1px;
}
div.content {
  top: 240px;
}
div#home.content{
  transform: translateY(80px);
}
.lightStatus {
    position: absolute;
    width: 200px;
    top: -50px;
    left: 50%;
    border: 1px solid #ccc;
    padding-top: 10px;
    border-radius: 5px;
    text-align: center;
  }

  .lightStatus .l-echo {
    margin-bottom: 10px;
  }
  @media (max-width: 1020px) {
    .lightStatus{
      top: -250px;
      left: 25%;
    }
    .chartStyle{
      transform: translateY(220px);
    }
  }
  @media(max-width:434px){
    header#header.consumer{
      height: 100px;
    }
    a#home-p{
      transform: translateY(40px);
    }
    a#signOut{
      transform: translateY(40px);
    }
    div#menu{
      transform: translateY(120px);
    }
    .datetime-container{
      transform: translate(-40px,-370px);

    }
    div#home.content{
      transform: translateY(270px);
    }
    .temp-container{
      transform: translate(-53px,-100px);
    }
    .lightStatus{
      top: -250px;
      left: 17%;
    }
}
#empty{
  height: 100px;
}
</style>
  <body>
    <header class="consumer" id="header">
      <ul>
        <li>
          <a href="#" id="logo">SNautomation</a>
        </li>
        <li><a href="#" id="home-p" onclick="loadContent('Home')">Home </a></li>
        <li><a href="homepage.php" id="signOut">Sign Out</a></li>
      </ul>
    </header>

    <div id="menu">
      <ul>
        <li>
          <div class="list" id="list1">
            <a href="#" onclick="loadContent('Airconditioner')"
              >Air Conditioner</a
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


<script>
<?php
// database connetion
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
      }

      $sql2 = "SELECT degree FROM `airconditioner` WHERE deviceid = 1";
      $result2 = mysqli_query($connection, $sql2);
      
      if (mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);
      }

      $sql3 = "SELECT degree FROM `thermostat` WHERE deviceid = 1";
      $result3 = mysqli_query($connection, $sql3);
      
      if (mysqli_num_rows($result3) > 0) {
        $row3 = mysqli_fetch_assoc($result3);
      }

      // close
      $connection->close(); 
?>

<?php

$host = "localhost";
$db = "web-home-automation";
$user = "root";
$password = "";

$baglanti = new mysqli($host, $user, $password, $db);

if ($baglanti->connect_error) {
  die("MySQL bağlantı hatası: " . $baglanti->connect_error);
}

// Cihazların durumlarını güncelleyen fonksiyon
function updateDeviceState($tableName, $deviceID, &$state, &$buttonText) {    session_start();

  global $baglanti;

  $query = "SELECT state FROM $tableName WHERE DeviceID = $deviceID";
  $result = $baglanti->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $state = $row["state"];
  } else {
    $state = "Off";
  }

  if ($state === "On") {
    $buttonText = "TURN OFF";
  } else {
    $buttonText = "TURN ON";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($state === "On") {
      $newState = "Off";
    } else {
      $newState = "On";
    }

    $updateQuery = "UPDATE $tableName SET state='$newState' WHERE DeviceID = $deviceID";
    if ($baglanti->query($updateQuery) === TRUE) {
      $state = $newState;
      if ($state === "On") {
        $buttonText = "TURN OFF";
      } else {
        $buttonText = "TURN ON";
      }
    } else {
      echo "Durum güncelleme hatası: " . $baglanti->error;
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
  }
}

// Air Conditioner
$airConditionerState = "";
$airConditionerButtonText = "";
if (isset($_POST['airconditioner'])) {
  updateDeviceState("airconditioner", 1, $airConditionerState, $airConditionerButtonText);
}
// Alarm
$alarmState = "";
$alarmButtonText = "";
if (isset($_POST['alarm'])) {
  updateDeviceState("alarm", 1, $alarmState, $alarmButtonText);
}
// Oven
$ovenState = "";
$ovenButtonText = "";
if (isset($_POST['oven'])) {
  updateDeviceState("oven", 1, $ovenState, $ovenButtonText);
}
// Thermostat
$thermostatState = "";
$thermostatButtonText = "";
if (isset($_POST['thermostat'])) {
  updateDeviceState("thermostat", 1, $thermostatState, $thermostatButtonText);
}

// Vacuum Cleaner
$vacuumCleanerState = "";
$vacuumCleanerButtonText = "";
if (isset($_POST['vacuumcleaner'])) {
  updateDeviceState("vacuumcleaner", 1, $vacuumCleanerState, $vacuumCleanerButtonText);
}

?>

<?php

$host = "localhost";
$db = "web-home-automation";
$user = "root";
$password = "";

$baglanti = new mysqli($host, $user, $password, $db);

if ($baglanti->connect_error) {
  die("MySQL bağlantı hatası: " . $baglanti->connect_error);
}

//Lights
  function updateLightsState($columnname, &$state, &$buttonText) {
  session_start();
  global $baglanti;

  $query = "SELECT `$columnname` FROM `lights` WHERE DeviceID = 1";
  $result = $baglanti->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $state = $row[$columnname];
  } else {
    $state = "Off";
  }

  if ($state === "On") {
    $buttonText = "TURN OFF";
  } else {
    $buttonText = "TURN ON";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($state === "On") {
      $newState = "Off";
    } else {
      $newState = "On";
    }

    $updateQuery = "UPDATE `lights` SET `$columnname`='$newState' WHERE DeviceID = 1";
    if ($baglanti->query($updateQuery) === TRUE) {
      $state = $newState;
      if ($state === "On") {
        $buttonText = "TURN OFF";
      } else {
        $buttonText = "TURN ON";
      }
    } else {
      echo "ERROR: " . $baglanti->error;
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
  }
}


// Living Room
$LivingRoomState = "";
$livingRoomText = "";
if (isset($_POST['livingRoom'])) {
  updateLightsState("livingRoom", $LivingRoomState, $livingRoomText);
}

// Kitchen
$KitchenState = "";
$KitchenText = "";
if (isset($_POST['Kitchen'])) {
  updateLightsState("Kitchen", $KitchenState, $KitchenText);
}

// Bedroom
$BedroomState = "";
$BedroomText = "";
if (isset($_POST['Bedroom'])) {
  updateLightsState("Bedroom", $BedroomState, $BedroomText);
}

// Bathroom
$BathroomState = "";
$BathroomText = "";
if (isset($_POST['Bathroom'])) {
  updateLightsState("Bathroom", $BathroomState, $BathroomText);
}

?>



  var airCons = <?php echo $row['AirCons']; ?>;
  var alarmCons = <?php echo $row['AlarmCons']; ?>;
  var lightCons = <?php echo $row['LightCons']; ?>;
  var thermCons = <?php echo $row['ThermCons']; ?>;
  var ovenCons = <?php echo $row['OvenCons']; ?>;
  var vacuumCons = <?php echo $row['VacuumCons']; ?>;
  var air_degree = <?php echo $row2['degree']; ?>;
  var therm_degree = <?php echo $row3['degree']; ?>;


</script>

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
          contentDiv.innerHTML = `
          <div class="datetime-container">
            <h3 id="time"></h3>
            <h3 id="date"></h3>
          </div>

          <div class="temp-container">
            <div class="temp" id="termometre"></div>
            <div class="temp" id="therm_temp"></div>
          </div>
        
          <div class="chartStyle" id="c1"><canvas id="myChart"></canvas>
          
          <div class="lightStatus">
          <?php
// database connection
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
      $sql = "SELECT LivingRoom,Kitchen,Bedroom,Bathroom
      FROM `lights`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "<div class='l-echo'> Living Room Status: ".$row['LivingRoom'] . "<br/><br /></div>"; 

      echo "<div class='l-echo'> Kitchen Status: ".$row['Kitchen'] ."<br /><br /></div>"; 

      echo "<div class='l-echo'> Bedroom Status: ".$row['Bedroom'] ."<br /><br /></div>";
      
      echo "<div class='l-echo'>Bathroom Status: ".$row['Bathroom'] ."<br /><br /></div>";
      }
      // close
      $connection->close(); 
      ?>
         </div>
         <div id="empty"></div>`;

     // change canvas element and create a graphic 
     var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: ['Air Conditioner', 'Alarm System', 'Lights', 'Thermostat', 'Oven', 'Vacuum Cleaner'], // title of datas
                datasets: [{
                    label: 'Device Consumption', // title of bar
                    data: [airCons, alarmCons, lightCons, thermCons, ovenCons, vacuumCons], // datas for y axis
                    backgroundColor: 'rgba(0, 123, 255, 0.5)', 
                    borderColor: 'rgba(0, 123, 255, 1)', 
                    borderWidth: 1 
                }]
            },
            options: {
                responsive: true, 
                scales: {
                    y: {
                        beginAtZero: true // y axis start 0
                    }
                }
            }
        });
      

      function updateDateTime() {
        var currentDate = new Date(); // the current time and date

        var year = currentDate.getFullYear(); // take years
        var month = currentDate.getMonth() + 1; // Take months 
        var day = currentDate.getDate(); // take day

        var hour = currentDate.getHours(); // take hours
        var minute = currentDate.getMinutes(); // take minutes
        var second = currentDate.getSeconds(); // take seconds

        var formattedDate = day.toString().padStart(2, '0') + '/' +
                            month.toString().padStart(2, '0') + '/' +
                            year;

        var formattedTime = hour.toString().padStart(2, '0') + ':' +
                            minute.toString().padStart(2, '0') + ':' +
                            second.toString().padStart(2, '0');

        document.getElementById('date').textContent = "Tarih: " + formattedDate; // update date
        document.getElementById('time').textContent = "Saat: " + formattedTime; // update time
      }

      //  date and time change, when page open
      updateDateTime();

      // update time and date per one second
      setInterval(updateDateTime, 1000);

  
      function updateTemperature() {
        var degree =<?php echo $row2['degree']; ?>; //degree from database
        var step = 0.5; // change ratio

      function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
      }

      function updateDegree() {
        degree += getRandomArbitrary(-step, step);
        degree = Math.round(degree * 10) / 10; // 
        return degree;
      }

      var width = 200;
      var height = 300;
      var maxTemperature = 60;

      var svg = d3.select("#termometre")
                    .append("svg")
                    .attr("width", width)
                    .attr("height", height);

    function drawTermometre(degree) {
      var rectHeight = Math.max(((degree + 0.5) / 100) * (height - 42), 0);
      svg.selectAll("*").remove();
      
      // outside
      svg.append("rect")
          .attr("x", width / 2 - 20)
          .attr("y", 20)
          .attr("width", 40)
          .attr("height", height - 40)
          .style("fill", "#ddd")
          .style("stroke", "#999");

      // inside
      svg.append("rect")
          .attr("x", width / 2 - 18)
          .attr("y", height - 22 - rectHeight)
          .attr("width", 36)
          .attr("height", rectHeight)
          .style("fill", "rgba(0, 123, 255, 0.7)");

      // value of degree
      svg.append("text")
          .attr("x", width / 2)
          .attr("y", 12)
          .attr("text-anchor", "middle")
          .style("font-size", "16px")
          .text("Home Temperature: "+degree+ "°C");

      // Degree scale
      var scaleHeight = height - 42;
      var scaleStep = scaleHeight / 10;

      for (var i = 0; i <= 10; i++) {
        var yPos = scaleHeight - i * scaleStep;

        svg.append("line")
          .attr("x1", width / 2 - 20)
          .attr("y1", 20 + yPos)
          .attr("x2", width / 2 - 10)
          .attr("y2", 20 + yPos)
          .style("stroke", "#999");

        svg.append("text")
          .attr("x", width / 2 - 30)
          .attr("y", 24 + yPos)
          .attr("text-anchor", "end")
          .style("font-size", "12px")
          .text((i * 10) + "°");
    }
      // update degree
      degree = updateDegree();

      //update
      setTimeout(function() {
        drawTermometre(degree);
      }, 1000);
    }
    drawTermometre(degree);
  }
  updateTemperature();
  
  function updatethermostatTemperature() {
        var degree =<?php echo $row3['degree']; ?>; //degree from database
        var step = 2; // change ratio

      function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
      }

      function updateDegree() {
        degree += getRandomArbitrary(-step, step);
        degree = Math.round(degree * 10) / 10; // 
        return degree;
      }

      var width = 200;
      var height = 300;

      var svg = d3.select("#therm_temp")
                    .append("svg")
                    .attr("width", width)
                    .attr("height", height);

    function drawTermometre(degree) {
      var rectHeight = Math.max(((degree + 0.5) / 100) * (height - 42), 0);
      svg.selectAll("*").remove();
      
      // outside
      svg.append("rect")
          .attr("x", width / 2 - 20)
          .attr("y", 20)
          .attr("width", 40)
          .attr("height", height - 40)
          .style("fill", "#ddd")
          .style("stroke", "#999");

      // inside
      svg.append("rect")
          .attr("x", width / 2 - 18)
          .attr("y", height - 22 - rectHeight)
          .attr("width", 36)
          .attr("height", rectHeight)
          .style("fill", "rgba(0, 123, 255, 0.7)");

      // value of degree
      svg.append("text")
          .attr("x", width / 2)
          .attr("y", 12)
          .attr("text-anchor", "middle")
          .style("font-size", "16px")
          .text("Water Temperature: "+degree+ "°C");

      // Degree scale
      var scaleHeight = height - 42;
      var scaleStep = scaleHeight / 10;

      for (var i = 0; i <= 10; i++) {
        var yPos = scaleHeight - i * scaleStep;

        svg.append("line")
          .attr("x1", width / 2 - 20)
          .attr("y1", 20 + yPos)
          .attr("x2", width / 2 - 10)
          .attr("y2", 20 + yPos)
          .style("stroke", "#999");

        svg.append("text")
          .attr("x", width / 2 - 30)
          .attr("y", 24 + yPos)
          .attr("text-anchor", "end")
          .style("font-size", "12px")
          .text((i * 10) + "°");
    }
      // update degree
      degree = updateDegree();

      //update
      setTimeout(function() {
        drawTermometre(degree);
      }, 3000);
    }
    drawTermometre(degree);
  }
  updatethermostatTemperature();


  } else if (page === "Airconditioner") {
          contentDiv = document.getElementById("airconditioner");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">AIR CONDITIONER</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
    <button type="submit" name="airconditioner"><?php echo $airConditionerButtonText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT State
      FROM `airconditioner`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "<div class='l-echo'> Airconditioner Status: ".$row['State'] . "<br/>To change please click the button.<br /></div>"; 

      }
      // close
      $connection->close(); 
      ?>
      </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g3">
          <p id="degree">26</p>
          <p id="santi">°C</p>
          <button id="buttonplus" onclick="plus(degree)" style="font-size: larger">+</button>
          <button id="buttonminus" onclick="minus(degree)" style="font-size: larger">-</button>
        </div>
        <div class="g1-style" id="g4">
          <select name="programs" id="programs">
            <option value="none" selected disabled hidden>Select a program</option>
            <option value="program1">Dry Mode</option>
            <option value="program2">Auto Mode</option>
            <option value="program3">Fan Mode</option>
            <option value="program4">Turbo Mode</option>
          </select>
        </div>
        <div class="g1-style" id="g5">
          <p id="mode">Winter mode is active</p>
          <button id="button" onclick="activate(button),toggleBtn2()">Activate summer mode</button>
        </div>
      </div>
      `;
        } else if (page === "Alarm") {
          contentDiv = document.getElementById("alarm");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">ALARM SYSTEM</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
    <button type="submit" name="alarm"><?php echo $alarmButtonText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT State
      FROM `alarm`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "<div class='l-echo'> Alarm System Status: ".$row['State'] . "<br/>To change please click the button.<br /></div>"; 

      }
      // close
      $connection->close(); 
      ?>
       </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g3">
          <p id="mode">The door is locked</p>
            <!-- This button locks/unlocks the door-->
            <button id="button2" onclick="activate(button2),toggleBtn2()">
              Unlocked the Door
            </button>        
        </div>
      </div>
      `;
        } else if (page === "Blinds") {
          contentDiv = document.getElementById("blinds");
          contentDiv.innerHTML = `
          <h1 class="g1-style" id="g1">BLINDS</h1>

<div id="g2-">
  <div id="g2-3" class="g2-style">
    <div>
    <form method="POST" action="">
    <button type="submit" name="LivingRoom"><?php echo $livingRoomText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT LivingRoom
      FROM `lights`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "Living Room State: ".$row['LivingRoom'] . "<br/>To change please click the button."; 

      }
      // close
      $connection->close(); 
      ?>
    </div>
  </div>
  <div id="g2-4" class="g2-style">
    <div>
    <form method="POST" action="">
    <button type="submit" name="Kitchen"><?php echo $KitchenText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT Kitchen
      FROM `lights`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "Kitchen State: ".$row['Kitchen'] . "<br/>To change please click the button."; 

      }
      // close
      $connection->close(); 
      ?>
    </div>
  </div>
  <div id="g2-5" class="g2-style">
    <div>
    <form method="POST" action="">
    <button type="submit" name="Bedroom"><?php echo $BedroomText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT Bedroom
      FROM `lights`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "Bedroom State: ".$row['Bedroom'] . "<br/>To change please click the button."; 

      }
      // close
      $connection->close(); 
      ?>
    </div>
  </div>
  <div id="g2-6" class="g2-style">
    <div>
    <form method="POST" action="">
    <button type="submit" name="Bathroom"><?php echo $BathroomText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT Bathroom
      FROM `lights`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "Bathroom State: ".$row['Bathroom'] . "<br/>To change please click the button."; 

      }
      // close
      $connection->close(); 
      ?>
    </div>
  </div>
</div>

  `;
        } else if (page === "Oven") {
          contentDiv = document.getElementById("oven");
          contentDiv.innerHTML = `
          <h1 class="g1-style" id="g1">OVEN</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
    <button type="submit" name="oven"><?php echo $ovenButtonText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT State
      FROM `oven`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "<div class='l-echo'> Oven Status: ".$row['State'] . "<br/>To change please click the button.<br /></div>"; 

      }
      // close
      $connection->close(); 
      ?>
      </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g4">
          <!-- In this section consumer can change the program of the oven  -->
          <select name="programs" id="programs">
            <option value="none" selected disabled hidden>
              Select a program
            </option>
            <option value="program1">Lower </option>
            <option value="program2">Upper </option>
            <option value="program3">Upper and lower </option>
            <option value="program4">Fan with lower </option>
            <option value="program5">Fan oven</option>
            <option value="program6">Grill</option>
          </select>
        </div>
        <div class="g1-style" id="g5">
          <select name="degree" id="degree">
            <option value="none" selected disabled hidden>
              Select a degree
            </option>
            <option value="degree1">75°C</option>
            <option value="degree2">100°C</option>
            <option value="degree3">150°C</option>
            <option value="degree4">200°C</option>
            <option value="degree5">250°C</option>
          </select>
        </div>
      </div>`;
        } else if (page === "Thermostat") {
          contentDiv = document.getElementById("thermostat");
          contentDiv.innerHTML = `
          <h1 class="g1-style" id="g1">THERMOSTAT</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
    <button type="submit" name="Thermostat"><?php echo $thermostatButtonText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT State
      FROM `thermostat`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "<div class='l-echo'> Thermostat Status: ".$row['State'] . "<br/>To change please click the button.<br /></div>"; 

      }
      // close
      $connection->close(); 
      ?>
      </div>
      <div class="g1-style" id="g">
        <div class="alarm-style" id="g3">
          <!-- In this section we can change the temperature of the thermostat
              with plus and minus buttons -->
              <p id="degree">26</p>
              <p id="santi">°C</p>
              <button id="buttonplus" onclick="plus(degree)">+</button>
              <button id="buttonminus" onclick="minus(degree)">-</button>
        </div>
        <div class="g1-style" id="g4">
          <!-- In this section we can change the mode of the thermostat -->
              <select name="programs" id="programs">
                <option value="none" selected disabled hidden>
                  Select a mode
                </option>
                <option value="program1">Auto</option>
                <option value="program2">AI</option>
                <option value="program3">Service</option>
              </select>
        </div>
        <div class="g1-style" id="g5">
        <?php
// database connection
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
      $sql = "SELECT WaterLevel
      FROM `thermostat`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "Water Pressure : ".$row['WaterLevel'] . " bar<br/>"; 

      }
      // close
      $connection->close(); 
      ?>
        </div>
      </div>`;
        } else if (page === "Vacuum") {
          contentDiv = document.getElementById("vacuum");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">VACUUM CLEANER</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
    <button type="submit" name="vacuumcleaner"><?php echo $vacuumCleanerButtonText; ?></button>
  </form>
  <?php
// database connection
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
      $sql = "SELECT State
      FROM `vacuumcleaner`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "<div class='l-echo'> Vacuum Cleaner Status: ".$row['State'] . "<br/>To change please click the button.<br /></div>"; 

      }
      // close
      $connection->close(); 
      ?>
          </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g3">
          <!-- In this section consumer can see the charge of the vacuum -->
          <?php
// database connection
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
      $sql = "SELECT Charge
      FROM `vacuumcleaner`
      WHERE DeviceID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);
 
      echo "Charge : ".$row['Charge'] . "%<br/>"; 

      }
      // close
      $connection->close(); 
      ?>
        </div>
        <div class="g1-style" id="g4">
          <select name="programs" id="programs">
                <!-- In this section consumer can change the program of the vacuum -->
                <option value="none" selected disabled hidden>
                  Select a program
                </option>
                <option value="program1">Normal Vacuum</option>
                <option value="program2">Turbo Vacuum</option>
                <option value="program3">Mopping with water</option>
                <option value="program4">Mopping with soap</option>
              </select>
        </div>
      </div>
      `;
        } else {
          contentDiv = document.getElementById("consumption-p");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">CONSUMPTION</h1>
      <div id="consumption-text">
      <?php
// database connection
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
      loadContent('Home')
      // Here we get our variables by their id's to use in the functions
      var btn1 = document.getElementById("onoffbutton");
      var btn2 = document.getElementById("button");

      // This function simply changes the text of the button when clicked on it
      function turnOff(button) {
        if (button.innerHTML == "TURN OFF") {
          button.innerHTML = "TURN ON";
        } else {
          button.innerHTML = "TURN OFF";
        }
      }

      // Toggle functions are used to change the background colors when clicked on them
      function toggleBtn1() {
        btn1.classList.toggle("active1");
      }

      function toggleBtn2() {
        btn2.classList.toggle("active2");
      }

      // This function, same as the turnOff, will activate summer or winter mode
      // by changing their innerHTML
      function activate(id) {
        if (id.innerHTML == "Activate winter mode") {
          id.innerHTML = "Activate summer mode";
          x = document.getElementById("mode").innerHTML =
            "Winter mode is active";
        } else if (id.innerHTML == "Activate summer mode") {
          id.innerHTML = "Activate winter mode";
          x = document.getElementById("mode").innerHTML =
            "Summer mode is active";
        } else if (id.innerHTML == "Unlocked the Door") {
          id.innerHTML = "Locked the Door";
          document.getElementById("mode").innerHTML = "The door is unlocked !!";
        } else {
          id.innerHTML = "Unlocked the Door";
          document.getElementById("mode").innerHTML = "The door is locked";
        }
      }
      // In this function, we provide the changes on the temperature
      // by clicking plus and minus buttons
      function plus(id) {
        var a = parseInt(id.innerHTML);
        a += 1;
        id.innerHTML = a;
      }
      function minus(id) {
        var a = parseInt(id.innerHTML);
        a -= 1;
        id.innerHTML = a;
      }
    </script>
  </body>
    </php>