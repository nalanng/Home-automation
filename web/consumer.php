<!DOCTYPE php>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="consumer.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
}
div.chartStyle {
  height: 280;
}
.datetime-container {
  position: fixed;
  top: 75px;
  right: 65px;
  font-size: 18px;
  color: #000;
  text-align: center;
  }    

</style>
  <body>
    <header class="consumer" id="header">
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
      // close
      $connection->close(); 
?>

  var airCons = <?php echo $row['AirCons']; ?>;
  var alarmCons = <?php echo $row['AlarmCons']; ?>;
  var lightCons = <?php echo $row['LightCons']; ?>;
  var thermCons = <?php echo $row['ThermCons']; ?>;
  var ovenCons = <?php echo $row['OvenCons']; ?>;
  var vacuumCons = <?php echo $row['VacuumCons']; ?>;
  var air_degree = <?php echo $row2['degree']; ?>

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
          <div id="termometre"></div>
          <div class="chartStyle" id="c1"><canvas id="myChart"></canvas>`;

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

  
          contentDiv = document.getElementById("airconditioner");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">AIR CONDITIONER</h1>
      <div class="g1-style" id="g2">
        <button id="onoffbutton" onclick="turnOff(this),toggleBtn1()" style="font-size: xx-large">TURN ON</button>
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
        <button id="onoffbutton" onclick="turnOff(this),toggleBtn1()" style="font-size: xx-large">TURN ON</button>
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
      <div><button id="onoffbutton" onclick="turnOff(this),toggleBtn1()" style="font-size: xx-large">TURN ON</button></div>
      <div><p style="font-size: medium;">Living Room</p></div>
    </div>
  </div>
  <div id="g2-4" class="g2-style">
    <div>
      <div><button id="onoffbutton" onclick="turnOff(this),toggleBtn1()" style="font-size: xx-large">TURN ON</button></div>
      <div><p style="font-size: medium;">Kitchen</p></div>
    </div>
  </div>
  <div id="g2-5" class="g2-style">
    <div>
      <div><button id="onoffbutton" onclick="turnOff(this),toggleBtn1()" style="font-size: xx-large">TURN ON</button></div>
      <div><p style="font-size: medium;">Bedroom</p></div>
    </div>
  </div>
  <div id="g2-6" class="g2-style">
    <div>
      <div><button id="onoffbutton" onclick="turnOff(this),toggleBtn1()" style="font-size: xx-large">TURN ON</button></div>
      <div><p style="font-size: medium;">Bathroom</p></div>
    </div>
  </div>
</div>

  `;
        } else if (page === "Oven") {
          contentDiv = document.getElementById("oven");
          contentDiv.innerHTML = `
          <h1 class="g1-style" id="g1">OVEN</h1>
      <div class="g1-style" id="g2">
        <button
          id="onoffbutton"
          onclick="turnOff(this),toggleBtn1()"
          style="font-size: xx-large"
        >
          TURN ON
        </button>
      </div>
      <div class="g1-style" id="g">
        <div class="alarm-style" id="g3">
          <p>
            "Oven will be turned on <br />
            with the selections <br />
            you clicked"
          </p>
        </div>
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
        <button
          id="onoffbutton"
          onclick="turnOff(this),toggleBtn1()"
          style="font-size: xx-large"
        >
          TURN ON
        </button>
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
          <!-- In this section user can see the water level -->
              <p>Water Level</p>
              <p>98 CM</p>
        </div>
      </div>`;
        } else if (page === "Vacuum") {
          contentDiv = document.getElementById("vacuum");
          contentDiv.innerHTML = `
      <h1 class="g1-style" id="g1">VACUUM CLEANER</h1>
      <div class="g1-style" id="g2">
        <button id="onoffbutton" onclick="turnOff(this),toggleBtn1()" style="font-size: xx-large">TURN ON</button>
      </div>
      <div class="g1-style" id="g">
        <div class="g1-style" id="g3">
          <!-- In this section consumer can see the charge of the vacuum -->
              <p>Charge: 78%</p>
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
      loadContent("Home");
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