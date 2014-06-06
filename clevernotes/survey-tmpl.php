<?php
/**
 *Template Name: Survey
*/
?>
<?php get_header(); ?>
<?php
$cnt=$_SESSION['cnt'];
?>
<div id="layout">
	<div id="main_container">	
		<div id="container_left">
	  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <div class="box post full" id="post-<?php the_ID(); ?>">
               <div class="post-block">
                    <div class="post-title">
                         <h1><?php the_title(); ?></h1>                              
                    </div>
                    <section class="body_content">
					<?php the_content(); ?>	
                         <?php
					if (isset($_SESSION['cnt'])) {  					
					?>
					<?php gravity_form(9, false, true, false, '', false); ?>
					<?php
					} else {
					?>
                         <h2>You must be registered to enter this competition. Please sign in below.</h2>
                         <a rel="leanModal" name="signup" href="#signup" class="notyetbutton">Sign in!</a>

                         <?php
					}
					?>                         
                    </section>
               </div>
	  	</div>	  
	  	<?php endwhile; endif; ?>	  			 
	</div>	
</div>
<?php get_footer(); ?>