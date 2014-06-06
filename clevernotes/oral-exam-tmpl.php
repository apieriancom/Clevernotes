<?php
/**
 *Template Name: Oral Exam
*/

?>
<?php get_header(); ?>
<nav id="category_nav">
<a class="back-link" href="javascript:history.go(-1)">Back</a>
<?php if(is_page(array(18580,18585))) { ?>
<a class="irish cat-link subject-link" href="https://www.clevernotes.org/category/irish/" title="View all posts in Irish">Irish</a>
<?php } elseif(is_page(array(20316,20318))) { ?>
<a class="french cat-link subject-link" href="https://www.clevernotes.org/category/french/" title="View all posts in French">French</a>
<?php } elseif(is_page(array(21751,21753))) { ?>
<a class="german cat-link subject-link" href="https://www.clevernotes.org/category/german/" title="View all posts in German">German</a>
<?php } elseif(is_page(array(22690,22692))) { ?>
<a class="german cat-link subject-link" href="https://www.clevernotes.org/category/spanish/" title="View all posts in Spanish">Spanish</a>
<?php } ?>
<?php if(is_page(array(18580,20316,21753,22690))) { ?>
<span class='cat-link tiptip' title='Higher'>H</span>
<?php } elseif (is_page(array(18585,20318,21751,22692))) { ?>
<span class='cat-link tiptip' title='Ordinary'>O</span>
<?php } ?>
<span class="cat-link">Leaving Certificate</span></nav>
			   
<div id="social_bookmarks" class="clearfix">
	<span class='st_twitter_hcount' displayText='Tweet'></span>
	<span class='st_googleplus_hcount' displayText='Google +'></span>
	<span class='st_email_hcount' displayText='Email'></span>
	<div class='jf-spacer'>&nbsp;</div>
	<span class='st_fblike_hcount' displayText='Facebook Like'></span>
	<span class='st_facebook_hcount' displayText='Facebook'></span>
	<span class='st_sharethis_hcount' displayText='ShareThis'></span>
</div>

	<div id="main_container" style="margin-top: 50px;">
		<h1>clevernotes<span class="dot">.</span>ie Oral Exam Study Plan</h1>

<div class="subject_title" style="margin-top: 25px;">
	<div style="margin-bottom: 5px;">

<?php if(is_page(array(18580,18585))) { ?>
	<a title="Irish" href="/category/irish/"><img width="50" height="50" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/irish-50x50.png" class="attachment-medium-cog" alt="irish"></a> <h2 class="irish" style="font-size:25px;margin:0 0 10px 15px;display: inline-block;vertical-align:-7px"><a title="Irish" href="/category/irish/">
	<?php } elseif(is_page(array(20316,20318))) { ?>
	<a title="French" href="/category/french/"><img width="50" height="50" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/french-50x50.png" class="attachment-medium-cog" alt="French"></a> <h2 class="french" style="font-size:25px;margin:0 0 10px 15px;display: inline-block;vertical-align:-7px"><a title="French" href="/category/french/">
<?php } elseif(is_page(array(21751,21753))) { ?>
<a title="German" href="/category/german/"><img width="50" height="50" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/german-50x50.png" class="attachment-medium-cog" alt="German"></a> <h2 class="french" style="font-size:25px;margin:0 0 10px 15px;display: inline-block;vertical-align:-7px"><a title="German" href="/category/german/">
<?php } elseif(is_page(array(22690,22692))) { ?>
<a title="Spanish" href="/category/spanish/"><img width="50" height="50" src="https://www.clevernotes.ie/wp-content/uploads/2012/10/spanish-50x50.png" class="attachment-medium-cog" alt="Spanish"></a> <h2 class="spanish" style="font-size:25px;margin:0 0 10px 15px;display: inline-block;vertical-align:-7px"><a title="Spanish" href="/category/spanish/">
<?php } ?>
	<?php the_title(); ?></a></h2></div>      
</div>

<?php if(is_page(array(18580,18585))) { ?>
<p>Improve your oral exam prep. and get ready for your oral exams with <strong >clevernotes.ie</strong>. We've created a list of oral exam essentials to help you study, prepare for and practice out loud for your oral exams in April.</p>
<br />
<?php } ?>


		<div id="container_left">
	  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <div class="box post full" id="post-<?php the_ID(); ?>">
               <div class="post-block">
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
                    </section>
               </div>
	  	</div>
	  	<?php endwhile; endif; ?>		    			 
	</div>
</div>
<?php get_footer(); ?>