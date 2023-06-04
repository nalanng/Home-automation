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

    .datetime-container{
      transform: translate(-40px,10px);

    }
    div#home.content{
      transform: translateY(270px);
    }
    .temp-container{
      transform: translate(-53px,-100px);
    }
    .content{
      text-align: center;
    }
    .lightStatus{
      top: -250px;
      left: 17%;
    }
    #airconditioner.content{
      transform: translateY(60px);
      font-size: larger;
    }
    #airconditioner.content h1{
      transform: translateY(-60px);
    }
    #alarm.content{
      transform: translateY(60px);
      font-size: larger;
    }
    #alarm.content h1{
      transform: translateY(-60px);
    }
    #blinds.content{
      font-size: larger;
    }
    #oven.content{
      font-size: larger;
    }
    #thermostat.content{
      font-size: larger;
    }
    #vacuum.content{
      transform: translateY(60px);
      font-size: larger;
    }
    #vacuum.content h1{
      transform: translateY(-60px);
    }
    #consumption-p.content{
      transform: translate(30px,350px);
      font-size: medium;
    }
}
#empty{
  height: 100px;
}
#menu{
  z-index: 1;
}
button[type="submit"] {
  height: 30px;
  width: 70px;
  background-color: rgb(168, 169, 222);
  border-radius: 5px;
}
</style>
  <body>
    <header class="consumer" id="header">
      <ul>
        <li>
          <a href="#" id="logo">SNautomation</a>
        </li>
        <li><a href="#" id="home-p" onclick="loadContent('Home')">Home </a></li>
        <li><a href="homepage.html" id="signOut">Sign Out</a></li>
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
if (isset($_POST['livingroom'])) {
  updateLightsState("livingroom", $LivingRoomState, $livingRoomText);
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
    <button type="submit" name="airconditioner">ON/OFF</button>
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
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web-home-automation";

        $connection = new mysqli($servername, $username, $password, $dbname);

        if ($connection->connect_error) {
            die("Database connection failed: " . $connection->connect_error);
        }

        // Dereceyi güncelle
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["air_degree"])) {
                $newDegree = $_POST["degree"];

                // Veritabanında dereceyi güncelle
                $updateQuery = "UPDATE airconditioner SET degree='$newDegree' WHERE DeviceID=1";
                if ($connection->query($updateQuery) === TRUE) {
                    echo "Degree updated successfully";
                } else {
                    echo "Error updating degree: " . $connection->error;
                }
            }
        }

        // Veritabanından dereceyi al
        $sql = "SELECT degree FROM airconditioner WHERE DeviceID=1";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentDegree = $row['degree'];
            echo  $currentDegree . "°C<br/>";
        }

        $connection->close();
        ?>
        <form method="POST" action="">
            <input type="number" name="degree" id="degree" value="<?php echo $currentDegree; ?>" min="0" max="100" step="1">
            <button type="submit" name="air_degree">Update</button>
        </form>
        </div>
        <div class="g1-style" id="g4">
        <?php
          $host = "localhost";
          $db = "web-home-automation";
          $user = "root";
          $password = "";

          $baglanti = new mysqli($host, $user, $password, $db);

          if ($baglanti->connect_error) {
            die("MySQL bağlantı hatası: " . $baglanti->connect_error);
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Seçilen programı al
            $selectedProgram = $_POST['programs'];

            // Veritabanında güncelleme yap
            $updateQuery = "UPDATE airconditioner SET program='$selectedProgram' WHERE DeviceID = 1";

            if ($baglanti->query($updateQuery) === TRUE) {
              echo "";
            } else {
              echo "Hata: " . $baglanti->error;
            }
          }
        ?>
        <form method="POST" action="">
        <select name="programs" id="programs">
          <option value="none" selected disabled hidden>Select a program</option>
          <option value="Dry">Dry Mode</option>
          <option value="Auto">Auto Mode</option>
          <option value="Fan">Fan Mode</option>
          <option value="Turbo">Turbo Mode</option>
          <option value="Winter">Winter Mode</option>
          <option value="Summer">Summer Mode</option>
        </select>
        <button type="submit">Update</button>
      </form>
        </div>
      </div>
      `;
        } else if (page === "Alarm") {
          contentDiv = document.getElementById("alarm");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">ALARM SYSTEM</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
    <button type="submit" name="alarm">ON/OFF</button>
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
    <button type="submit" name="livingroom">ON/OFF</button>
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
    <button type="submit" name="Kitchen">ON/OFF</button>
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
    <button type="submit" name="Bedroom">ON/OFF</button>
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
    <button type="submit" name="Bathroom">ON/OFF</button>
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
        }else if (page === "Oven") {
          contentDiv = document.getElementById("oven");
          contentDiv.innerHTML = `
          <h1 class="g1-style" id="g1">OVEN</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
        <button type="submit" name="oven">ON/OFF
        </button>
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
              <?php
        $host = "localhost";
        $db = "web-home-automation";
        $user = "root";
        $password = "";

        $baglanti = new mysqli($host, $user, $password, $db);

        if ($baglanti->connect_error) {
            die("ERROR: " . $baglanti->connect_error);
        }
            if (isset($_POST["programUpdate"])) {
                $selectedProgram = $_POST["programs"];
                
                $updateQuery = "UPDATE oven SET program='$selectedProgram' WHERE DeviceID = 1";
                if ($baglanti->query($updateQuery) === TRUE) {
                    echo "";
                } else {
                    echo "ERROR: " . $baglanti->error;
                }
            }

            if (isset($_POST["degreeUpdate"])) {
                $selectedDegree = $_POST["degree"];
                
                $updateQuery = "UPDATE oven SET degree=$selectedDegree WHERE DeviceID = 1";
                if ($baglanti->query($updateQuery) === TRUE) {
                    echo "";
                } else {
                    echo "ERROR: " . $baglanti->error;
                }
            }

      ?>
                <div class="g1-style" id="g4">
                  <!-- In this section consumer can change the program of the oven  -->
                  <form method="POST" action="">
                   <select name="programs" id="programs">
                    <option value="none" selected disabled hidden>Select Program</option>
                    <option value="Lower">Lower</option>
                    <option value="Upper">Upper</option>
                    <option value="Upper and Lower">Upper and lower</option>
                    <option value="Fan with Lower">Fan with lower</option>
                    <option value="Fan Oven">Fan oven</option>
                    <option value="Grill">Grill</option>
                  </select>
                   <button type="submit" name="programUpdate">Update</button>
                 </form>
        </div>
        <div class="g1-style" id="g5">
            <form method="POST" action="">
                <label for="degree">Degree:</label>
                <input type="number" name="degree" id="degree" min="0" max="250">
                <button type="submit" name="degreeUpdate">Update</button>
            </form>


        </div>
      </div>`;
        } else if (page === "Thermostat") {
          contentDiv = document.getElementById("thermostat");
          contentDiv.innerHTML = `
          <h1 class="g1-style" id="g1">THERMOSTAT</h1>
      <div class="g1-style" id="g2">
      <form method="POST" action="">
    <button type="submit" name="thermostat">ON/OFF</button>
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
          
        </div>
        <div class="g1-style" id="g4">
          <!-- In this section we can change the mode of the thermostat -->
          <?php
          $host = "localhost";
          $db = "web-home-automation";
          $user = "root";
          $password = "";

          $baglanti = new mysqli($host, $user, $password, $db);

          if ($baglanti->connect_error) {
            die("MySQL bağlantı hatası: " . $baglanti->connect_error);
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Seçilen programı al
            $selectedProgram = $_POST['programs'];

            // Veritabanında güncelleme yap
            $updateQuery = "UPDATE thermostat SET Mode ='$selectedProgram' WHERE DeviceID = 1";

            if ($baglanti->query($updateQuery) === TRUE) {
              echo "";
            } else {
              echo "Hata: " . $baglanti->error;
            }
          }
        ?>
        <form method="POST" action="">
        <select name="programs" id="programs">
                <option value="none" selected disabled hidden>
                  Select a mode
                </option>
                <option value="Auto">Auto</option>
                <option value="AI">AI</option>
                <option value="Service">Service</option>
              </select>
        <button type="submit">Update</button>
      </form>
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
    <button type="submit" name="vacuumcleaner">ON/OFF</button>
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
 
      echo "<div class='echo'> Air Condition Consumption: ".$row['AirCons'] . " Watt<br/><br /></div>"; 

      echo "<div class='echo'> Alarm System Consumption: ".$row['AlarmCons'] ." Watt<br /><br /></div>"; 

      echo "<div class='echo'> Lights Consumption: ".$row['LightCons'] ." Watt<br /><br /></div>";
      
      echo "<div class='echo'>Thermostat Consumption: ".$row['ThermCons'] ."Watt<br /><br /></div>";

      echo "<div class='echo'> Oven Consumption: ".$row['OvenCons'] ." Watt<br /><br /></div>";

      echo "<div class='echo'> Vacuum Cleaning Consumption: ".$row['VacuumCons'] ." Watt<br /><br /></div>";

      //total concumption
      $total = $row['AirCons'] + $row['AlarmCons'] + $row['LightCons'] + $row['ThermCons'] + $row['OvenCons'] + $row['VacuumCons'];
  echo "<div class='echo' id='total'> Total Consumption: " . $total . " Watt</div>";
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
    </script>
  </body>
    </php>