<?php
/**
 *Template Name: Price Tables
*/

?>
<?php get_header(); ?>

<?php 
if (loggedIn()) {
  $cnt=$_SESSION['cnt']; // Set the contact array from the Session 
  }
?>

                                  <?php if($_GET['errMsg']!='') echo '<p class="error">'.$_GET['errMsg'].'</p>'; ?>

	<div id="main_container" style="margin-top: 20px;">
		<div id="container_left">


                    <section class="body_content">        


<div class="onepricecol">
<ul class="pricing-table featured">
<li class="title">Leaving Cert (June 2014)</li>
<li class="price">Register your interest</li>
<li class="bullet-item description"></li>
<li class="bullet-item">Get a head start to your leaving cert year</li>
<li class="bullet-item">5th years, register your interest in order</li>
<li class="bullet-item">to access leading revision material for your next</li>
<li class="bullet-item">school year. Enter your email address below:</li>
<li class="cta-button">
<a class="buynowbutton" rel="leanModal" name="payreg" href="#payreg">Register</a>
</li>
</ul>
</div>


<!-- div class="one_half">
<ul class="pricing-table featured">
<li class="title">Leaving Cert (June 2013)</li>
<li class="price">€15</li>
<li class="bullet-item description">Access exam material until the end of your exams <a class="tiptip" title="English, Irish, Maths, Physics, Biology, Geography, French, Business, Home Ec., History, Chemistry, German &#038; Spanish. (HL &#038; OL covered)"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Exam tips &#038; study guides <a class="tiptip" title="Created by expert teachers and examiners"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Sample answers for exam questions <a class="tiptip" title="Perfect for last minute revision. Helps you focus on what you need to know."><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Learn faster and retain more <a class="tiptip" title="Lessons contain audio, video and interactive elements on exam topics"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Revise key exam topics effectively</li>
<li class="cta-button">
<?php if (!loggedIn()) { ?>
<a class="buynowbutton" rel="leanModal" name="signup" href="#signup">Buy Now</a>
<?php } else { ?>
<a class="buynowbutton" rel="leanModal" name="payfa" href="#payfa">Pay with Paypal</a>
<?php } ?>
</li>
</ul>
</div>
<div class="one_half last">
<ul class="pricing-table featured">
<li class="title">Leaving Cert (June 2014)</li>
<li class="price">Register your interest</li>
<li class="bullet-item description"></li>
<li class="bullet-item">Get a head start to your leaving cert year</li>
<li class="bullet-item">5th years, register your interest in order</li>
<li class="bullet-item">to access leading revision material for your next</li>
<li class="bullet-item">school year. Enter your email address below:</li>
<li class="cta-button">
<a class="buynowbutton" rel="leanModal" name="payreg" href="#payreg">Register</a>
</li>
</ul>
</div -->
<div class="clearboth"></div>



<?php 
/*


<div class="one_half">
<ul class="pricing-table featured">
<li class="title">Full Access</li>
<li class="price">€12.50 <span style="font-size:0.3em;">per mo.</span><a class="tiptip" style="color: red; text-decoration:none;" title="One time payment of €25.00">*</a></li>
<li class="bullet-item description">Access ALL areas until June 30th, 2013 <a class="tiptip" title="Maths (OL), English, Irish, Biology, Geography, French, Business, Home Ec., History, Chemistry, German &#038; Spanish. (HL &#038; OL covered)"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Exam tips &#038; study guides <a class="tiptip" title="Created by expert teachers and examiners"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Sample answers for exam questions <a class="tiptip" title="Perfect for last minute revision. Helps you focus on what you need to know."><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Learn faster and retain more <a class="tiptip" title="Lessons contain audio, video and interactive elements on exam topics"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Revise key exam topics effectively</li>
<li class="cta-button">
<?php if (!loggedIn()) { ?>
<a class="buynowbutton" rel="leanModal" name="signup" href="#signup">Buy Now</a>
<?php } else { ?>
<a class="buynowbutton" rel="leanModal" name="payfa" href="#payfa">Pay with Paypal</a>
<?php } ?>
</li>
</ul>
</div>
<div class="one_half last">
<ul class="pricing-table">
<li class="title">1 Month Access</li>
<li class="price">€15</li>
<li class="bullet-item description">30 Day Access <a class="tiptip" title="Maths (OL), English, Irish, Biology, Geography, French, Business, Home Ec., History, Chemistry, German &#038; Spanish. (HL &#038; OL covered)"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Exam tips &#038; study guides <a class="tiptip" title="Created by expert teachers and examiners"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Sample answers for exam questions <a class="tiptip" title="Perfect for last minute revision. Helps you focus on what you need to know."><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Learn faster and retain more <a class="tiptip" title="Lessons contain audio, video and interactive elements on exam topics"><span aria-hidden="true" class="icon-info"></span></a></li>
<li class="bullet-item">Revise key exam topics effectively</li>
<li class="cta-button">
<?php if (!loggedIn()) { ?>
<a class="buynowbutton" rel="leanModal" name="signup" href="#signup">Buy Now</a>
<?php } else { ?>
<a class="buynowbutton" rel="leanModal" name="paymp" href="#paymp">Pay with Paypal</a>
<?php } ?>
</li>
</ul>
</div>
<div class="clearboth"></div>

*/
?>



