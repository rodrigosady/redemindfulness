<?php

// Widget Class
class qns_video_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_video_widget() {
		$widget_ops = array( 'classname' => 'video_widget', 'description' => __('Display a Video', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'video_widget' );
		$this->WP_Widget( 'video_widget', __('Video Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$video_id = $instance['video_id'];	
		$video_type = $instance['video_type'];
		$video_caption = $instance['video_caption'];
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>
		
		<?php if ($video_type == 'youtube') { ?>
			
			<div class="video-wrapper clearfix">
				<iframe style="width: 100%;" height="215px" src="http://www.youtube.com/embed/<?php echo $video_id; ?>?HD=false;rel=0;showinfo=0"></iframe>
			</div>
		
		<?php } else { ?>
			
			<div class="video-wrapper clearfix">
				<iframe style="width: 100%;" height="215px" src="http://player.vimeo.com/video/<?php echo $video_id; ?>?autoplay=0&amp;title=0&amp;byline=0&amp;portrait=0"></iframe>
			</div>
		
		<?php } ?>
		
		<?php if ($video_caption != '') { ?>
			<p><?php echo $video_caption; ?></p>
		<?php } ?>
		
		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_id'] = strip_tags( $new_instance['video_id'] );
		$instance['video_type'] = $new_instance['video_type'];
		$instance['video_caption'] = strip_tags( $new_instance['video_caption'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Video',
		'video_id' => '',
		'video_type' => 'youtube'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'video_id' ); ?>"><?php _e('Video ID:', 'qns') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('video_id'); ?>" name="<?php echo $this->get_field_name('video_id'); ?>" value="<?php echo $instance['video_id']; ?>" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'video_type' ); ?>"><?php _e('Video Type:', 'qns') ?></label>
			<select id="<?php echo $this->get_field_id( 'video_type' ); ?>" name="<?php echo $this->get_field_name('video_type'); ?>" class="widefat">
				<option value="youtube">Youtube</option>
				<option value="vimeo">Vimeo</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'video_caption' ); ?>"><?php _e('Video Caption:', 'qns') ?></label>
			<textarea id="<?php echo $this->get_field_id('video_caption'); ?>" class="widefat" name="<?php echo $this->get_field_name('video_caption'); ?>"><?php echo $instance['video_caption']; ?></textarea>
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_video_widget' );

// Register Widget
function qns_video_widget() {
	register_widget( 'qns_video_widget' );
}