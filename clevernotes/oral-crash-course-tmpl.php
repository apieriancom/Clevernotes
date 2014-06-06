<?php
/**
 *Template Name: Oral Crash Course
*/

?>
<?php get_header(); ?>


<?php if (!loggedIn() && is_front_page() || loggedIn() && is_page('oral-crash-course') ) { ?>
<h1 style="text-align: center; margin: 10px auto 30px; font-size: 2.4em; font-family: 'Titillium Web', sans-serif; font-weight: normal;">Get ready for your Orals with our Crash Course.</h1>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.bxslider').bxSlider({
			auto: true,
			controls: false,
			mode: 'fade',
			pager: false,
			pagerType: 'full'
		});
	});
</script>		

<div id="flash">
<ul class="bxslider">
  <li>Perfect for your last minute exam prep</li>
  <li>Save time - We tell you what you need to know</li>
  <li>Maximise your marks with our crash course</li>
  <li>Everything you need to survive the orals</li>
  <li>Boost your last minute prep</li>
  <li>Improve your marks - easy to follow steps</li>
</ul>
</div>

<div style="width:60%; margin: 10px auto 5px;">
<span aria-hidden="true" class="icon-headphones"></span> Audio, 
<span aria-hidden="true" class="icon-youtube"></span> Video, 
<span aria-hidden="true" class="icon-edit"></span> Tests, 
<span aria-hidden="true" class="icon-exchange"></span> Interactive lessons available for:</div>

<div style="width:60%; margin: 0 auto;">
<div class="one_fourth"><img class="alignleft size-thumbnail" alt="Irish subject icon" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/irish-150x150.png" width="30" height="30" /> <strong class="sectiontitle">Irish</strong><br /></div>
<div class="one_fourth"><img class="alignleft size-thumbnail" alt="French subject icon" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/french-150x150.png" width="30" height="30" /> <strong class="sectiontitle">French</strong></div>
<div class="one_fourth"><img class="alignleft size-thumbnail" alt="German subject icon" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/german-150x150.png" width="30" height="30" /> <strong class="sectiontitle">German</strong></div>
<div class="one_fourth last"><img class="alignleft size-thumbnail" alt="Spanish subject icon" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/spanish-150x150.png" width="30" height="30" /> <strong class="sectiontitle">Spanish</strong></div>
</div>

<div class="slicedss"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/header.png" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/step1a.png" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/step2a.png" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/step3.png" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/step4a.png" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/step5a.png" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/step6.png" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer.png" /></div>

<a name="buynow"></a>
<p style="text-align:center;">For only €10 you'll have access to all language content until April 30th, 2013</p>
<h1 style="text-align: center; margin: 0px auto 40px; font-size: 2em; font-family: 'Titillium Web', sans-serif; font-weight: normal;">Join thousands of students already getting ready...</h1>


<?php if (loggedIn()) { ?>
<p style="text-align:center; 	font-size: 1.1em; font-family: 'Titillium Web', sans-serif; margin: 10px; padding: 0; color: #e56c69;">Click the button bellow to complete your purchase!</p>
<div style="text-align: center; margin: auto;">
<?php if (loggedIn()) {
	$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
    }
?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XSSRY5N63S2QQ">
<input type="submit" value="Pay now with Paypal!" name="submit" class="buynowbutton" />
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form></div>
<?php } else { ?>
<div style="text-align: center; margin: auto;"><a rel="leanModal" name="signup" href="#signup" class="buynowbutton">Buy Now!</a> <a rel="leanModal" name="login" href="#login" class="notyetbutton">Not yet</a></div>
<?php } ?>


	<div id="main_container" style="margin-top: 70px;">
		<div class="subject_title" style="margin-top: 25px;">


<div style="width:60%; margin: 0 auto;">
Oral Crash Course also includes:<br />
<div class="one_fourth"><strong class="sectiontitle">Irish</strong><br />All 5 poetry readings<br />All 20 sraith pictiúr</div>
<div class="one_fourth"><strong class="sectiontitle">French</strong><br />Detailed notes on Le Document</div>
<div class="one_fourth"><strong class="sectiontitle">German</strong><br />Coverage of the Projekt option<br />All 5 role plays<br />All 5 picture stories</div>
<div class="one_fourth last"><strong class="sectiontitle">Spanish</strong><br />All 5 role plays</div>
</div>

<p>&nbsp;</p>

		</div>
