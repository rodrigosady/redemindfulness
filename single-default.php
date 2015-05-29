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
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
			<!-- BEGIN .blog-entry -->
			<div id="post-<?php the_ID(); ?>" <?php post_class("blog-entry clearfix"); ?>>

				<div class="blog-info">
					<div class="blog-date">
						<h3><?php the_time('d'); ?> <span><?php the_time('M'); ?></span></h3>
					</div>
					<ul class="blog-meta">
						<li><strong><?php _e('By','qns'); ?></strong> <?php the_author(); ?></li>
						<li><strong><?php _e('In','qns'); ?></strong> <?php the_category(', '); ?></li>
						<li><strong><?php _e('Comments','qns'); ?></strong> <?php comments_popup_link( 
							__( 'None', 'qns' ), 
							__( '1', 'qns' ), 
							__( '%', 'qns' ), 
							'',
							__( 'Off','qns')
						); ?></li>
					</ul>
				</div>

				<div class="blog-content blog-content-single clearfix">

					<?php if( has_post_thumbnail() ) { ?>		
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style10' ); ?>
							<?php echo '<img src="' . $src[0] . '" alt="" class="blog-image" />'; ?>
						</a>	
					<?php } ?>

					<div class="clearboth"></div>

					<?php the_content(); ?>
					
					<p class="post-tags"><?php the_tags( __('Tags: ','qns'), ', ', '' ); ?></p>
					
					<?php 
						wp_link_pages( array( 
							'before' => '<div class="page-pagination">', 
							'after' => '</div>', 
							'link_before' => '<span class="page">', 
							'link_after' => '</span>'
						) ); 
					?>

				</div>
				
				<?php //if( $data['display_sharing_options'] ) { ?>

					<div class="news-social-links">
						<ul class="clearfix">
							<li class="tweet-link"><a target="_blank" href="http://twitter.com/share?text=<?php the_title(); ?>"><?php _e('Tweet this article','qns'); ?></a></li>
							<li class="facebook-link"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>/&t=<?php the_title(); ?>"><?php _e('Share on Facebook','qns'); ?></a></li>
							<li class="pinterest-link"><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $src[0]; ?>&description=<?php the_title();?>"><?php _e('Pin on Pinterest','qns'); ?></a></li>
						</ul>
					</div>

				<?php //} ?>
				
				<div class="clearboth"></div>

			<?php endwhile; endif; ?>
		
			<?php if ( comments_open() ) :
				comments_template();
			endif; ?>
		
			<!-- END .blog-entry -->
			</div>
			
			<?php } ?>
			
		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

	<?php get_sidebar(); ?>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>