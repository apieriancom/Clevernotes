<?php
// Enable session
add_action('init', 'custom_init_session', 1);
function custom_init_session() {
    if (!session_id()) {
        session_start();
    }
}

// Test if logged in
add_action('init', 'loggedIn', 2);
function loggedIn() {
    	if (isset($_SESSION['cnt'])) {
     	return true;
    	}
	else {
		return false;
    	}
}

add_action('init', 'getSubjects', 3);
function getSubjects() {
	$subjects = $_SESSION['subjects'];
	if (isset($subjects)) {
		$subject_array = array();
		$subject_and_level_array = array();
		foreach($subjects as $key => $subject) {
			$theconSubject = (isset($subject->Contact_Subjects__r->records) ? $subject->Contact_Subjects__r->records : null);
			$thesubjects = (isset($subject->SubjectLevels__r->records) ? $subject->SubjectLevels__r->records : null);
			$subjectId = $subject->Id;
			foreach($thesubjects as $key => $level) {
				if($theconSubject!=null){
					if($subjectId==$theconSubject->Subject__c&&$level->Level__r->Id==$theconSubject->Subject_Level__c) {
						//echo $subject->Name . " : " . $subject->WordPress_ID__c ." -> " .$level->Level__r->Name . " - " . $level->Level__r->Wordpress_ID__c."<br>";	//Subject Level not used for now because there aren't enough articles
						$subject_array[] = $subject->WordPress_ID__c;
					}
				}
			}
		}
		$default_array = array(2101,58,59); //59 = Learning  / 58 = Study Centre / 2101 = Competition
		$subject_array = array_merge($default_array, $subject_array);
		return $subject_array;
	}
}

add_action('init', 'getSubjectsAndLevels');
function getSubjectsAndLevels() {
	$subjects = $_SESSION['subjects'];
	if (isset($subjects)) {
		$subject_and_level_array = array();
		$x = 0;
		foreach($subjects as $key => $subject) {
			$theconSubject = (isset($subject->Contact_Subjects__r->records) ? $subject->Contact_Subjects__r->records : null);
			$thesubjects = (isset($subject->SubjectLevels__r->records) ? $subject->SubjectLevels__r->records : null);
			$subjectId = $subject->Id;
			foreach($thesubjects as $key => $level) {
				if($theconSubject!=null){
					if($subjectId==$theconSubject->Subject__c&&$level->Level__r->Id==$theconSubject->Subject_Level__c) {
						//echo $subject->Name . " : " . $subject->WordPress_ID__c ." -> " .$level->Level__r->Name . " - " . $level->Level__r->Wordpress_ID__c."<br>";	//Subject Level not used for now because there aren't enough articles
						$subject_and_level_array[$subject->Name]['subject'] = $subject->WordPress_ID__c;
						$subject_and_level_array[$subject->Name]['level']= $level->Level__r->Wordpress_ID__c;
					}
				}
			}
			$x++;
		}
		return $subject_and_level_array;
	}
}


//test if running off local server
add_action('init', 'is_local', 4);
function is_local() {
	include('includes/get-tld.php');
	if (($this_tld == "ie") || ($this_tld == "org")) {
		return false;
	}
	else {
		return true;	
	}
}

//function to see if post if more than 29 days and if so is it free, otherwise block it
add_action('init', 'blockPost', 5);
function blockPost() {
	if (is_single()) {
		global $post;					
		//First check if post if under 30 days so then it's free
		/* NOT USED FOR NOW */
		$published = strtotime(get_the_time('Y-m-d', $post->ID)); //Echos date in Y-m-d format.
		$now = strtotime("now");
		$diff = (abs($now) - $published);
		$years = floor($diff / (365*60*60*24));	
			//$time_limit = 2592000; //30 days in seconds
			$time_limit = 1; //disable for now
		if ($diff < $time_limit) {
			return false;	
		}	
		else { //more than 30 days so do more tests 
		   	// require_once ('/var/www/sfdc/validatesubscription.php');
			require_once ('/nas/wp/www/cluster-1716/clevernotes/sfdc/validatesubscription.php');
			
		   	if( validateSubscription()==1 ) {			   
				return false;
		   	}
		   	else {
		    	$terms = get_the_terms( $post->ID, 'article_type') ; //see if it's free even though it's over 29 days     					
				if ($terms) {
					$terms_slugs = array();
						foreach( $terms as $term ) {
						    array_push($terms_slugs,$term->slug); // save the slugs in an array
						}	
					if (in_array('free',$terms_slugs)) {

						return false;
					}
					else if (in_array('home-page',$terms_slugs)) {
						return false;
					}					
					else if ((count($terms_slugs) == 0) || (in_array('paid',$terms_slugs))) {
						return true; //the post is older than 29 days, they are not paid, and it's not free 
					}
				}
				else {
					return true;
				}
								
			}
		}	
	}
}

add_action('init', 'isSubscribed', 6);
function isSubscribed() {
	if(session_id() == "") { //Session is started in header.php
		session_start();
	}	
	$cnt = $_SESSION['cnt'];
	if (isset($cnt->Subscription_End_Date__c)) {
		$Subscription_End_Date__c = $cnt->Subscription_End_Date__c;
	}
	else {
		$Subscription_End_Date__c = "";
	}
	
	$todays_date = date("Y-m-d");	 
	$today = strtotime($todays_date);
	$expiration_date = strtotime($Subscription_End_Date__c);		
	
	if( isset($Subscription_End_Date__c) && ($Subscription_End_Date__c != "") ) {	
		if ($expiration_date > $today) {
			return true;
		}
		else {
			return false;	
		}
	}
	else {
		return false;	
	}
}

