<?php

function button_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'link_url' => '',
			'type' => '',
			'background_color' => '',
			'text_color' => '',
			'rounded' => '',
			'target' => '',
		), $atts ) );
	
	if( isset($atts['link_url']) ) $link = $atts['link_url'];
	if( isset($atts['type']) ) $type = $atts['type'];
	if( isset($atts['background_color']) ) $background_color = $atts['background_color'];
	if( isset($atts['text_color']) ) $text_color = $atts['text_color'];
	if( isset($atts['rounded']) ) $rounded = $atts['rounded'];
	if( isset($atts['target']) ) $target = $atts['target'];
	
	// Get button type
	if( !isset($atts['type']) ) {
		$type = 'button1';
	}
	
	elseif ( $atts['type'] == 'small' ) {
		$type = 'button1';
	}
	
	elseif ( $atts['type'] == 'medium' ) {
		$type = 'button2';
	}
	
	elseif ( $atts['type'] == 'large' ) {
		$type = 'button3';
	}
	
	elseif ( $atts['type'] == 'extra-large' ) {
		$type = 'button4';
	}
	
	// Get button type
	if( !isset($atts['target']) ) {
		$target = '_parent';
	}
	
	else {
		$target = $atts['target'];
	}
	
	$output = '';
	$output .= '<a target="' . $target . '" href="';
	$output .= $link;
	$output .= '" class="';
	$output .= $type;
	
	// Get button rounded
	if ( $rounded == 'true' ) {
		$output .= ' rounded-button';
	}
	
	$output .= '"';
	
	if( isset($atts['background_color']) or isset($atts['text_color']) ) {
		$output .= ' style="border:none;';
	}
	
	if( isset($atts['background_color']) ) {
		$output .= 'background:' . $background_color . ';';
	}
	
	if( isset($atts['text_color']) ) {
		$output .= 'color:' . $text_color . ';';
	}
	
	if( isset($atts['background_color']) or isset($atts['text_color']) ) {
		$output .= '" ';
	}

	$output .= '>';
	$output .= $content;
	$output .= '</a>';
	$output .= '<div class="clearboth"></div>';
	
	return $output;

}

add_shortcode( 'button', 'button_shortcode' );

?>