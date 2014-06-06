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
                    </section>
               </div>
	  	</div>
	  	<?php endwhile; endif; ?>


	<?php
//	if ( current_user_can('activate_plugins') || is_page('test-by-sean') ) {
//		$cnt = $_SESSION['cnt'];
//		$sfid = $cnt->Id;
// $meta_value = gform_get_meta($entry_id, $meta_key);

//	echo " / ";
//		echo $tst_contact_type;
//	}
	?>

	</div>
</div>
<?php get_footer(); ?>