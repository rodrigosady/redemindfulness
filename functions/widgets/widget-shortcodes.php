<?php

// Widget Class
class qns_shortcodes_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_shortcodes_widget() {
		$widget_ops = array( 'classname' => 'shortcodes_widget', 'description' => __('A widget which accepts shortcodes', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'shortcodes_widget' );
		$this->WP_Widget( 'shortcodes_widget', __('Shortcodes Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$shortcodes_content = $instance['shortcodes_content'];
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>
		
		
		<?php 
		if ($shortcodes_content != '') {
			$shortcodes_content = $instance['shortcodes_content'];
		} ?>
		

		<?php echo do_shortcode( $shortcodes_content ); ?>
		
		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['shortcodes_content'] = $new_instance['shortcodes_content'];
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => '',
		'shortcodes_content' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'shortcodes_content' ); ?>"><?php _e('Shortcodes:', 'qns') ?></label>
			<textarea id="<?php echo $this->get_field_id('shortcodes_content'); ?>" class="widefat" name="<?php echo $this->get_field_name('shortcodes_content'); ?>"><?php echo $instance['shortcodes_content']; ?></textarea>
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_shortcodes_widget' );

// Register Widget
function qns_shortcodes_widget() {
	register_widget( 'qns_shortcodes_widget' );
}