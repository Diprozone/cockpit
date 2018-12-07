<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/semantic.cyborg.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1 class="title">Cockpit</h1>
<div class="ui container">

<div id="googleMap" style="width:100%;height:400px;"></div>
<br>
  <div class="ui cards">
    <div class="ui link card" style="width: 48.8%">
      <div class="content">
        <a class="header">Caméra</a>
        <img src="img/nosignal.jpg" style="width: 100%; height: 100%;">
      </div>
    </div>
    <div class="ui link card">
      <div class="content">
        <a class="header">Position</a>
        <div class="meta">
          <span class="date">Coordonnées actuelles</span>
        </div>
        <div class="description">Latitude: <pre>36.056413</pre><br>Longitude: <pre>-5.498693</pre></div>
      </div>
    </div>
    <div class="ui link card">
      <div class="content">
        <a class="header">Météo</a>
        <div class="meta">
          <span class="date">Position actuelle</span>
        </div>
        <div class="description"><b><?= date('d M Y') ?> </b><br>Matin: <pre>18°C</pre><br>Midi: <pre>30°C</pre><br>Soir: <pre>15°C</pre><br><i>Temps sec, très aride, il est conseillé de bien boire de l'eau la journée afin d'éviter une déshydratation</i> <br><br><b>Demain: </b>24°C<br><i>Un crachin sera a prévoir</i></div>
      </div>
    </div>
  </div>
</div>
<script>
    function myMap() {
      var mapProp= {
        center:new google.maps.LatLng(36.056413, -5.498693),
        zoom:15,
      };
      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9JfvWTB6yvryw04uG5b7WVe_0SaaJdHo&callback=myMap"></script>
</body>
</html>
