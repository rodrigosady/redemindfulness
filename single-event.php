<?php
	
	// Display Header
	get_header();
	
	// Get Theme Options
	global $data;
	
	// Get Post ID
	global $wp_query;$post_id = $wp_query->post->ID;
	
	// Get Header Image
	$header_image = page_header(get_post_meta($post_id, 'qns_page_header_image_url', true));
	
	// Get Content ID/Class
	$content_id_class = content_id_class(get_post_meta($post_id, 'qns_page_sidebar', true));
	
	// Reset Query
	wp_reset_query();

?>

<!-- BEGIN .page-header -->
<div class="page-header clearfix" <?php echo $header_image;	?>>
	
	<div class="page-header-inner clearfix">	
		<div class="page-title">	
			<h2><?php the_title(); ?></h2>
			<div class="page-title-block"></div>
		</div>
		<?php dimox_breadcrumbs(); ?>
	</div>
	
<!-- END .page-header -->
</div>

<!-- BEGIN .content-wrapper -->
<div class="content-wrapper page-content-wrapper clearfix">

	<!-- BEGIN .main-content -->
	<div <?php echo $content_id_class; ?>>
	
		<!-- BEGIN .inner-content-wrapper -->
		<div class="inner-content-wrapper">
			
			<?php if ( post_password_required() ) {
				echo qns_password_form();
			} else { ?>
			
			<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<ul class="event-list">
				
					<?php // Get event date
					$e_date = get_post_meta($post->ID, 'qns_event_date', true);
					if ( $e_date !== '' ) { 
						$event_date_string = $e_date;
						$event_monthM = mysql2date( 'M', $event_date_string );
						$event_day = mysql2date( 'd', $event_date_string );
						$event_month = apply_filters('get_the_date', $event_monthM, 'M');
					}

					// If no date set
					else { 
						$event_month = "---";
						$event_day = "00";
					}

					// Get event time	
					$e_time = get_post_meta($post->ID, 'qns_event_time', true);
					if ( $e_time !== '' ) { $event_time = $e_time; }
					else { $event_time = __('No time set','qns'); }

					// Get event location
					$e_location = get_post_meta($post->ID, 'qns_event_location', true);
					if ( $e_location !== '' ) { $event_location = $e_location; }
					else { $event_location = __('No location set','qns'); } ?>

					<!-- BEGIN .event-wrapper -->
					<li id="post-<?php the_ID(); ?>" <?php post_class("event-wrapper event-full event-single clearfix"); ?>>
					
						<div class="event-date">
							<div class="event-m"><?php echo $event_month; ?></div>
							<div class="event-d"><?php echo $event_day; ?></div>	
						</div>
				
						<div class="event-info">
							
							<div class="event-meta">
								<p><strong><?php _e('Time','qns') ?>:</strong> <?php echo $event_time; ?></p>
								<p><strong><?php _e('Location','qns') ?>:</strong> <?php echo $event_location; ?></p>
							</div>
							
							<?php // Get the Thumbnail URL
								$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-large' );
								echo '<img src="' . $src[0] . '" alt="" class="event-image"/>';
							?>
							
							<div style="height: 30px;"></div>
							
							<?php the_content(); ?>
							
						</div>
				
					<!-- END .event-wrapper -->
					</li>

				<?php endwhile; ?>
					
				</ul>
					
			<?php endif; ?>
		
			<?php } ?>
			
		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

	<?php get_sidebar(); ?>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>