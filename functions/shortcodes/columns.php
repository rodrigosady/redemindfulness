<?php



function column_shortcode( $atts, $content = null ) {
	return '<li class="col">' . do_shortcode($content) . '</li>';
}
add_shortcode( 'column', 'column_shortcode' );



function two_columns_shortcode( $atts, $content = null ) {
	return '<ul class="columns-2 clearfix">' . do_shortcode($content) . '</ul>';
}
add_shortcode( 'two_columns', 'two_columns_shortcode' );



function three_columns_shortcode( $atts, $content = null ) {
	return '<ul class="columns-3 clearfix">' . do_shortcode($content) . '</ul>';
}
add_shortcode( 'three_columns', 'three_columns_shortcode' );



function four_columns_shortcode( $atts, $content = null ) {
	return '<ul class="columns-4 clearfix">' . do_shortcode($content) . '</ul>';
}
add_shortcode( 'four_columns', 'four_columns_shortcode' );



?>