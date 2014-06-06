<?php
date_default_timezone_set('Europe/Dublin');
/******** LOGGED IN ********/
if (loggedIn()) {
	if (!isset($_SESSION['user_posts'])) {
		$_SESSION['user_posts'] = userPosts(); //have to add in this in case they haven't saved their profile or if they've just logged in
	}	
	$_SESSION['subject_array'] = getSubjects();
	$cnt=$_SESSION['cnt'];
}
?>
<?php
/*------------------------------------*/
/* Get theme options from options page
/*------------------------------------*/
global $options;
foreach ($options as $value) {
	if (isset($value['id']) && get_option($value['id']) === FALSE && isset($value['std'])) {
		$$value['id'] = $value['std'];
	}
	elseif (isset($value['id'])) {
		$$value['id'] = get_option($value['id']);
	}
}
// Build responsive menu
$jf_menuName = 'menu-3';
if (($locations = get_nav_menu_locations()) && isset($locations[$jf_menuName])) {
	$jf_menu = wp_get_nav_menu_object($locations[$jf_menuName]);
	$jf_menuItems = wp_get_nav_menu_items($jf_menu->term_id);
	$jf_menuOutput = '<select name="responsive_menu" id="responsive_menu">';
	foreach ((array) $jf_menuItems as $key => $jf_menuItem) {
		$jf_menuID = $jf_menuItem->ID;
		$jf_title = $jf_menuItem->title;
		$jf_pageID = get_post_meta($jf_menuID, '_menu_item_object_id', true);
		$jf_menuOutput .= '<option class="level-0" value="'.$jf_pageID.'">';
		$jf_menuOutput .= $jf_title;
		$jf_menuOutput .= '</option>';
	}
$jf_menuOutput .= '</select>';
}
?>
<!DOCTYPE html><!-- wpe -->
<!--[if IE 7]>
	<html class="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if lte IE 8]>
	<html class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if lte IE 10]>
	<html class="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
	<html class="not-ie" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php bloginfo('name'); ?> - <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="author" content="www.nevada.ie" />
	<?php if(is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" />
	<?php } ?>
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	<meta name="google-site-verification" content="JRYBc8qchMgM-HLYUJ1D7ON5Nbsdj9jvfrBdlFlJCmE" />
	<?php if (is_page_template('oral-exam-tmpl.php') || is_page_template('oral-crash-course-tmpl.php') || (is_page_template('price-tables-tmpl.php')) || (is_page_template('test-center-tmpl.php')) || is_page('tour')) { ?>
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
	<?php } ?>
	<?php if (loggedIn()) { ?>
	<style type="text/css" media="screen, projection">
		@import url(//assets.zendesk.com/external/zenbox/v2.5/zenbox.css);
	</style>
	<?php } ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<!--EnableDEB-->
<!-- enable IE8/7 to recognise HTML5 elements -->
<!-- enable IE8/7 to recognise CSS3 media queries -->
<!--[if lt IE 9]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>  
<![endif]-->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<?php if (is_page_template('subscribe-tmpl.php')) {
		echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/membership.js"></script>';
	} ?>

	<script type="text/javascript">
	     var oneall_js_protocol = (("https:" == document.location.protocol) ? "https" : "http");
     	document.write(unescape("%3Cscript src='" + oneall_js_protocol + "://clevernotesie.api.oneall.com/socialize/library.js' type='text/javascript'%3E%3C/script%3E"));
     </script>
	<?php if ((is_front_page()) || is_category()) : ?>
		<script type="text/javascript">
			jQuery(document).ready(function() { 
				jQuery(".newsticker-jcarousellite").jCarouselLite({
					vertical: true,
					visible: 3,
					auto: 3000,
					speed: 2000
				});
			});
		</script>		
	<?php endif; ?>
	<?php if ((is_category()) || is_page(9908)) : ?>
		<script type="text/javascript">
			jQuery(document).ready(function() { 
				var msie6 = jQuery.browser == 'msie' && jQuery.browser.version < 7;
				if (!msie6) {
					var top = jQuery('#nav_slider').offset().top - parseFloat(jQuery('#nav_slider').css('margin-top').replace(/auto/, 0));
					jQuery(window).scroll(function (event) {
						// what the y position of the scroll is
						var y = jQuery(this).scrollTop();
						// whether that's below the navigation
						if (y >= top) {
							// if so, ad the fixed class
							jQuery('#nav_slider').addClass('fixed');
						} else {
							// otherwise remove it
							jQuery('#nav_slider').removeClass('fixed');
						}
					});
				} 
			});
		</script>		
	<?php endif; ?>
	<?php 
/*
	global $block_post;
	$block_post = 0;
	if (blockPost()) { 
	$block_post = 1;
*/
	?>
		<script type="text/javascript">
/*
			(function($) {
				$(document).ready(function() {	
					$.blockUI({
						message: $('#paid-content'),
						css: {
							padding: 0,
							margin: 0,
							textAlign: 'center',
							color: '#000',
							border: '5px solid #EFEFEF', 			
							backgroundColor: '#FFF',
							cursor: 'default'
						},
						overlayCSS: {
							backgroundColor: '#FFF',
							opacity: 0.8,
							cursor: 'default'
						}
					});
					$('.blockUI.blockMsg').center();
				});
			})(jQuery);
*/
		</script>				
	<?php // } ?>	
	<?php if (!loggedIn()) { ?>
		<?php if (is_page('clever-tests')) { ?>
			<script type="text/javascript">
				jQuery(document).ready(function() { 
					jQuery('.block_text').text('Please Connect with Facebook on the home page to access these FREE tests');
				});
			</script>
		<?php } ?>
		<?php if ( is_category() || (is_page('clever-tests')) ) { ?>
			<script type="text/javascript">
/*
				(function($) {
					$(document).ready(function() {
						$.blockUI({
							message: $('#logged-out'),
							css: {
								padding: 0,
								margin: 0,
								textAlign: 'center',
								color: '#000',
								border: '5px solid #EFEFEF',
								backgroundColor: '#FFF',
								cursor: 'default'
							},
							overlayCSS: {
								backgroundColor: '#FFF',
								opacity: 0.8,
								cursor: 'default'
							}
						});
						$('.blockUI.blockMsg').center();
					});
				})(jQuery);
*/
			</script>
		<?php } else { ?>
			<script type="text/javascript">
/*
				(function($) {
					$(document).ready(function() {
						$('.logged-out, #related_posts a').click(function(e) {
							//var htmlStr = $("#oneall-script").html();
							e.preventDefault();
							$.blockUI({
								message: $('#logged-out'),
								css: {
									padding: 0,
									margin: 0,
									textAlign: 'center',
									color: '#000',
									border: '5px solid #EFEFEF',	
									backgroundColor: '#FFF',
									cursor: 'default'
								},
								overlayCSS: {
									backgroundColor: '#FFF',
									opacity: 0.8,
									cursor: 'pointer'
								}
							});				
							$('.blockUI.blockMsg').center();
							$('.blockOverlay,.button').attr('title','Click to close').click($.unblockUI);
						});
					});
				})(jQuery);
*/
			</script>			              
		<?php }
	} ?>
	<script type="text/javascript">var switchTo5x=false;</script>
	<script type="text/javascript" src="//w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "ur-29841c6a-c34c-a440-af11-baf1bf65d6ab", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	<?php if ((is_front_page()) || is_page('oral-crash-course') || is_page('oral-crash-course-landing')) : ?>
	    <style type="text/css">
      .js #flash {display: none;}
    </style>
		<script type="text/javascript">
      //$('html').addClass('js');
      $(document).ready(function() {
       //  Stuff to do as soon as the DOM is ready
       console.log('ready ');
      });
		</script>
	<?php endif; ?>
<?php if (is_live()) { ?>  
<!-- enable pingdom Real User Monitoring on live -->
<script type="application/javascript">var _prum={id:"51694841abe53da219000000"};var PRUM_EPISODES=PRUM_EPISODES||{};PRUM_EPISODES.q=[];PRUM_EPISODES.mark=function(b,a){PRUM_EPISODES.q.push(["mark",b,a||new Date().getTime()])};PRUM_EPISODES.measure=function(b,a,b){PRUM_EPISODES.q.push(["measure",b,a,b||new Date().getTime()])};PRUM_EPISODES.done=function(a){PRUM_EPISODES.q.push(["done",a])};PRUM_EPISODES.mark("firstbyte");(function(){var b=document.getElementsByTagName("script")[0];var a=document.createElement("script");a.type="text/javascript";a.async=true;a.charset="UTF-8";a.src="//rum-static.pingdom.net/prum.min.js";b.parentNode.insertBefore(a,b)})();</script>
<!-- Google Analytics -->
<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
     var _gaq = _gaq || [];
     _gaq.push(['_setAccount', 'UA-34212391-1']);     
	 console.log('GA');
     <?php
     ////// CUSTOM VARIABLES FOR GOOGLE ANALYTICS ///////
     if (!loggedIn()) {
          $visitor_type = 'Anonymous';
     } else {
     	if ( isSubscribed() ) {
     	   $visitor_type = 'Member';
     	} else {
     	   $visitor_type = 'Registered';
     	}
     }
     ?>		
      _gaq.push(['deleteCustomVar',1]);
      _gaq.push(['deleteCustomVar',2]);
      _gaq.push(['_setCustomVar',
           3,
           'Visitor Type',
           '<?php echo $visitor_type; ?>',
           3  
     ]);
     <?php
     /* we can only set these custom variables if the user is logged in */
     global $article_style; //this variable is set in single.php		
     if ((loggedIn()) && (isset($article_style))) {
     ?>
      _gaq.push(['_setCustomVar',
           5,
           'Article Style',
           '<?php echo $article_style; ?>',
           3  
     ]);					
     <?php
     }
     ?>
     _gaq.push(['_trackPageview']);
     (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();
     

jQuery(function($) {
	console.log('JQuery');
    // Debug flag
    var debugMode = true;

    // Default time delay before checking location
    var callBackTime = 100;

    // # px before tracking a reader
    var readerLocation = 200;

    // Set some flags for tracking & execution
    var timer = 0;
    var scroller = false;
    var endContent = false;
    var didComplete = false;

    // Set some time variables to calculate reading time
    var startTime = new Date();
    var beginning = startTime.getTime();
    var totalTime = 0;

    // Track the aticle load
    if (!debugMode) {
        _gaq.push(['_trackEvent', 'Reading', 'ArticleLoaded', '', , true]);
    }

    // Check the location and track user
    function trackLocation() {
    	console.log('Track Location');
        bottom = $(window).height() + $(window).scrollTop();
        height = $(document).height();

        // If user starts to scroll send an event
        if (bottom > readerLocation && !scroller) {
            currentTime = new Date();
            scrollStart = currentTime.getTime();
            timeToScroll = Math.round((scrollStart - beginning) / 1000);
            if (!debugMode) {
                _gaq.push(['_trackEvent', 'Reading', 'StartReading', '', timeToScroll]);
            } else {
                console.log('started reading ' + timeToScroll);
            }
            scroller = true;
        }

        // If user has hit the bottom of the content send an event
        if (bottom >= $('.lessonbody').scrollTop() + $('.lessonbody').innerHeight() && !endContent) {
            currentTime = new Date();
            contentScrollEnd = currentTime.getTime();
            timeToContentEnd = Math.round((contentScrollEnd - scrollStart) / 1000);
            if (!debugMode) {
                _gaq.push(['_trackEvent', 'Reading', 'ContentBottom', '', timeToContentEnd]);
            } else {
                console.log('end content section '+timeToContentEnd);
            }
            endContent = true;
        }

        // If user has hit the bottom of page send an event
        if (bottom >= height && !didComplete) {
            currentTime = new Date();
            end = currentTime.getTime();
            totalTime = Math.round((end - scrollStart) / 1000);
            if (!debugMode) {
                if (totalTime < 60) {
                    _gaq.push(['_setCustomVar', 4, 'ReaderType', 'Scanner', 2]);
                } else {
                    _gaq.push(['_setCustomVar', 4, 'ReaderType', 'Reader', 2]);
                }
                _gaq.push(['_trackEvent', 'Reading', 'PageBottom', '', totalTime]);
            } else {
                console.log('bottom of page '+totalTime);
            }
            didComplete = true;
        }
    }

    // Track the scrolling and track location
    $(window).scroll(function() {
        if (timer) {
            clearTimeout(timer);
        }
        console.log('Scroll');

        // Use a buffer so we don't call trackLocation too often.
        timer = setTimeout(trackLocation, callBackTime);
    });
});
</script>
<?php } ?>
<?php if (is_page('profile')) { ?>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('#lshideshow').live('click', function(event) {        
         jQuery('#lscontent').toggle('show');
    });
    jQuery('#pbhideshow').live('click', function(event) {        
         jQuery('#pbcontent').toggle('show');
    });
});
</script>
<?php } ?>
<?php if (is_page_template('test-center-tmpl.php')) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/accordion.css" />
		<noscript>
			<style>
				.st-accordion ul li{
					height:auto;
				}
				.st-accordion ul li > a span{
					visibility:hidden;
				}
			</style>
		</noscript>
