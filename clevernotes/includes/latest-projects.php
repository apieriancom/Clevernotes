<?php	
if (isset($project_category)) :
	$args = array( 'post_type' => 'project', 'category' => $project_category, 'numberposts' => 4, 'post_status' => null, 'post_parent' => null ); 	
	$project_thumbs_title = "Related";
else :
	$args = array( 'post_type' => 'project', 'numberposts' => 4, 'post_status' => null, 'post_parent' => null ); 	
	$project_thumbs_title = "Latest";
endif ;

$project = get_posts( $args );
if ($project) {
?>
<section id="related_categories">
		<h3><?=$project_thumbs_title?> projects</h3>
          <div id="isotope-container">
               <ul id="bottom-services">
                    <?php
                         foreach ( $project as $post ) {
                              setup_postdata($post);
                              if ($post_id != get_the_ID()) { //we don't want to show the same project as the current one
                              ?>
                    
                                   <li class="isotope-item">
                                        <div class="box post" id="post-<?php the_ID(); ?>">
                                        <?php 
                                        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                        ?>				 
                                             <span class="fade_me">
                                             <a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>">
                                                  <?php the_post_thumbnail('thumbnail'); ?>
                                             </a>	
                                             </span>
                                        <?php
                                        }
                                        ?>
                                        <h4><a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                        <?php 
                                        if ( get_field('sub_title_p') ) : //for custom fields
                                             echo "<div class='sub-title'>".get_field('sub_title_p')."</div>"; 				
                                        endif ;
                                        ?>	
                                        </div>                      
                                   </li>                  
                              <?php
                              }
                         }
                    ?>                                                           
               </ul>  
          </div>   
</section> 
<?php
}
?>