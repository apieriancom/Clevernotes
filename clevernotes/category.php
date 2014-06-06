<?php get_header(); ?>
<script type="text/javascript">
jQuery(document).ready(function() { 
	<?php
	//Create a fake click to open the panel
	if (isset($_GET['panel'])) {
		$panel = $_GET['panel'];
	?>
	jQuery("#side_nav li .<?php echo $panel; ?>").click();
	<?php
	} else {
	?>
	jQuery("#side_nav li:first ul").show(); //make first item show panel
	<?php
	}
	?>	
});
</script>	
<div id="layout" class="subject-page">
	<div class="left">
          <div id="nav_wrapper">
               <div id="nav_slider">
                    <div class="subject_title" style="margin-top: 5px;">
                         <?php
                         //SUBJECT TITLE AND COG
                         if (is_category( )) {
                              $cat = get_query_var('cat');
						$cat =  pa_category_top_parent_id ($cat); //always get top level category id for subject or sub category pages lose main category and inherit sub category
                              $category = get_category ($cat); //ID of category //$catid for Learnosity
                              $cat_name = $category->name;
                              $cat_slug = $category->slug;
                              $catid = $category->term_id;
                         }
					$cog = taxonomyImage($category->term_taxonomy_id, 'medium-cog', 'taxonomy');
                     
                         $subject_title = "<div style='margin-bottom: 5px;'><a title='$cat_name' href='/category/$cat_slug/'>$cog</a> <h2 class='$cat_slug' style='font-size:25px;margin:0 0 10px 15px;display: inline-block;vertical-align:-7px'><a title='$cat_name' href='/category/$cat_slug/'>".$cat_name."</a></h2></div>";	
                         
                         echo $subject_title;
                         ?>      
                    </div> 
                    <div id="nav_content" class="curved-box">
                         <div id="search_holder">
                              <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
                                <fieldset id="search">
                                  <div><input type="text" value="Search..." onClick="this.value='';" name="s" id="s" class="keywords" /></div>
                                  <div id="search_mag"><input name="searchsubmit" type="image" src="<?php bloginfo('template_directory'); ?>/images/buttons/search_button.jpg" alt="Submit" title="Search our site" id="searchsubmit" class="fade_me" /></div>
                                </fieldset>
                              </form>
                         </div>    
                         <div class="clearfix"></div>   
                         <ul id="side_nav"> 
                         <?php
					
					$user_posts = $_SESSION['user_posts']; //array of all posts relevant to this user					
					//CHECK IF THE USER HAS CHOSEN THIS SUBJECT - If they haven't show unfiltered results
					if (isset($_SESSION['subject_array'])) {
						if ((!in_array($catid, $_SESSION['subject_array'])) || ($catid == '2101') || ($catid == '58')) {
							$user_posts = "";
						}
					}
					else {
						$user_posts = "";
					}
					
                         //now get all terms in custom taxonomy that are not empty -> Article Type
                         $taxonomies = array( 
                             'article_type',
                         );
                         
                         $args = array(
                             'orderby' => 'term_order', //plugin does this
                             'exclude'       => array(3263,3267,3559), //exclude free=3263,paid=3267, home page 3559
                             'hide_empty'    => true,
					    'parent'         => 0 //only get top level terms for now
                         ); 				
                         $article_type_terms = get_terms( $taxonomies, $args );	
                         
                         foreach ( $article_type_terms as $term ) { //loop through top level terms and see if any posts exist in subject category
                         
                         //$cat_slug - subject slug taken from top of file
                         $term_slug = $term->slug;
					$term_name = $term->name;
					$term_id = $term->term_id;
                              $targs = array(
							'posts_per_page' => -1,
                                   'tax_query' => array(
                                        array(
                                             'taxonomy' => 'article_type',
                                             'field' => 'slug',
                                             'terms' => $term_slug
                                        ),
                                        array(
                                             'taxonomy' => 'category',
                                             'field' => 'slug',
                                             'terms' => $cat_slug
                                        )						
                                   )
                              );

						$bold = "";
						if ( isset($_GET['article_type']) ) {
								if ( $_GET['article_type'] == $term_slug ) {
									$bold = " style='font-weight:700'";
								}
						}
						
                              $postslist = get_posts( $targs );	
                              if ( $postslist ) { //if there are posts create a menu system - need to give every title a class so that an icon can be associated with it
						?>                            
                              
                                   <li class="article_type curved-box">
                                   	<div class="title <?php echo "at_".$term_slug ?>"><?php echo $term_name ?></div>
                                   	<ul>                                        
                                        	<li class='filter_posts'><a <?php echo $bold; ?> href='/category/<?php echo $cat_slug ?>/?article_type=<?php echo $term_slug ?>&amp;panel=<? echo "at_".$term_slug ?>'>Show all (<?php echo count($postslist); ?>)</a></li>

										<?php
										//At this stage all we know is that there are posts with the term for this article type but now we have to loop through the sub terms
										//now get all terms in custom taxonomy that are not empty -> Article Type
										$sub_args = array(
										    'orderby' => 'term_order', //plugin does this
										    'hide_empty'    => true,
										    'parent'         => $term_id //only get sub terms
										); 				
										$sub_article_type_terms = get_terms( 'article_type', $sub_args );	
										
										foreach ( $sub_article_type_terms as $sub_term ) { //loop through sub level terms and see if any posts exist in subject category
										
										 	$sub_term_slug = $sub_term->slug;
											$sub_term_name = $sub_term->name;
											$sub_term_id = $sub_term->term_id;										
											
											//LOOP THROUGH SUB-CATEGORIES OF TERM
											//now get all terms in custom taxonomy that are not empty -> Article Type
											$sub_targs = array(
												'post_type' => 'post',
												'post__in' => $user_posts, //all the posts applicable to the user
												'posts_per_page' => -1,
												'tax_query' => array(
													'relation' => 'AND',
													array(
														'taxonomy' => 'article_type',
														'field' => 'slug',
														'terms' => $sub_term_slug
													),
													array(
														'taxonomy' => 'category',
														'field' => 'slug',
														'terms' => $cat_slug
													)						
												)
											);
											
											$bold = "";
											if ( isset($_GET['article_type']) ) {
													if ( $_GET['article_type'] == $sub_term_slug ) {
														$bold = " style='font-weight:700'";
													}
											}
											
											$sub_postslist = get_posts( $sub_targs );		
											if ( $sub_postslist ) { //if there are posts then show terms
													?>
														<li class='jf-subCat'><a <?php echo $bold; ?> href='/category/<?php echo $cat_slug ?>/?article_type=<?php echo $sub_term_slug ?>&panel=<? echo "at_".$term_slug ?>'><?php echo $sub_term_name; ?> (<?php echo count($sub_postslist); ?>)</a></li>                                        
													<?php											
											}
										}
                                             ?>                                              
                                        </ul>
                                   </li>
                                   
                              <?php
                              }					
                         }					
                         ?>
                    	</ul>
                    </div>
                    <?php // if (is_category( array( 'Irish','French','German','Spanish' ) )) { ?>
	                    <!-- a class="oralbutton" style="text-decorarion:none;" href="/oral-exam-prep-centre/">
                    		<strong><span aria-hidden="true" class="icon-play"></span> Prepare for the Oral Exam</strong>
                    	</a -->
                    <?php // } ?>


                    <?php if (is_category( 'English' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybenglish testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your English knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Biology' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybbiology testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Biology knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Business' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybbusiness testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Business knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Chemistry' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybchemistry testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Chemistry knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'French' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybfrench testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your French knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Geography' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybgeography testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Geography knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Home Economics' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybhomeecs testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Home Ec. knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Irish' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybirish testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Irish knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Maths' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybmaths testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Maths knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>
                    <?php if (is_category( 'Physics' ) ) { ?>
                    <div class="clearfix"></div>
                    <p class="testyourselfbox">
                    	<a class="tybphysics testyourselfbutton" style="text-decorarion:none;" href="/test-yourself/">
                    		<strong><span aria-hidden="true" class="icon-edit"></span> Test your Physics knowledge here!</strong>
                    	</a>
                    </p>
                    <?php } ?>


               </div><div class="clearfix"></div> 
          </div>
	</div>
	<div class="right">
	
		<?php if (!is_category( array('Biology','Business','Chemistry','English','French','Geography','German','History','Home Economics','Irish','Maths','Physics','Spanish') ) ) { echo adrotate_group(3);  } ?>
		<?php if (is_category( 'Biology' ) ) { echo adrotate_group(19);  } ?>
		<?php if (is_category( 'Business' ) ) { echo adrotate_group(21);  } ?>
		<?php if (is_category( 'Chemistry' ) ) { echo adrotate_group(23);  } ?>
		<?php if (is_category( 'English' ) ) { echo adrotate_group(3);  } ?>
		<?php if (is_category( 'French' ) ) { echo adrotate_group(27);  } ?>
		<?php if (is_category( 'Geography' ) ) { echo adrotate_group(29);  } ?>
		<?php if (is_category( 'German' ) ) { echo adrotate_group(31);  } ?>
		<?php if (is_category( 'History' ) ) { echo adrotate_group(33);  } ?>
		<?php if (is_category( 'Home Economics' ) ) { echo adrotate_group(35);  } ?>
		<?php if (is_category( 'Irish' ) ) { echo adrotate_group(37);  } ?>
		<?php if (is_category( 'Maths' ) ) { echo adrotate_group(39); } ?>
		<?php if (is_category( 'Physics' ) ) { echo adrotate_group(41); } ?>
		<?php if (is_category( 'Spanish' ) ) { echo adrotate_group(43); } ?>

	<!--
<?php
//SUBJECT LEVEL
// $category->name == "";
// $categories = get_the_terms($post->ID,'subject_level');
// if($categories){
//    foreach($categories as $category) {
//         $cat_title = cat_title($category->name);
//         echo $cat_title . ' 1 and 2 ';
//         echo $category->name;
//    }
// }
?>





 6 biology-post
 7 business-post
 8 chemistry-post	
 9 english-post
10 french-post
11 geography-post
12 german-post
13 history-post
14 homeec-post
15 irish-post
16 maths-post
17 physics-post	
18 spanish-post
19 biology-hl
20 biology-ol
21 business-hl
22 business-ol
23 chemistry-hl
24 chemistry-ol
25 english-hl
26 english-ol
27 french-hl
28 french-ol
29 geography-hl
30 geography-ol
31 german-hl
32 german-ol
33 history-hl
34 history-ol
35 homeec-hl
36 homeec-ol
37 irish-hl
38 irish-ol
39 maths-hl
40 maths-ol
41 physics-hl
42 physics-ol
43 spanish-hl
44 spanish-ol


	-->
	
	
		<div id="infinite">
		<?php
		if (isset($_GET['article_type'])) {  //filter by second taxonomy as well as category
			$article_type = array($_GET['article_type']);
			$args = array(		
				'post_type' => 'post',
				'paged' 		=> $paged,
				'post__in' => $user_posts,
				'post_status' => 'publish',
				'posts_per_page' => 8,
				'tax_query' => array(	
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $cat_slug
					),		
					array(
						'taxonomy' => 'article_type',
						'field' => 'slug',
						'terms' => $article_type
					),												
				)
			);			
		} else {		
			$args = array(		
				'post_type' => 'post',
				'paged' 		=> $paged,
				'post__in' => $user_posts,
				'post_status' => 'publish',
				'posts_per_page' => 8,
				'tax_query' => array(		
					array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $cat_slug
					)								
				)
			);		
		}
			
		
		query_posts( $args ); //breaking infinite scroll??
		
		$posts = get_posts($args);
		foreach( $posts as $post ) : setup_postdata($post);
                         ?>
                         <article class="infinite-item one-col">     
                    <?php
				
							//Find out if this article is an audio or video post then apply a style further down the page	
							$mediaterms = get_the_terms( $post->ID, 'article_style' );
							$media_style = "";
							$media_title = "";
							foreach($mediaterms as $media) {									
								if ($media->slug != 'standard') {									
									$media_style = "at_".$media->slug;
									$media_title = $media->name;
								}								
							}				
							
                                   //SUBJECT LEVEL
                                   $categories = get_the_terms($post->ID,'subject_level');
                                   if($categories){
                                        foreach($categories as $category) {
                                             $cat_title = cat_title($category->name);
                                             echo "<span style='margin-bottom:8px;' class='subject-button subject-level tiptip'  title='$cat_title'>".$category->name."</span>";
                                        }
                                   }			
							/// SEE IF THE CONTENT IS FOR MEMBERS ONLY - check for the paid tag (or lack of it which means it's paid content)
							$terms = get_the_terms( $post->ID, 'article_type') ;  
							$paid = 1; //assume paid content
							if ($terms) {
								$terms_slugs = array();
									foreach( $terms as $term ) {
									    array_push($terms_slugs,$term->slug); // save the slugs in an array
									}	
								if (in_array('free',$terms_slugs)) { //we only have to check if it's free, otherwise it's paid
									$paid = 0;
								}
							}				
							if ($paid == 1) {
								echo "<span class='subscriber'><a href='/membership' title='Membership options' class='tiptip'>Member</a></span>";		
							}									 
                              ?>              
                              <div class="clearfix"></div>                                           
                              <div class="article-title">
                                   <a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                              </div>
                              <div class="cat_article_image_wrapper">
							<?php if ($media_style != "") { ?>
                                   <div class="media_mask <?php echo $media_style; ?> tiptip" title="<?php echo $media_title; ?>"></div>
                                   <?php } ?>                              
                                   <a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>">
                                   <?php the_post_thumbnail(); ?>
                                   </a>
                              </div>
                              <div class="w100p float_left">
                                   <?php short_content(get_the_excerpt()); ?>                    
                                   <?php
                                   if (get_field('display_author') == 'Show') {		
                                   ?>
                                   by <?php the_author_posts_link(); ?>
                                   <?php } ?>
                                   <span class="article-nuggets">
                                        <a href="<?php the_permalink(); ?>#comment_holder" class="comment_number" title="View comments">
                                             <span><?php comments_number( '0', '1', '%' ); ?></span>
                                        </a>
                                        <time><?php the_time('M jS, Y') ?></time>  
                                        <!-- span class="post-views"> <?php // the_views(); ?></span -->
                                   </span> 
                              </div>       
                         </article> 
                         <?php
               endforeach;
               if(function_exists('wp_pagenavi')) {
                    wp_pagenavi(); 
               }	
          ?>                     
     	</div>    
	</div> 
</div>



<?php get_footer(); ?>