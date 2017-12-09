<?php
class PhpGoogleMap{
	private $apikey;
    private $dimx;
    private $dimy;
    private $latitudine;
    private $longitudine;
    private $indirizzo;
    private $latitudini;
    private $longitudini;
    private $nomi;
    private $n;
    
	function __construct($_apikey){
    	$this->apikey = $_apikey; //assegna la chiave dell'api di google map 
        $this->dimx = 100;
        $this->dimy = 300;
        $this->latitudine = 0;
        $this->longitudine = 0;
        $this->indirizzo = "";
    }
    
    //funzione per dichiarare mappa tramite codice javascript
    function set_map(){
      //setta chiave api nella composizione dell'url
      echo "
          <script src=\"http://maps.google.com/maps?file=api&v=2&key=". $this->apikey ."&sensor=false\" type=\"text/javascript\">
          </script>
      ";
      
      //assegna il contenuto alla variabile JScenterMap la quale permette di geolocalizzare un punto sulla mappa tramite indirizzo
      
      if($this->indirizzo!=""){
    	$JScenterMap = "
        	var geocoder = new GClientGeocoder();
        	geocoder.getLatLng('".$this->indirizzo."',function(point) {
                if (!point) {
                    alert('".$this->indirizzo."' + \" not found\");
                } else {
                    map.setCenter(point, 13);
                    var marker = createMarker(point, 'Ciao');
                    map.addOverlay(marker);                         
                }
            });
    	";
	  } else {
    		$JScenterMap = "map.setCenter(new GLatLng(".$this->latitudine.", ".$this->longitudine."), 11);
            var marker1 = createMarker(new GLatLng(".$this->latitudini[0].", ".$this->longitudini[0]."), '" .$this->nomi[0] ."');
            var marker2 = createMarker(new GLatLng(".$this->latitudini[1].", ".$this->longitudini[1]."), '" .$this->nomi[1] ."');
            var marker3 = createMarker(new GLatLng(".$this->latitudini[2].", ".$this->longitudini[2]."), '" .$this->nomi[2] ."');
            var marker4 = createMarker(new GLatLng(".$this->latitudini[3].", ".$this->longitudini[3]."), '" .$this->nomi[3] ."');
            var marker5 = createMarker(new GLatLng(".$this->latitudini[4].", ".$this->longitudini[4]."), '" .$this->nomi[4] ."');
            var marker6 = createMarker(new GLatLng(".$this->latitudini[5].", ".$this->longitudini[5]."), '" .$this->nomi[5] ."');
            var marker7 = createMarker(new GLatLng(".$this->latitudini[6].", ".$this->longitudini[6]."), '" .$this->nomi[6] ."');
            var marker8 = createMarker(new GLatLng(".$this->latitudini[7].", ".$this->longitudini[7]."), '" .$this->nomi[7] ."');
            var marker9 = createMarker(new GLatLng(".$this->latitudini[8].", ".$this->longitudini[8]."), '" .$this->nomi[8] ."');
            var marker10 = createMarker(new GLatLng(".$this->latitudini[9].", ".$this->longitudini[9]."), '" .$this->nomi[9] ."');
            map.addOverlay(marker1);
            map.addOverlay(marker2);
            map.addOverlay(marker3);
            map.addOverlay(marker4);
            map.addOverlay(marker5);
            map.addOverlay(marker6);
            map.addOverlay(marker7);
            map.addOverlay(marker8);
            map.addOverlay(marker9);
            map.addOverlay(marker10);
            ";
        }
      
	  
      //inizializza il punto sulla mappa in base al contenuto della variabile JScenterMap
      //window.onload permette di richiamare il metodo initialize e Gunload (per svuotare la memoria) direttamente da qui senza specificarlo nel body
      echo "
          <script type=\"text/javascript\">
          
          	  function createMarker(point,html) {
				var marker = new GMarker(point);
				GEvent.addListener(marker, \"mouseover\", function() { marker.openInfoWindowHtml(html); });
				return marker;
			  }
              
          	  window.onload = initialize;  
              window.onunload = GUnload;
              function initialize() {
                  if (GBrowserIsCompatible()) {
                      var map = new GMap2(document.getElementById(\"map_canvas\"));
                      $JScenterMap;
                      map.setUIToDefault();
                 }
               }
          </script>
      ";
	}
    
    function renderHTML(){
    	echo "<div id=\"map_canvas\" style=\"width:" .$this->dimx."px; height:" .$this->dimy."px;\"></div>";
	}
    
    function set_dimensioni($x,$y){
    	$this->dimx = $x;
        $this->dimy = $y;
    }
    
    function set_coordinate($lat,$long){
    	$this->latitudine = $lat;
        $this->longitudine = $long;
        $this->indirizzo = "";
    }
    
    function set_indirizzo($ind){
    	$this->indirizzo=$ind;
    }
    
    function set_arraycoordinate($lat,$long){
    	$this->latitudini = $lat;
        $this->longitudini = $long;
        $this->n = count($latitudini);
    } 
    
    function set_text($t){
    	$this->nomi = $t;
    }
}
?>