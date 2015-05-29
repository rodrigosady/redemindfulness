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
	
	<div class="blog-content">

		<?php if( has_post_thumbnail() ) { ?>		
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style10' ); ?>
				<?php echo '<img src="' . $src[0] . '" alt="" class="blog-image" />'; ?>
			</a>	
		<?php } ?>
		
		<div class="clearboth"></div>
		
		<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> &raquo;</a></h3>
		<?php print_excerpt(190); ?>
		
	</div>

<!-- END .blog-entry -->
</div>