<?php

// Widget Class
class qns_blog_slider_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_blog_slider_widget() {
		$widget_ops = array( 'classname' => 'blog_slider_widget', 'description' => __('Display Blog Posts in a Slider', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'blog_slider_widget' );
		$this->WP_Widget( 'blog_slider_widget', __('Blog Slider Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$blog_post_count = $instance['blog_post_count'];
		$blog_post_per_slide = $instance['blog_post_per_slide'];
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } 
		
		if ($blog_post_count != '') {
			$blog_post_count = $instance['blog_post_count'];
		} else {
			$blog_post_count = '6';
		}
		
		if ($blog_post_per_slide != '') {
			$blog_post_per_slide = $instance['blog_post_per_slide'];
		} else {
			$blog_post_per_slide = '3';
		}
		
		global $post; 

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $blog_post_count
		);

		$wp_query = new WP_Query($args);

		if($wp_query->have_posts()) : ?>

			<!-- BEGIN .slider-blocks -->
			<div class="slider-blocks clearfix">
				
				<!-- BEGIN .slides -->
				<ul class="slides slide-loader2">
			
					<?php while($wp_query->have_posts()) : 
						$wp_query->the_post(); ?>
		
		<?php $current_num = $wp_query->current_post + 1; ?>

		<?php if ( $wp_query->current_post == 0 ) {
			echo '<li><ul class="news-items">';
		} elseif ( $wp_query->current_post % $blog_post_per_slide == 0 ) {
			echo '<li><ul class="news-items">';
		} ?>
		
		<li id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
			
			<?php if( has_post_thumbnail() ) { ?>
				<div class="news-image">		
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style9' ); ?>
						<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
					</a>
				</div>
			<?php } ?>
			
			<div class="news-content">
				<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				<p class="news-date"><?php the_time('F jS, Y'); ?></p>
				<?php print_excerpt(110); ?>
			</div>
		</li>

		<?php if ( $current_num % $blog_post_per_slide == 0 ) {
			echo '</ul></li>';
		} elseif ( $current_num == $wp_query->post_count ) {
			echo '</ul></li>';
		} else {
			//echo '</li>';
		} ?>

		<?php endwhile; ?>
		
		</ul>
	</div>
		
	<?php endif; ?>

		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['blog_post_count'] = strip_tags( $new_instance['blog_post_count'] );
		$instance['blog_post_per_slide'] = strip_tags( $new_instance['blog_post_per_slide'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Blog Slider',
		'blog_post_count' => '6',
		'blog_post_per_slide' => '3'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'blog_post_count' ); ?>"><?php _e('Total Number of Posts:', 'qns') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('blog_post_count'); ?>" name="<?php echo $this->get_field_name('blog_post_count'); ?>" value="<?php echo $instance['blog_post_count']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'blog_post_per_slide' ); ?>"><?php _e('Number of Posts Per Slide:', 'qns') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('blog_post_per_slide'); ?>" name="<?php echo $this->get_field_name('blog_post_per_slide'); ?>" value="<?php echo $instance['blog_post_per_slide']; ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_blog_slider_widget' );

// Register Widget
function qns_blog_slider_widget() {
	register_widget( 'qns_blog_slider_widget' );
}