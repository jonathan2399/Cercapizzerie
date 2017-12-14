<html>
<head>
<?php
  include("PhpGoogleMap.php");
?>
    
<style>
h1 {
	text-align: center;
    color: #86b300;
    size: 20px;
}
select {
	width: 50%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #ccff33;
}
table {
	border-collapse: collapse;
    width: 100%;
}
table, th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even) {background-color: #ff6666;}

</style>
<title>Cercapizzerie</title>
</head>
  <body>
  
  <?php
  //CREAZIONE DEGLI INPUT 
  /*
  $paesi = array("Bergamo","Brescia","Milano","Cremona");
  $luoghi = array("pizzerias","coffee");
  echo "<h1>Benvenuti nella mia Web application</h1></br></br>";
  
  echo "<form name=\"inserimento\" method=\"post\" action=\"\" id=\"myform\">";
  
    echo "Seleziona la città: <select id=\"primo\" name=\"paesi\" >";
    	for ($i=0;$i<count($paesi);$i++)
        	echo "<option value=\"$paesi[$i] \">". $paesi[$i] . "</option>";   
    echo "</select> ";
    
    echo "</br></br> Seleziona il luogo: <select id=\"secondo\" name=\"luoghi\" >";
    	for ($i=0;$i<count($luoghi);$i++)
        	echo "<option value=\"$luoghi[$i] \">". $luoghi[$i] . "</option>";   
    echo "</select> ";
    
    echo "</br></br><input type=\"submit\" value=\"Ricerca\"/>";
  echo "</form>";
  */
  
  
  	/*
  	if(isset($_POST['paesi'])&&isset($_POST['luoghi'])){
    	$paese=$_POST['paesi'];
        $luogo=$_POST['luoghi'];
        $settata = 1;
    }
    else{
    	$paese="Bergamo";
        $luogo="coffee";
    }*/
    
    
   $v = "20161016";
   $ll = "45.693952%2C%20-9.663608";
   $query = "pizzerias";
   $intent = "checkin";
   $near = "Bergamo";
   $client_id = "GQGSEC2NDQNYRD2M1NUSMZC45A5DUHJBU01SCCQ25DOOXRSG";
   $client_secret = "LRCFWEECNA4WTWCTYQU2PXIXCYDMDFBMSNPY5OQVOKJL2UR4";
   $search = "https://api.foursquare.com/v2/venues/search?";
   $url = $search . "v=" . $v . "&" . "ll=" . $ll . "&" . "query=" . $query . "&" . "intent=" . $intent . "&" . "near=" . $near . "&" . "client_id=" . $client_id . "&" . "client_secret=" . $client_secret;
   
   
   $json = file_get_contents($url);  //effettua richiesta get http del contenuto json
   $response = json_decode($json, true); //decodifica file json
    
	/*
    echo '<pre>';
  	print_r($response);
    echo '</pre>';*/
    
    
    $latitudini = array();
    $longitudini = array();
    $nomi = array();
    $i=0;
    //CREA TABELLA
    echo "<table>";
    echo "<tr><th>NOME</th><th>LATITUDINE</th><th>LONGITUDINE</th><th>INDIRIZZO</th></tr>";
        foreach($response['response']['venues'] as $venues){
             echo "<tr><th>". $venues['name']. "</th>" . "<th>". $venues['location']['lat'] . "</th>" . "<th>" . $venues['location']['lng'] . "</th>" . "<th>" . $venues['location']['address'] . "</th>" ."</tr>";
             $nomi[$i] = $venues['name'];
             $latitudini[$i] = $venues['location']['lat'];
             $longitudini[$i] = $venues['location']['lng'];
             $i++;
        }
    echo "</table>";
    
    $map = new PhpGoogleMap("AIzaSyAcAg8U21nYuM4bWn7PyiV_ZrTUHWEZUbA");
  	$map->set_dimensioni(1875,700);
    $map->set_coordinate(45.683333,9.716667);
    $map->set_arraycoordinate($latitudini,$longitudini);
    $map->set_text($nomi);
    $n = count($nomi);
    $map->set_nmarkers($n);
    $map->set_map();
    $map->renderHTML();
  ?>
  </body>
</html>