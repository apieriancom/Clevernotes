</div>
<!-- End 'layout' DIV -->
<div class="clearfix"></div>
<?php
	/*------------------------------------*/
	/* Get theme options from options page
	/*------------------------------------*/
	global $options;
	foreach ($options as $value) {
		if (isset($value['id']) && get_option( $value['id']) === FALSE && isset($value['std'])) {
			$$value['id'] = $value['std'];
		} elseif (isset($value['id'])) {
			$$value['id'] = get_option( $value['id']);
		}
	}
?>
<?php if (is_front_page() && loggedIn()) { ?>
</div>
<!-- End 'page' DIV -->
<?php } ?>
<div id="footer_container">
	<footer id="footer">	
		<div id="top_footer"><?php wp_nav_menu(array('theme_location' => 'menu-2')); ?></div>
		<div class="clearfix"></div>
		<div id="bottom_footer">
			<ul>
				<li id="copyright">&copy; Copyright <?php echo date('Y'); ?> <?php if ($opts_organisation) { echo $opts_organisation; } ?></li>
			</ul>
		</div>     
	</footer>
	<div class="clearfix"></div>
</div>
<!-- End 'footer_container' DIV -->
</div>
<!-- End 'body' DIV -->
</div>
<!-- End 'body_wrapper' DIV -->
</div>
<!-- End 'wrapper' DIV -->
<?php wp_footer(); ?>
<?php if (is_front_page()) : ?>
	<!-- <script type="text/javascript" src="https://twitter.com/javascripts/blogger.js"></script> -->
	<!-- <script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline/CleverNotesIE.json?callback=twitterCallback2&amp;count=3"></script> -->
<?php endif; ?>

<?php 
if (loggedIn()) { //intercom variables 
	$cnt = $_SESSION['cnt'];
	//create array of member type
	$member_type = array();
		if($cnt->Student__c==1) {
			array_push($member_type,'student');
		}
		if($cnt->Parent__c==1) {
			array_push($member_type,'Parent');
		}
		if($cnt->Teacher__c==1) {
			array_push($member_type,'Teacher');
		}
		if($cnt->Other__c==1) {
			array_push($member_type,'Other');
		}			
	if (isSubscribed()) { //has paid up
		$end_date = strtotime($cnt->Subscription_End_Date__c);				
		$subscriber = 'Yes';
	} else {
		$subscriber = 'No';
		$end_date = '';
	}			
} 
// end intercom variables 
?>

<?php if (is_live()) { ?>  
	<!-- StatCounter -->
	<script type="text/javascript">
		var sc_project=8206539;
		var sc_invisible=1;
		var sc_security="aa0516c6";
		var sc_https=1;
		var sc_remove_link=1;
		var scJsHost = (("https:" == document.location.protocol) ? "https://secure." : "http://www.");
		document.write("<sc"+"ript type='text/javascript' src='" + scJsHost + "statcounter.com/counter/counter.js'></"+"script>");
	</script>
	<noscript><div class="statcounter"><img class="statcounter" src="https://c.statcounter.com/8206539/0/aa0516c6/1/" alt="web statistics"></div></noscript>
	<!-- End StatCounter -->
	<?php if (loggedIn()) {
		$cnt=$_SESSION['cnt'];
		$ISS_Email = $cnt->Email;
		//if it's their first log in then set created to today as it will be empty
		$ISS_CreatedDate = $cnt->CreatedDate;
		if (!isset($ISS_CreatedDate)) {
			$ISS_CreatedDate = date('m d Y');
		}
		$app_id = 'mf51hypl';
	?>
	<!-- Intercom LIVE -->
	<script id="IntercomSettingsScriptTag">
		window.intercomSettings = {
			email: "<?php echo $ISS_Email; ?>",
			user_hash: "<?php echo hash_hmac("sha256", $ISS_Email, "0_JS1naEyQ3t_kyENnQAB54_T2b86DvmKdNbDd_m"); 
  ?>",
			created_at: <?php echo strtotime($ISS_CreatedDate); ?>,
			app_id: "<?php echo $app_id; ?>",
			custom_data: {
				"subscriber" : "<?php echo $subscriber ?>",
				<?php if (isSubscribed()) { ?>"subscription_end_date_at" : <?php echo $end_date ?>,<?php } ?>
				"member_type" : "<?php echo implode(", ", $member_type); ?>"
			}
		};
	</script>
	<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://api.intercom.io/api/js/library.js';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}};})()</script>     
	<?php } // end loggedIn() test ?>      
<?php } // end is_live() test ?>

