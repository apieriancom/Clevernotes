<section id="featured_posts">
	<?php
		$args = array(
			'post_type' => 'post',
			'category__in' => $category_array,
			'posts_per_page' => 4,
			'meta_query' => array(
				array(
					'key' => 'home_page_feature',
					'value' => 'Yes'
				),	
			)
		);	
		query_posts($args);
		while (have_posts()) : the_post();
	?>
		<?php //SUBJECT
			$categories = get_the_category();
			$seperator = ' ';
			$output = '';
			if ($categories) {
				$count = 0;
				foreach ($categories as $category) {
					if ($count == 0) {
						global $taxonomy_images_plugin;							
						$output .= '<a class="subject-button" href="'.get_category_link($category->term_id).'" title="'.esc_attr(sprintf( __("All %s posts"), $category->name)).'">';
						$img = $taxonomy_images_plugin->get_image_html('tiny-cog', $category->term_taxonomy_id);
						if(!empty($img)) {
							$output .= $img;
						}
						$output .= $category->cat_name."</a>".$seperator;
						$count++;
					}
				}
				echo trim($output, $seperator);
			}
			//SUBJECT LEVEL
			$categories = get_the_terms($post->ID,'subject_level');
			if ($categories) {
				foreach ($categories as $category) {
					$cat_title = cat_title($category->name);
					echo "<span class='subject-button subject-level tiptip' title='$cat_title'>".$category->name."</span>";
				}
			}
		?>
		<div class="clearfix"></div>
		<a style="float:left;margin:0 10px 10px 0;" href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(280,180)); ?></a>
		<a class="article-heading" href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	<?php endwhile;	wp_reset_query(); ?>
</section>