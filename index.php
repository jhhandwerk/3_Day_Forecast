<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="style.css">

<!--map-->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=[API Key]&callback=initMap&libraries=&v=weekly"></script>
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

<video autoplay muted loop id="myVideo">
  <source src="img/rain_on_leaves.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>


<!--weather-->
<?php
error_reporting(0);
$get = json_decode(file_get_contents('http://ip-api.com/json/'),true);


date_default_timezone_set($get['timezone']);
 $city = $_GET['q'];
 $string =  "http://api.openweathermap.org/data/2.5/forecast?zip=".$city.",jp&units=metric&appid=d21182cea448ccd30b383aa34b9af45a";


 
 $data = json_decode(file_get_contents($string),true);

 $dayA = $data['list'][0]['dt_txt'];
 $dayB = $data['list'][8]['dt_txt'];
 $dayC = $data['list'][16]['dt_txt'];


 $descA = $data['list'][0]['weather'][0]['description'];
 $descB = $data['list'][8]['weather'][0]['description'];
 $descC = $data['list'][16]['weather'][0]['description'];

 $tempA = $data['list'][0]['main']['temp'];
 $tempB = $data['list'][8]['main']['temp'];
 $tempC = $data['list'][16]['main']['temp'];
 
 $temp_minA = $data['list'][0]['main']['temp_min'];
 $temp_maxA = $data['list'][0]['main']['temp_max'];
 $temp_minB = $data['list'][8]['main']['temp_min'];
 $temp_maxB = $data['list'][8]['main']['temp_max'];
 $temp_minC = $data['list'][16]['main']['temp_min'];
 $temp_maxC = $data['list'][16]['main']['temp_max'];

 //i fixed the one below and made the following 2
 $iconA = $data['list'][0]['weather'][0]['icon'];
 $iconB = $data['list'][8]['weather'][0]['icon'];
 $iconC = $data['list'][16]['weather'][0]['icon'];

 $country =  "<h1><b>".$data['city']['name']."...".$data['city']['country']."</h1></b>";
 
 $logoA = "<center><img src='http://openweathermap.org/img/w/".$iconA.".png'></center>";
 $logoB = "<center><img src='http://openweathermap.org/img/w/".$iconB.".png'></center>";
 $logoC = "<center><img src='http://openweathermap.org/img/w/".$iconC.".png'></center>";
 
 $dateA = "<b>".$dayA."</br>";
 $dateB = "<b>".$dayB."</br>";
 $dateC = "<b>".$dayC."</br>";
 $descriptionA = "<b>".$descA."</b><br>";
 $descriptionB = "<b>".$descB."</b><br>";
 $descriptionC = "<b>".$descC."</b><br>";
 $temperatureA =  "<b>Current Temperature: ".$tempA."°C</b><br>";
 $temperatureB =  "<b>Current Temperature: ".$tempB."°C</b><br>";
 $temperatureC =  "<b>Current Temperature: ".$tempC."°C</b><br>";
 $max_tempA = "<b>Daily High: ".$temp_maxA."°C</b><br>";
 $low_tempA = "<b>Daily Low: ".$temp_minA."°C</b><br>";
 $max_tempB = "<b>Daily High: ".$temp_maxB."°C</b><br>";
 $low_tempB = "<b>Daily Low: ".$temp_minB."°C</b><br>";
 $max_tempC = "<b>Daily High: ".$temp_maxC."°C</b><br>";
 $low_tempC = "<b>Daily Low: ".$temp_minC."°C</b><br>";
 ?>




<!--form for weather-->
<div class="content">
<form class="example" method="GET" action="index.php" style="margin:auto;max-width:350px">
<h2>Enter a postal code</h2>
<label>Search Weather</label>
<input type="textbox" value="532-0013" name="q" required>
<button type="submit" class="fa fa-search">Search</button>
</form>


<!--form for map-->
<form class="example" method="GET" action="index.php" style="margin:auto;max-width:350px">
<label>Search Map</label>  
<input id="address" type="textbox" value="532-0013" name="q" required>
<button id="find"  type="button" class="fa fa-search">Search</button>
</form>
</div>
</div>

<!--weather display content-->
<div class = "content2">
<h3>
    <?php 
    echo $country; 
    echo "<center><h2>".$desc."</h1></center>";
    ?>
</h3> 
</div>
  
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
       <h1><?php echo $dateA;?></h1>
       <h2><?php echo $descriptionA;?></h2>
      <?php echo $logoA;?>
    <h2>
      <?php echo $temperatureA; ?>
      <?php echo $max_tempA;?>
      <?php echo $low_tempA;?>
    </h2>
    </div>
    <div class="flip-card-back">
      <h1>Have a nice day</h1> 
      <p>No matter what the weather...</p> 
      <p>it's gonna be great.</p>
    </div>
  </div>
</div>
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
    <h1><?php echo $dateB;?></h1>
    <h2><?php echo $descriptionB;?></h2>
    <?php echo $logoB;?>
    <h2>
    <?php echo $max_tempB;?>
    <?php echo $low_tempB;?>
    </h2>
    </div> 
    <div class="flip-card-back">
      <h1>Have a nice day tomorrow</h1> 
      <p>No matter what the weather...</p> 
      <p>it's gonna be great.</p>
    </div>
  </div>
</div>
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
    <h1><?php echo $dateC;?></h1>
    <h2><?php echo $descriptionC;?></h2>
    <?php echo $logoC;?>
    <h2>
    <?php echo $max_tempC;?>
    <?php echo $low_tempC;?> 
    </h2>
    </div>
    <div class="flip-card-back">
      <h1>Have a nice day everyday</h1> 
      <p>No matter what the weather...</p> 
      <p>it's gonna be great.</p>
    </div>
  </div>
</div>

<!--map display-->
<div class="row2">
  <div class="column2">
    <div id="map"></div>
 </div>
</div>



</body>
</html>
