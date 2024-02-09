<html>
  <head>
  <meta charset="UTF-8">
    <link rel="stylesheet" href="https://openlayers.org/en/v5.3.0/css/ol.css" type="text/css">
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v5.3.0/build/ol.js"></script>

    <script>
	var spii = "a";
	var sbas = "a";
	</script>
    <style>
      #map {
        height: 100%;
        width: 80%;
      }
	   .ol-popup {
            font-family: 'Lucida Grande', Verdana, Geneva, Lucida, Arial, Helvetica, sans-serif !important;
            font-size: 12px;
            position: absolute;
            background-color: white;
            -webkit-filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
            filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 100px;
        }

        .ol-popup:after,
        .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }
		#marker {
				width: 20px;
				height: 20px;
				border: 1px solid #088;
				border-radius: 10px;
				background-color: #FF;
				opacity: 0.5;
			}
        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }

        .ol-popup:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
        }

        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }

        .ol-popup-closer:after {
            content: "✖";
            color: #c3c3c3;
        }
		#map {
          width: 80%;
          height: 100%;
          float:left;
          
      }
      		#map2 {
          width: 80%;
          height: 100%;
          float:left;
          
      }
      #sol {
        width: 20%;
        height: 100%;
        float:left; 
        text-align:center;
        background-color:#EBF5FB ;
      }
      .sonuc1{
          width:100%;
          background-color:#ccc;
          margin-top:5px;
      }
      .sonuc2{
          width:100%;
          background-color:#cfa;
          margin-top:5px;
      }
	  #bilgi{
		visibility: hidden;
		 width: 20%;
        height: 100%;
		  
	  }
	  #fbilgi{
		
		width: 100%;
        height: 100%; 
		  
	  }
    </style>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	
    <title>CTMA | CBS Tabanlı Makale Arama | Halil BÖLÜK -  2020</title>
  </head>
  <body>
  
	 <div id="sol">
        
        <div id="logo"> <img src="logo.png" width="200px"><br>
        GIS based Academic Paper Search System </div>
        
        <br> Search<br>
    <input type="text" id="metin">
            <button id="ara">Ara</button>
<div id="kayit"></div>
<hr>Created By Halil BÖLÜK <br>(MSc. Geological Engineer)
  <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="usaStates" style="width: 20px; height: 20px; cursor: pointer;  background-color: #f8f9fa; border: 2px solid #adb5bd; border-radius: 5px;">
        <label class="form-check-label" for="usaStates" style="margin-left: 5px; cursor: pointer;">
            USA States
        </label>
    </div>		 
<hr> Results 
            <div id="sonuclar"></div>

        </div>
    <div id="map" class="map"></div>
    <div id="bilgi" class="bilgi"><button>KAPAT</button><iframe id="fbilgi" src="" ></iframe></div>
    <div id="popup" class="ol-popup">
         <a href="#" id="popup-closer" class="ol-popup-closer"></a>
         <div id="popup-content"></div>
 	</div>

    <script type="text/javascript">
		
	//wms katmanları
	var usaStatesLayer  =new ol.layer.Image({
    extent: [-13884991, 2870341, -7455066, 6338219],
    source: new ol.source.ImageWMS({
      url: 'https://ahocevar.com/geoserver/wms',
      params: {'LAYERS': 'topp:states'},
      serverType: 'geoserver'
    })
	});
	//

  
		
  	var vectorLayer = new ol.layer.Vector({ // VectorLayer({
    		source: new ol.source.Vector(),
  	});
  	var map = new ol.Map({
    		layers: [
      		new ol.layer.Tile({ // TileLayer({
        		source: new ol.source.OSM()
      		}),
     		vectorLayer,
	    	],
	    	target: 'map',
    	view: new ol.View({
      		center: [3848973, 4790288],
          	zoom: 6
    })
  });
   var vectorSource = vectorLayer.getSource();

	
	


function addMarker(cor,bil,pki) {
    console.log(cor);
    var marker = new ol.Feature({
				 geometry: new ol.geom.Point(cor),
				 bilgi : bil,
				 bpii : pki,
			 });
    var zIndex = 999;
    marker.setStyle(new ol.style.Style({
      image: new ol.style.Icon(({
        anchor: [0.5, 36],
        anchorXUnits: "fraction",
        anchorYUnits: "pixels",
        opacity: 1,
        src: "ikon.png",
        zIndex: zIndex
      })),
      zIndex: zIndex
    }));
    vectorSource.addFeature(marker);
  } 