<?php if ((is_dev()) && (loggedIn())) {
	$cnt = $_SESSION['cnt'];
	$ISS_Email = $cnt->Email;
	//if it's their first log in then set created to today as it will be empty
	$ISS_CreatedDate = $cnt->CreatedDate;
	if (!isset($ISS_CreatedDate)) {
		$ISS_CreatedDate = date('m d Y');
	}
	$app_id = 'mbtohi7k';
?>
	<!-- Intercom DEV -->
	<script id="IntercomSettingsScriptTag">
		window.intercomSettings = {
			email: "<?php echo $ISS_Email; ?>",
			created_at: <?php echo strtotime($ISS_CreatedDate); ?>,
			app_id: "<?php echo $app_id; ?>",
			custom_data: {
				"subscriber" : "<?php echo $subscriber ?>",
				<?php if (isSubscribed()) { ?>"subscription_end_date_at" : <?php echo $end_date ?>,<?php } ?>
				"member_type" : "<?php echo implode(", ", $member_type); ?>"
			}			
		};
	</script>
	<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://static.intercomcdn.com/intercom.v1.js';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}};})()</script>     
<?php } // end is_dev() && loggedIn() test ?>
<?php if (loggedIn()) { ?>
<script type="text/javascript" src="//assets.zendesk.com/external/zenbox/v2.5/zenbox.js"></script>
<script type="text/javascript">
	if (typeof(Zenbox) !== "undefined") {
		Zenbox.init({
			dropboxID: "20128201",
			url: "https://clevernotes.zendesk.com",
			tabID: "Support",
			tabColor: "black",
			tabPosition: "Left"
		});
	}
</script>
<?php } ?>

<?php if (is_single( '29961' )) { ?>
		<div id="login">
			<div id="login-ct">
				<div id="login-header">
					<h2>Connect with:</h2>
					<p>Your Facebook or Google information.</p>
				</div>
				  <div class="txt-fld">
						<div id="social_login_container"></div>
						<script type="text/javascript">
							oneall.api.plugins.social_login.build("social_login_container", {
								'providers' :  ['facebook', 'google'],
								'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
								'grid_size_x': '2',
								'grid_size_y': '1',
								'callback_uri': '<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/sfdc/oa-login-survey.php'
							});
						</script>
				  </div>

				  <div class="btn-fld">
					  <a class="modal_close" href="#">I don't want to login now</a>
				  </div>

			</div>
		</div>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
		});
	</script>
<?php } ?>



<?php if ((is_page('new-buy-flow')) || (is_front_page()) || is_page('oral-crash-course') || is_page('oral-crash-course-landing') || is_page_template('price-tables-tmpl.php') || is_page('tour')) { ?>
		<div id="signup">
			<div id="signup-ct">
				<div id="signup-header">
					<h2>Please login first</h2>
					<p>Using your Facebook or Google information.</p>
				</div>

			
				  <div class="txt-fld">
						<div id="social_signup_container"></div>
						<script type="text/javascript">
							oneall.api.plugins.social_login.build("social_signup_container", {
								'providers' :  ['facebook', 'google'],
								'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
								'grid_size_x': '2',
								'grid_size_y': '1',
								'callback_uri': '<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/sfdc/oa-login-pricetables.php'
							});
						</script>
				  </div>

				  <div class="btn-fld">
					  <a class="modal_close" href="#">I'm not ready to signup yet</a>
				  </div>

			</div>
		</div>
		<div id="login">
			<div id="login-ct">
				<div id="login-header">
					<h2>Connect with:</h2>
					<p>Your Facebook or Google information.</p>
				</div>
				  <div class="txt-fld">
						<div id="social_login_container"></div>
						<script type="text/javascript">
							oneall.api.plugins.social_login.build("social_login_container", {
								'providers' :  ['facebook', 'google'],
								'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
								'grid_size_x': '2',
								'grid_size_y': '1',
								'callback_uri': '<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/sfdc/oa-login.php'
							});
						</script>
				  </div>

				  <div class="btn-fld">
					  <a class="modal_close" href="#">I don't want to login now</a>
				  </div>

			</div>
		</div>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
		});
	</script>
<?php } ?>
<?php if (is_page_template('test-center-tmpl.php')) { ?>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.accordion.js"></script>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript">
		jQuery(document).ready(function($){
			jQuery('#st-accordion').accordion();
        });
    </script>
<?php } ?>
</body>
</html>