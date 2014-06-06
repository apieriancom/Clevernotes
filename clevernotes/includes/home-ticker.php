                    <section id="ticker" style="margin-bottom:10px;">
	                    <div class="newsticker-jcarousellite">
	                         <ul id="ticker_items">
                              	<?php
							$args = array(  
								'post_type' => 'updates'
							); 
							$ticker_query = new WP_Query($args); 
							if (have_posts()) :		
								while($ticker_query->have_posts()) : $ticker_query->the_post();	
								?>
                                        <li>
                                        	<div class="spacer">
									<?php
                                                  /* just show text */
                                                  $no_link = $open_link_in_new_window = "";
										
										if (get_field('no_link') != "") {
                                                  	$no_link = implode(', ', get_field('no_link'));
										}
                                                  /* send to alternate link */									
                                                  $alternative_link = get_field('alternative_link');
                                                  /* open in new window */
                                                       $blank = "";
                                                 	if (get_field('open_link_in_new_window') != "") { 
											$open_link_in_new_window = implode(', ', get_field('open_link_in_new_window'));	
									    	}
                                              	if (	$open_link_in_new_window == 'Yes' ) {
                                                       $blank = " target='_blank'";
                                                  }
                                             ?>
                                             <?php
                                             if ($no_link != "Yes") { //link ticker item
                                             ?>
                                                  <?php
                                                  if (	$alternative_link != 'http://' ) { //link ticker item
                                                  ?>                                        
                                                  <a href="<?php echo $alternative_link; ?>" <?php echo $blank; ?>>  
                                                  <?php								
                                                  }
                                                  else {
                                                  ?>
                                                  <a href="<?php the_permalink(); ?>" <?php echo $blank; ?>>       
                                                  <?php								
                                                  }
                                             }
                                             ?>
                                             <?php the_post_thumbnail( array(50,50) ); ?><?php the_title(); ?>  
                                             <?php
                                             if ($no_link != "Yes") {
                                             ?>
                                             </a>    
                                             <?php								
                                             }
                                             ?>
                                        	</div>
                                        </li>
								<?php 
								endwhile ;
							endif ;
							wp_reset_query();
							?>
						</ul>
					<?php

                         ?>     
                         </div>
                    </section>  