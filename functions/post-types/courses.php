<?php

function create_post_type_course() {
	
	register_post_type('course', 
		array(
			'labels' => array(
				'name' => __( 'Courses', 'qns' ),
                'singular_name' => __( 'Course', 'qns' ),
				'add_new' => __('Add New', 'qns' ),
				'add_new_item' => __('Add New Course' , 'qns' )
			),
		'public' => true,
		'menu_position' => 5,
		'menu_icon' => get_template_directory_uri() .'/images/admin/course-icon.png',
		'rewrite' => array(
			'slug' => __('course','qns')
		), 
		'supports' => array( 'title','thumbnail'),
	));
}

add_action( 'init', 'create_post_type_course' );



// Add the Meta Box  
function add_course_meta_box() {  
    add_meta_box(  
        'course_meta_box', // $id  
        'Course', // $title  
        'show_course_meta_box', // $callback  
        'course', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_course_meta_box');



// Field Array  
$prefix = 'qns_';  
$course_meta_fields = array(  
    array(  
        'label'=> __('Course Name','qns'),  
        'desc'  => 'e.g. "BSc (Hons) WordPress Development"',  
        'id'    => $prefix.'course_name',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Course ID','qns'),  
        'desc'  => 'e.g. "001"',  
        'id'    => $prefix.'course_id',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Program Type','qns'),  
        'desc'  => 'e.g. "Undergraduate"',  
        'id'    => $prefix.'program_type',  
        'type'  => 'text'
    ),
	array(  
    	'label'=> __('Course Length','qns'),  
    	'desc'  => 'e.g. "3 Months"',  
    	'id'    => $prefix.'course_length',  
    	'type'  => 'text'
	),
	array(  
    	'label'=> __('Course Description','qns'),  
    	'desc'  => 'To add a course image click "Set featured image" on the right side of this page',  
    	'id'    => $prefix.'course_description',  
    	'type'  => 'textarea'
	)
        
);



// The Callback  
function show_course_meta_box() {  
global $course_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="course_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    foreach ($course_meta_fields as $field) {  
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
					    echo '<div class="control-area"><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="100" rows="12">'.$meta.'</textarea></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_course_meta($post_id) {  
    global $course_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['course_meta_box_nonce'])) {
		$post_data = $_POST['course_meta_box_nonce'];
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
    foreach ($course_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_course_meta');



/* -------------------------------------------------------------

	Tab One Meta Box
	
------------------------------------------------------------- */

function add_tab_one_meta_box() {  
    add_meta_box(  
        'tab_one_meta_box', // $id  
        'Tab One', // $title  
        'show_tab_one_meta_box', // $callback  
        'course', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_tab_one_meta_box');



// Field Array  
$prefix = 'qns_';  
$tab_one_meta_fields = array(  
    array(  
        'label'=> __('Title','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_one_title',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Content','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_one_content',  
        'type'  => 'textarea'
    ),
        
);



// The Callback  
function show_tab_one_meta_box() {  
global $tab_one_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="tab_one_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    foreach ($tab_one_meta_fields as $field) {  
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
					    echo '<div class="control-area"><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="100" rows="12">'.$meta.'</textarea></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_tab_one_meta($post_id) {  
    global $tab_one_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['tab_one_meta_box_nonce'])) {
		$post_data = $_POST['tab_one_meta_box_nonce'];
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
    foreach ($tab_one_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_tab_one_meta');



/* -------------------------------------------------------------

	Tab Two Meta Box
	
------------------------------------------------------------- */
function add_tab_two_meta_box() {  
    add_meta_box(  
        'tab_two_meta_box', // $id  
        'Tab Two', // $title  
        'show_tab_two_meta_box', // $callback  
        'course', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_tab_two_meta_box');



// Field Array  
$prefix = 'qns_';  
$tab_two_meta_fields = array(  
    array(  
        'label'=> __('Title','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_two_title',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Content','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_two_content',  
        'type'  => 'textarea'
    ),
        
);



// The Callback  
function show_tab_two_meta_box() {  
global $tab_two_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="tab_two_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    foreach ($tab_two_meta_fields as $field) {  
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
					    echo '<div class="control-area"><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="100" rows="12">'.$meta.'</textarea></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_tab_two_meta($post_id) {  
    global $tab_two_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['tab_two_meta_box_nonce'])) {
		$post_data = $_POST['tab_two_meta_box_nonce'];
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
    foreach ($tab_two_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_tab_two_meta');



/* -------------------------------------------------------------

	Tab Three Meta Box
	
------------------------------------------------------------- */

function add_tab_three_meta_box() {  
    add_meta_box(  
        'tab_three_meta_box', // $id  
        'Tab Three', // $title  
        'show_tab_three_meta_box', // $callback  
        'course', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_tab_three_meta_box');



// Field Array  
$prefix = 'qns_';  
$tab_three_meta_fields = array(  
    array(  
        'label'=> __('Title','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_three_title',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Content','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_three_content',  
        'type'  => 'textarea'
    ),
        
);



// The Callback  
function show_tab_three_meta_box() {  
global $tab_three_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="tab_three_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    foreach ($tab_three_meta_fields as $field) {  
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
					    echo '<div class="control-area"><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="100" rows="12">'.$meta.'</textarea></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_tab_three_meta($post_id) {  
    global $tab_three_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['tab_three_meta_box_nonce'])) {
		$post_data = $_POST['tab_three_meta_box_nonce'];
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
    foreach ($tab_three_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_tab_three_meta');



/* -------------------------------------------------------------

	Tab Four Meta Box
	
------------------------------------------------------------- */

function add_tab_four_meta_box() {  
    add_meta_box(  
        'tab_four_meta_box', // $id  
        'Tab Four', // $title  
        'show_tab_four_meta_box', // $callback  
        'course', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_tab_four_meta_box');



// Field Array  
$prefix = 'qns_';  
$tab_four_meta_fields = array(  
    array(  
        'label'=> __('Title','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_four_title',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Content','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_four_content',  
        'type'  => 'textarea'
    ),
        
);



// The Callback  
function show_tab_four_meta_box() {  
global $tab_four_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="tab_four_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    foreach ($tab_four_meta_fields as $field) {  
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
					    echo '<div class="control-area"><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="100" rows="12">'.$meta.'</textarea></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_tab_four_meta($post_id) {  
    global $tab_four_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['tab_four_meta_box_nonce'])) {
		$post_data = $_POST['tab_four_meta_box_nonce'];
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
    foreach ($tab_four_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_tab_four_meta');



/* -------------------------------------------------------------

	Tab Five Meta Box
	
------------------------------------------------------------- */  

function add_tab_five_meta_box() {  
    add_meta_box(  
        'tab_five_meta_box', // $id  
        'Tab Five', // $title  
        'show_tab_five_meta_box', // $callback  
        'course', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_tab_five_meta_box');



// Field Array  
$prefix = 'qns_';  
$tab_five_meta_fields = array(  
    array(  
        'label'=> __('Title','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_five_title',  
        'type'  => 'text'
    ),

	array(  
        'label'=> __('Content','qns'),  
        'desc'  => '',  
        'id'    => $prefix.'tab_five_content',  
        'type'  => 'textarea'
    ),
        
);



// The Callback  
function show_tab_five_meta_box() {  
global $tab_five_meta_fields, $post;  
// Use nonce for verification  
echo '<input type="hidden" name="tab_five_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    foreach ($tab_five_meta_fields as $field) {  
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
					    echo '<div class="control-area"><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="100" rows="12">'.$meta.'</textarea></div>
					        <div class="label-area">'.$field['desc'].'</div>
							<div class="clearboth"></div>';  
					break;
                
			} //end switch  
			
			echo '</div>';
			
    } // end foreach  
	
	echo '<div class="clearboth admin-bottom"></div>';
}



// Save the Data  
function save_tab_five_meta($post_id) {  
    global $tab_five_meta_fields;  
  	
	$post_data = '';
	
	if(isset($_POST['tab_five_meta_box_nonce'])) {
		$post_data = $_POST['tab_five_meta_box_nonce'];
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
    foreach ($tab_five_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_tab_five_meta');

?>