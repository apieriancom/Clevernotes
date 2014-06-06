<?php
/**
 *Template Name: Competition
*/
?>
<?php get_header(); ?>
<?php
$cnt=$_SESSION['cnt'];
?>
<div id="layout">
	<div id="main_container">	
		<div id="container_left">
	  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <div class="box post full" id="post-<?php the_ID(); ?>">
               <div class="post-block">
                    <div class="post-title">
                         <h1><?php the_title(); ?></h1>                              
                    </div>
                    <section class="body_content">
					<?php the_content(); ?>	
                         <?php
					if (isset($_SESSION['cnt'])) {  					
					?>
                         <form action="/competition-thanks/" method="post" id="competition_form">
                         	<fieldset>
                                    <div style="margin-top: 15px;">
                                   <label for="competition_name" class="bold">Name</label>
                                   <input class="competition_field" type="text" name="competition_name" value="<?php echo $cnt->FirstName . " ". $cnt->LastName; ?>">
                                   </div>
                                   <div style="margin-top: 10px;">
                                   <label for="competition_email" class="bold">Email</label>
                                   <input class="competition_field" type="text" name="competition_email" value="<?php echo $cnt->Email; ?>">
                                   </div>
                                   <div style="margin-top: 15px;">  
                                        <input class="button" type="submit" name="competition_submit" id="submit" value="Submit">
                         		</div>
                         </form>                         
                         <?php
					} else {
					?>
                         <h2>You must be registered to enter this competition. Please sign in below.</h2>
                         <section id="facebook_login">
                              <div class="title">Create Your FREE Account</div>
                              <div id="social_login_container"></div>
                              <script type="text/javascript">
                                   oneall.api.plugins.social_login.build("social_login_container", {
                                   'providers' :  ['facebook'], 
                                   'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
                                   'grid_size_x': '1',
                                   'grid_size_y': '1',
                                   'callback_uri': '<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/sfdc/oa-login.php'
                                   });
                              </script>         
                         </section>                         
                         <?php
					}
					?>                         
                    </section>
               </div>
	  	</div>	  
	  	<?php endwhile; endif; ?>	  			 
	</div>	
</div>
<?php get_footer(); ?>