add_action('init', 'userPosts');
function userPosts() {
	//create multiple queries and add them together because WordPress can't query multiple custom taxonomies and add them together yet .e.g French -> Higher AND German -> Lower etc.

	$choices = getSubjectsAndLevels();	
	//HACK BECAUSE NO getSubjectsAndLevels() LOCALLY
	//$choices = unserialize('a:9:{i:0;i:2101;i:1;i:58;i:2;i:59;s:10:"Accounting";a:2:{s:7:"subject";s:3:"312";s:5:"level";s:2:"23";}s:8:"Business";a:2:{s:7:"subject";s:2:"29";s:5:"level";s:2:"23";}s:7:"English";a:2:{s:7:"subject";s:2:"12";s:5:"level";s:2:"23";}s:6:"French";a:2:{s:7:"subject";s:2:"27";s:5:"level";s:1:"8";}s:9:"Geography";a:2:{s:7:"subject";s:2:"16";s:5:"level";s:1:"8";}s:5:"Irish";a:2:{s:7:"subject";s:2:"25";s:5:"level";s:2:"23";}}');	
	
	$mergedposts = array();

	if ((isset($choices)) && ($choices != "")) {
		foreach($choices as $choice => $sublevs) {
			if (!is_int($choice)) { //make sure only subjects are used
				$i = 0;
				foreach ($sublevs as $sublev) {
					if ($i == 0) {
						$subject_id = $sublev;
					}
					else {								
						if (($sublev == 23) || ($sublev == 8)) { //higher or lower so include higher and lower posts too
							$level_ids = array($sublev,7);
						}
						else if ($sublev == 7) { //higher AND lower, so also include higher and lower posts too
							$level_ids = array($sublev,23,8);
						}					
						else {
							$level_ids = array($sublev); //foundation or common
						}
					}
					$i++;
				}
	
			//now build queries using variable variables because using arraymerge or using array_push within the loop doesn't work
			$query = array(
				'post_type' => 'post',
				'posts_per_page' => -1,
				'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'category',
							'field' => 'id',
							'terms' => $subject_id
						),		
						array(
							'taxonomy' => 'subject_level',
							'field' => 'term',
							'terms' => $level_ids
						),																			
				)					
			);	
			
			$postids = wp_list_pluck( get_posts($query), 'ID' );
			array_push($mergedposts,$postids);				
			}		
		}
	}
	
	//this is two dimensional array so we need second level which contains IDs
	$user_posts = array();
	foreach($mergedposts as $key => $values) {
		foreach ($values as $id) {	
			array_push($user_posts,$id);
		}
	}	
	
	return $user_posts;
}

add_action('init', 'taxonomyImage');
function taxonomyImage($id,$thumb='medium-cog',$type='taxonomy') {
	$terms = apply_filters(
		'taxonomy-images-get-terms',
		'',		
		array(
			'taxonomy'  => 'category',
			'term_args' => array(
				'hide_empty' => 0,
				),
			)	
		
	);
	if ( ! empty( $terms ) ) {
	    foreach( (array) $terms as $term ) {		    
		 	if( $type == 'taxonomy' ) {
				if ($id == $term->term_taxonomy_id) {
					return wp_get_attachment_image( $term->image_id, $thumb );
				}				
			}
			else if ( $type == 'term' ) {
				if ($id == $term->term_id) {			
			 		return wp_get_attachment_image( $term->image_id, $thumb );
				}
			}
		}
	}
}

//remove feeds because they are including paid articles
remove_action('do_feed_rdf', 'do_feed_rdf', 10, 1);
//remove_action('do_feed_rss', 'do_feed_rss', 10, 1);
//remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
//remove_action('do_feed_atom', 'do_feed_atom', 10, 1);

//test if running off dev server
add_action('init', 'is_dev');
function is_dev() {
	include('includes/get-tld.php');
	if (($this_tld == "org") || ($_SERVER['HTTP_HOST'] == "aws.clevernotes.ie")) {
		return true;
	}
	else {
		return false;	
	}	
}

//test if running off dev server
add_action('init', 'is_live');
function is_live() {
	include('includes/get-tld.php');
	if ($_SERVER['HTTP_HOST'] == "www.clevernotes.ie") {
		return true;
	}
	else {
		return false;	
	}
}

//test category name and give it a title because the categories are only letters now
add_action('init', 'cat_title');
function cat_title($i) {
	switch ($i) {
		case "H + O":
			$cat_title = "Higher and Ordinary";

			break;
		case "H":
			$cat_title = "Higher";
			break;
		case "O":
			$cat_title = "Ordinary";
			break;
		case "F":
			$cat_title = "Foundation";
			break;
		case "C":
			$cat_title = "Common";
			break;
		default:
			$cat_title = "";
	}
	return $cat_title;
}

/**
* Returns ID of top-level parent category, or current category if you are viewing a top-level
*
* @param    string      $catid      Category ID to be checked
* @return   string      $catParent  ID of top-level parent category
*/
add_action('init', 'pa_category_top_parent_id');
function pa_category_top_parent_id ($catid) {
 while ($catid) {
  $cat = get_category($catid); // get the object for the catid
  $catid = $cat->category_parent; // assign parent ID (if exists) to $catid
  // the while loop will continue whilst there is a $catid
  // when there is no longer a parent $catid will be NULL so we can assign our $catParent
  $catParent = $cat->cat_ID;
 }
return $catParent;
}

//Add Meta Box for ID of Post
add_action( 'add_meta_boxes', 'post_id_meta_box' );  
function post_id_meta_box()  
{  
    add_meta_box( 'cn-post-id', 'Unique ID', 'post_id_meta_box_cb', 'post', 'side', 'high' );  
}  
//now populate meta box with ID
function post_id_meta_box_cb()  
{  
	global $post;
	echo "<strong>".$post->ID."</strong>";
}  

