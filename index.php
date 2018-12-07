<?php require "jpgraph/jpgraph.php";
require "jpgraph/jpgraph_line.php";

$pdo = new PDO('mysql:host=localhost;dbname=hero', 'root', '');
$q = $pdo->query('SELECT * FROM historique WHERE id_user = 1');
$nom = $pdo->query('SELECT * FROM utilisateurs WHERE id = 1');

$nom = $nom->fetch();
$q = $q->fetchAll();
$activite = [];
$vigilance = [];
$conscience = [];
$freq = [];
$tempcorp = [];
$date = [];

foreach ($q as $value) {
  array_push($activite, $value['activite']);
  array_push($vigilance, $value['vigilance']);
  array_push($conscience, $value['conscience']);
  array_push($freq, $value['freq']);
  array_push($tempcorp, $value['tempcorp']);
  array_push($date, date('d-m-Y', strtotime($value['date'])));
}

// Setup the graph
$graph = new Graph(1280,720);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Courbes de données de ' . $nom['prenom'] . ' ' . $nom['nom']);
$graph->SetBox(false);

$graph->SetMargin(40,20,36,63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($date);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($activite);
$graph->Add($p1);
$p1->SetColor("#FF0000");
$p1->SetLegend('Activité');

$p2 = new LinePlot($vigilance);
$graph->Add($p2);
$p2->SetColor("#FF00FF");
$p2->SetLegend('Vigilance');

$p3 = new LinePlot($conscience);
$graph->Add($p3);
$p3->SetColor("#00FF00");
$p3->SetLegend('Conscience');

$p4 = new LinePlot($freq);
$graph->Add($p4);
$p4->SetColor("#00FFFF");
$p4->SetLegend('Fréquence cardiaque');

$p5 = new LinePlot($tempcorp);
$graph->Add($p5);
$p5->SetColor("#0000FF");
$p5->SetLegend('Température corporelle');

$graph->legend->SetFrameWeight(1);

// Output line
unlink('img/' . $nom['id'] . '.png');
$graph->Stroke('img/' . $nom['id'] . '.png');
// Output line
?>

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
