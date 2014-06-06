<?php
/**
 *Template Name: Authors
*/
?>
<?php get_header(); ?>
	
		<div id="container_left">
	  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <div class="box post full" id="post-<?php the_ID(); ?>">
               <div class="post-block">
                         <div class="post-title">
                              <h1><?php the_title(); ?></h1>                              
                         </div>
                    <section class="body_content">        
                         <?php the_content(); ?>			
                    </section>
               </div>
	  	</div>
	  	<?php endwhile; endif; ?>

<?php get_footer(); ?>