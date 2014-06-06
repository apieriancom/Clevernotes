<?php
/**
 *Template Name: User Profile
*/
?>
<?php get_header(); ?>

<?php
//ini_set('display_errors',1); 
//error_reporting(E_ALL);

$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
date_default_timezone_set('Europe/Dublin');

if ((isset($cnt->bNewUser)) && ($cnt->bNewUser == true_)) {
?>
<!-- Google Code for New Sign-up Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 993364078;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "WECBCPq3kgQQ7pDW2QM";
var google_conversion_value = 1;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/993364078/?value=1&amp;label=WECBCPq3kgQQ7pDW2QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php
}

//print_r($_SESSION['cnt']);
//echo "<br><br><br>";
//print_r ( $_SESSION['subject_array'] );
//echo serialize($_SESSION['subject_array'])."<br>";
//echo serialize(getSubjectsAndLevels());
//echo "<br><br><br>";
//print_r ( getSubjectsAndLevels() );
//echo "<br><br><br>";
//print_r ( $_SESSION['subjects'] );

//print_r(getSubjectsAndLevels());

//echo "<br><br><br>";
//print_r(getSubjects());
/*
print apply_filters( 'taxonomy-images-queried-term-image', 'accounting' );

$terms = apply_filters( 'taxonomy-images-get-terms', '' );
if ( ! empty( $terms ) ) {
    print '<ul>';
    foreach( (array) $terms as $term ) {
	   // print_r( $term);
	    
        print '<li>' . wp_get_attachment_image( $term->image_id, 'small-cog' ) . $term->term_id.'</li>';
    }
    print '</ul>';
}
*/

function buildSubjects($status){
  
  $subjects = $_SESSION['subjects'];
  $row = 1; // Row counter

  $sT1 ='<table class="subject_table">';
	foreach($subjects as $key_val => $subject) {
		global $taxonomy_images_plugin;
		if($subject->Status__c==$status){
			$rowColor = "";
			if ($row % 2 != 0) {
				  $rowColor = " class='row_background'";
			} 
				
			$sT1.= '<tr>';
			$sT1.= '<td id="subject_row" '.$rowColor.'>';
			/* GET COG ADDED BY ALAN */		
			$sT1.= taxonomyImage($subject->WordPress_ID__c, 'small-cog', 'term');
			//$sT1.= $taxonomy_images_plugin->get_image_html( 'small-cog', $subject->WordPress_ID__c );   //associate cog with subject
			//$sT1.=  $subject->Name. " - $subject->WordPress_ID__c";
			$sT1.=  $subject->Name;			
			$sT1.= '</td>';
			$sT1.= '<td '.$rowColor.'>';
			  //(isset($result->result->ContactSubjects) ? $result->result->ContactSubjects : null); // Set the ContactSubjects session variable to store the chosen subjects
			$conSubjects = (isset($subject->Contact_Subjects__r->records) ? $subject->Contact_Subjects__r->records : null);
			$certId = (isset($subject->SubjectCerts__r->records) ? $subject->SubjectCerts__r->records->Certificate__c : null);
			$subjects = (isset($subject->SubjectLevels__r->records) ? $subject->SubjectLevels__r->records : null);
			//$sT1.= printRadio($subjects, $subject->Id, 'Higher Level', $conSubjects, $certId);  
			//$sT1.= '</td>';
			$sT1.= '<td '.$rowColor.'>';
			$sT1.= printSelect($subjects, $subject->Id, $conSubjects, $certId);  
			$sT1.= '</td>';
			//$sT1.= '<td '.$rowColor.'>';
			//$sT1.= printRadio($subjects, $subject->Id, 'Higher & Ordinary Level', $conSubjects, $certId); 
			//$sT1.= printRadio($subjects, $subject->Id, 'Higher & Ordinary Level', $conSubjects, $certId); 
			//$sT1.= '</td>';
			//$sT1.= '<td '.$rowColor.'>';
			//$sT1.= '<input type="radio" name="'.$subject->Id.'" value="" />';
			//$sT1.= '</td>';
			$sT1.= '</tr>';
			$row++; // Increment row 
		  }
	}
	$sT1.= '</table>';
	print $sT1;
}

function printRadio($levels, $subjectId, $s, $conSubject, $certId){
  $rb='';
  foreach($levels as $key_val => $level) {
    if($level->Level__r->Name==$s){
      $rb.= '<input type="radio" value="'.$level->Level__r->Id.';'.$subjectId.';'.$certId.'" name="'.$subjectId.'"' ;
      if($conSubject!=null){
        if($subjectId==$conSubject->Subject__c&&$level->Level__r->Id==$conSubject->Subject_Level__c)$rb.=  ' checked="true 1"';
      }
      $rb.= ' />';
    }
  }
  return $rb;
}