/**********************************************************/
/*    Allow Contributor to upload Media
/**********************************************************/
if ( current_user_can('contributor') && !current_user_can('upload_files') ) {
	add_action('admin_init', 'allow_contributor_uploads');
}

function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
}

/**********************************************************/
/*   Limit custom statuses for EditFlow based on user role
/**********************************************************/

/**
 * Limit custom statuses based on user role
 * In this example, we limit the statuses available to the
 * 'contributor' user role
 *
 * @see http://editflow.org/extend/limit-custom-statuses-based-on-user-role/
 *
 * @param array $custom_statuses The existing custom status objects
 * @return array $custom_statuses Our possibly modified set of custom statuses
 */
function efx_limit_custom_statuses_by_role( $custom_statuses ) {

	$current_user = wp_get_current_user();
	switch( $current_user->roles[0] ) {
		// Only allow a contributor to access specific statuses from the dropdown
		case 'admin-rights':
			$permitted_statuses = array(
					'origination',
					'pending',
					'copyedit',
					'format',
					'multimedia',
					'senior-editor-review',
					'smelanguage-review',
					'ready',
					'scheduled',
				);
			// Remove the custom status if it's not whitelisted
			foreach( $custom_statuses as $key => $custom_status ) {
				if ( !in_array( $custom_status->slug, $permitted_statuses ) )
					unset( $custom_statuses[$key] );
			}
		break;
		case 'apierian':
		case 'copyeditors':
		case 'formatting':
		case 'multimedia':
		case 'smes':
		case 'language-proofers':
			$permitted_statuses = array(
					'origination',
					'pending',
					'copyedit',
					'format',
					'multimedia',
					'multimedia2',
					'senior-editor-review',
					'smelanguage-review',
					'ready',
				);
			// Remove the custom status if it's not whitelisted
			foreach( $custom_statuses as $key => $custom_status ) {
				if ( !in_array( $custom_status->slug, $permitted_statuses ) )
					unset( $custom_statuses[$key] );
			}
		break;	
		
		case 'contributor':
		//case 'Author':
		//case 'Freelance Writers':
		//case 'ID':
			$permitted_statuses = array(
					'origination',
					'pending',
				);
			// Remove the custom status if it's not whitelisted
			foreach( $custom_statuses as $key => $custom_status ) {
				if ( !in_array( $custom_status->slug, $permitted_statuses ) )
					unset( $custom_statuses[$key] );
			}
		break;		
	}
	return $custom_statuses;
}
add_filter( 'ef_custom_status_list', 'efx_limit_custom_statuses_by_role' );


/**************************************************************************************/
/*    Most viewed posts for home page hack of wp-postviews function get_most_viewed
/**************************************************************************************/
add_action('init', 'getViews');
function getViews($mode = '', $limit = 10, $chars = 0, $display = true) {
	global $wpdb;
	$views_options = get_option('views_options');
	$where = '';
	$temp = '';
	$output = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	//$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit");
	//$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < NOW() - INTERVAL 1 WEEK AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit");
	//echo "SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE DATE_SUB(NOW(),INTERVAL 1 WEEK) <= post_date AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit";
	$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE DATE_SUB(NOW(),INTERVAL 1 WEEK) <= post_date AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit");

	if($most_viewed) {
		foreach ($most_viewed as $post) {
			//$post_views = intval($post->views);
			$post_title = get_the_title($post);
			if($chars > 0) {
				$post_title = snippet_text($post_title, $chars);
			}
			$post_excerpt = views_post_excerpt($post->post_excerpt, $post->post_content, $post->post_password, $chars);
			$temp = stripslashes($views_options['most_viewed_template']);
			$temp = str_replace(" - ", "", $temp);
			$temp = str_replace("views", "", $temp);
			$temp = str_replace("%VIEW_COUNT%", "", $temp);
			$temp = str_replace("%POST_TITLE%", $post_title, $temp);
			$temp = str_replace("%POST_EXCERPT%", $post_excerpt, $temp);
			$temp = str_replace("%POST_CONTENT%", $post->post_content, $temp);
			$temp = str_replace("%POST_URL%", get_permalink($post), $temp);
			$output .= $temp;
		}			
	} else {
		$output = '<ul><li>'.__('No new lessons this week.', 'wp-postviews').'</li></ul>'."\n";
	}
	return $output;
}

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
		'menu-1' => __( 'Header' ),
		'menu-2' => __( 'Footer' ),
		'menu-3' => __( 'Responsive' )
		)
	);
}

function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

/*
function hide_disqus() {
if (is_page('Home Page')) { ?>
<script>$(document).ready(function() {
$("#disqus_thread").remove()
});</script>
<?php } }
add_action('wp_footer', 'hide_disqus');
*/

function tokenTruncate($string, $your_desired_width) {
  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
  $parts_count = count($parts);
  $length = 0;
  $last_part = 0;
  for (; $last_part < $parts_count; ++$last_part) {
    $length += strlen($parts[$last_part]);
    if ($length > $your_desired_width) { break; }
  }

  return implode(array_slice($parts, 0, $last_part));
}

function replace_ellipsis($text) {
	$return = str_replace('[...]', '...', $text);
	return $return;
}
add_filter('get_the_excerpt', 'replace_ellipsis');

// Add default posts and comments RSS feed links to head
add_theme_support('automatic-feed-links');

//thumbnails for posts
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 290, 180, true );
add_image_size( 'search-results',  235, 180, true );
add_image_size( 'standard-thumb',  100, 100, true );
add_image_size( 'small-feature',  190, 190, true );
add_image_size( 'featured-image',  480, 480 );
add_image_size( 'two-col-article',  370, 250, true );
add_image_size( 'subject-header', 1020, 260, true );
add_image_size( 'tiny-cog',  20, 20 );
add_image_size( 'small-cog',  33, 33 );
add_image_size( 'medium-cog',  50, 50 );
add_image_size( 'large-cog',  220, 220 );

