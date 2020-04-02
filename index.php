<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="author" content="SURONO">
	  <link rel='icon' href='assets/img/bolmong.png' type='image/x-icon'/ >
	  <title>PETA COVID-19 KAB. BOLAANG MONGONDOW</title>
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
	  <link rel="stylesheet" href="assets/lib/Leaflet.ExtraMarkers/css/leaflet.extra-markers.min.css">
	  <link rel="stylesheet" href="assets/app.css">
</head>
<body>
	  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
	  <script src="assets/lib/Leaflet.ExtraMarkers/js/leaflet.extra-markers.min.js"></script>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#"><img src="assets/img/bolmong.png" style="width: 25px"> BOLAANG MONGONDOW TANGGAP COVID-19</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-light" href="#" data-toggle="modal" data-target="#infoModal"><i class="fas fa-info-circle text-light"> </i> Info</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Modal -->
  <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark text-light">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i>Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card alert-dark p-3">

            <h4>PENGERTIAN</h4> <br>
            <p align="justify"><b>Pelaku Perjalanan (Notifikasi)</b> adalah orang yang memiliki riwayat perjalanan dari Negara/daerah area trasmisi lokal yang tidak bergejala wajib melakukan monitoring mandiri terhadap kemungkinan munculnya gejala selama 14 hari sejak kepulangan</p><br>
            <p align="justify"><b>Orang Dalam pemantauan (ODP)</b> adalah orang dengan gejala demam 38 derajat Celsius (atau lebih) atau ada riwayat demam atau ada gejala gangguan pernapasan (batuk/pilek/sakit tenggorokan/ sesak tanpa pneumonia) dan memiliki riwayat bepergian ke daerah yang diyakini ada penularan loka dalam 14 hari terakhir sebelum timbul gejala</p>
            <hr>Peta ini menggunakan data kasus COVID-19 dari <a href="https://covid19.bolmongkab.go.id/" target="_blank">https://covid19.bolmongkab.go.id/</a><br>
            yang diudate setiap hari pukul 17.00 WITA
          </div>
        </div>
        <div class="modal-footer">
            <div class="col text-left">
              <a class="btn btn-link btn-sm" type="button" href="https://www.linkedin.com/in/surono-surono-590430171/" target="_blank">SURONO@2020</a>
            </div>
            <div class="col text-right">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row row-map">
      <div class="col-sm">
        <div id="map"></div>
      </div>
    </div>
    <div class="row row-info">
      <?php
        $Dataadminkecamatan = file_get_contents("data/kec_bolmong.geojson");
        $JumlahKasus = json_decode($Dataadminkecamatan, TRUE);

        $totalPP = 0;
        $totalODP = 0;
        $totalPDP = 0;
        $totalpositif = 0;
        $totalsembuh = 0;
        $totalmeninggal = 0;

        foreach($JumlahKasus['features'] as $item){
          $totalPP +=$item['properties']['PP'];
          $totalODP += $item['properties']['ODP'];
          $totalPDP += $item['properties']['PDP'];
          $totalpositif += $item['properties']['POSITIF'];
          $totalsembuh += $item['properties']['SEMBUH'];
          $totalmeninggal += $item['properties']['MENINGGAL'];
        }
      ?>
      <div class="col-sm-4 text-center text-info bg-dark">
        <div class="row p-2">
          <div class="col-2">
            <i class="fa fa-car fa-2x"></i>
          </div>
          <div class="col text-left">
            <h10><strong>TOTAL NOTIFIKASI</strong></h10>
            <h10><strong><?php echo $totalPP; ?> ORANG</strong></h10>
          </div>
        </div>
      </div>
      <div class="col-sm-4 text-center text-light bg-dark">
        <div class="row p-2">
          <div class="col-2">
            <i class="fa fa-thermometer-quarter fa-2x"></i>
          </div>
          <div class="col text-left">
            <h10><strong>TOTAL ODP</strong></h10>
            <h10><strong><?php echo $totalODP; ?> ORANG</strong></h10>
          </div>
        </div>
      </div>
      <div class="col-sm-4 text-center text-primary bg-dark">
        <div class="row p-2">
          <div class="col-2">
            <i class="fa fa-bed fa-2x"></i>            
          </div>
          <div class="col text-left">
            <h10><strong>TOTAL PDP</strong></h10>
            <h10><strong><?php echo $totalPDP; ?> ORANG</strong></h10>
          </div>
        </div>
      </div>
      <div class="col-sm-4 text-center text-warning bg-dark">
        <div class="row p-2">
          <div class="col-2">
            <i class="far fa-sad-tear fa-2x"></i>
          </div>
          <div class="col text-left">
            <h10><strong>TOTAL POSITIF</strong></h10>
            <h10><strong><?php echo $totalpositif; ?> ORANG</strong></h10>
          </div>
        </div>
      </div>
      <div class="col-sm-4 text-center text-success bg-dark">
        <div class="row p-2">
          <div class="col-2">
            <i class="far fa-smile fa-2x"></i>
          </div>
          <div class="col text-left">
            <h10><strong>TOTAL SEMBUH</strong></h10>
            <h10><strong><?php echo $totalsembuh; ?> ORANG</strong></h10>
          </div>
        </div>
      </div>
      <div class="col-sm-4 text-center text-danger bg-dark">
        <div class="row p-2">
          <div class="col-2">
            <i class="far fa-frown fa-2x"></i>
          </div>
          <div class="col text-left">
            <h10><strong>TOTAL MENINGGAL</strong></h10>
            <h10><strong><?php echo $totalmeninggal; ?> ORANG</strong></h10>
          </div>
        </div>
      </div>
    </div>
   </div>	

    <!-- Bootstrap Modal -->
	<div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title text-primary" id="feature-title"></h4>
	        <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
	      </div>
	      <div class="modal-body" id="feature-info"></div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>

   <script>
    /* Initial Map */
    var map = L.map('map').setView([0.694,123.992],10); //lat, long, zoom
    map.setMaxBounds(map.getBounds());
    
    /* Tile Basemap */
	var basemap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
		 minZoom: 7,
	     maxZoom: 20,
		 subdomains:['mt0','mt1','mt2','mt3'],
		 attribution: 'Google Streets | <a href="#" target="_blank">SURONO@2020</a>'
		});
	var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		   attribution: 'OSM | <a href="#" target="_blank">SURONO@2020</a>'
		});
	var basemap2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Dark_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
			attribution: 'ESRI | <a href="#" target="_blank">SURONO@2020</a>',
			maxZoom: 16
			});
	  basemap2.addTo(map);

		/* GeoJSON Polygon */
	var adminkecamatan = L.geoJson(null, {
	  /* Style polygon */
	  style: function (feature) { //Fungsi style polygon
	    return {
	      fillColor: "red", //Warna tengah polygon
	      fillOpacity: 0, //Transparansi tengah polygon
	      color: "yellow", //Warna garis tepi polygon
	      weight: 2, //Tebal garis tepi polygon
	      opacity: 1, //Transparansi garis tepi polygon
	    };
	  },
	  /* Highlight & Popup */
      onEachFeature: function (feature, layer) {
      if (feature.properties) {
        var content = "<table class='table table-striped table-bordered table-condensed'>" +
        "<tr><th>Notifikasi</th><td>" + feature.properties.PP +" Orang"+ "</td></tr>" +
        "<tr><th>Orang Dalam Pemantauan</th><td>" + feature.properties.ODP +" Orang"+"</td></tr>"+
        "<tr><th>Pasien Dalam Pengawasan</th><td>"+ feature.properties.PDP +" Orang"+ "</td></tr>"+
        "<tr><th>Positif</th><td>" + feature.properties.POSITIF +" Orang"+"</td></tr>"+
        "<tr><th>Sembuh</th><td>"+ feature.properties.SEMBUH +" Orang"+"</td></tr>"+
        "<tr><th>Meninggal</th><td>"+ feature.properties.MENINGGAL +" Orang"+"</td></tr>"+
        "</table>";
        layer.on({
      mouseover: function (e) { //Fungsi ketika mouse berada di atas obyek
        var layer = e.target; //variabel layer
        layer.setStyle({ //Highlight style
          weight: 2, //Tebal garis tepi polygon
          color: "#FFFFFF", //Warna garis tepi polygon
          opacity: 1, //Transparansi garis tepi polygon
          fillColor: "#00FFFF", //Warna tengah polygon
          fillOpacity: 1, //Transparansi tengah polygon
        });
        adminkecamatan.bindTooltip("KEC. " + feature.properties.KECAMATAN, {sticky: true});
      },
      mouseout: function (e) { //Fungsi ketika mouse keluar dari area obyek
        adminkecamatan.resetStyle(e.target); //Mengembalikan style polygon ke style awal
        map.closePopup(); //Menutup popup
      },

      click: function (e) {
          $("#feature-title").html("KEC. "+feature.properties.KECAMATAN);
          $("#feature-info").html(content);
          $("#featureModal").modal("show");
         			}
        		});
       		}
    	}
	});
	/* memanggil data geojson polygon */
	$.getJSON("data/kec_bolmong.geojson", function (data) {
	  adminkecamatan.addData(data);
	  map.addLayer(adminkecamatan); //adminkecamatan ditampilkan ketika halaman dipanggil
	});

	var baseMaps = { //list basemap
	  'ESRI Dark Gray': basemap2,
	  'Open Street Map': basemap1,
	  'Google Streets': basemap,
	};
	var Layers = {  //list layer
	  'Batas Kecamatan': adminkecamatan,
	};
	var layerControl = L.control.layers(baseMaps, Layers, {collapsed:false});
	layerControl.addTo(map);

  var legend = new L.Control({position: 'bottomleft'});
  legend.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
  };
  legend.update = function () {
    this._div.innerHTML = '<h5 style=bold>Cara menggunakan</h5><ol><li><p align="justify">Arahkan Pointer ke salah satu poligon <br>kecamatan, dan Klik untuk mengetahui isi data</p></li><li><p align="justify">Untuk mengganti basemap, klik salah satu <br> basemap di control layer kanan atas </p></li></ol><hr><large>Sumber data:<br><a href="https://covid19.bolmongkab.go.id/" target="_blank">https://covid19.bolmongkab.go.id/</a></large>'
  };
  legend.addTo(map);
	</script>
</body>
</html>