function printSelect($levels, $subjectId, $conSubject, $certId){
  $rb='<select name="'.$subjectId.'" >' ;
  
  $rb.='<option vlaue="">Not Selected</option>';
  foreach($levels as $key_val => $level) {
    //if($level->Level__r->Name==$s){
      $rb.= '<option value="'.$level->Level__r->Id.';'.$subjectId.';'.$certId.'" ' ;
      if($conSubject!=null){
        if($subjectId==$conSubject->Subject__c&&$level->Level__r->Id==$conSubject->Subject_Level__c)$rb.= ' selected';
		//else if($level->Level__r->Name=='Higher & Ordinary Level')$rb.=  ' selected';
      }
      $rb.= ' >'.$level->Level__r->Name.'</option>';
    //}
  }
  
  $rb.= '</select>';
  return $rb;
}
?>
  <div id="main_container" class="profile-page">
    <div id="container_left">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="box post full" id="post-<?php the_ID(); ?>">
      <div class="post-block">
     <div class="post-title">
      <h1><?php the_title(); ?></h1>
          <div class="clearfix"></div>         
    </div>
    <section class="body_content">           
      <div class="top">
               <?php
      // Check to see if the user has tried to update their profile
      if(isset($_SESSION['profileupdate'])){
		//ADDED BY ALAN
		$_SESSION['user_posts'] = userPosts(); //function to grab all posts applicable to a user depending on their saved options. This is used to filter for subject level, adn maybe other things in the future.		 
        	
		if($_SESSION['profileupdate']=='yes')print '<h2 style="color:green">Profile Updated</h2>';
        	if($_SESSION['profileupdate']=='no')print '<h2 style="color:red">Error updating profile</h2>';
        	$_SESSION['profileupdate']='';
      }   
      ?>   
               <div class="clearfix"></div>              
      		<?php
                if (loggedIn()) {
				the_content();
	           if (!isSubscribed()) {
//	                 $cnt = $_SESSION['cnt'];
//	                 $end_date = date("jS M Y", strtotime($cnt->Subscription_End_Date__c));
	                      //$end_date = date("jS M Y");
	            ?>
	            <p class="alignright">&nbsp;&nbsp; Redeem your code:<br />
	            <input type='image' id='lshideshow' value='hide/show' src="<?php echo get_stylesheet_directory_uri(); ?>/images/lslogo160.png" style="width:auto; height: auto; border: none; background-color: #fff; float:right;">
	            <input type='image' id='pbhideshow' value='hide/show' src="<?php echo get_stylesheet_directory_uri(); ?>/images/pblogo160.png" style="width:auto; height: auto; border: none; background-color: #fff; float:right;">
	            <div class="clearfix"></div>
	            <div id='lscontent'  style="display: none"><?php gravity_form(1, false, true, false, '', true); ?></div>
	            <div id='pbcontent'  style="display: none"><?php gravity_form(3, false, true, false, '', true); ?></div>
	            <div class="clearfix"></div>
	            </p>
	            <?php
	            }

			 }
			?>
               </div>
               <?php if (loggedIn()) { ?>
               <script>
				jQuery(function() {
					 jQuery('.Birthdate').datepicker({ dateFormat: 'dd-mm-yy' }).val();
				});
			</script>
               <form action="/wp-content/themes/clevernotes/profile-page-save.php" method="post" enctype="application/x-www-form-urlencoded" name="save_profile" id="save_profile">
                    <fieldset>
                         <div id="profile_wrapper" class="curved-box">
                         	<div id="profile_header">
                              	<div id="profile_header_padding">
                                        <div class="left">
                                             <?php if (($cnt->Social_Image__c != "") && ($cnt->Social_Image__c != trim('<img src=" " alt="Contact Image" border="0"/>'))) { ?>
                                                  <div id="profile_image"><?php echo $cnt->Social_Image__c; ?></div>
                                             <?php } ?>
                                             <div class="profile_name">
										<?php echo $cnt->FirstName; ?>'s Profile										
                                             </div>
                                        </div>
                                        <div class="right">
                                             <div class="save-button"><input type="submit" name="submit" value="Save Profile"></div>      
                                             <div class="subjects_count">
                                                  <div class="text">Selected subjects</div>
                                                  <div class="number">
                                                       <?php 
                                                       $remove_me = array(2101,58,59); //59 = Learning  / 58 = Study Centre / 2101 = Competition
                                                       $my_subjects = array_diff(getSubjects(), $remove_me);
                                                       echo count ($my_subjects);
                                                       ?>
                                                   </div>
                                             </div>                             
                                        </div>
                                        <div class="clearfix"></div> 
                                   </div>
                              </div>
                                   <div id="profile_body">   
								<div id="profile_body_padding">                                      	                                  
                                             <div class="one_half">
                                                  <table class="profile_table">
                                                    <tbody>
                                                        <tr>
                                                              <td colspan="2" class="table-title">My Details</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">First name *</td>
                                                                 <td><input name="FirstName" type="text" value="<?php if(isset($cnt->FirstName ))echo $cnt->FirstName ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">Last name *</td>
                                                                 <td><input name="LastName" type="text" value="<?php if(isset($cnt->LastName ))echo $cnt->LastName ?>"></td>
                                                            </tr>                         
                                                            <tr>
                                                                 <td class="text">Email *</td>
                                                                 <td>
                                                                 <input name="Email" type="text" value="<?php if(isset($cnt->Email ))echo $cnt->Email ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">Mobile</td>
                                                                 <td>
                                                                 <input name="MobilePhone" type="text" value="<?php if(isset($cnt->MobilePhone ))echo $cnt->MobilePhone ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">Date of Birth</td>
                                                                 <td>
                                                                 <input class="Birthdate" name="Birthdate" type="text" value="<?php if(isset($cnt->Birthdate ))echo date("d-m-Y", strtotime($cnt->Birthdate) )?>"></td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">Address</td>
                                                                 <td>
                                                                 <input name="MailingStreet" type="text" value="<?php if(isset($cnt->MailingStreet ))echo $cnt->MailingStreet ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">City/Town</td>
                                                                 <td>
                                                                 <input name="MailingCity" type="text" value="<?php if(isset($cnt->MailingCity ))echo $cnt->MailingCity ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">County</td>
                                                                 <td>
                                                                 <input name="MailingState" type="text" value="<?php if(isset($cnt->MailingState ))echo $cnt->MailingState ?>"></td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="text">Country</td>
                                                                 <td>
                                                                 <input name="MailingCountry" type="text" value="<?php if(isset($cnt->MailingCountry ))echo $cnt->MailingCountry ?>"></td>
                                                            </tr> 
                                                            <tr>
                                                                 <td class="text">Type<br><span class="normal">(please select all that apply)</span></td>
                                                                 <td>
                                                                    <div class="type_choices"><label><span>Student</span> <input name="Student__c" type="checkbox" <?php if($cnt->Student__c==1)echo 'checked'?>></label></div>
                                                                    <div class="type_choices"><label><span>Parent</span> <input name="Parent__c" type="checkbox" <?php if($cnt->Parent__c==1)echo 'checked'?>></label></div>
                                                                    <div class="type_choices"><label><span>Teacher</span> <input name="Teacher__c" type="checkbox" <?php if($cnt->Teacher__c==1)echo 'checked'?>></label></div>
                                                                    <div class="type_choices"><label><span>Other</span> <input name="Other__c" type="checkbox" <?php if($cnt->Other__c==1)echo 'checked'?>></label></div>
                                                                 
                                                                 </td>
                                                            </tr> 
                                                            <tr>
                                                                 <td class="text">Subscribe to receive updates?</td>
                                                                 <td>
                                                                 <input name="Email_Opt_In__c" type="checkbox" <?php if($cnt->Email_Opt_In__c==1)echo 'checked'?>>
                                                                 </td>
                                                            </tr> 
                                                    </tbody>                        
                                                  </table>
                                             </div>
                                             <div class="one_half last">
                                                  <div id="subscription_type">
                                                       <div id="my_membership" class="table-title">My Membership</div>
                                                       <div id="member-status">                                                            
                                                            <?php
                                                            if (isSubscribed()) {
                                                                 $cnt = $_SESSION['cnt'];
                                                                 $end_date = date("jS M Y", strtotime($cnt->Subscription_End_Date__c));
                                                                      //$end_date = date("jS M Y");
                                                            ?>
                                                                 <span class="member">Member</span>Subscribed until <span class="subscription_end_date"><?php echo $end_date ?></span>     	
                                                            <?php
                                                            } else {
                                                            ?>    
                                                                 <span class="guest">Guest</span>
                                                            <?php
                                                            }
                                                            ?>                                                   
                                                       </div>
                                                  </div>                                             
                                                   <table class="profile_table">
                                                         <tbody>
                                                             <tr>
                                                                   <td class="table-title" colspan="5">My Subjects</td>
                                                                 </tr>
                                                             <tr>
                                                                 <td>
                                                                 <?php buildSubjects('Active'); ?>
                                                                 </td>
                                                            </tr>
                                                            </tbody>                    
                                                       </table>
                                                  </div>
                                                   <div class="one_half last">
                                                   <table class="profile_table">
                                                         <tbody>
                                                             <tr>
                                                                   <td class="table-title" colspan="5">Subjects I Would Like to See</td>
                                                                 </tr>
                                                             <tr>
                                                                 <td>
                                                                 <?php buildSubjects('Proposed'); ?>
                                                                 </td>
                                                            </tr>
                                                            </tbody>                    
                                                       </table>
                                                  </div>
                                             <div class="clearfix"></div>  
                                        </div>
                                   </div>
                              </div>
                    </fieldset>
               </form>
               <div class="clearfix"></div>  
               </div>
               <?php } else { ?>
               <h2>
                <p style='margin-top: 15px;'>Please login to get the full benefits of Clevernotes.ie. <br>               
                 <a href="/">Just visit the home page and log in with Facebook or Google+.</a>
                    </p>
               </h2>
               <?php } ?>
    </section>
    </div>
    </div>
    <?php endwhile; endif; ?>              
  </div>
</div>
<?php get_footer(); ?>