<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( 	"name" 		=> "Main Layout",
						"desc" 		=> "Select main content and sidebar alignment. Choose between no sidebar, right sidebar or left sidebar layout.",
						"id" 		=> "sidebar_position",
						"std" 		=> "right",
						"type" 		=> "images",
						"options" 	=> array(
							'none' 	=> $url . '1col.png',
							'right'	=> $url . '2cr.png',
							'left' 	=> $url . '2cl.png'
						)
				);

$of_options[] = array( 	"name" 		=> "Display search in main menu",
						"desc" 		=> "Tick to display",
						"id" 		=> "main_menu_search",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( "name" => "Logo",
						"desc" => "Upload a logo",
						"id" => "logo_image",
						"std" => "",
						"type" => "media"
				);
				
$of_options[] = array( 	"name" 		=> "Logo Text Dark",
						"desc" 		=> "e.g. Park",
						"id" 		=> "logo_text_dark",
						"std" 		=> "",
						"type" 		=> "text"
				);
							
$of_options[] = array( 	"name" 		=> "Logo Text Light",
						"desc" 		=> "e.g. College",
						"id" 		=> "logo_text_light",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Default Header Image URL",
						"desc" 		=> "Displayed on all inner pages, e.g. http://website.com/image.jpg",
						"id" 		=> "default_header_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Favicon",
						"desc" 		=> "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
						"id" 		=> "custom_favicon",
						"std" 		=> "",
						"type" 		=> "upload"
				); 
				
$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Footer Text",
						"desc" 		=> "Displayed in the footer area",
						"id" 		=> "footer_text",
						"std" 		=> '&copy; Copyright - <a href="#">ParkCollege</a> by <a href="#">Quite Nice Stuff</a>',
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Home Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Display Homepage Blocks",
						"desc" 		=> "Tick to display",
						"id" 		=> "display_homepage_blocks",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( "name"      => "Number of Homepage Coloured Blocks",
						"desc"     => "",
						"id"       => "homepage_coloured_blocks_number",
						"std"      => "5",
						"type"     => "select",
						"options"  => array(
								'3'  => 'Three',
								'4'  => 'Four',
								'5'  => 'Five',)
				);

$of_options[] = array( 	"name" 		=> "Homepage Coloured Blocks",
						"desc" 		=> "",
						"id" 		=> "homepage_coloured_blocks",
						"std" 		=> "",
						"type" 		=> "custom_blocks"
				);

$of_options[] = array( 	"name" 		=> "Homepage Slideshow",
						"desc" 		=> "Add the description/caption like so:<br /><br />&lt;p&gt;First line text&lt;/p&gt;<br />
						&lt;div class=\"clearboth\"&gt;&lt;/div&gt;<br />
						&lt;p&gt;Second line text&lt;/p&gt;",
						"id" 		=> "homepage_slider",
						"std" 		=> "",
						"type" 		=> "slider"
				);
				
$of_options[] = array( 	"name" 		=> "Slideshow Boxed Layout",
						"desc" 		=> "Tick if your slideshow images are the same width as your content",
						"id" 		=> "slideshow_boxed",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( "name"       => "Slideshow Height in px",
						"desc"      => "Enter a numerical value e.g. \"450\", do NOT add px or %",
						"id"        => "slideshow_height",
						"std"       => "450",
						"type"      => "text"
				);
				
$of_options[] = array( 	"name" 		=> "Do not overlay header on slideshow",
						"desc" 		=> "Tick this option if you do not wish to overlay the header on your slideshow",
						"id" 		=> "slideshow_header_overlay",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
		
$of_options[] = array( 	"name" 		=> "Styling Options",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Body Background Colour",
						"desc" 		=> "",
						"id" 		=> "body_background",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( "name"       => "Background Image",
						"desc"      => "Upload a background image",
						"id"        => "body_background_image",
						"std"       => "",
						"type"      => "media"
				);

$of_options[] = array( "name"      => "Background Repeat",
						"desc"     => "Choose how to repeat the background image",
						"id"       => "background_repeat",
						"std"      => "repeat",
						"type"     => "select",
						"options"  => array(
							'repeat'    => 'Repeat',
							'repeat-y'  => 'Repeat-y',
							'repeat-x'  => 'Repeat-x',
							'no-repeat' => 'No-repeat',)
				);

$of_options[] = array( 	"name" 		=> "Main Colour",
						"desc" 		=> "",
						"id" 		=> "main_colour",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Footer Background Colour",
						"desc" 		=> "",
						"id" 		=> "footer_background_colour",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Footer Highlight Colour",
						"desc" 		=> "",
						"id" 		=> "footer_highlight_colour",
						"std" 		=> "",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Footer Text Link Colour",
						"desc" 		=> "",
						"id" 		=> "footer_link_colour",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Top Bar Text Hover Colour",
						"desc" 		=> "",
						"id" 		=> "top_bar_hover_colour",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( "name" =>  "Slideshow Caption Background Colour (RGBA format)",
						"desc" => "Use http://hex2rgba.devoth.com/ e.g. rgba(28, 28, 28, 0.7)",
						"id" => "main_colorrgba",
						"std" => "",
						"type" => "text");
	
$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( "name"       => "Google Font",
						"desc"      => "Add Google Font Code Here, e.g. <br /><br /> &#60;link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,700,900' rel='stylesheet' type='text/css'&#62;",
						"id"        => "custom_font_code",
						"std"       => "<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,700,900' rel='stylesheet' type='text/css'>",
						"type"      => "textarea"
				);

$of_options[] = array( "name"       => "Google Font Name",
						"desc"      => "Enter the Google Font name / family here without 'font-family', e.g. <br /><br /> 'Merriweather', serif",
						"id"        => "custom_font",
						"std"       => "'Merriweather', serif",
						"type"      => "text"
				);

$of_options[] = array( 	"name" 		=> "Portfolio Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( "name"      => "Portfolio Columns",
						"desc"     => "Choose how many columns to display on the portfolio listing page",
						"id"       => "portfolio_columns",
						"std"      => "two",
						"type"     => "select",
						"options"  => array(
							'two'    => 'Two',
							'three'  => 'Three',
							'four'  => 'Four',)
				);

$of_options[] = array( 	"name" 		=> "Items Per Page",
						"desc" 		=> "The number of portfolio items to be displayed on each page, add a numerical value e.g. \"10\"",
						"id" 		=> "portfolio_items_pp",
						"std" 		=> "10",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Portfolio Page URL",
						"desc" 		=> "To be used on the portfolio single page breadcrumbs, enter your portfolio page slug e.g. \"portfolio\"",
						"id" 		=> "portfolio_page_url",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Course Settings",
						"type" 		=> "heading"
				);							

$of_options[] = array( 	"name" 		=> "Items Per Page",
						"desc" 		=> "The number of course items to be displayed on each page, add a numerical value e.g. \"10\"",
						"id" 		=> "course_items_pp",
						"std" 		=> "10",
						"type" 		=> "text"
				);
				
$of_options[] = array( "name"      => "Course Order",
						"desc"     => "Choose the order courses are displayed in on the course page",
						"id"       => "course_order",
						"std"      => "ASC",
						"type"     => "select",
						"options"  => array(
							'DESC' => 'Oldest First',
							'ASC'  => 'Newest First',)
				);
				
$of_options[] = array( 	"name" 		=> "Course Page URL",
						"desc" 		=> "To be used on the course single page breadcrumbs, enter your course page slug e.g. \"courses\"",
						"id" 		=> "course_page_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Teacher Settings",
						"type" 		=> "heading"
				);							

$of_options[] = array( 	"name" 		=> "Items Per Page",
						"desc" 		=> "The number of teachers to be displayed on each page, add a numerical value e.g. \"10\"",
						"id" 		=> "teacher_items_pp",
						"std" 		=> "10",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Link to Teacher Single Page",
						"desc" 		=> "Tick to switch link on",
						"id" 		=> "teacher_single_link",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( "name"      => "Teacher Single Page Style",
						"desc"     => "",
						"id"       => "teacher_single_style",
						"std"      => "style_one",
						"type"     => "select",
						"options"  => array(
							'style_one' => 'Style One',
							'style_two'  => 'Style Two',)
				);
						
$of_options[] = array( 	"name" 		=> "Teacher Page URL",
						"desc" 		=> "To be used on the teacher single page breadcrumbs, enter your teacher page slug e.g. \"teachers\"",
						"id" 		=> "teacher_page_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Event Settings",
						"type" 		=> "heading"
				);							

$of_options[] = array( 	"name" 		=> "Items Per Page",
						"desc" 		=> "The number of events to be displayed on each page, add a numerical value e.g. \"10\"",
						"id" 		=> "event_items_pp",
						"std" 		=> "10",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Event Page URL",
						"desc" 		=> "To be used on the event single page breadcrumbs, enter your event page slug e.g. \"events\"",
						"id" 		=> "event_page_url",
						"std" 		=> "",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> "Show Past Events",
						"desc" 		=> "Check to show past events",
						"id" 		=> "event_show_past",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"name" 		=> "Order By",
						"desc" 		=> "Choose the order events are displayed",
						"id" 		=> "event_order",
						"std" 		=> "Oldest First",
						"type" 		=> "select",
						"options"	=> array('Oldest First', 'Newest First')
				);
		
$of_options[] = array( 	"name" 		=> "Contact Settings",
						"type" 		=> "heading"
				);
						
$of_options[] = array( 	"name" 		=> "Email Address",
						"desc" 		=> "e.g. email@website.com",
						"id" 		=> "email_address",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Phone Number",
						"desc" 		=> "e.g. 1800-562-3764",
						"id" 		=> "phone_number",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Social Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Twitter URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_twitter",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Facebook URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_facebook",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Google+ URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_googleplus",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Pinterest URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_pinterest",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Flickr URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_flickr",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Youtube URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_youtube",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Vimeo URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_vimeo",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Skype URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_skype",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "RSS URL",
						"desc" 		=> "e.g. http://website.com/user",
						"id" 		=> "social_rss",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
					
	}
}
?>