/**********************************************************/
/*     Add Clevernotes avatar
/**********************************************************/
if ( !function_exists('fb_addgravatar') ) {
	function fb_addgravatar( $avatar_defaults ) {
		$myavatar = get_bloginfo('template_directory') . '/images/avatars/clevercog.png';
		$avatar_defaults[$myavatar] = 'Clevercog';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'fb_addgravatar' );
}

/* Enqueue Scripts */
function tools_method() {
   wp_register_script('tools_script',
       get_template_directory_uri() . '/js/jquery.tools.min.js',
       array('jquery'),
       '1.4.3' );
   wp_enqueue_script('tools_script');
}
add_action('wp_enqueue_scripts', 'tools_method');

function custom_method() {
   wp_register_script('custom_script',
       get_template_directory_uri() . '/js/custom.js',
       array('jquery'),
       '1.4' );
   wp_enqueue_script('custom_script');
}
add_action('wp_enqueue_scripts', 'custom_method');

//if (is_page_template('profile-page.php') ) {
	function jquery_method() {		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-draggable');		
	}
	add_action('wp_enqueue_scripts', 'jquery_method');
//}


/**
 * Register widgetized areas, 
 * @uses register_sidebar
 */
function theme_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Related posts widget area', 'wp' ),
		'id' => 'related-posts-widget-area',
		'description' => __( 'Related posts widget area', 'wp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer widget area', 'wp' ),
		'id' => 'top-footer-widget-area',
		'description' => __( 'Footer widget area', 'wp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
/** Register sidebars by running simply_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'theme_widgets_init' );

// Add support for a variety of post formats
//add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

/********************************/
/*      TinyMCE custom styles   */
/********************************/
// Add custom CTA styles to TinyMCE editor
if ( ! function_exists('tdav_css') ) {
	function tdav_css($wp) {
		$wp .= ',' . get_bloginfo('stylesheet_directory') . '/css/tinymce.css';
		return $wp;
	}
}
add_filter( 'mce_css', 'tdav_css' );

/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'mce_buttons', 'my_mce_buttons' );
function my_mce_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect', 'styleselect2' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
function tuts_mce_before_init( $settings ) {

    $style_formats = array(
		array(  
            'title' => 'Swanky and Moo Moo',  
		  'inline' => 'span',
            'classes' => 'swanky_and_moo_moo'
        	),	
		array(  
            'title' => 'Waiting for the Sunrise',  
		  'inline' => 'span',
            'classes' => 'waiting_for_the_sunrise'
        	),	
		array(  
            'title' => 'Architects Daughter',  
		  'inline' => 'span',
            'classes' => 'architects_daughter'
        	),					
		array(  
            'title' => 'Pull quote left',  
            'selector' => 'blockquote',  
            'classes' => 'pullquote_float_left'
        	),
		array(  
            'title' => 'Pull quote right',  
            'selector' => 'blockquote',  
            'classes' => 'pullquote_float_right'
        	),	    
		array(  
            'title' => 'Tick list',  
            'selector' => 'ul',  
            'classes' => 'tick_list'
        	),
		array(  
            'title' => 'Grey star list',  
            'selector' => 'ul',  
            'classes' => 'star_list'
        	),
		array(  
            'title' => 'Gold star list',  
            'selector' => 'ul',  
            'classes' => 'gold_star_list'
        	),
		array(  
            'title' => 'Green star list',  
            'selector' => 'ul',  
            'classes' => 'green_star_list'
        	),
		array(  
            'title' => 'Red star list',  
            'selector' => 'ul',  
            'classes' => 'red_star_list'
        	),
		array(  
            'title' => 'Standard box',   
		  'inline' => 'div',
            'classes' => 'standard_box'
        	),
		array(  
            'title' => 'Tick box',   
		  'inline' => 'div',
            'classes' => 'tick_box'
        	),
		array(  
            'title' => 'Cross box',   
		  'inline' => 'div',
            'classes' => 'x_box'
        	),		
		array(  
            'title' => 'Alert box',  
		  'inline' => 'div',
            'classes' => 'alert_box'
        	),
		array(  
            'title' => 'Warning box',  
		  'inline' => 'div',
            'classes' => 'warning_box'
        	),		
		array(  
            'title' => 'Information box',  
		  'inline' => 'div',
            'classes' => 'info_box'
        	),
		array(  
            'title' => 'Cross box',  
		  'inline' => 'div',
            'classes' => 'cross_box'
        	),						
		array(  
            'title' => 'Dropcap',  
		  'inline' => 'span',
            'classes' => 'dropcap'
        	),				
	);

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

/**************************************************************************************************/
/*      Fix for issue with Edit Flow plugin. See:                                                 */
/*      http://wordpress.org/support/topic/plugin-edit-flow-unable-to-add-users-to-usergroups     */
/**************************************************************************************************/
function jp_edit_flow_show_all_users() {
	$args = array(
		'fields' => array(
			'ID',
			'display_name',
			'user_email'
		),
		'orderby' => 'display_name',
	);
	return $args;
}
add_filter('ef_users_select_form_get_users_args', 'jp_edit_flow_show_all_users');


/*******************************************/
/*      Short Codes for Column Layouts     */
/*******************************************/

function webtreats_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'webtreats_one_third');

function webtreats_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'webtreats_one_third_last');

function webtreats_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'webtreats_two_third');

function webtreats_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'webtreats_two_third_last');

function webtreats_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'webtreats_one_half');

function webtreats_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'webtreats_one_half_last');

