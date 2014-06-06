<?php
/**
 *Template Name: Authors
*/
?>
<?php get_header(); ?>
<style type="text/css">
.author_holder .button {
	bottom: 10px;
	font-size: 13px;
	left: 20%;
	padding: 3px 5px;	
	position: absolute;
}
.author_holder {
	border: 5px solid #EFEFEF;
	display: block;
	float: left;
	height: 150px;
	margin: 0 20px 20px 0;
	padding: 5px;
	width: 100px;	
	-webkit-border-radius: 5px;
	   -moz-border-radius: 5px;
		   border-radius: 5px;
	position: relative;
	text-align: center;
	behavior: url(/wp-content/themes/clevernotes/PIE.php);	
}
	.author_holder a {
		font-weight: 700;	
		font-size: 12px;
	}
#authors {
	padding: 15px;
}
#authors .button {
	margin-top: 10px;
}
	#authors img {
		margin-bottom: 15px;
	}
.author_profile {
	margin: 10px;
}
.author_profile {
	display: none;	
}
</style>
<script type="text/javascript">
(function($) {	
	$(document).ready(function() {		
		$('.popup').click(function() {		
			//move author details to container div
			var info = $(this).parent('p').parent('div').parent('div').children('.author_profile').html();
			//var info = "this is a test";
			$('#authors').html(info);
			//show pop up	
			$.blockUI({
				message: $('#authors'),
				css: {
					padding:        0,
					margin:         0,
					textAlign:      'center',
					color:          '#000',
					border:         '5px solid #EFEFEF', 			
					backgroundColor:'#FFF',
					cursor:         'default',
					top:            '-20px'
				},
			    overlayCSS:  { 
				   backgroundColor: '#FFF', 
				   opacity:         0.8, 
				   cursor:          'pointer' 
			    }
			});
			$('.blockUI.blockMsg').center();
			$('.blockOverlay').attr('title','Click to close').click($.unblockUI);
	    });
	});
})( jQuery );
</script>
<?php 
function list_all_authors() {
    global $wpdb, $edit_flow;
   	// First get all users with at least one post
	$min_posts = 2; 
	$author_ids = $wpdb->get_col(
	"SELECT post_author FROM
		(SELECT post_author, COUNT(*) AS count FROM {$wpdb->posts} WHERE post_status='publish' AND post_type='post' GROUP BY post_author) 
		AS stats
		WHERE count >= {$min_posts} ORDER BY count DESC;
	");
    // Now get users and filter
    $authors = $wpdb->get_results("SELECT * from $wpdb->users ORDER BY display_name");
	// Grab details of 'Do Not Display' user group
	$jf_doNotDisplay = $edit_flow->user_groups->get_usergroup_by('name', 'Do Not Display');
    foreach ($authors as $author ) {
		$aid = $author->ID; $jf_displayFlag = 1;
		// Test if current author is in 'Do Not Display' user group
		foreach ($jf_doNotDisplay->user_ids as $jf_noDisplay) {
			if ($aid == $jf_noDisplay) { $jf_displayFlag = 0; }
		}
		if ($jf_displayFlag == 1) {
			$curauth = get_userdata(intval($aid));
	    	if ((in_array($aid,$author_ids)) && ($aid != 1)) {
	    	?>
			<div class="author_holder">
				<div class="author_info">
					<p class="author_photo"><a class="popup" title="<?php the_author_meta('display_name',$aid); ?>" href="javascript:void(0)"><?php userphoto_thumbnail($aid ); ?></a></p>
					<p><a class="popup" href="javascript:void(0)"><?php the_author_meta('display_name',$aid); ?></a></p>
				</div>
				<div class="author_profile">
					<?php userphoto($aid); ?>
					<div style="text-align:left;"><?php the_author_meta('description',$aid); ?></div>
					<div><a href="/author/<?php the_author_meta('user_nicename',$aid); ?>">View All Posts by <?php the_author_meta('display_name',$aid); ?></a></div>
					<input type="button" class="button" value="close" onclick="jQuery.unblockUI(); jQuery('#blockUI_buttons').children().unbind(); jQuery('#blockUI_div').children().unbind()" />
				</div>
			</div>
			<?php 
			}
		}
	}
}
?> 
<div id="authors" style="display:none;"> 
</div> 
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
                              <div class="clearfix"></div>
						<?php list_all_authors(); ?>   	
                         </section>
                    </div>
	  	</div>
	  	<?php endwhile; endif; ?>		    			 
	</div>	
</div>
<?php get_footer(); ?>