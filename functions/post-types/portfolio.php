<?php

function create_post_type_portfolio() {
	
	register_post_type('portfolio', 
		array(
			'labels' => array(
				'name' => __( 'Portfolios', 'qns' ),
                'singular_name' => __( 'Portfolio', 'qns' ),
				'add_new' => __('Add New', 'qns' ),
				'add_new_item' => __('Add New Portfolio' , 'qns' )
			),
		'public' => true,
		'menu_position' => 5,
		'menu_icon' => get_template_directory_uri() .'/images/admin/photo-icon.png',
		'rewrite' => array(
			'slug' => __('portfolio','qns')
		), 
		'supports' => array( 'title','editor','thumbnail'),
	));
}

add_action( 'init', 'create_post_type_portfolio' );



// Add the Meta Box  
function add_portfolio_meta_box() {  
    add_meta_box(  
        'portfolio_meta_box', // $id  
        'Portfolio', // $title  
        'show_portfolio_meta_box', // $callback  
        'portfolio', // $page  
        'normal', // $context  
        'high'); // $priority  

	add_meta_box( 
		'qns_slideshow', // $id
		__( 'Slideshow', 'qns' ), // $title
		'qns_slideshow_box', // $callback
		'portfolio', // $page
		'side'); // $context
			
}  
add_action('add_meta_boxes', 'add_portfolio_meta_box');



// Field Array  
$prefix = 'qns_';  
$portfolio_meta_fields = array(  
    array(  
        'label'=> __('Portfolio Main Title','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'portfolio_main_title',  
        'type'  => 'text'
    ),
	
	array(  
        'label'=> __('Portfolio Main Content','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'portfolio_main_content',  
        'type'  => 'textarea'
    ),

	array(  
        'label'=> __('Portfolio Secondary Title','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'portfolio_secondary_title',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Portfolio Secondary Content','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'portfolio_secondary_content',  
        'type'  => 'textarea'
    )
        
);




// Show Slideshow Meta Box
function qns_slideshow_box() {
	global $post;
	?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($){
			
			// Set variables
			var $image_slideshow_ids = $('#slideshow_images');
			var $slideshow_images = $('#qns_slideshow_wrapper .slideshow_images');
			
			// Make images sortable
			$slideshow_images.sortable({
				cursor: 'move',
				items: '.image',
				update: function(event, ui) {
					var attachment_ids = '';
					$('#qns_slideshow_wrapper ul .image').css('cursor','default').each(function() {
						var attachment_id = jQuery(this).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					});
					$image_slideshow_ids.val( attachment_ids );				
				}
			});
			
			// Uploading files
			var slideshow_frame;
			
			jQuery('.add_slideshow_images').live('click', function( event ){
				
				event.preventDefault();
				
				// If the media frame already exists, reopen it.
				if ( slideshow_frame ) {
					slideshow_frame.open();
					return;
				}
				
				// Create the media frame.
				slideshow_frame = wp.media.frames.downloadable_file = wp.media({
					
					// Set the title of the modal.
					title: '<?php _e( 'Add Images to Slideshow', 'qns' ); ?>',
					
					// Set the button of the modal.
					button: {
						text: '<?php _e( 'Add to slideshow', 'qns' ); ?>',
					},
					
					// Set to true to allow multiple files to be selected
					multiple: true
					
				});
				
				var $el = $(this);
				var attachment_ids = $image_slideshow_ids.val();
				
				// When an image is selected, run a callback.
				slideshow_frame.on( 'select', function() {
					var selection = slideshow_frame.state().get('selection');
					selection.map( function( attachment ) {
						attachment = attachment.toJSON();
						if ( attachment.id ) {
							attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
							$slideshow_images.append('\
								<li class="image" data-attachment_id="' + attachment.id + '">\
									<img src="' + attachment.url + '" />\
									<span><a href="#" class="delete_slide" title="<?php _e( 'Delete image', 'qns' ); ?>"><?php _e( 'Delete', 'qns' ); ?></a></span>\
								</li>');
						}
					} );
					$image_slideshow_ids.val( attachment_ids );
				});
				
				// Finally, open the modal
				slideshow_frame.open();
								
			});
			
			// Remove files
			$('#qns_slideshow_wrapper').on( 'click', 'a.delete_slide', function() {
				
				$(this).closest('.image').remove();
				var attachment_ids = '';
				
				$('#qns_slideshow_wrapper ul .image').css('cursor','default').each(function() {
					var attachment_id = jQuery(this).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});
				
				$image_slideshow_ids.val( attachment_ids );
				return false;
				
			} );

		});
	</script>
	
	<div id="qns_slideshow_wrapper">
		<ul class="slideshow_images clearfix">
			<?php
				if ( metadata_exists( 'post', $post->ID, '_slideshow_images' ) ) {
					$slideshow_images = get_post_meta( $post->ID, '_slideshow_images', true );
				} else {
					$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
					$slideshow_images = implode( ',', $attachment_ids );
				}

				$attachments = array_filter( explode( ',', $slideshow_images ) );

				if ( $attachments )
					foreach ( $attachments as $attachment_id ) {
						echo '<li class="image" data-attachment_id="' . $attachment_id . '">
							' . wp_get_attachment_image( $attachment_id, 'image-style5' ) . '
							<span><a href="#" class="delete_slide" title="' . __( 'Delete image', 'qns' ) . '">' . __( 'Delete', 'qns' ) . '</a></span>
						</li>';
					}
			?>

		</ul>

		<input type="hidden" id="slideshow_images" name="slideshow_images" value="<?php echo esc_attr( $slideshow_images ); ?>" />

	</div>
	
	<p class="add_images_wrapper hide-if-no-js">
		<a href="#" class="add_slideshow_images"><?php _e( 'Add slideshow images', 'qns' ); ?></a>
	</p>

	<?php
}



// The Callback  
function show_portfolio_meta_box() {  
global $portfolio_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="portfolio_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    foreach ($portfolio_meta_fields as $field) {  
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        
		echo '<div class="section">';

        echo '<h3 class="heading">'.$field['label'].'</h3>';  
                switch($field['type']) {  
					
					// text  
					case 'text':  
					    echo '<div class="control-area"><input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;

					// textarea  
					case 'textarea':  
					    echo '<div class="control-area"><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;

					// checkbox  
					case 'checkbox':  
					    echo '<div class="control-area"><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;

					// select  
					case 'select':  
					    echo '<div class="control-area">
					<div class="select_wrapper"><select name="'.$field['id'].'" id="'.$field['id'].'">';  
					    foreach ($field['options'] as $option) {  
					        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
					    }  
					    echo '</select></div></div>
					<div class="label-area">'.$field['desc'].'</div>
					<div class="clearboth"></div>';  
					break;
					
					// date
					case 'date':
						echo '<div class="control-area"><input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /></div>
								<div class="label-area">'.$field['desc'].'</div>
								<div class="clearboth"></div>';
					break;
					
			
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_portfolio_meta($post_id) {  
    global $portfolio_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['portfolio_meta_box_nonce'])) {
		$post_data = $_POST['portfolio_meta_box_nonce'];
	}

    // verify nonce  
    if (!wp_verify_nonce($post_data, basename(__FILE__)))  
        return $post_id;

    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;

    // check permissions  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  
    // loop through fields and save the data  
    foreach ($portfolio_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
	
	// Slideshow Images
	$attachment_ids = array_filter( explode( ',', sanitize_text_field( $_POST['slideshow_images'] ) ) );
	update_post_meta( $post_id, '_slideshow_images', implode( ',', $attachment_ids ) );

}  
add_action('save_post', 'save_portfolio_meta');


?>