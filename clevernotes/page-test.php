<?php
/**
 *Template Name: Paypal button test
*/

?>
<?php get_header(); ?>
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
                         <?php 
                         if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                              echo "<span class='feature'>";
                              the_post_thumbnail('featured-image');
                              echo "</span>";
                         }
                         ?>	     
                         <?php the_content(); ?>	
                         <?php wp_link_pages('before=<p><strong>Pages:</strong> &after=</p>&next_or_number=number'); ?> 
                          <?php if (loggedIn()) {
											$cnt=$_SESSION['cnt']; // Set the contact array from the Session ?>

                         
                         <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="N835CQPUGDSAQ">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
		<?php echo $cnt->Id; ?>
		                          <?php } ?>

                    </section>
               </div>
	  	</div>
	  	<?php endwhile; endif; ?>		    			 
	</div>
</div>
<?php get_footer(); ?>
