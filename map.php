<?php
require_once 'bootstrap.php';
$aidees = OS_Aidee::fetchOutstanding();

// loop through aidees and prepare data for transfer to JS
$markers = array();
foreach ($aidees as $aidee) {
	$geoData = $aidee->getGeolocation();
	$markers[] = array(
		'type' => $aidee->get('type'),
		'neighborhood' => $aidee->get('neighborhood'),
		'lat' => $geoData['lat'],
		'lng' => $geoData['lng']
	);
}

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyDqAE2IgpslZZUsn6YvRGlnEIzLikEpzE4&sensor=true" type="text/javascript"></script>
<script type="text/javascript" src="js/gmaps.js"></script>
<script>
$(function(){
	// setup map using gmaps
	map = new GMaps({
		el: '#map',
		lat: 40.637488,
		lng: -73.979681,
		zoom: 10,
		zoomControl : true,
		panControl : false,
		streetViewControl : false,
		mapTypeControl: false,
		overviewMapControl: false
	});
	
	// get coordinates to pin from php/db
	var markerData = <?php echo json_encode($markers) ?>;
	
	var typeToMarkerMap = {
		"pump": {
			"icon": "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=P|1838f9|ffffff"
		},
		"cleanup": {
			"icon": "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=C|f9f618|000000"
		},
	    "supplies": {
	    	"icon": "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=S|b718f9|ffffff"
	    },
    	"repair": {
    		"icon": "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=R|aa0000|ffffff"
    	}
	};
	
	// paint markers
	$.each(markerData, function(){
		map.addMarker(
			$.extend(
				{
				  lat: this.lat,
				  lng: this.lng
				},
				typeToMarkerMap[this.type]
			)
		);
	});

});
</script>

<div id="map" style="width:570px; height: 350px; margin: 5px 0;"></div>
<div class="small">C = clean-up; P = pumping; R = repair; S = supplies. Use this map to find an area of need.<br/>Text in to receive a specific address assignment once you are on the ground.</div>