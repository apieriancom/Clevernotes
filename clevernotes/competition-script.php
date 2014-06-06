<?php
/**
 *Template Name: Competition Thanks
 */
?>
<?php get_header(); ?>
<?php
$referrer = $_SERVER['HTTP_REFERER'];
if (isset($_POST['competition_submit'])){

	$formsfields = "";
			
	foreach($_POST as $key => $value){
		$formsfields .= $value;
		$$key = preg_replace("/\n/", "", $value);
	};		

	$user_email = $competition_email;
		
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

				$message .= $competition_name."\n==============================\n\n";
				
                       if ($entrants_name)                                        
                       {
                          $entrants_name = "Message Sent by: $entrants_name\n";
                          $message .= "$entrants_name\n";
                       }
					   
				   if ($competition_email)                                        
                       {
                          $competition_email = "Email: $competition_email\n";
                          $message .= "$competition_email\n";
                       }
				   
				   if ($mobile)                                        
                       {
                          $mobile = "Mobile: $mobile\n";
                          $message .= "$mobile\n";
                       }		
				   
				   if ($answers)                                        
                       {
                          $answers = "ANSWER\n==============================\n".$answers; 
                          $message .= "$answers\n";
                       }						   		   
				   
				   $message .= "\n_____________________________________________________________________________________\n\nClevernotes.ie\nEmail: competitions@clevernotes.ie\n\n";

				   $message = stripslashes($message);
	

			//SENDMAIL OPTION
			mail( "competitions@clevernotes.ie", "Competition Entry for ".$competition_name." from Clevernotes.ie", $message, "From: competitions@clevernotes.ie");	
			
			//SMTP OPTION	
			//try using PEAR	
			/*
			require_once "Mail.php";

			$to = "alan@nevada.ie";
			//$to = "competitions@clevernotes.ie";			
			$from = "Clevernotes.ie <competitions@clevernotes.ie>";
			$host = "email-smtp.us-east-1.amazonaws.com";
			$username = "AKIAICNV6CCL6BGEXMFQ";
			$password = "Ajj2MTbtashuOH610b81cnFQwiDhfCUk0MfsQjCkrapI";
			$subject = "Competition Entry for ".$competition_name." from Clevernotes.ie";
			$body = $message;
				
			//HEADERS
			$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);				
			
			$smtp = Mail::factory('smtp',				
			  array ('host' => $host,
				'auth' => true,
				'username' => $username,
				'password' => $password));				
			$mail = $smtp->send($to, $headers, $body);		
			*/
			
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
