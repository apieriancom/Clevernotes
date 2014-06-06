<?php get_header(); ?>
<script type="text/javascript">
   jQuery(document).ready(function() {
		var characters = 150;
		    jQuery("#counter").append("You have <strong>"+  characters+"</strong> characters remaining");
		    jQuery("#feedback").keyup(function(){
			   if(jQuery(this).val().length > characters){
			   jQuery(this).val(jQuery(this).val().substr(0, characters));
			   }
		    var remaining = characters -  jQuery(this).val().length;
		    jQuery("#counter").html("You have <strong>"+  remaining+"</strong> characters remaining");
		    if(remaining <= 10)
		    {
			   jQuery("#counter").css("color","red");
		    }
		    else
		    {
			   jQuery("#counter").css("color","black");
		    }
		    });
   });
</script>
<div id="layout">
  <div id="centercol">
    <?php if (have_posts()) : ?>
    <div class="box post">
      <div class="post-block">
        <div class="post-title full">
          <h1>Search Results For: <span><?php echo $s; ?></span></h1>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div id="infinite">
	    <?php while (have_posts()) : the_post(); ?>
         <article class="infinite-item" style="margin-bottom: 60px;">
           <div class="content">
             <?php $postimageurl = get_post_meta($post->ID, 'post-img', true); if ($postimageurl) { ?>
             <div class="pic"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $postimageurl; ?>" alt="<?php the_title_attribute(); ?>" class="img_left" /></a></div>
             <?php } ?>
             <!--/post-img -->
             <div class="post-title">
               <h2 style="display:inline-block"><a href="<?php the_permalink(); ?>" rel="title" title="<?php the_title_attribute(); ?>">
                 <?php the_title(); ?>
                 </a></h2>
               <?php
               //SUBJECT
               $categories = get_the_category();
               $seperator = ' ';
               $output = '';
               if($categories){
                         foreach($categories as $category) {									
                              if($category->parent == 0 ){
                                   global $taxonomy_images_plugin;									
                                   $output .= '<a style="float:left;margin-right: 30px;bottom: -10px;" class="subject-button" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "All %s posts" ), $category->name ) ) . '">';
                                        $img = $taxonomy_images_plugin->get_image_html( 'tiny-cog', $category->term_taxonomy_id );
                                             if( !empty( $img ) ) {
                                                  $output .= $img;
                                             }
                                   $output .= $category->cat_name."</a>".$seperator;
                              }
                         }
               echo trim($output, $seperator);
               }						
               ?>             
             </div>
             <div class="post-excerpt">
               <div class="search-post-thumnail">
                    <?php the_post_thumbnail('standard-thumb'); ?>
               </div>         
               <?php the_excerpt(); ?>          
             </div>
             <div class="bg"></div>
                 <?php the_time('j M Y'); ?>
             <div class="bg"></div>
           </div>
		</article>
         <?php endwhile; ?>
         <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
    </div>
    <?php else : ?>
    <div class="box post">
      <div class="post-title">
        <h1>Search Results For Keyword: '<span><?php echo $s; ?></span>'</h1>
      </div>
      <div class="content">
        	<p style="padding: 0 0 20px 0;" class="red">We don't have any results matching that search term. Please let us know what you were looking for by completing the form below.</p>        
               <form action='/feedback-thanks' method='post' id='feedback_form' style='width: 100%;' >
                    <fieldset>
                         <div>
                         	<label for='feedback_topic' class='bold'>Topic you're interested in</label><input class='field' type='text' name='feedback_topic' value='<?php echo $_GET['s']; ?>'>
                         </div>
                         <div style='margin-top: 10px; width: 100%;'>
                         	<label for='feedback' class='bold'>Additional information</label><textarea style='width: 320px;height:150px;' class='feedback_field' type='text' name='feedback' id='feedback'></textarea>
                         </div>
                         <div id="counter"></div>
                         <div style='margin-top: 15px;'>
                         	<input class='button' type='submit' name='feedback_submit' id='feedback_submit' value='Send to clevernotes.ie'>
                         </div>
                    </fieldset>
               </form> 
      </div>
    </div>
    <?php endif; ?>
  </div>
  <div class="clearfix"></div>
</div>
<!--/columns -->
<?php get_footer(); ?>