function webtreats_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'webtreats_one_fourth');

function webtreats_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'webtreats_one_fourth_last');

function webtreats_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'webtreats_three_fourth');

function webtreats_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'webtreats_three_fourth_last');

function webtreats_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'webtreats_one_fifth');

function webtreats_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'webtreats_one_fifth_last');

function webtreats_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'webtreats_two_fifth');

function webtreats_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'webtreats_two_fifth_last');

function webtreats_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'webtreats_three_fifth');

function webtreats_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'webtreats_three_fifth_last');

function webtreats_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'webtreats_four_fifth');

function webtreats_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'webtreats_four_fifth_last');

function webtreats_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'webtreats_one_sixth');

function webtreats_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'webtreats_one_sixth_last');

function webtreats_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'webtreats_five_sixth');

function webtreats_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'webtreats_five_sixth_last');


/***************************************************************/
/*      Disable Wordpress wpautop and wptexturize filters.     */
/***************************************************************/

function webtreats_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'webtreats_formatter', 99);
add_filter('widget_text', 'webtreats_formatter', 99);

/***************************/
/*     Fixing the backtrack_limit Bug      */
/***************************/

//Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
@ini_set('pcre.backtrack_limit', 500000);

/***************************************************/
/*      Add custom post types to search
/***************************************************/

function post_type_tags_fix($request) {
    if ( isset($request['tag']) && !isset($request['post_type']) )
    $request['post_type'] = 'any';
    return $request;
} 
add_filter('request', 'post_type_tags_fix');

function short_content($excerpt){
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 120);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	echo $excerpt . "...";
}

/***************************************************************/
/*      Custom Taxonomies
/***************************************************************/

/**** SUBJECTS ****/
add_action( 'init', 'posts_init' );

function posts_init() {
	
	$subject_labels = array(
		'name' => _x( 'Subject Levels', 'taxonomy general name' ),
		'singular_name' => _x( 'Subject Level', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Subject Levels' ),
		'all_items' => __( 'All Subject Levels' ),
		'parent_item' => __( 'Parent Subject Level' ),
		'parent_item_colon' => __( 'Parent Subject Level' ),
		'edit_item' => __( 'Edit Subject Level' ), 
		'update_item' => __( 'Update Subject Level' ),
		'add_new_item' => __( 'Add New Subject Level' ),
		'new_item_name' => __( 'New Subject Level name' ),
		'menu_name' => __( 'Subject Level' ),
	);
	
	register_taxonomy(
		'subject_level',
		'post',
		array(
			'label' => __( 'Subject Level' ),
			'hierarchical' => true,
		    	'show_ui' => true,
		    	'query_var' => true,	
			'labels' => $subject_labels,					
			'rewrite' => array( 'slug' => 'subject_level' )
		)
	);

	$cert_labels = array(
		'name' => _x( 'Certificate', 'taxonomy general name' ),
		'singular_name' => _x( 'Certificate Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Certificate Categories' ),
		'all_items' => __( 'All Certificate Categories' ),
		'parent_item' => __( 'Parent Certificate Category' ),
		'parent_item_colon' => __( 'Parent Certificate Category:' ),
		'edit_item' => __( 'Edit Certificate Category' ), 
		'update_item' => __( 'Update Certificate Category' ),
		'add_new_item' => __( 'Add New Certificate Category' ),
		'new_item_name' => __( 'New Certificate Category Name' ),
		'menu_name' => __( 'Certificate' ),
	); 	

	register_taxonomy(
		'certificate',
		'post',
		array(
			'label' => __( 'Certificate' ),
			'hierarchical' => true,
		    	'show_ui' => true,
		    	'query_var' => 'certificate',
			'labels' => $cert_labels,				
			'rewrite' => true
		)
	);
		
	$artstyle_labels = array(
		'name' => _x( 'Article Style', 'taxonomy general name' ),
		'singular_name' => _x( 'Article Style Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Article Style Categories' ),
		'all_items' => __( 'All Article Style Categories' ),
		'parent_item' => __( 'Parent Article Style Category' ),
		'parent_item_colon' => __( 'Parent Article Style Category' ),
		'edit_item' => __( 'Edit Article Style Category' ), 
		'update_item' => __( 'Update Article Style Category' ),
		'add_new_item' => __( 'Add New Article Style Category' ),
		'new_item_name' => __( 'New Article Style Category Name' ),
		'menu_name' => __( 'Article Style' ),
	); 	

	register_taxonomy(
		'article_style',
		'post',
		array(
			'label' => __( 'Article Style' ),
			'hierarchical' => true,
		    	'show_ui' => true,
		    	'query_var' => 'article_style',
			'labels' => $artstyle_labels,				
			'rewrite' => true
		)
	);	
	
	$tickerstyle_labels = array(
		'name' => _x( 'Ticker category', 'taxonomy general name' ),
		'singular_name' => _x( 'Ticker Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Ticker Categories' ),
		'all_items' => __( 'All Ticker Categories' ),
		'parent_item' => __( 'Parent Ticker Category' ),
		'parent_item_colon' => __( 'Parent Ticker Category' ),
		'edit_item' => __( 'Edit Ticker Category' ), 
		'update_item' => __( 'Update Ticker Category' ),
		'add_new_item' => __( 'Add New Ticker Category' ),
		'new_item_name' => __( 'New Ticker Category Name' ),
		'menu_name' => __( 'Ticker category' ),
	); 	

	register_taxonomy(
		'ticker_category',
		'updates',
		array(
			'label' => __( 'Ticker category' ),
			'hierarchical' => true,
		    	'show_ui' => true,
		    	'query_var' => 'ticker_category',
			'labels' => $tickerstyle_labels,	
			'rewrite' => array( 'slug' => 'ticker_category' )
		)
	);
	
	$arttype_labels = array(
		'name' => _x( 'Article Type', 'taxonomy general name' ),
		'singular_name' => _x( 'Article Type Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Article Type Categories' ),
		'all_items' => __( 'All Article Type Categories' ),
		'parent_item' => __( 'Parent Article Type Category' ),
		'parent_item_colon' => __( 'Parent Article Type Category' ),
		'edit_item' => __( 'Edit Article Type Category' ), 
		'update_item' => __( 'Update Article Type Category' ),
		'add_new_item' => __( 'Add New Article Type Category' ),
		'new_item_name' => __( 'New Article Type Category Name' ),
		'menu_name' => __( 'Article Type' ),
	); 	

	register_taxonomy(
		'article_type',
		'post',
		array(
			'label' => __( 'Article Type' ),
			'hierarchical' => true,
		    	'show_ui' => true,
		    	'query_var' => 'article_type',
			'labels' => $arttype_labels,				
			'rewrite' => true
		)
	);	
		
}

/**** FILTERS TO MAKE SURE SLUGS READ TAXONOMIES ****/

add_filter('post_link', 'certificate_permalink', 10, 3);
add_filter('post_type_link', 'certificate_permalink', 10, 3);

/***************************************************************/
/*      Custom Posts
/***************************************************************/

add_action( 'init', 'create_ticker_type' );
function create_ticker_type() {
	register_post_type( 'updates',
		array(
			'labels' => array(
				'name' => __( 'Ticker' ),
				'singular_name' => __( 'Ticker' ),	 
				'add_new' => 'Add new ticker item',
				'edit_item' => 'Edit ticker item',
				'new_item' => 'New ticker item',
				'view_item' => 'View ticker item',
				'search_items' => 'Search ticker items',
				'not_found' => 'No ticker items found',
				'not_found_in_trash' => 'No ticker items found in Trash',
			),
				'public' => true,
				'hierarchical' => true,
				'taxonomies' => array('category'),
				'menu_position' => 9,   				
				'supports' => array('title','thumbnail','editor','category') 			
		)
	);
}

add_action( 'init', 'create_faq_type' );
function create_faq_type() {
	register_post_type( 'faq',
		array(
			'labels' => array(
				'name' => __( 'FAQ' ),
				'singular_name' => __( 'FAQ' ),
				'add_new' => 'Add new FAQ',
				'edit_item' => 'Edit FAQ',
				'new_item' => 'New FAQ',
				'view_item' => 'View FAQ',
				'search_items' => 'Search FAQs',
				'not_found' => 'No FAQs found',
				'not_found_in_trash' => 'No FAQs found in Trash',
			),
				'public' => true,
				'hierarchical' => true,
				'menu_position' => 10,
				'supports' => array('title','editor','page-attributes')
		)
	);
}

add_action( 'init', 'create_testimonial_type' );
function create_testimonial_type() {
	register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonial' ),
				'add_new' => 'Add new testimonial',
				'edit_item' => 'Edit testimonial',
				'new_item' => 'New testimonial',
				'view_item' => 'View testimonial',
				'search_items' => 'Search testimonials',
				'not_found' => 'No testimonials found',
				'not_found_in_trash' => 'No testimonials found in Trash',
			),
				'public' => true,
				'hierarchical' => true,
				'menu_position' => 11,
				'supports' => array('title','thumbnail','editor','page-attributes')
		)
	);
}

