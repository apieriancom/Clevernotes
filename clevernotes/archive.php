<?php get_header(); ?>
	<div id="layout" class="results">

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
          <?php /* Category Archive */ if (is_category()) { ?>
               <h1 class="archive_title"><?php _e('Archive for ‘','comicpress'); ?><?php single_cat_title() ?>’</h1>
          <?php /* Tag Archive */ } elseif( is_tag() ) { ?>
               <h1 class="archive_title"><?php _e('Posts Tagged ‘','comicpress'); ?><?php single_tag_title() ?>’</h1>
          <?php /* Daily Archive */ } elseif (is_day()) { ?>
               <h1 class="archive_title"><?php _e('Archive for','comicpress'); ?> <?php the_time('F jS, Y') ?></h1>
          <?php /* Monthly Archive */ } elseif (is_month()) { ?>
               <h1 class="archive_title"><?php _e('Archive for','comicpress'); ?> <?php the_time('F, Y') ?></h1>
          <?php /* Yearly Archive */ } elseif (is_year()) { ?>
               <h1 class="archive_title"><?php _e('Archive for','comicpress'); ?> <?php the_time('Y') ?></h1>
          <?php /* Author Archive */ } elseif (is_author()) { ?>
               <h1 class="archive_title"><?php _e('Author Archive','comicpress'); ?></h1>
          <?php /* Paged Archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
               <h1 class="archive_title"><?php _e('Archives','comicpress'); ?></h1>
          <?php /* taxonomy */ } elseif (is_taxonomy($wp_query->query_vars['taxonomy'])) {
			$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
               if (is_term($wp_query->query_vars['term'])) { ?>
                    <h1 class="archive_title"><?php echo $term->name; ?></h1>
               <?php } else { ?>
                    <h1 class="archive_title"><?php echo $wp_query->query_vars['taxonomy']; ?></h1>
               <?php } ?>
          <?php /* Post Type */ } elseif ($post->post_type !== 'post') { ?>
               <h1 class="archive_title"><?php echo $post->post_type; ?></h1>
          <?php } ?>
		<div class="clearfix"></div>
		<?php if (have_posts()) : ?>
          <section id="isotope-container">
          <?php 
          while (have_posts()) : the_post(); 		 				
          ?>
          <?php wp_get_post_categories( $post_id ); ?>
               <a href="<?php the_permalink(); ?>" rel="title">
                    <span id="post-<?php the_ID(); ?>" class="isotope-item">
                    <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                         echo "<div>".the_post_thumbnail('search-results')."</div>"; 
                    }			
                    ?>
                    <h6><?php the_title(); ?>asdf</h6>                 
                    </span>
               </a>
          <?php endwhile; ?>
          </section>
          <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
          <?php else : ?>  
               <div class="clearfix"></div>
               <h2 style="margin-top:40px;font-weight:lighter;">No results found</h2>
          <?php endif; ?>	
     <div class="clearfix"></div>
</div>
<?php get_footer(); ?>
