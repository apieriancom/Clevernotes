<?php
/**
 *Template Name: Clever Tests
*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Learnosity

// User ID
$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
$d = date("Ymd-Hi");


function arrayToStringForSignature($array) {
    $string = "";
    // Sort array by keys (comparing them as strings)
    ksort($array,SORT_STRING);
    foreach ($array as $key => $value) {
        if (strlen($string) > 0) {
            $string .= "_";
        }
        if (is_array($value)) {
            // if value is array, call function recursively
            $string .= $key . "_" . arrayToStringForSignature($value);
        } else {
            $string .= $key . "_" . $value;
        } 
    }
    return $string;
}

function generateSsoPreHashString($jsonString, $domain, $consumer_secret) {
    // Parse JSON
    $jsonArray = json_decode($jsonString, TRUE);
    
    // Concatenate String
    // Retrieve required parameters from JSON
    $consumer_key = $jsonArray['consumer_key'];
    //$timestamp = $jsonArray['timestamp'];
	
	$timestamp = date("Ymd-Hi");
    $user_id = $jsonArray['user_id'];
    
    // Create String to Hash
    $preHashString = $consumer_key . '_' . $domain . '_' . $timestamp . '_' . $user_id . '_' . $consumer_secret;
    
    // Remove above attributes from JSON before hashing
    unset($jsonArray['consumer_key']);
    unset($jsonArray['timestamp']);
    unset($jsonArray['user_id']);
    
    // Append hashing of all other attributes in JSON using auxiliary function
    $preHashString .= "_" . arrayToStringForSignature($jsonArray);
    
    // Return Concatenated String
    return $preHashString;
}


function buildSignature($course, $d, $cnt){
	// Domain where script is running 
	$domain = $_SERVER['HTTP_HOST'];
	
	// Consumer secret (not to be placed in the page sent to the client)
	$consumer_secret = 'c1341201e32a4a32e02e17a84260c5c79aec7fea';
	
	// Call to generate the String concatenation that will be hashed
	$preHashString = generateSsoPreHashString(buildJSON($course, $d, $cnt), $domain, $consumer_secret);
	
	// $signature is created by hashing $preHashString
	return hash('sha256', $preHashString);
	
}

function buildJSON($course, $d, $cnt){
	return '{	"consumer_key": "wSIoIUPa4cA4aJf8",
				"timestamp": "'.$d.'",
				"user_id": "'.$cnt->Id.'",
				"user":{"firstname":"'.$cnt->FirstName.'"},
				"module": "student",
				"return_link":{"url":"http:\/\/www.clevernotes.ie\/clever-tests\/","label":"Back to clevernotes.ie"},
				"courses": [{"id":"'.$course.'"}]
				}';
}


?>
<?php get_header(); ?>
	<div id="main_container">	
		<div id="container_left">
	  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <div class="box post full" id="post-<?php the_ID(); ?>">
               <div class="post-block">
                    <div class="post-title">
                         <h1><?php the_title(); ?></h1>
                         <div class="clearfix"></div>         
                    </div>
                    <section class="body_content">        
                         <?php 
                         if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                              echo "<span class='feature'>";
                              the_post_thumbnail('featured-image');
                              echo "</span>";
                         }
                         ?>	     
                         <?php the_content(); ?>	                         
                         <?php wp_link_pages('before=<p><strong>Pages:</strong> &after=</p>&next_or_number=number'); ?> 		
                         <script src="https://sso.learnosity.com"></script>
                         
                         <div id="clever_tests">
                         	<div class="clever_test curved-box grey-bg">
                                   <img src="/wp-content/uploads/2012/10/biology-50x50.png" alt="" width="50" height="50" class="alignnone size-medium-cog wp-image-122">
                                   <h2 class="biology">Biology</h2>
                                   <button onclick="LearnositySSO.signon({
                                      'consumer_key':'wSIoIUPa4cA4aJf8',
                                      'timestamp':'<?php echo date('Ymd-Hi'); ?>',
                                      'user_id':'<?php echo $cnt->Id; ?>',
                                      'user':{'firstname':'<?php echo $cnt->FirstName; ?>'},
                                      'module':'student',
                                      'courses': [{'id':'lc_biology_h'}],
                                      'return_link':{'url':'http:\/\/www.clevernotes.ie\/clever-tests\/','label':'Back to clevernotes.ie'},
                                      'signature':'<?php echo buildSignature('lc_biology_h',  $d, $cnt); ?>'
                                      })">Start Test</button> 
                             	</div> 
                              <!--
						<div class="clever_test curved-box grey-bg">
                                 	<img src="/wp-content/uploads/2012/10/geography-50x50.png" alt="" width="50" height="50" class="alignnone size-medium-cog wp-image-122">
                              	<h2 class="geography">Geography</h2>
                                   <button onclick="LearnositySSO.signon({
                                      'consumer_key':'wSIoIUPa4cA4aJf8',
                                      'timestamp':'<?php echo date('Ymd-Hi'); ?>',
                                      'user_id':'<?php echo $cnt->Id; ?>',
                                      'user':{'firstname':'<?php echo $cnt->FirstName; ?>'},
                                      'module':'student',
                                      'courses': [{'id':'lc_geography_h'}],
                                      'return_link':{'url':'http:\/\/www.clevernotes.ie\/clever-tests\/','label':'Back to clevernotes.ie'},
                                      'signature':'<?php echo buildSignature('lc_geography_h',  $d, $cnt); ?>'
                                      })">Start Test</button> 
                           	</div>
                              -->
                         	<div class="clever_test curved-box grey-bg">
                              	<img src="/wp-content/uploads/2012/10/home_economics-50x50.png" alt="" width="50" height="50" class="alignnone size-medium-cog wp-image-122">
                              	<h2 class="home-economics">Home Economics</h2>
                                   <button onclick="LearnositySSO.signon({
                                      'consumer_key':'wSIoIUPa4cA4aJf8',
                                      'timestamp':'<?php echo date('Ymd-Hi'); ?>',
                                      'user_id':'<?php echo $cnt->Id; ?>',
                                      'user':{'firstname':'<?php echo $cnt->FirstName; ?>'},
                                      'module':'student',
                                      'courses': [{'id':'lc_homeconomics_h'}],
                                      'return_link':{'url':'http:\/\/www.clevernotes.ie\/clever-tests\/','label':'Back to clevernotes.ie'},
                                      'signature':'<?php echo buildSignature('lc_homeconomics_h',  $d, $cnt); ?>'
                                      })">Start Test</button> 
                         	</div>                              
                         	<div class="clever_test curved-box grey-bg">
                     			<img src="/wp-content/uploads/2012/10/french-50x50.png" alt="" width="50" height="50" class="alignnone size-medium-cog wp-image-122">
                 				<h2 class="french">French</h2>
                                   <button onclick="LearnositySSO.signon({
                                      'consumer_key':'wSIoIUPa4cA4aJf8',
                                      'timestamp':'<?php echo date('Ymd-Hi'); ?>',
                                      'user_id':'<?php echo $cnt->Id; ?>',
                                      'user':{'firstname':'<?php echo $cnt->FirstName; ?>'},
                                      'module':'student',
                                      'courses': [{'id':'lc_french_h'}],
                                      'return_link':{'url':'http:\/\/www.clevernotes.ie\/clever-tests\/','label':'Back to clevernotes.ie'},
                                      'signature':'<?php echo buildSignature('lc_french_h',  $d, $cnt); ?>'
                                      })">Start Test</button> 
	                           </div>
                            </div>
                    </section>
               </div>
	  	</div>
	  	<?php endwhile; endif; ?>		    			 
	</div>
</div>
<?php get_footer(); ?>
