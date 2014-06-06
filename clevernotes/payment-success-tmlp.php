<?php
/**
 *Template Name: Payment Success
*/

?>
<?php get_header(); ?>
	<div id="main_container">	
		<div id="container_left">
	  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <div class="box post full" id="post-<?php the_ID(); ?>">
               <div class="post-block">
                    <div class="post-title">
                         <h1><?php the_title(); ?></h1>
                         <div class="clearfix"></div>         
                    </div>
                    <section class="body_content">        
                         <?php 
                         if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                              echo "<span class='feature'>";
                              the_post_thumbnail('featured-image');
                              echo "</span>";
                         }
                         ?>	     
                         <?php the_content(); ?>	
                         <?php wp_link_pages('before=<p><strong>Pages:</strong> &after=</p>&next_or_number=number'); ?> 		
                    </section>
               </div>
	  	</div>
	  	<?php endwhile; endif; ?>		    			 
	</div>
</div>
<?php 
if (!isset($_SESSION['paying_member'])) {
?>
<!-- Google Code for New paying member Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 993364078;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "sfc3COq5kgQQ7pDW2QM";
var google_conversion_value = 50;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/993364078/?value=50&amp;label=sfc3COq5kgQQ7pDW2QM&amp;guid=ON&amp;script=0"/>
</div>
<?php
$_SESSION['paying_member'] = 1;
}
?>
</noscript>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-34212391-1");
pageTracker._trackPageview();
pageTracker._addTrans(
"<?php echo $_GET['tx_token']; ?>", // Order ID
"", // Affiliation
"<?php echo $_GET['mc_gross_1']; ?>", // Total
"0.00", // Tax
"0.0", // Shipping
"", // City
"", // State
"" // Country
);
pageTracker._addItem(
"<?php echo $_GET['tx_token']; ?>", // Order ID
"<?php echo $_GET['item_number1']; ?>", // SKU
"<?php echo $_GET['item_name1']; cle?>", // Product Name  
"<?php echo $_GET['item_name1']; ?>", // Category
"<?php echo $_GET['mc_gross_1']; ?>", // Price
"1" // Quantity
);
pageTracker._trackTrans();
} catch(err) {}
</script>
<?php get_footer(); ?>
