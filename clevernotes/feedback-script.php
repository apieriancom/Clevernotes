<?php
/**
 *Template Name: Feedback Thanks
 */
?>
<?php get_header(); ?>
<?php
$referrer = $_SERVER['HTTP_REFERER'];
if (isset($_POST['feedback_submit'])){

	$formsfields = "";
			
	foreach($_POST as $key => $value){
		$formsfields .= $value;
		$$key = preg_replace("/\n/", "", $value);
	};		
		
		// Make sure the form was posted from a browser
		if(!isset($_SERVER['HTTP_USER_AGENT'])){
								header( "Location: $referrer" );
								//don't process
								exit();
		}
		// Make sure the form was indeed POST'ed:	
		
		if(!$_SERVER['REQUEST_METHOD'] == "POST"){
								header( "Location: $referrer" );
								//don't process
								exit();   
		}
		
		//attempt to defend against header injection
					$badStrings = array("content-type:",
										 "mime-version:",
										 "content-transfer-encoding:",
										 "bcc:",
										 "cc:",
										 "from:",
										 "reply-to:");
					
					// Loop through each POST'ed value and test if it contains
					// one of the $badStrings:
					foreach($_POST as $k => $v){
					$v = strtolower($v);
					   foreach($badStrings as $v2){
						   if(strpos($v, $v2) !== false){
								header( "Location: $referrer" );
						   }
					   }
					} 			

				//test for more than 2 @ symbols
				if (substr_count($formsfields, '@') > 2) {
					header( "Location: $referrer" );
					exit();
				}
	
				if (substr_count($formsfields, 'http://') > 2) {
					header( "Location: $referrer" );
					exit();
				}

				$message = "";

				$message .= "\n==============================\n\n";
				
                       if ($feedback_topic)                                        
                       {
                          $feedback_topic = "Feedback Search Terms: $feedback_topic\n";
                          $message .= "$feedback_topic\n";
                       }
				   
				   if ($feedback)                                        
                       {
                          $feedback = "FEEDBACK\n==============================\n".$feedback; 
                          $message .= "$feedback\n";
                       }						   		   
				   
				   $message .= "\n_____________________________________________________________________________________\n\nClevernotes.ie\nEmail: info@clevernotes.ie\n\n";

				   $message = stripslashes($message);
	
	mail( "feedback@clevernotes.ie", "Feedback form from Clevernotes.ie", $message, "From: feedback@clevernotes.ie");
	//mail( "alan@nevada.ie", "Feedback form from Clevernotes.ie", $message, "From: feedback@clevernotes.ie");
}
?>
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
                         <?php the_content(); ?>		
                    </section>
               </div>
	  	</div>
	  	<?php endwhile; endif; ?>		    			 
	</div>
</div>
<?php get_footer(); ?>