function ekle(cc){
	var formData = new FormData();

	formData.append("p", spii);
	formData.append("b", sbas); 
	formData.append("s", cc); 
	var request = new XMLHttpRequest();
	request.open("POST", "ekle.php");
	request.send(formData);
	 
	addMarker(cc,sbas,spii);
	  }
	  
function git(url)
{
	window.open(url,'', 'toolbar=0,scrollbars=2,location=0,statusbar=1,menubar=0,resizable=0,width=500,height=600,left = 200,top = 100');
	}




var container = document.getElementById('popup');
 var content = document.getElementById('popup-content');
 var closer = document.getElementById('popup-closer');

 var overlay = new ol.Overlay({
	 element: container,
	 autoPan: true,
	 autoPanAnimation: {
		 duration: 250
	 }
 });
 map.addOverlay(overlay);

 closer.onclick = function() {
	 overlay.setPosition(undefined);
	 closer.blur();
	 return false;
 };
 
map.on('singleclick', function (event) {
if (map.hasFeatureAtPixel(event.pixel) === true) {
var iconFeatureA = map.getFeaturesAtPixel(event.pixel);
var coordinate = event.coordinate;

var bilgi = iconFeatureA[0].get("bilgi");
var bpii = iconFeatureA[0].get("bpii");
var site = "https://www.sciencedirect.com/science/article/pii/" + bpii;
content.innerHTML = "<b>"+bpii+"</b><br />"+bilgi+"<br /><button onclick=git('"+site+"')>MAKALEYE GİT</button>";
event.preventDefault(); // avoid bubbling 
 overlay.setPosition(coordinate);
} else {
  var coordinate = event.coordinate;
    if(spii=='a'){
    		
		alert("Önce soldan arama yapınız ve makale seçiniz");
		overlay.setPosition(0,0);
	}else{
		content.innerHTML = '<b>'+spii+'</b><br />'+sbas+'<br /><button onclick=ekle(['+coordinate+'])>MAKALEYİ EKLE</button>';
 		overlay.setPosition(coordinate);
	}
 closer.blur();
}
});
   			
function form(pii,metin){
	spii=pii;
	sbas=metin;
	
}

document.getElementById("ara").onclick = function(){
var metin = document.getElementById("metin").value;

$.getJSON('https://api.elsevier.com/content/search/sciencedirect?apiKey=0210d621d87b92248edb2cf2eb37751e&query='+ metin +'&httpAccept=application/json', function(data) {
var obj = (data["search-results"]["entry"]);
var sonuc='';
var say=1;
var cl = "sonuc1";
$.each(obj, function() {
			
sonuc = sonuc + "<div class="+cl+">";
			sonuc = sonuc + "<input type=radio onclick='dene" + say + "(" + say +")' id=b" + say +" name=pii value=" + this['pii'] + "/>";
			sonuc = sonuc + "  <label for=" + this['pii'] + ">" + this['pii'] + "</label><br>" ;
			sonuc = sonuc + this['dc:title'] + "</div>";
			sonuc = sonuc + "<script> function dene" + say + "(){";
			sonuc = sonuc + "form('" + this['pii'] +"','" + this['dc:title'] +"')";
			sonuc = sonuc + "} <\/script>" ;
say = say + 1;
			if(cl=="sonuc1"){cl="sonuc2";}else{cl="sonuc1";}
});
$('#sonuclar').html(sonuc);
});
}
var sUsaStates =0;
document.getElementById('usaStates').addEventListener('change', function() {
        if (this.checked) {
            // Checkbox işaretlendiğinde çağrılacak fonksiyon
            map.addLayer(usaStatesLayer);
        } else {
            // Checkbox işaretlenmediğinde çağrılacak fonksiyon
            map.removeLayer(usaStatesLayer);
        }
    }); 

    
    
    
    <?php

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
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  ?>			
	addMarker([<?php echo $row["coor"] ?>],'<?php echo $row["baslik"] ?>','<?php echo $row["pii"] ?>');
	
	  <?php  
  }
  ?> 

  document.getElementById("kayit").innerHTML = "Academic Papers: <?php echo $result->num_rows ?>";
  
  <?php
} else {
  echo "0 results";
}

$conn->close();
?>
		
    </script>

  </body>
</html>