<?php if (!loggedIn()) { ?>
<p class="aligncenter" style="margin: 120px auto 70px auto;">Or try the service before you buy:<br /><a rel="leanModal" name="signup" href="#signup" class="notyetbutton">Register</a></p>
<?php } ?>
                          		
                    </section>
               </div>




		<div id="payreg">
			<div id="pay-ct">
				<div id="pay-header">
					<h2>Register your interest</h2>
					<p>Please fill the form bellow.</p>
				</div>

			
				  <div class="txt-fld">
				  	<?php gravity_form(4, false, false, false, '', true); ?>
				  </div>

				  <div class="btn-fld">
					  <a class="modal_close" href="#">I'm not ready to register now</a>
				  </div>

			</div>
		</div>





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







		<div id="payocc">
			<div id="pay-ct">
				<div id="pay-header">
					<h2>Oral Crash Course Pass</h2>
					<p>Click the button below to complete the €10 payment.</p>
				</div>

			
				  <div class="txt-fld">
						<div id="social_signup_container"></div>
                         <div id="subscribe_button" style="margin-top:30px;">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="XSSRY5N63S2QQ">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div>
				  </div>

				  <div class="btn-fld">
					  <a class="modal_close" href="#">I'm not ready to buy yet</a>
				  </div>

			</div>
		</div>


		<div id="paymp">
			<div id="pay-ct">
				<div id="pay-header">
					<h2>One Month Pass</h2>
					<p>Click the button below to complete the €15 payment.</p>
				</div>

			
				  <div class="txt-fld">
						<div id="social_signup_container"></div>
                         <div id="subscribe_button" style="margin-top:30px;">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
							<input type="hidden" name="return" value="https://www.clevernotes.ie/sfdc/pdt.php?utm_nooverride=1">
							<input type="hidden" name="notify_url" value="https://www.clevernotes.ie/sfdc/success.php">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="SD9TJX99LXAGL">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div>
				  </div>

				  <div class="btn-fld">
					  <a class="modal_close" href="#">I'm not ready to buy yet</a>
				  </div>

			</div>
		</div>


		<div id="payfa">
			<div id="pay-ct">
				<div id="pay-header">
					<h2>Leaving Cert (June 2013)</h2>
					<p>Click the button below to complete the €15.00 payment.</p>
				</div>

			
				  <div class="txt-fld">
						<div id="social_signup_container"></div>
                         <div id="subscribe_button" style="margin-top:10px;">
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
							<input type="hidden" name="return" value="https://www.clevernotes.ie/sfdc/pdt.php?utm_nooverride=1">
							<input type="hidden" name="notify_url" value="https://www.clevernotes.ie/sfdc/success.php">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="V3EWFVZ4GNU9N">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div>
				  </div>

				  <div class="btn-fld">
					  <a class="modal_close" href="#">I'm not ready to buy yet</a>
				  </div>

			</div>
		</div>


	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
		});
	</script>






	</div>
</div>
<?php get_footer(); ?>