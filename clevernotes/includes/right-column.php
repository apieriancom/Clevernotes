               <?php
               if (isset($_SESSION['cnt'])) : //SalesForce ID
               ?>              
              <div id="search_holder">
                    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
                      <fieldset id="search">
                        <div><input type="text" value="Search..." onClick="this.value='';" name="s" id="s" class="keywords" /></div>
                        <div id="search_mag"><input name="searchsubmit" type="image" src="<?php bloginfo('template_directory'); ?>/images/buttons/search_button.jpg"  title="Search our site" id="searchsubmit" class="fade_me" /></div>
                      </fieldset>
                    </form>
               </div>  
               <?php
               endif;	
               ?>  
               <div class="clearfix"></div>  
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
                                                  $no_link = "";
                                                  $no_link = implode(', ', get_field('no_link'));
                                                  /* send to alternate link */									
                                                  $alternative_link = get_field('alternative_link');
                                                  /* open in new window */
                                                       $blank = "";
                                                  $open_link_in_new_window = implode(', ', get_field('open_link_in_new_window'));	
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
          	<div id="facebook">
                    <div class="fb-like-box" data-href="http://www.facebook.com/CleverNotesIE" data-width="307" data-show-faces="false" data-stream="true" data-header="true"></div>     
               </div>
          	<div id="twitter">
				<div class='title'><span style="color:#4099FF;font-weight:700;margin-right: 10px;font-size: 19px;"><a href='http://twitter.com/CleverNotesIE'><img src="<?php bloginfo('template_directory'); ?>/images/logos/twitter.png" width="148" height="27" alt="Twitter"></a></span><span class='more'><a href='http://twitter.com/CleverNotesIE'>follow us</a></span></div>
				<ul id="twitter_update_list" class="tul" style="padding:0;margin:0;"></ul>
			</div>