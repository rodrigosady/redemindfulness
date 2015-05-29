			<?php global $data; ?>
						
				<!-- BEGIN #footer-wrapper -->
				<div id="footer-wrapper">

					<?php /* Only display widget area if widgets are placed in it */ 
					if ( is_active_sidebar('footer-widget-area') ) { ?>
					
						<!-- BEGIN #footer -->
						<div id="footer">

					<?php } else { ?>
						
						<!-- BEGIN #footer -->
						<div id="footer" class="footer-no-widgets">

					<?php } ?>

						<ul class="columns-4 clearfix">
							
					<?php if ( is_active_sidebar('footer-widget-area') ) { ?>	
						<?php dynamic_sidebar( 'footer-widget-area' ); ?>
					<?php } ?>

							
				</ul>
						
			<!-- BEGIN #footer-bottom -->
			<div id="footer-bottom" class="clearfix">
				
				<?php if( $data['footer_text'] ) { ?>
					<p class="fl"><?php echo $data['footer_text']; ?></p>
				<?php } ?>
				
				<p class="go-up fr">
					<a class="scrollup" href="#top"><?php _e('Top','qns'); ?></a>
				</p>
	
			<!-- END #footer-bottom -->
			</div>
			
			<!-- END #footer -->
			</div>

		<!-- END #footer-wrapper -->
		</div>

		<?php wp_footer(); ?>

	<!-- END body -->
	</body>
</html>