<?php } ?>
<?php if (is_single('share-your-thoughts-win')) { ?>
<script type="text/javascript">
jQuery(document).ready(function() {
		jQuery('#gform_5 input[type=submit]', this).click(function() {
			jQuery('#gform_5 input[type=submit]').css('display','none');
		});
	});
</script>
<?php } ?>
</head>
<body <?php if (is_front_page()) {  echo ' id="home-page"'; } else { echo ' id="inside-page"'; } ?> <?php body_class(''); ?>>
<?php if (!loggedIn()) { ?>
	<div id="jf-fakeZenBoxTab" title="Sorry, this is a members-only feature">
		<span id="jf-fakeZenBoxTabText">Support</span>
	</div>
<?php } ?>
<?php if ((is_front_page()) || is_category()) : ?>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
<?php endif; ?>
<div id="logged-out" style="display: none;">
	<h2 style="margin-top: 15px;"><span class="block_text">Your session has expired. You need to login again.</span></h2>
	<p style="margin-bottom: 15px;"><a href="/" class="button">Go to home page</a></p>
</div>
<!-- End 'logged-out' DIV -->
<div id="paid-content" style="display: none;">
	<h2 style="margin-top: 15px;"><span class="block_text">Sorry, you can't access Member content on a Guest Account. If you're considering signing up you can find out how by clicking on the Member Benefits button below. It's quick and easy and then you can get back to studying for June<br />(with some added clevernotes.ie help :)).</span></h2>
	<p style="margin-bottom: 15px;">
		<a href="/tour" class="button" style="background:#00aeee;">Take a Tour</a> 
		<a href="/membership" class="button" style="background:#D2232A;">Member Benefits</a>
	</p>
	<div class="jf-closeButton">
		<?php
			if (isset($_SERVER['HTTP_REFERER'])) { $ref = $_SERVER['HTTP_REFERER']; }
			if (isset($ref)) {
				echo '<a href="'.$ref.'">Close</a>';
			} else {
				echo '<a href="/">Close</a>';
			}
		?>
	</div>