/* ICONS for post type */

add_action( 'admin_head', 'cpt_icons' );
function cpt_icons() {
?>
    <style type="text/css" media="screen">
        #menu-posts-updates .wp-menu-image {
            background: url(<?php bloginfo('template_url') ?>/images/icons/ticker.png) no-repeat 6px -17px !important;
        }
	#menu-posts-updates:hover .wp-menu-image, #menu-posts-POSTTYPE.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
    </style>
<?php 
} 

/**
 * Define default terms for custom taxonomies in WordPress 3.0.1
 *
 * @author    Michael Fields     http://wordpress.mfields.org/
 * @props     John P. Bloch      http://www.johnpbloch.com/
 *
 * @since     2010-09-13
 * @alter     2010-09-14
 *
 * @license   GPLv2
 */
function mfields_set_default_object_terms( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            'article_type' => array( 'paid','lessons' ),
		  'article_style' => array( 'standard' ),
		  'ticker_category' => array( 'general' ),
            );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'mfields_set_default_object_terms', 100, 2 );
 
function certificate_permalink($permalink, $post_id, $leavename) {
	if (strpos($permalink, '%certificate%') === FALSE) return $permalink;
 
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;
 
        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'certificate');	
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'general';
 
	return str_replace('%certificate%', $taxonomy_slug, $permalink);
}

add_filter('post_link', 'subject_level_permalink', 10, 3);
add_filter('post_type_link', 'subject_level_permalink', 10, 3);
 
function subject_level_permalink($permalink, $post_id, $leavename) {
	if (strpos($permalink, '%subject_level%') === FALSE) return $permalink;
 
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;
 
        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'subject_level');	
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'all-levels';
 
	return str_replace('%subject_level%', $taxonomy_slug, $permalink);
}

/***************************/
/*      Theme Options      */
/***************************/

// Add support for custom backgrounds.
add_theme_support( 'custom-background', array(
	'default-color' => 'E1E1E2',
	'default-image' => get_template_directory_uri() . '/images/backgrounds/background.jpg'
) );

// Now add custom background into the header of the theme
if ( function_exists('get_custom_header')) {           
        add_theme_support('custom-background');        
}

