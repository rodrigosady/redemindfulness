<?php

function googlemap_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'width' => '100%',
			'height' => '400px',
			'maptype' => 'ROADMAP',
			'zoom' => '14',
			'address' => 'London, UK',
			'marker_html' => ""
		), $atts ) );
	
	if( isset($atts['width']) ) $width = $atts['width'];
	if( isset($atts['height']) ) $height = $atts['height'];
	if( isset($atts['maptype']) ) $maptype = $atts['maptype'];
	if( isset($atts['zoom']) ) $zoom = $atts['zoom'];
	if( isset($atts['address']) ) $address = $atts['address'];
	if( isset($atts['marker_html']) ) $marker_html = $atts['marker_html'];
		
	$output = '';
	$output .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
	$output .= '<div id="google-map" style="';
	$output .= 'width:' . $width . ';';
	$output .= 'height:' . $height . ';';
	$output .= '"></div>';
	
	$output .= '<script type="text/javascript">

			var latlng = new google.maps.LatLng(0, 0);
			var myOptions = {
				zoom: ' . $zoom . ',
				center: latlng,
				scrollwheel: true,
				scaleControl: false,
				disableDefaultUI: false,
				mapTypeId: google.maps.MapTypeId.' . $maptype . '
			};
			var map = new google.maps.Map(document.getElementById("google-map"),
			myOptions);

			    var geocoder_map = new google.maps.Geocoder();';
			
			$output .= "var map_address = '" . $address . "';";
			
			
				$output .= "geocoder_map.geocode( { 'address': map_address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);

							var marker = new google.maps.Marker({
								map: map, 

								position: map.getCenter()
							});";

								$output .= 'var contentString = "' . $marker_html . '";
								var infowindow = new google.maps.InfoWindow({
									content: contentString
								});';

								$output .= "google.maps.event.addListener(marker, 'click', function() {
								  infowindow.open(map,marker);
								});";

					$output .= '} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
				});
				</script>';
	
	return $output;

}

add_shortcode( 'googlemap', 'googlemap_shortcode' );

?>