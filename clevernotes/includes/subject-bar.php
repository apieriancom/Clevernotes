<?php
/*----------------------------------------------*/
/* Subject Categories / Logged In / Logged Out
/*----------------------------------------------*/
?>
	 <div id="jf-chooseSubject" class="curved-box grey-bg">Choose a Subject:</div>
     <nav id="cogs" class="curved-box grey-bg">
     <?php   
     /******** LOGGED IN ********/
     if (isset($_SESSION['cnt'])) {	
          $args = array(
               'include' => $_SESSION['subject_array']
          );
          $categories = get_categories($args);
          //print_r($categories);
          
          $output = '';
          if($categories){
               foreach($categories as $category) {
				if($category->parent == 0 ){
					$output .= '<a class="subject-cog-medium resize tiptip fade-me" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "%s" ), $category->name ) ) . ' (' .$category->category_count.')">';
						$img = taxonomyImage($category->term_taxonomy_id, 'medium-cog', 'taxonomy');
							if( !empty( $img ) ) {
								$output .= $img;
							}					
					$output .= '</a>';
				}
               }
          echo trim($output);
          }
     
          $args = array(
               'exclude' => $_SESSION['subject_array']
          );
          $categories = get_categories($args);	
          $output = '';
          if($categories){
               foreach($categories as $category) { 
				if($category->parent == 0 ){
					global $taxonomy_images_plugin;
					$output .= '<a class="subject-cog-medium resize tiptip subject-not-selected" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "%s" ), $category->name ) ) . ' (' .$category->category_count.')<br><span class=\'light_grey small\'>not selected</span>">';
						$img = taxonomyImage($category->term_taxonomy_id, 'medium-cog', 'taxonomy');
							if( !empty( $img ) ) {
								$output .= $img;
							}					
					$output .= '</a>';
				}
               }
          echo trim($output);
          }	
          
     }
     /********* LOGGED OUT ********/
     else {
          $categories = get_categories();
          $output = '';
          if($categories){
               foreach($categories as $category) {
				if($category->parent == 0 ){
					$output .= '<a class="subject-cog-medium resize tiptip fade-me logged-out" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "%s" ), $category->name ) ) . ' (' .$category->category_count.')">';
						$img = taxonomyImage($category->term_taxonomy_id, 'medium-cog', 'taxonomy');
							if( !empty( $img ) ) {
								$output .= $img;
							}					
					$output .= '</a>';
				}
               }
          echo trim($output);
          }
     }
     ?>             
     </nav>