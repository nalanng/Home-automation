<!DOCTYPE php>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="producer.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://d3js.org/d3.v7.min.js"></script>
</head>
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
#airstate {
  font-size: 35px;
  text-align: center;
  padding-bottom: 10px;
  border-bottom: 1px solid rgba(143, 211, 244, 0.5);
}
#blind-p {
    font-size: 35px;
    text-align: center;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(143, 211, 244, 0.5);
  }
  #oven-p {
    font-size: 35px;
    text-align: center;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(143, 211, 244, 0.5);
  }
  #thermostat-p {
    font-size: 35px;
    text-align: center;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(143, 211, 244, 0.5);
  }
  #alarm-p {
    font-size: 35px;
    text-align: center;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(143, 211, 244, 0.5);
  }
  #vacuum-p {
    font-size: 35px;
    text-align: center;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(143, 211, 244, 0.5);
  }

div#consumption-p.content{
  padding: 20px;
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
      $sql1 = "SELECT LivingRoom,Kitchen,Bedroom,Bathroom
      FROM `lights`
      WHERE DeviceID=1"; 
      
      $result1 = mysqli_query($connection, $sql1); 

      if (mysqli_num_rows($result1) > 0) { 
      $row1 = mysqli_fetch_assoc($result1);
      }
      
      $state1=$row1['LivingRoom'];
      $state2=$row1['Kitchen'];
      $state3=$row1['Bedroom'];
      $state4=$row1['Bathroom']; 
      if($state1=="On") {
        $sql3 = "UPDATE `consumption` SET LightCons=LightCons*1.03";
        mysqli_query($connection, $sql3);
      }
      if($state2=="On") {
        $sql4 = "UPDATE `consumption` SET LightCons=LightCons*1.03";
        mysqli_query($connection, $sql4);
      } 
      if($state3=="On") {
        $sql5 = "UPDATE `consumption` SET LightCons=LightCons*1.03";
        mysqli_query($connection, $sql5);
      }
      if($state4=="On") {
        $sql6 = "UPDATE `consumption` SET LightCons=LightCons*1.03";
        mysqli_query($connection, $sql6);
      }
        // close
    $connection->close();
?>

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
          <?php
// Database Connection
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
      $sql = "SELECT *
              FROM `airconditioner` 
              WHERE ConsumptionID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);

      }
    
      ?>

      <h1 class="g1-style mb-5" id="g1">AIR CONDITIONER</h1>
      <div class="g1-style mb-4" id="g2">
      <p class="mb-5" id="airstate">The air conditioner is "<?php echo $row['State'] ?>"</p>
      </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g3">
        <p class="mb-5" id="airstate">The degree is set to "<?php echo $row['Degree'] ?>"</p>
        </div>
        <p class="mb-5" id="airstate">Selected program is "<?php echo $row['Program'] ?>"</p>
        </div>
        <div class="g1-style" id="g5">
        <p class="mb-5" id="airstate">Activated mode is "<?php echo $row['Mode'] ?>"</p>
        </div>
      </div>
      `;
        } else if (page === "Alarm") {
          contentDiv = document.getElementById("alarm");
          contentDiv.innerHTML = `
          <?php
// Database Connection
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
      $sql = "SELECT *
              FROM `alarm` 
              WHERE ConsumptionID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);

      }
    
      ?>
      <h1 class="g1-style" id="g1">ALARM SYSTEM</h1>
      <div class="g1-style" id="g2">
      <p id="alarm-p">The alarm syatem is <?php echo $row['State'] ?> </p>
      </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g3">
        <p id="alarm-p">The door is <?php echo $row['DoorState'] ?> </p>
            </button>        
        </div>
      </div>
      `;
        } else if (page === "Blinds") {
          contentDiv = document.getElementById("blinds");
          contentDiv.innerHTML = `
          <?php
// Database Connection
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
      $sql = "SELECT *
              FROM `lights` 
              WHERE ConsumptionID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);

      }
    
      ?>
          <h1 class="g1-style mb-5" id="g1">BLINDS</h1>
