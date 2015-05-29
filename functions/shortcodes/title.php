<?php

function title_shortcode( $atts, $content = null ) {
	
	$output = '<div class="title1 clearfix">';
	$output .= '<h4>';
	$output .= $content;
	$output .= '</h4>';
	$output .= '<div class="title-block"></div>';
	$output .= '</div>';
	
	return $output;
	
}

add_shortcode( 'title', 'title_shortcode' );

?>