</div>
<?php } ?>




<?php if (loggedIn() && is_front_page()) { ?>
<div id="layout">
	<div id="bot">
		<section class="left">
			<?php if (loggedIn()) { ?>
				<div id="welcome" class="curved-box grey-bg">
					<div class="holder">
						<?php 
						//set session variable for free lessons filter
						if (isset($_POST['toggle_free'])) {
							if (isset($_SESSION['free_lessons'])) {
								unset($_SESSION['free_lessons']);
							}
							else {
								$_SESSION['free_lessons'] = 1;	
							}
						}
						
						$cnt=$_SESSION['cnt']; 
						if (($cnt->Social_Image__c != "") && ($cnt->Social_Image__c != trim('<img src=" " alt="Contact Image" border="0"/>'))) { ?>
							<div id="facebook_image"><?php echo $cnt->Social_Image__c; ?></div>
						<?php
                              }
						?>
						<div id="jf-searchIntroContainer">
							<h1 class="red">Hi <?php echo $cnt->FirstName; ?></h1>
							<div class="clearfix"></div>
							<div id="jf-searchIntro">What would you like to revise?</div>
						</div>
						<div id="home-search">
							<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
								<fieldset id="search">
									<input name="searchsubmit" type="submit" value="GO" title="Search our site" id="searchsubmit" class="button fade_me" />
									<input type="text" value="Search..." onclick="this.value='';" name="s" id="s" class="keywords" />
								</fieldset>
							</form>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			<?php } ?>
               <script type="text/javascript">
			(function($) {
				$(document).ready(function() {
					  $('#free_lessons').click(function() {
						$('#free_lessons_only').submit();
					});
				});	
			})(jQuery);
			</script>
			<div id="infinite">
				<div id="lessons_header">
                         <span class="latest_lessons">Latest lessons</span>
                         <?php
					if (loggedIn()) {
					?>
                         <form method="post" id="free_lessons_only" action="<?php bloginfo('url'); ?>/">
                              <fieldset>
                                   <label for="free_lessons">Show Free Lessons Only
                                        <input name="free_lessons" type="checkbox" title="Show free lessons only" id="free_lessons" <?php if (isset($_SESSION['free_lessons'])) { ?>checked<?php } ?>>
                                        <input type="hidden" name="toggle_free">
                                   </label>
                              </fieldset>
                         </form>
                         <?php
					}
					?>
                    </div>
				<?php				
				$counter = 0; $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					if (loggedIn()) {
						$category_array = $_SESSION['subject_array'];
					} else {
						$category_array = 0;
					}
					if (loggedIn()) {						
						$user_posts = $_SESSION['user_posts'];
						if (isset($_SESSION['free_lessons'])) { // Only show free posts if they have clicked this option
							$args = array(
									'post__in' => $user_posts, //all the posts applicable to the user
									'post_type' => 'post',
									'paged' => $paged,
									'posts_per_page' => 8,	
									'tax_query' => array(
										array(
											'taxonomy' => 'article_type',
											'field' => 'slug',
											'terms' => 'free'
										)
									)															
							);						
						}
						else {
							$args = array(
									'post__in' => $user_posts, //all the posts applicable to the user
									'post_type' => 'post',
									'paged' => $paged,
									'posts_per_page' => 8,							
							);
						}
					} else {
						$args = array(
							'post_type' => 'post',
							'paged' => $paged,
							'category__in' => $category_array,
							'posts_per_page' => 6,
							'tax_query' => array(
								array(
									'taxonomy' => 'article_type',
									'field' => 'slug',
									'terms' => 'home-page'
								)
							)
						);
					}
					query_posts($args);
					while (have_posts()) : the_post();
					$truncate = 180; //trim excerpt length
					$class = "one-col";
					$no_right_margin = "";
					if ($counter % 2 != 0) {
						$no_right_margin = "no_right_margin";
					}
					//Find out if this article is an audio or video post then apply a style further down the page
					$mediaterms = get_the_terms($post->ID, 'article_style');
					$media_style = "";
					$media_title = "";
					foreach($mediaterms as $media) {									
						if ($media->slug != 'standard') {									
							$media_style = "as_".$media->slug;
							$media_title = $media->name;
						}								
					}	
				?>
				<article class="infinite-item <?php echo $class." ".$no_right_margin; ?>">
					<div class="article-title">
						<?php //SUBJECT
							$categories = get_the_category();
							$seperator = ' ';
							$output = '';
							if ($categories) {
								foreach ($categories as $category) {
									if ($category->parent == 0) {
										$output .= '<a class="subject-button" href="'.get_category_link($category->term_id ).'" title="'.esc_attr(sprintf( __("All %s posts"), $category->name)).'">';
										$img = taxonomyImage($category->term_taxonomy_id, 'tiny-cog', 'taxonomy');
										if (!empty($img)) {
											$output .= $img;
										}
										$output .= $category->cat_name."</a>".$seperator;
									}
								}
								echo trim($output, $seperator);
							}
							//SUBJECT LEVEL
							$categories = get_the_terms($post->ID,'subject_level');
							if ($categories) {
								foreach ($categories as $category) {
									$cat_title = cat_title($category->name);
									echo "<span class='subject-button subject-level tiptip' title='$cat_title'>".$category->name."</span>";
								}
							}
							// SEE IF THE CONTENT IS FOR MEMBERS ONLY - check for the paid tag (or lack of it which means it's paid content)
							$terms = get_the_terms($post->ID, 'article_type');
							$paid_content = 1; // assume paid content
							if ($terms) {
								$terms_slugs = array();
								foreach($terms as $term) {
									array_push($terms_slugs,$term->slug); // save the slugs in an array
								}
								if ((in_array('free',$terms_slugs)) || (in_array('home-page',$terms_slugs))) {
									//we only have to check if it's free or on the home page, otherwise it's paid
									$paid_content = 0;
								}
							}
							if ($paid_content == 1) {
								echo "<span class='subscriber'><a href='/membership' title='Membership options' class='tiptip'>Member</a></span>";
							}
						?>
						<div class="clearfix"></div>
						<a class="article-heading" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</div>
					<!-- End 'article-title' DIV -->
					<a style="position: relative; float: left; margin: 0 10px 10px 0;" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php if ($media_style != "") {
						echo '<div class="media_mask '.$media_style.' tiptip" title="'.$media_title.'"></div>';
					} ?>
					<?php the_post_thumbnail(array(100,100)); ?></a>
					<a class="excerpt-text" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo tokenTruncate(get_the_excerpt(), $truncate)." &hellip;"; ?></a>
					<span class="article-nuggets">
						<a href="<?php the_permalink(); ?>#comment_holder" class="comment_number" title="View comments"><span><?php comments_number('0', '1', '%'); ?></span></a>
						<time><?php the_time('M jS, Y') ?></time>
						<span class="post-views"> <?php the_views(); ?></span>
					</span>
				</article>
				<?php $counter++; endwhile; ?>
			</div>
			<!-- End 'infinite' DIV -->
			<div class="clearfix"></div>
			<?php if (loggedIn() && function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</section>
		<?php wp_reset_query(); //don't reset the query before the pagination ?>
		<section class="right">
            <p class="oralbuttonbox">
                <a class="oralbutton" style="text-decorarion:none;" href="/oral-exam-prep-centre/">
                    <strong><span aria-hidden="true" class="icon-play"></span> Prepare for the Oral Exam</strong>
                </a>
            </p>
			<?php if (loggedIn()) : ?>
				<div class="clearfix"></div>
				<?php include ('includes/home-ticker.php'); ?>   
				<div class="clearfix"></div>
				<section class="popular_posts">
					<div class="title" style="height: auto;">Most Read Lessons</div>
					<?php echo getViews('post', 5); ?>
				</section>
			<?php endif; ?>
			<div id="facebook">
				<div class="fb-like-box" data-href="http://www.facebook.com/CleverNotesIE" data-width="337" data-show-faces="false" data-stream="true" data-header="true"></div>
			</div>
			<div id="twitter">
				<div class="title">
					<span style="color: #4099FF; font-weight: 700; margin-right: 10px; font-size: 19px;"><a href="http://twitter.com/CleverNotesIE"><img src="<?php bloginfo('template_directory'); ?>/images/logos/twitter.png" width="148" height="27" alt="Twitter"></a></span><span class="more"><a href="http://twitter.com/CleverNotesIE">follow us</a></span>
				</div>
				<ul id="twitter_update_list" class="tul" style="padding:0;margin:0;"></ul>
			</div>
		</section>
		<div class="clearfix"></div>
	</div>
	<!-- End 'bot' DIV -->
	<div class="clearfix"></div>
<?php } ?>

<?php get_footer(); ?>