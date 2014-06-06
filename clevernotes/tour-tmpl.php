<?php
/**
 *Template Name: Tour page
*/

?>
<?php get_header(); ?>

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



<?php if (loggedIn()) { ?>
<!-- p style="text-align:center; 	font-size: 1.1em; font-family: 'Titillium Web', sans-serif; margin: 10px; padding: 0; color: #e56c69;">Click the button bellow to complete your purchase!</p -->
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
<div style="text-align: center; margin: auto;"><a rel="leanModal" name="signup" href="#signup" class="buynowbutton">Buy Now!</a> <a rel="leanModal" name="login" href="#login" class="notyetbutton">Try for free</a></div>
<?php } ?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

	</div>

<?php get_footer(); ?>