<?php

// Widget Class
class qns_contact_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_contact_widget() {
		$widget_ops = array( 'classname' => 'contact_widget', 'description' => __('Display Contact Details', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact_widget' );
		$this->WP_Widget( 'contact_widget', __('Contact Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$contact_phone = $instance['contact_phone'];
		$contact_email = $instance['contact_email'];
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>
		
		<ul class="contact-widget">
			<?php if ($contact_phone != '') {echo '<li><span class="contact-phone">'. $instance['contact_phone'] . '</span></li>';} ?>
			<?php if ($contact_email != '') {echo '<li><span class="contact-email">'. $instance['contact_email'] . '</span></li>';} ?>
		</ul>

		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contact_phone'] = strip_tags( $new_instance['contact_phone'] );
		$instance['contact_email'] = strip_tags( $new_instance['contact_email'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Contact',
		'contact_phone' => '',
		'contact_email' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'contact_phone' ); ?>"><?php _e('Phone Number:', 'qns') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('contact_phone'); ?>" name="<?php echo $this->get_field_name('contact_phone'); ?>" value="<?php echo $instance['contact_phone']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'contact_email' ); ?>"><?php _e('Email Address:', 'qns') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('contact_email'); ?>" name="<?php echo $this->get_field_name('contact_email'); ?>" value="<?php echo $instance['contact_email']; ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_contact_widget' );

// Register Widget
function qns_contact_widget() {
	register_widget( 'qns_contact_widget' );
}