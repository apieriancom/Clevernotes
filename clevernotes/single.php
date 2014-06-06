<?php get_header(); ?>
		<?php if (!is_category( array('Biology','Business','Chemistry','English','French','Geography','German','History','Home Economics','Irish','Maths','Physics','Spanish') ) ) { echo adrotate_group(6);  } ?>
		<?php if (is_category( 'Biology' ) ) { echo adrotate_group(6);  } ?>
		<?php if (is_category( 'Business' ) ) { echo adrotate_group(7);  } ?>
		<?php if (is_category( 'Chemistry' ) ) { echo adrotate_group(8);  } ?>
		<?php if (is_category( 'English' ) ) { echo adrotate_group(6);  } ?>
		<?php if (is_category( 'French' ) ) { echo adrotate_group(10);  } ?>
		<?php if (is_category( 'Geography' ) ) { echo adrotate_group(11);  } ?>
		<?php if (is_category( 'German' ) ) { echo adrotate_group(12);  } ?>
		<?php if (is_category( 'History' ) ) { echo adrotate_group(13);  } ?>
		<?php if (is_category( 'Home Economics' ) ) { echo adrotate_group(14);  } ?>
		<?php if (is_category( 'Irish' ) ) { echo adrotate_group(15);  } ?>
		<?php if (is_category( 'Maths' ) ) { echo adrotate_group(16); } ?>
		<?php if (is_category( 'Physics' ) ) { echo adrotate_group(17); } ?>
		<?php if (is_category( 'Spanish' ) ) { echo adrotate_group(18); } ?>
<div id="layout" class="article">
	<div id="main_container">
           <?php $urlHome = get_bloginfo('template_directory'); ?>
           <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
           <article class="box post<?php if (isSubscribed()) { echo " lessonbody"; }  ?>" id="post-<?php the_ID(); ?>">
             <div class="content">
               <?php $postimageurl = get_post_meta($post->ID, 'post-img', true); if ($postimageurl) { ?>
               <div class="pic"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $postimageurl; ?>" alt="<?php the_title_attribute(); ?>" class="img_left" /></a></div>
               <?php } ?>
               <nav id="category_nav">
			   <?php // checks if this is a Learnosity Blog and redirects 'Back' link if it is
					if (get_field('learnosity_id') && get_field('learnosity_id') != '') {
						echo '<a class="back-link" href="/">Home</a>';
					} else {
						echo '<a class="back-link" href="javascript:history.go(-1)">Back</a>';
					}
				?>
				<?php
                    //SUBJECT
                    $categories = get_the_category();
                    $output = '';
                    if($categories){
                         foreach($categories as $category) {								
							if($category->parent == 0 ){
                              	$output .= '<a class="'.$category->slug.' cat-link subject-link" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>';
							}
                         }
                    echo trim($output);
                    }
				//SUBJECT LEVEL
				$categories = get_the_terms($post->ID,'subject_level');
				if($categories){
					foreach($categories as $category) {
							$cat_title = cat_title($category->name);
							//echo '<a class="cat-link" href="/'.$category->taxonomy . "/" .$category->slug.'">'.$category->name.'</a>';
							echo "<span class='cat-link tiptip' title='$cat_title'>".$category->name."</span>";
					}
				}	
				//CERTIFICATE
				$categories = get_the_terms($post->ID,'certificate');
				if($categories){
					foreach($categories as $category) {
							//echo '<a class="cat-link" href="/'.$category->taxonomy . "/" .$category->slug.'">'.$category->name.'</a>';
							echo '<span class="cat-link">'.$category->name.'</span>';
					}
				}
				//ARTICLE STYLE
				$categories = get_the_terms($post->ID,'article_style');
				if($categories){
					$article_style = array();
					foreach($categories as $category) {
							array_push($article_style, $category->name);
					}
				$article_style = implode(",",$article_style);
				}	
				//ARTICLE TYPE - find out if it's free
				$article_type = 'Paid';
				$categories = get_the_terms($post->ID,'article_type');
				if($categories){
					foreach($categories as $category) {
						if ($category->name == 'Free') {
							$article_type = 'Free';
						}
					}
				}									
                    ?>
               </nav>
				<div id="social_bookmarks" class="clearfix">
					<span class='st_twitter_hcount' displayText='Tweet'></span>
					<span class='st_googleplus_hcount' displayText='Google +'></span>
					<span class='st_email_hcount' displayText='Email'></span>
					<div class='jf-spacer'>&nbsp;</div>
					<span class='st_fblike_hcount' displayText='Facebook Like'></span>
					<span class='st_facebook_hcount' displayText='Facebook'></span>
					<span class='st_sharethis_hcount' displayText='ShareThis'></span>
               </div>
			   
               <h1 class="post-title"><?php the_title(); ?></h1>
		     <div class="clearfix"></div>
               <?php
				if (get_field('display_author') == 'Show') {		
			?>
               <span class="author-title">By <?php the_author_posts_link(); ?> </span>
               <?php
			}				
			?>
               <?php
			if (get_comments_number()!=0) {
			?>
               <a href="#comment_holder" class="comment_number" title="View comments">
				<span><?php comments_number( '', '1', '%' ); ?></span>
               </a>
               <?php
			}
               ?>           
               <section class="post-excerpt">
               	<?php
				//Syllabus Link
				if ((trim(get_field('description')) != "") && (trim(get_field('description')) != " ") && (trim(get_field('description')) != NULL)){
				?>
                    <div id="syllabus_box" class="colorbox">
                         <h3 id="syllabus_header">SYLLABUS LINK</h3>
                         <div class="syllabus_content">
						<?php the_field('description'); ?>
                         </div>
                    </div>  
                    <div class="clearfix"></div>                  
                    <?php						
				}
				?>
				<?php 						
				//Block content from WordPress if member not paid
				if ($block_post == 1) { //if you use blockPost() function here it won't work so global variable set in header
					echo "<h3 class='red' style='margin-bottom: 20px;'>This content is only available to members.</h3>";	
				}
				else {
					// checks if blog entry has associated Learnosity ID
					if (loggedIn() && get_field('learnosity_id') && get_field('learnosity_id') != '') {
						the_excerpt();
						include 'includes/inc-learnosity-blog.php';
					}		
					the_content(); 			
				}
				?>


