<?php

// Widget Class
class qns_course_finder_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_course_finder_widget() {
		$widget_ops = array( 'classname' => 'course_finder_widget', 'description' => __('Display Course Finder', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'course_finder_widget' );
		$this->WP_Widget( 'course_finder_widget', __('Course Finder Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$form_description = $instance['form_description'];
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>
		
		
		<?php 
		if ($form_description != '') {
			$form_description = '<p>' . $instance['form_description'] . '</p>';
		} ?>
		
		
		
		<?php echo $form_description; ?>
		
		<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="course-finder-form clearfix">

			<select name="keyword-type">
				<option value="course_id"><?php _e('Course ID','qns'); ?></option>
				<option value="course_name"><?php _e('Course Name','qns'); ?></option>
				<option value="program_type"><?php _e('Program','qns'); ?></option>
				<option value="course_length"><?php _e('Length','qns'); ?></option>
			</select>

			<input type="text" onblur="if(this.value=='')this.value='<?php _e('Keywords','qns'); ?>';" onfocus="if(this.value=='<?php _e('Keywords','qns'); ?>')this.value='';" value="<?php _e('Keywords','qns'); ?>" name="s" />
			<input type="submit" value="<?php _e('Search','qns'); ?>" />
			
		</form>
				
		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['form_description'] = strip_tags( $new_instance['form_description'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Course Finder',
		'form_description' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'form_description' ); ?>"><?php _e('Description:', 'qns') ?></label>
			<textarea id="<?php echo $this->get_field_id('form_description'); ?>" class="widefat" name="<?php echo $this->get_field_name('form_description'); ?>"><?php echo $instance['form_description']; ?></textarea>
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_course_finder_widget' );

// Register Widget
function qns_course_finder_widget() {
	register_widget( 'qns_course_finder_widget' );
}