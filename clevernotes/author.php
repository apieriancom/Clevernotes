<?php get_header(); ?>
<div id="layout">
	<div id="main_container">
     <!-- This sets the $curauth variable -->
         <?php
         $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
         ?>
         <article>
              <h1>About: <?php echo $curauth->nickname; ?></h1>
              <dl>
                  <dt><h2>Profile</h2></dt>
                  <!--
                  <dd>
                  <?php // echo "<a href='mailto:".antispambot($curauth->user_email)."'>".$curauth->user_email."</a><br>"; ?>
                  </dd>
                  
                  <dd>
                  <a href="<?php// echo $curauth->user_url; ?>" target='_blank'><?php //echo $curauth->user_url; ?></a>
                  </dd>   
                  -->               
                  <dd>
			   	<div class="curved-img align-right"><?php userphoto($curauth ); ?></div>
				<?php echo $curauth->user_description; ?>
                   </dd>
              </dl>
              <h3>Posts by <?php echo $curauth->nickname; ?>:</h3>
              <ul>
              <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                  <li>
                      <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                      <?php the_title(); ?></a>,
                       in <?php the_category(' & ');?>
                  </li>
              <?php endwhile; else: ?>
                  <p><?php _e('No posts by this author.'); ?></p>
              <?php endif; ?>
              </ul>
         </article>
     </div>
</div>
<?php get_footer(); ?>