$themename = wp_get_theme( 'clevernotes' );
$shortname = "opts";
$options = array (

array(  "type" => "open"),

array(  "name" => "Organisation",
        "desc" => "Your organisation name",
        "id" => $shortname."_organisation",
        "std" => "",
        "type" => "text"),

array(  "name" => "Phone number",
        "desc" => "Your main contact number",
        "id" => $shortname."_phone_number",
        "std" => "",
        "type" => "text"),

array(  "name" => "Fax number",
        "desc" => "Your main fax number",
        "id" => $shortname."_fax_number",
        "std" => "",
        "type" => "text"),
	   
array(  "name" => "Address",
        "desc" => "Business address",
        "id" => $shortname."_business_address",
        "type" => "textarea"),

array(  "name" => "Email address",
        "desc" => "Your primary business email address",
        "id" => $shortname."_business_email",
        "type" => "text"),

array(  "name" => "VAT number",
        "desc" => "Your VAT number",
        "id" => $shortname."_vat",
        "type" => "text"),	
	   
array(  "name" => "Company registration number",
        "desc" => "Your company registration number",
        "id" => $shortname."_company_reg",
        "type" => "text"),

array(  "name" => "YouTube",
        "desc" => "Your YouTube Channel",
        "id" => $shortname."_youtube",
        "type" => "text"),	

array(  "name" => "Facebook",
        "desc" => "Your Facebook Page",
        "id" => $shortname."_facebook",
        "type" => "text"),
	   
array(  "name" => "Twitter",
        "desc" => "Your Twitter Page",
        "id" => $shortname."_twitter",
        "type" => "text"),	

array(  "type" => "close")

);
function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>

<p></p>
<form method="post">

<?php foreach ($options as $value) {

//Next is the code which tells WordPress how to display the ‘type’ of option used (title, open, close, text, textarea, checkbox etc.)

switch ( $value['type'] ) {

case "open":
?>
<table width="100%" border="0" style="background-color:#ECECEC; padding:10px;">

<?php break;

case "close":
?>

</table><br />

<?php break;

case "title":
?>
<table width="100%" border="0" style="background-color:#777; color:#FFF; padding:5px 10px;"><tr>
    <td colspan="2"><h3><?php echo $value['name']; ?></h3></td>
</tr>

<?php break;

case 'text':
?>

<tr>
    <td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="85%"><input style="width: 400px; padding: 10px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr>

<tr>
    <td><?php echo $value['desc']; ?></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #FFF;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'textarea':
?>

<tr>
    <td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="85%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?></textarea></td>

</tr>

<tr>
    <td><?php echo $value['desc']; ?></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #FFF;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'select':
?>
<tr>
    <td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="85%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr>
    <td><?php echo $value['desc']; ?></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #FFF;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case "checkbox":
?>
    <tr>
    <td width="15%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
        <td width="85%"><? if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                </td>
    </tr>

    <tr>
        <td><small><?php echo $value['desc']; ?></small></td>
   </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php         break;

}
}
?>
<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}
add_action('admin_menu', 'mytheme_add_admin'); 


/**
 * Short code - use variable to get background color
 */

function colorbox_sc( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'background'   => '',
		'fontcolor'   => 'black',
	), $atts ) );

	$output = '<div class="color_box" style="color:' . esc_attr( $fontcolor ) . ';background:#' . esc_attr( $background ) . '">'.$content.'</div>';
	return $output;
}
add_shortcode('colorbox', 'colorbox_sc');

function competition_form_sc( $atts ) {	                     
	if (isset($_SESSION['cnt'])) {  
	
	extract( shortcode_atts( array(
		'competition_name'   => ''
	), $atts ) );
		
	$cnt = $_SESSION['cnt'];
	$name = $cnt->FirstName . " ". $cnt->LastName;
	if (isset($cnt->MobilePhone)) {
		$mobilePhone = $cnt->MobilePhone;	
	}
	else {
		$mobilePhone = "";
	}
	$output = "<form action='/competition-thanks' method='post' id='competition_form'>
			<input type='hidden' value='" . esc_attr($competition_name)  . "' name='competition_name'>
			<fieldset>
				 <div style='margin-top: 15px;'>
				<label for='entrants_name' class='bold'>Name</label><input class='competition_field' type='text' name='entrants_name' value='".$name."'>
				</div>
				<div style='margin-top: 10px;'>
				<label for='competition_email' class='bold'>Email</label><input class='competition_field' type='text' name='competition_email' value='".$cnt->Email."'>
				</div>
				<div style='margin-top: 10px;'>
				<label for='mobile' class='bold'>Mobile Number</label><input class='competition_field' type='text' name='mobile' value='".$mobilePhone."'>
				</div>
				<div style='margin-top: 10px;'>
				<label for='competition_email' class='bold'>Answer/s</label><textarea style='width: 300px;height:100px;' class='competition_field' type='text' name='answers'></textarea>
				</div>								
				<div style='margin-top: 15px;'>  
					<input class='button' type='submit' name='competition_submit' id='submit' value='Submit'>
				</div>
			</fieldset>
		</form> 
	";                
     } else {
	 $output = "<h2>You must be registered to enter this competition. Please sign in below.</h2><section id='facebook_login'><div class='title'>Create Your FREE Account</div>
		<div id='social_login_container'></div>
		<script type='text/javascript'>
			oneall.api.plugins.social_login.build('social_login_container', {
			'providers' :  ['facebook', 'google'], 
			'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
			'grid_size_x': '2',
			'grid_size_y': '1',
			'callback_uri': 'https://".$_SERVER['HTTP_HOST']."/sfdc/oa-login.php'
			});
		</script>         
	</section>  
	";
	}
	return $output;
}
add_shortcode('competition_form', 'competition_form_sc');

