<?php
/**
 *Template Name: Subscribe
*/

?>
<?php get_header(); ?>

<div id="main_container">
    <div id="container_left">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="box post full" id="post-<?php the_ID(); ?>">
            <div class="post-block">
                <div class="post-title">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                    <div class="clearfix"></div>
                </div>
                <section class="body_content">
                    <?php the_content(); ?>
                    <?php						
							$jf_featureListFreeTitle = get_field('list_title_free');
							$jf_featureListFreePrice = get_field('price_free');
							$jf_featureListFreePriceNote = get_field('price_note_free');
							$jf_featureListFree = get_field('feature_list_free');						
							
							$jf_featureListPaidTitle = get_field('list_title_paid');
							$jf_featureListPaidPrice = get_field('price_paid');
							$jf_featureListPaidPriceNote = get_field('price_note_paid');
							$jf_useFeaturedImage = get_field('featured_image_paid');
							$jf_featureListPaid = get_field('feature_list_paid');
						?>
                    <div id="jf-featureLists">
                        <div id="jf-featureFree" class="jf-featureBox">
                            <div class="jf-priceBoxWrapper">
                                <h3>
                                    <?php if ($jf_featureListFreeTitle && $jf_featureListFreeTitle !='') { echo $jf_featureListFreeTitle; } else { echo 'Free'; } ?>
                                </h3>
                                <div class="jf-price">&euro;
                                    <?php if ($jf_featureListFreePrice && $jf_featureListFreePrice !='') { echo $jf_featureListFreePrice; } else { echo '0'; } ?>
                                </div>
                                <div class="jf-priceNote">
                                    <?php if ($jf_featureListFreePriceNote && $jf_featureListFreePriceNote !='') { echo $jf_featureListFreePriceNote; } else { echo '&nbsp;'; } ?>
                                </div>
                            </div>
                            <div class="jf-buttonBoxWrapper">
                                <div class="jf-subscribeButton">
                                    <?php if (loggedIn()) {
											$cnt=$_SESSION['cnt']; // Set the contact array from the Session ?>






                                   <div id="subscribe_button" style="margin-left:0 !important;">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SD9TJX99LXAGL">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>









                                    &nbsp;
                                    <?php } else { ?>
                                    <div id="social_login"></div>
                                    <script type="text/javascript">
												oneall.api.plugins.social_login.build("social_login", {
												'providers' :  ['facebook', 'google'], 
												'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
												'grid_size_x': '2',
												'grid_size_y': '1',
												'callback_uri': '<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/sfdc/oa-login.php'
												});
											</script>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="jf-featuresBoxWrapper">
                                <div class="jf-features">
                                    <?php if ($jf_featureListFree && $jf_featureListFree !='') { echo $jf_featureListFree; } ?>
                                </div>
                            </div>
                        </div>
                        <div id="jf-featurePaid" class="jf-featureBox">
                            <div class="jf-priceBoxWrapper">
                                <h3>
                                    <?php if ($jf_featureListPaidTitle && $jf_featureListPaidTitle !='') { echo $jf_featureListPaidTitle; } else { echo 'Paid'; } ?>
                                </h3>
                                <?php
										if (has_post_thumbnail() && $jf_useFeaturedImage && $jf_useFeaturedImage != '') {
											echo '<div id="jf-image">';
											the_post_thumbnail('featured-image');
											echo '</div>';
										}
									?>
                                <div class="jf-price">&euro;
                                    <?php if ($jf_featureListPaidPrice && $jf_featureListPaidPrice !='') { echo $jf_featureListPaidPrice; } else { echo '-'; } ?>
                                </div>
                                <div class="jf-priceNote">
                                    <?php if ($jf_featureListPaidPriceNote && $jf_featureListPaidPriceNote !='') { echo $jf_featureListPaidPriceNote; } else { echo '&nbsp;'; } ?>
                                </div>
                            </div>
                            <div class="jf-buttonBoxWrapper">
                                <div class="jf-subscribeButton">
                                    <?php if (loggedIn()) { ?>
                                    <div id="subscribe_button">
                                        <form action="/sfdc/paypalpost.php" method="post">
                                            <label for="vcode">Voucher Code:</label>                                            
                                            <input type="text" name="vcode"> 
                                            <?php 
												if($_GET['errMsg']!='') echo '<p class="error">'.$_GET['errMsg'].'</p>'; 
											?>
                                            <br />
                                            <input type="image" value="submit" src="https://www.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
                                            <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                                        </form>
                                    </div>
                                    <?php } else { ?>
                                    <p id="">You will need to connect to the site<br/>
										<span id="jf-buttonLoc">using one of the buttons on the left<br /></span>
                                        prior to becoming a member.</p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="jf-featuresBoxWrapper">
                                <div class="jf-features">
                                    <?php if ($jf_featureListPaid && $jf_featureListPaid !='') { echo $jf_featureListPaid; } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php
							$jf_displayBoxes = get_field('display_boxes');
							if ($jf_displayBoxes && $jf_displayBoxes != '') {
								$jf_boxesHeading = get_field('heading_for_boxes');
								$jf_box1Title = get_field('title_box_1');
								$jf_box1Content = get_field('content_box_1');
								$jf_box2Title = get_field('title_box_2');
								$jf_box2Content = get_field('content_box_2');						
								$jf_box3Title = get_field('title_box_3');
								$jf_box3Content = get_field('content_box_3');
								$jf_box4Title = get_field('title_box_4');
								$jf_box4Content = get_field('content_box_4');
						?>
                    <div id="jf-boxes">
                        <?php if ($jf_boxesHeading && $jf_boxesHeading !='') { echo '<h2>'.$jf_boxesHeading.'</h2>'; } ?>
                        <div class="jf-box" id="jf-box1">
                            <?php if ($jf_box1Title && $jf_box1Title !='') { echo '<h3>'.$jf_box1Title.'</h3>'; } else { echo '&nbsp;'; } ?>
                            <?php if ($jf_box1Content && $jf_box1Content !='') { echo '<div class="jf-boxContent">'.$jf_box1Content.'</div>'; } else { echo '<div class="jf-boxContent">&nbsp;</div>'; } ?>
                        </div>
                        <div class="jf-box" id="jf-box2">
                            <?php if ($jf_box2Title && $jf_box2Title !='') { echo '<h3>'.$jf_box2Title.'</h3>'; } else { echo '&nbsp;'; } ?>
                            <?php if ($jf_box2Content && $jf_box2Content !='') { echo '<div class="jf-boxContent">'.$jf_box2Content.'</div>'; } else { echo '<div class="jf-boxContent">&nbsp;</div>'; } ?>
                        </div>
                        <div class="jf-box" id="jf-box3">
                            <?php if ($jf_box3Title && $jf_box3Title !='') { echo '<h3>'.$jf_box3Title.'</h3>'; } else { echo '&nbsp;'; } ?>
                            <?php if ($jf_box3Content && $jf_box3Content !='') { echo '<div class="jf-boxContent">'.$jf_box3Content.'</div>'; } else { echo '<div class="jf-boxContent">&nbsp;</div>'; } ?>
                        </div>
                        <div class="jf-box" id="jf-box4">
                            <?php if ($jf_box4Title && $jf_box4Title !='') { echo '<h3>'.$jf_box4Title.'</h3>'; } else { echo '&nbsp;'; } ?>
                            <?php if ($jf_box4Content && $jf_box4Content !='') { echo '<div class="jf-boxContent">'.$jf_box4Content.'</div>'; } else { echo '<div class="jf-boxContent">&nbsp;</div>'; } ?>
                        </div>
                        <br class="jf-clear" />
                    </div>
                    <?php } // Grab the Testimonials
							$jf_testimonialArgs = array(
								'numberposts' => -1,
								'orderby'     => 'menu_order',
								'order'       => 'ASC',
								'post_type'   => 'testimonial'
							);
							$jf_testimonials = get_posts($jf_testimonialArgs);
							if ($jf_testimonials) {
						?>
                    <div id="jf-testimonials">
                        <h2>Media &amp; Members</h2>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <?php foreach ($jf_testimonials as $jf_theTestimonial) { ?>
                                <tr>
                                    <td class="jf-testimonialContent"><?php echo apply_filters('the_content', $jf_theTestimonial->post_content); ?></td>
                                    <td class="jf-testimonialSource"><?php if (has_post_thumbnail($jf_theTestimonial->ID)) {
												echo get_the_post_thumbnail($jf_theTestimonial->ID, 'featured-image');
											} else {
												echo '<p>'.$jf_theTestimonial->post_title.'</p>';
											} ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } // Grab the FAQs
							$jf_faqArgs = array(
								'numberposts' => -1,
								'orderby'     => 'menu_order',
								'order'       => 'ASC',
								'post_type'   => 'faq'
							);
							$jf_faq = get_posts($jf_faqArgs);
							if ($jf_faq) {
						?>
                    <div id="jf-faq">
                        <h2>Frequently Asked Questions</h2>
                        <ol>
                            <?php foreach ($jf_faq as $jf_theFaq) { ?>
                            <li>
                                <h4><?php echo $jf_theFaq->post_title; ?></h4>
                                <div class="jf-faqContent"><?php echo apply_filters('the_content', $jf_theFaq->post_content); ?></div>
                            </li>
                            <?php } ?>
                        </ol>
                    </div>
                    <?php } ?>
                </section>
            </div>
        </div>
        <?php endwhile; endif; ?>
    </div>
</div>
<?php get_footer(); ?>