<?php get_header(); ?>
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
							'posts_per_page' => 8,
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
						<!-- span class="post-views"> <?php // the_views(); ?></span -->
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
		
			<?php if (loggedIn()) : ?>
				<div class="clearfix"></div>
				<?php echo adrotate_group(1); ?>
				<div class="clearfix"></div>
				<section class="popular_posts">
					<div class="title" style="height: auto;">Most Read Lessons</div>
					<?php echo getViews('post', 5); ?>
				</section>
			<?php endif; ?>

			<?php echo adrotate_group(2); ?>

			<div id="facebook">
<!-- 				<div class="fb-like-box" data-href="https://www.facebook.com/CleverNotesIE" data-width="337" data-show-faces="false" data-stream="true" data-header="true"></div> -->
				<div class="fb-recommendations" data-site="http://www.clevernotes.ie" data-app-id="303018056471646" data-width="335" data-height="300" data-header="true"></div>
			</div>
<!--
			<div id="twitter">
				<div class="title">
					<span style="color: #4099FF; font-weight: 700; margin-right: 10px; font-size: 19px;"><a href="http://twitter.com/CleverNotesIE"><img src="<?php bloginfo('template_directory'); ?>/images/logos/twitter.png" width="148" height="27" alt="Twitter"></a></span><span class="more"><a href="http://twitter.com/CleverNotesIE">follow us</a></span>
				</div>
				<ul id="twitter_update_list" class="tul" style="padding:0;margin:0;"></ul>
			</div>
-->
			<div class="clearfix"></div><br />
			<a class="twitter-timeline" href="https://twitter.com/CleverNotesIE" data-widget-id="344739049212346369" data-border-color="#999999" data-tweet-limit="3">Tweets by @CleverNotesIE</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		</section>
		<div class="clearfix"></div>
	</div>
	<!-- End 'bot' DIV -->
	<div class="clearfix"></div>
<?php get_footer(); ?>