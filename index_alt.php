<?
// API KEYS
 
$googleKey = "AIzaSyBozlkR6cTENc0CcjNdLsLTsdN5tmGc3hk";
 
 
// ARRAY OF LOCATION PARAMETERS
 
$params = array(); 
$params['address'] = "Widumweg 9"; 
$params['city'] = "Schellenberg"; 
$params['state'] = "LI"; 
$params['zip'] = "9424";

// GEOCODING USING GOOGLE
 
$coords = geocodeGoogle($params,$googleKey); 
echo "Latitude: {$coords['latitude']}<br>\n"; 
echo "Longitude: {$coords['longitude']}<br>\n";
 
 
// GOOGLE GEOCODE FUNCTION 
function geocodeGoogle($params,$key){ 
	$location = strtolower(str_replace(' ','+',"{$params['zip']}")); 
	$url = "http://maps.google.com/maps/geo?q={$location}&output=json&key={$key}"; 
	$response = file_get_contents($url); 
	//$parts = explode(',',$response);
	//$parts = json_decode($response,true);
	return $response;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
    </style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=<?echo $googleKey?>&sensor=true">
    </script>

    
    <script type="text/javascript">
		var marker;
		var map;
		var response = <?echo $coords ?>;
		var googleKey = "AIzaSyBozlkR6cTENc0CcjNdLsLTsdN5tmGc3hk";
		
		
		/*for (var key in response.Placemark) {
		  if (response.Placemark.hasOwnProperty(key)) {
		  	var addresses += 
		    console.log(key + " -> " + response.Placemark[key].address);
		    
		  }
		}	*/
		
		/*function initialize() {
		  	var myLatlng = new google.maps.LatLng(<? //echo $coords['latitude'] ?>, //echo $coords['longitude'] ?>);   
		  	var myLatlng =    	
			var myOptions = {
			  center: myLatlng,
			  zoom: 12,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};        
			var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
			var marker = new google.maps.Marker({
				position: myLatlng,
			  	map: map,
			  	draggable: true,
			  	title:"My Position"
			});

      }*/
      
      $("#searchForm").submit(function(event) {	
	    /* stop form from submitting normally */
	    event.preventDefault(); 
	        
	    /* get some values from elements on the page: */
	    var $form = $( this ),
	        term = $form.find( 'input[name="s"]' ).val(),
	        url = $form.attr( 'action' );
	        $url = "http://maps.google.com/maps/geo?q="+term+"&output=json&key="+googleKey;
	        
	        	
	    /* Send the data using post and put the results in a div */
	    $.post(url,{s:term},
	      function( data ) {
	          var content = $( data ).find( '#content' );
	          $( "#result" ).empty().append( content );
	      }
	    );
	      
      
      
      
      
      
    </script>
  </head>
  <body onload="initialize()">
  	<form action="" id="searchForm">
	   <input type="text" name="s" placeholder="Search..." />
	   <input type="submit" value="Search" />
	  </form>
	  
	  <div id="result"></div>
  	
  	
    <div id="map_canvas" style="width:50%; height:50%"></div>
  </body>
</html>

