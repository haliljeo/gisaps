
<?php
header('Content-Type: application/javascript');
$servername = "localhost";
$username = "gisaps";
$password = "gisAPS12";
$dbname = "gisaps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM data";
$result = $conn->query($sql);
?>
var vectorLayer = new ol.layer.Vector({ // VectorLayer({
    source: new ol.source.Vector(),
  });
  
var vectorSource = vectorLayer.getSource();
 map.addLayer(vectorLayer);
function addMarker(c,b,p) { 
    var marker = new ol.Feature(new ol.geom.Point([c],[b],[p]));
    console.log(c);
     var zIndex = 1;
    marker.setStyle(new ol.style.Style({
        image: new ol.style.Icon(({
        anchor: [0.5, 36], 
        anchorXUnits: "fraction",
        anchorYUnits: "pixels",
        opacity: 1,
        src: "/logo.png", 
        zIndex: zIndex
      })),
      zIndex: zIndex
    }));
    vectorSource.addFeature(marker);
  }
  
<?
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>			
	addMarker('<?php echo $row["coor"] ?>','<?php echo $row["baslik"] ?>','<?php echo $row["pii"] ?>');
	
	  <?php  
  }
  ?> 

  document.getElementById("kayit").innerHTML = "Toplam Makale Sayısı : <?php echo $result->num_rows ?>";
  
  <?php
} else {
  echo "0 results";
}

$conn->close();
?>
