
<!DOCTYPE html>
<html>
<head><title>Report of <?php echo $_GET['q']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<link rel="stylesheet" href="style.css">

  <!--map code-->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script defer 
      src="https://maps.googleapis.com/maps/api/js?key=[API Key]&callback=initMap&libraries=&v=weekly">
    </script>
    
<style>
  /*style for map*/
 #map {
        height: 100%;
      }
/* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: "Roboto", "sans-serif";
        line-height: 30px;
        padding-left: 10px;
      }
.btn {
  background-color: #f4511e;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
}
.btn:hover {opacity: 1}
</style>

<!--map script-->
<script>
      "use strict";

      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: {
            lat: -34.397,
            lng: 150.644
          }
        });
        const geocoder = new google.maps.Geocoder();
        document.getElementById("find").addEventListener("click", () => {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        const address = document.getElementById("address").value;
        geocoder.geocode(
          {
            address: address
          },
          (results, status) => {
            if (status === "OK") {
              resultsMap.setCenter(results[0].geometry.location);
              new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
              });
            } else {
              alert(
                "Geocode was not successful for the following reason: " + status
              );
            }
          }
        );
      }
    </script>


</head>

<body>

<div>
<!--form for weather-->
<form class="example" method="GET" action="index.php" style="margin:auto;max-width:350px">
<h2>Find the weather and a map using a postal code</h2>
<label>Search Weather</label>
<input type="textbox" value="532-0013" name="q" required>
<button type="submit" class="fa fa-search">Search</button>
</form>
</div>

<!--form for map-->
<div>
<form class="example" method="GET" action="index.php" style="margin:auto;max-width:350px">
<label>Search Map</label>  
<input id="address" type="textbox" value="532-0013" name="q" required>
<button id="find"  type="button" class="fa fa-search">Search</button>
</form>
</div>

<?php
error_reporting(0);
$get = json_decode(file_get_contents('http://ip-api.com/json/'),true);


date_default_timezone_set($get['timezone']);
 $city = $_GET['q'];
 $string =  "http://api.openweathermap.org/data/2.5/forecast?zip=".$city.",jp&units=metric&cnt=3&appid=[API Key]";

 $data = json_decode(file_get_contents($string),true);

 $temp = $data['list'][0]['main']['temp'];
 $temp2 = $data['list'][1]['main']['temp'];
 $temp3 = $data['list'][2]['main']['temp'];
 
 $temp_minA = $data['list'][0]['main']['temp_min'];
 $temp_maxA = $data['list'][0]['main']['temp_max'];
 $temp_minB = $data['list'][1]['main']['temp_min'];
 $temp_maxB = $data['list'][1]['main']['temp_max'];
 $temp_minC = $data['list'][2]['main']['temp_min'];
 $temp_maxC = $data['list'][2]['main']['temp_max'];

 //i fixed the one below and made the following 2
 $iconA = $data['list'][0]['weather'][0]['icon'];
 $iconB = $data['list'][1]['weather'][0]['icon'];
 $iconC = $data['list'][2]['weather'][0]['icon'];

 $country =  "<h1><b>".$data['city']['name']."...".$data['city']['country']."</h1></b>";
 
 $logoA = "<center><img src='http://openweathermap.org/img/w/".$iconA.".png'></center>";
 $logoB = "<center><img src='http://openweathermap.org/img/w/".$iconB.".png'></center>";
 $logoC = "<center><img src='http://openweathermap.org/img/w/".$iconC.".png'></center>";
 
 $temperature =  "<b>Current Temperature: ".$temp."°C</b><br>";
 $temperature2 =  "<b>Current Temperature: ".$temp2."°C</b><br>";
 $temperature3 =  "<b>Current Temperature: ".$temp3."°C</b><br>";
 $max_tempA = "<b>Daily High: ".$temp_maxA."°C</b><br>";
 $low_tempA = "<b>Daily Low: ".$temp_minA."°C</b><br>";
 $max_tempB = "<b>Daily High: ".$temp_maxB."°C</b><br>";
 $low_tempB = "<b>Daily Low: ".$temp_minB."°C</b><br>";
 $max_tempC = "<b>Daily High: ".$temp_maxC."°C</b><br>";
 $low_tempC = "<b>Daily Low: ".$temp_minC."°C</b><br>";
 ?>

	

  <h2>

		<?php 
		echo $country; 
		echo "<center><h2>".$desc."</h1></center>";
		?>


	</h2>

<div class="row">
  <div class="column" style="background-color:#a0d2eb;">
    <h1>Today</h1>
      <?php echo $logoA;?>
    <h2>
      <?php echo $temperature; ?>
      <?php echo $max_tempA;?>
      <?php echo $low_tempA;?>
    </h2>
    	
  </div>
  <div class="column" style="background-color:#d0bdf4;">
    <h1>Tomorrow</h1>
    <?php echo $logoB;?>
    <h2>
    <?php echo $temperature2; ?>
    <?php echo $max_tempB;?>
    <?php echo $low_tempB;?>
    </h2>
    		
  </div>
  <div class="column" style="background-color:#8458B3;">
    <h1>The next day</h1>
    <?php echo $logoC;?>
    <h2>
    <?php echo $temperature3; ?>
    <?php echo $max_tempC;?>
    <?php echo $low_tempC;?> 
    </h2>
   						
  </div>
</div>


<div class="row2">
  <div class="column2" style="background-color:black;">
 
    <div id="map"></div>
 </div>
  
  <div class="column2" style="background-color:#001f3f;">
    <h2>Something Interesting!!!</h2>
    <p>Some text..</p>
  </div>
</div>
-->
</body>
</html>