function membership_page_login_sc( $atts ) {	                     
	if (isset($_SESSION['cnt'])) {  
	
	extract( shortcode_atts( array(
		'member_login'   => ''
	), $atts ) );		
	
	$output = "
		<h3><a href='/profile'>Click here to view your profile</a></h3>
	";                
     } else {
	 $output = "
	 <section>
		<div id='social_login'></div>
		<script type='text/javascript'>
			oneall.api.plugins.social_login.build('social_login', {
			'providers' :  ['facebook', 'google'], 
			'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
			'grid_size_x': '2',
			'grid_size_y': '1',
			'callback_uri': 'https://".$_SERVER['HTTP_HOST']."/sfdc/oa-login.php'
			});
		</script>   
		<div>Sign up for free using the Facebook or Google connect buttons.</div>
	</section>  
	";
	}
	return $output;
}
add_shortcode('member_login', 'membership_page_login_sc');



// Added by Ricardo April 11th 2013

	function jquery_bxslider() {		
		wp_register_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), '4.1', true );
//		wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true );
		if ( is_page('oral-crash-course')  || is_page('oral-crash-course-landing')) {
		wp_enqueue_script( 'bxslider' );
//		wp_enqueue_script( 'easing' );
        wp_enqueue_style( 'bxslidercss', get_template_directory_uri() . '/css/jquery.bxslider.css' );
		}	
	}
	add_action('wp_enqueue_scripts', 'jquery_bxslider');




// Added by Ricardo March 8th 2013

//if (is_page_template('profile-page.php') ) {
	function jquery_leanmodal() {		
		wp_register_script( 'leanmodal', get_template_directory_uri() . '/js/jquery.leanModal.min.js', array('jquery'), '1.1', true );

		if ( is_page('membership') || is_page('new-buy-flow') || is_front_page() || is_page('oral-crash-course')  || is_page('oral-crash-course-landing') || (is_page_template('price-tables-tmpl.php')) ||  is_page('tour') || is_single( '29961' )) {
		wp_enqueue_script( 'leanmodal' );
		}
		
//		wp_enqueue_script('jquery-ui-draggable',  FILE_URL . 'jquery.ui.draggable.min.js', array('jquery','jquery-ui-core') );		
	}
	add_action('wp_enqueue_scripts', 'jquery_leanmodal');
//}

// Added by Ricardo March 19th 2013
// Hide paid content from WordPress generated RSS feeds:
function exclude_content_from_feeds( &$wp_query ) {
	
	// Only do this for feed queries:
	if ( $wp_query->is_feed() ) {
		
		$types_to_exclude = array('paid');
		
		// Extra query to hack onto the $wp_query object:
		$extra_tax_query = array(
			'taxonomy' => 'article_type',
			'field' => 'slug',
			'terms' => $types_to_exclude,
			'operator' => 'NOT IN'
		);
		
		$tax_query = $wp_query->get( 'tax_query' );
		if ( is_array( $tax_query ) ) {
			$tax_query = $tax_query + $extra_tax_query;
		} else {
			$tax_query = array( $extra_tax_query );
		}
		$wp_query->set( 'tax_query', $tax_query );
	}
}

// Call the above hook
add_action( 'pre_get_posts', 'exclude_content_from_feeds' );

add_filter('gform_field_value_sf_id', 'sf_id_population_function');
function sf_id_population_function($value){
    global $cnt; // tells PHP to use the global variable
	if (isset($_SESSION['cnt'])) {
	$cnt = $_SESSION['cnt'];
	$sf_id = $cnt->Id;
	return $sf_id;
	} else {
		return " ";
	}
}

add_filter('gform_field_value_sf_email', 'sf_email_population_function');
function sf_email_population_function($value){
    global $cnt; // tells PHP to use the global variable
	if (isset($_SESSION['cnt'])) {		
	$cnt = $_SESSION['cnt'];
	$sf_email = $cnt->Email;
	return $sf_email;
	} else {
		return " ";
	}
}

add_filter('gform_field_value_sf_name', 'sf_name_population_function');
function sf_name_population_function($value){
    global $cnt; // tells PHP to use the global variable
	if (isset($_SESSION['cnt'])) {		
	$cnt = $_SESSION['cnt'];
	$sf_name = $cnt->FirstName . " ". $cnt->LastName;
	return $sf_name;
	} else {
		return " ";
	}
}

add_filter('gform_field_value_sf_phone', 'sf_phone_population_function');
function sf_phone_population_function($value){
    global $cnt; // tells PHP to use the global variable
	if (isset($_SESSION['cnt'])) {		
	$cnt = $_SESSION['cnt'];
	$sf_phone = $cnt->MobilePhone;
	return $sf_phone;
	} else {
		return " ";
	}
}


add_shortcode('sffirstname', 'sf_firstname_population');
function sf_firstname_population($value){
    global $cnt; // tells PHP to use the global variable
	if (isset($_SESSION['cnt'])) {
	$cnt = $_SESSION['cnt'];
	$sf_fn = $cnt->FirstName;
	if ($sf_fn != "") {
	return $sf_fn;
		} else {
		return "Student";
	}
	} else {
		return "Guest";
	}
}

add_filter('gform_field_value_sf_lastname', 'sf_lastname_population_function');
function sf_lastname_population_function($value){
    global $cnt; // tells PHP to use the global variable
	if (isset($_SESSION['cnt'])) {		
	$cnt = $_SESSION['cnt'];
	$sf_lastname = $cnt->LastName;
	return $sf_lastname;
	} else {
		return " ";
	}
}

add_filter('gform_field_value_sf_account', 'sf_account_population_function');
function sf_account_population_function($value){
    global $cnt; // tells PHP to use the global variable
	if (isset($_SESSION['cnt'])) {		
	$cnt = $_SESSION['cnt'];
	$sf_account = $cnt->Account;
	return $sf_account;
	} else {
		return "No account";
	}
}
?>