<?php
/**
 *Template Name: PageOfPosts
*/
?>
<?php get_header(); ?>
<div id="layout">
	<div id="main_container" class="theme_width pageofposts">
		<div id="container_left">
		    <?php 		    
			$temp = $wp_query;
			$wp_query= null;
			$wp_query = new WP_Query();
			$wp_query->query("cat=$pcat&showposts=5"."&paged=".$paged);		    
		    
		    ?>
			 <?php if (have_posts()) : ?>
			 <?php while (have_posts()) : the_post(); ?>
			 <article class="box post" id="post-<?php the_ID(); ?>">
			   <div class="ne_holder">	
			   	<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				?>				 
					<span class="ne_thumb">
					<a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>	
					</span>
				
				<?php
				}
				?>
				<span class="ne_content">
					<div class="post-title">
					  <h2><a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>">
					    <?php the_title(); ?>
					    </a></h2>
					</div>	
                         <!--			
					<time class="post-date">
					  <?php //the_time('j M Y'); ?>
					</time>
                         -->
					<section class="post-excerpt">
					  <?php the_excerpt(); ?>
						<?php
						if ( $pcat == 1 ) {
						?>
						<p style="color:#999999;font-size:.9em">
						<?php
						comments_number('(No Comments)', '(1 Comment)', '(% Comments)' );
						?>			
						</p>				
						<?php
						}	
						 ?>					  
					    <a class="button" href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>">Read more</a>					  
					</section>
				</span>
			   </div>
			 </article>
			 <?php endwhile; ?>
			 <?php endif; ?>	
			 <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
  </div>
  	<section id="container_right" class="inside">			 
		 <?php get_sidebar(); ?>		
	</section><div class="clearfix"></div>
  </div>
  </div>
</div>
<!--/columns -->
<?php get_footer(); ?>