<div id="g2-" class="mb-5">
  <div id="g2-3" class= "g2-style mb-5">
    <div>
      <div><p id="blind-p" style="font-size:xx-large;">Living Room's blinds are "<?php echo $row['LivingRoom'] ?>"</p></div>
    </div>
  </div>
  <div id="g2-4" class="g2-style mb-5">
    <div
      <div><p id="blind-p"style="font-size:xx-large;">Kitchen's blinds are "<?php echo $row['Kitchen'] ?>"</p></div>
    </div>
  </div>
  <div id="g2-5" class="g2-style mb-5">
    <div>
      <div><p id="blind-p" style="font-size:xx-large;">Bedroom' blinds are "<?php echo $row['Bedroom'] ?>"</p></div>
    </div>
  </div>
  <div id="g2-6" class="g2-style mb-5">
    <div>
      <div><p id="blind-p"style="font-size:xx-large;">Bathroom's blinds are "<?php echo $row['Bathroom'] ?>"</p></div>
    </div>
  </div>
</div>

  `;
        } else if (page === "Oven") {
          contentDiv = document.getElementById("oven");
          contentDiv.innerHTML = `
          <?php
// Database Connection
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
      $sql = "SELECT *
              FROM `oven` 
              WHERE ConsumptionID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);

      }
    
      ?>
          <h1 class="g1-style mb-5" id="g1">OVEN</h1>
      <div class="g1-style mb-5" id="g2">
        <p id="oven-p"
          style="font-size: xx-large"
        >
          Oven is "<?php echo $row['State'] ?>"
        </p>
      </div>
        <div class="g1-style mb-5" id="g4">
        <p id="oven-p"
          style="font-size: xx-large"
        >
          Oven is turned on with the program "<?php echo $row['Program'] ?>"
        </p>
        </div>
        <div class="g1-style mb-5" id="g5">
        <p id="oven-p"
          style="font-size: xx-large"
        >
        Oven is turned on with the degree "<?php echo $row['Degree'] ?>"
        </p>
        </div>
      </div>`;
        } else if (page === "Thermostat") {
          contentDiv = document.getElementById("thermostat");
          contentDiv.innerHTML = `
          <?php
// Database Connection
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
      $sql = "SELECT *
              FROM `thermostat` 
              WHERE ConsumptionID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);

      }
    
      ?>
          <h1 class="g1-style mb-5" id="g1">THERMOSTAT</h1>
      <div class="g1-style mb-5" id="g2">
      <p id="thermostat-p">Thermostat is "<?php echo $row['State'] ?>" </p>
      </div>
      <div class="g1-style mb-5" id="g">
        <div class="alarm-style mb-5" id="g3">
        <p id="thermostat-p">Thermostat' degree is set to "<?php echo $row['Degree'] ?>" </p>
        </div>
        <div class="g1-style mb-5" id="g4">
        <p id="thermostat-p">Thermostat's mode is set to"<?php echo $row['Mode'] ?>" </p>
        </div>
        <div class="g1-style mb-5" id="g5">
        <p id="thermostat-p">Thermostat's water level is"<?php echo $row['WaterLevel'] ?>" </p>
        </div>
      </div>`;
        } else if (page === "Vacuum") {
          contentDiv = document.getElementById("vacuum");
          contentDiv.innerHTML = `
          <?php
// Database Connection
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
      $sql = "SELECT *
              FROM `vacuumcleaner` 
              WHERE ConsumptionID=1"; 
      
      $result = mysqli_query($connection, $sql); 

      if (mysqli_num_rows($result) > 0) { 

      $row = mysqli_fetch_assoc($result);

      }
    
      ?>          
      <h1 class="g1-style" id="g1">VACUUM CLEANER</h1>
      <div class="g1-style" id="g2">
      <p id="vacuum-p">The vaccum cleaner is "<?php echo $row['State'] ?>"</p>
      </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g3">
          <!-- In this section consumer can see the charge of the vacuum -->
              <p id="vacuum-p"> Charge: <?php echo $row['Charge'] ?> </p>
        </div>
        <div class="g1-style" id="g4">
        <p id="vacuum-p">Selected program is "<?php echo $row['Program'] ?>" </p>
        </div>
      </div>
      `;
        } else {
          contentDiv = document.getElementById("consumption-p");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">CONSUMPTION</h1>
      <div id="consumption-text">
      <?php
// Database connection
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  </body>
    </php>

    