<!-- Survey -->
                    <?php
                    if (is_single( '29961' )) {
                    echo "<hr />";
					if (isset($_SESSION['cnt'])) { 
					gravity_form(5, true, true, false, '', false);
					} else {
					?>
                         <p style="text-align:center !important; margin: 30px 0 20px 0 !important;"><h2>You must be registered to enter this competition. Please sign in below.</h2>
                         <a rel="leanModal" name="login" href="#login" class="notyetbutton aligncenter">Sign in!</a></p>
                         <div class="clearfix"></div>

                         <?php
					}
					}
					?>                         
<!-- / Survey -->


                 	<time><?php the_date(); ?></time>
                    <!-- span class="post-views"> <?php // the_views(); ?></span -->
               </section>
             </div>					
     </article>
     <?php //related_posts(); ?>
     <div class="clearfix"></div>
     <?php
	if (get_field('display_author') == 'Show') {		
	?>
     <aside id="author_holder" class="curved-box">
	     <div class="curved-img align-left">
			<?php userphoto_the_author_thumbnail(); ?>
          </div>
          <h4>Author: <?php the_author_posts_link(); ?></h4>
		<?php  	    	
		the_author_meta('description');
		//echo tokenTruncate(get_the_author_meta('description'), 250) . "&hellip;";
         	?>
          <div class="clearfix"></div>
     </aside>
     <aside id="related_posts">
		<?php wp_related_posts(); ?>     
     </aside>
     <?php
	}
	?>
	<div id="comment_holder">
		<p id="jf-commentIntro">All comments submitted to the clevernotes website are subject to moderation and will not appear until approved by us. Any comments judged to be defamatory or abusive will not be published. The decision of the moderator with regards to comment suitability is final.</p>
		<?php comments_template( '/mycomments.php' ); ?>
     </div>
	<?php do_action('oa_social_login'); ?> 
     <?php endwhile; else: ?>
     <p>Sorry, no posts matched your criteria.</p>
     <?php endif; ?>
  	<?php //if ( dynamic_sidebar( 'related-posts-widget-area' ) ) : endif; ?>
     </div>
	<div class="clearfix"></div>
</div>
<?php get_footer(); ?>