</div>
<!-- End 'paid-content' DIV -->
<div id="wrapper">  
	<?php if (is_front_page() || is_page('oral-crash-course') || is_page('oral-crash-course-landing')) { ?>
		<?php if (!loggedIn()) { //show small header if not logged in ?>  
			<div class="theme_width">
				<header id="header" class="jf-notLoggedIn">
					<nav id="main-nav">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
					</nav>
					<div id="logo"><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/logos/small_logo.png" alt="Clevernotes.ie" title="Home page" /></a></div>
					<?php echo $jf_menuOutput; ?>
					<div class="clearfix"></div>
				<!-- div id="alreadyamember"><a rel="leanModal" name="login" href="#login" style="padding: 5px 7px; color: #fff; text-decoration: none; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background: #2589c5;">Already a member? Click here!</a></div -->
				</header>
			</div>
			<!-- End 'theme_width' DIV -->
			<div class="clearfix"></div>
		<?php } else { //show large header with subject picker if you are logged in ?>
			<div id="page" class="theme_width">
				<header id="header" class="jf-loggedIn">
					<nav id="main-nav">
						<?php wp_nav_menu(array('theme_location' => 'menu-1')); ?>
					</nav>
					<div id="profile_links"><a href="/logout" title="Logout">Logout</a><span id="jf-profileLink"> | <a href="/profile" title="Profile">My Profile</a></span></div>
					<div id="logo"><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/logos/logo.png" alt="Clevernotes.ie" title="Home page" /></a></div>
					<?php include("includes/subject-bar.php"); ?>
					<?php echo $jf_menuOutput; ?>
					<div class="clearfix"></div>
				</header>
			<!-- 'page' DIV remains open -->
		<?php } ?>
		<?php if (!loggedIn()) { ?>
			<?php if (!is_page_template('oral-crash-course-tmpl.php')) { ?>
			<div id="home-page-feature">
				<div class="theme_width">
					<section id="facebook_login">
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
					</section>
				</div>
			</div>
			<!-- End 'home-page-feature' DIV -->
			<?php // include("includes/featured-posts.php"); ?>
		<?php } } ?>
	<?php } else { ?>
		<div id="page" class="theme_width">
			<header id="header">
				<nav id="main-nav">
					<?php wp_nav_menu(array('theme_location' => 'menu-1')); ?>
				</nav>
				<?php if (loggedIn()) { ?><div id="profile_links"><a href="/logout" title="Logout">Logout</a><span id="jf-profileLink"> | <a href="/profile" title="Profile">My Profile</a></span></div><?php } ?>
				<div id="logo"><a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/logos/logo.png" alt="Clevernotes.ie" title="Home page" /></a></div>
				<?php include("includes/subject-bar.php"); ?>
				<?php echo $jf_menuOutput; ?>
				<div class="clearfix"></div>
			</header>
		<!-- 'page' DIV remains open -->
	<?php } ?>
	<div class="clearfix"></div>
	<div id="body_wrapper" class="theme_width">
		<div id="body">
<!-- 'wrapper' DIV remains open -->
<!-- 'body_wrapper' DIV remains open -->
<!-- 'body' DIV remains open -->