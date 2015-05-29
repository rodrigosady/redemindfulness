<?php

	//Display Header
	get_header();
	
	//Get Post ID
	global $wp_query;
	$post_id = $wp_query->post->ID;
	
	//Get Header Image
	$header_image = page_header(get_post_meta($post_id, 'qns_page_header_image_url', true));
	
	//Get Content ID/Class
	$content_id_class = content_id_class(get_post_meta($post_id, 'qns_page_sidebar', true));
	
	//Reset Query
	wp_reset_query();
	
?>

<!-- BEGIN .page-header -->
<div class="page-header clearfix" <?php echo $header_image;	?>>
	
	<div class="page-header-inner clearfix">	
		<div class="page-title">	
			<h2><?php _e('Page Not Found', 'qns'); ?></h2>
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

			<p><?php echo __('Oops! we couldn\'t find the page you requested,','qns') . ' <a href="' . home_url() . '">' . __('Go home?', 'qns') ?></a></p>

		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

	<?php get_sidebar(); ?>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>