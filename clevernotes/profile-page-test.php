<?php
/**
 *Template Name: User Profile
*/

ini_set('display_errors',1); 
error_reporting(E_ALL);

if(session_id() == "") { //Session is started in header.php of 
	session_start();
}


//ini_set('display_errors',1); 
//error_reporting(E_ALL);

$cnt=$_SESSION['cnt']; // Set the contact array from the Session 

/*
//print_r($_SESSION);
print "<h2>Session Details</h2><pre>";
print_r ($_SESSION['ContactSubjects']);
print "</pre>";
*/

function buildSubjects(){
	$subjects = $_SESSION['subjects'];
	$row = 1; // Row counter
	
	print '<table class="subject_table">';
	print '<tr>';
	print '<th>Subject</th>';
	print '<th>Higher</th>';
	print '<th>Ordinary</th>';
	print '<th>Foundation</th>';
	print '<th><div class="remove_subject tiptip" title="Remove Subject">x</div></th>';
	
	
	print '<tr>';
	foreach($subjects as $key_val => $subject) {
		$rowColor = "";
		if ($row % 2 != 0) {
    			$rowColor = " class='row_background'";
		}
    		
		print '<tr>';
		print '<td '.$rowColor.'>';
		print  $subject->Name;
		print '</td>';
		print '<td '.$rowColor.'>';
		//(isset($result->result->ContactSubjects) ? $result->result->ContactSubjects : null); // Set the ContactSubjects session variable to store the chosen subjects
		$conSubjects = (isset($subject->Contact_Subjects__r->records) ? $subject->Contact_Subjects__r->records : null);
		$certId = (isset($subject->SubjectCerts__r->records) ? $subject->SubjectCerts__r->records->Certificate__c : null);
		$subjects = (isset($subject->SubjectLevels__r->records) ? $subject->SubjectLevels__r->records : null);
		printRadio($subjects, $subject->Id, 'Higher Level', $conSubjects, $certId);	
		print '</td>';
		print '<td '.$rowColor.'>';
		printRadio($subjects, $subject->Id, 'Ordinary Level', $conSubjects, $certId);	
		print '</td>';
		print '<td '.$rowColor.'>';
		printRadio($subjects, $subject->Id, 'Foundation', $conSubjects, $certId);	
		print '</td>';
		print '<td '.$rowColor.'>';
		print '<input type="radio" name="'.$subject->Id.'" value="" />';
		print '</td>';
		print '</tr>';
		$row++; // Increment row
	}
	print '</tr>';
	
	print '</table>';
	
}

function printRadio($levels, $subjectId, $s, $conSubject, $certId){
	foreach($levels as $key_val => $level) {
		if($level->Level__r->Name==$s){
			print '<input type="radio" value="'.$level->Level__r->Id.';'.$subjectId.';'.$certId.'" name="'.$subjectId.'"' ;
			if($conSubject!=null){
				if($subjectId==$conSubject->Subject__c&&$level->Level__r->Id==$conSubject->Subject_Level__c)print ' checked="true 1"';
			}
			print ' />';
		}
	}
	
}
?>
	<div id="main_container" class="profile-page">
		<div id="container_left">
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
				if($_SESSION['profileupdate']=='yes')print '<h2 style="color:green">Profile Updated</h2>';
				if($_SESSION['profileupdate']=='no')print '<h2 style="color:red">Error updating profile</h2>';
				$_SESSION['profileupdate']='';
			}			
			?>   
               <div class="clearfix"></div>              
			<?php the_content(); ?>	          
               </div>
               <?php if (isset($_SESSION['cntId'])) { ?>
                <script>
			    jQuery(function() {
				   jQuery('.Birthdate').datepicker({ dateFormat: 'dd-mm-yy' }).val();
			    });
			</script>
               <form action="/wp-content/themes/clevernotes/profile-page-save.php" method="post" enctype="application/x-www-form-urlencoded" name="save_profile" id="save_profile">
               <fieldset>
               <div class="save-button"><input type="submit" name="submit" value="Save Profile"></div>
			<div class="one_half">
                    <table class="profile_table">
                    	<tbody>
                         	<tr>
                              	<td colspan="2" class="table-title">Your Details</td>
                              </tr>
                              <tr>
                                   <td>First name *</td>
                                   <td><input name="FirstName" type="text" value="<?php if(isset($cnt->FirstName ))echo $cnt->FirstName ?>"></td>
                              </tr>
                              <tr>
                                   <td>Last name *</td>
                                   <td><input name="LastName" type="text" value="<?php if(isset($cnt->LastName ))echo $cnt->LastName ?>"></td>
                              </tr>                         
                              <tr>
                                   <td>Email *</td>
                                   <td>
                                   <input name="Email" type="text" value="<?php if(isset($cnt->Email ))echo $cnt->Email ?>"></td>
                              </tr>
                              <tr>
                                   <td>Mobile</td>
                                   <td>
                                   <input name="MobilePhone" type="text" value="<?php if(isset($cnt->MobilePhone ))echo $cnt->MobilePhone ?>"></td>
                              </tr>
                              <tr>
                                   <td>Date of Birth</td>
                                   <td>
                                   <input class="Birthdate" name="Birthdate" type="text" value="<?php if(isset($cnt->Birthdate ))echo $cnt->Birthdate ?>"></td>
                              </tr>
                              <tr>
                                   <td>Address</td>
                                   <td>
                                   <input name="MailingStreet" type="text" value="<?php if(isset($cnt->MailingStreet ))echo $cnt->MailingStreet ?>"></td>
                              </tr>
                              <tr>
                                   <td>City/Town</td>
                                   <td>
                                   <input name="MailingCity" type="text" value="<?php if(isset($cnt->MailingCity ))echo $cnt->MailingCity ?>"></td>
                              </tr>
                              <tr>
                                   <td>County</td>
                                   <td>
                                   <input name="MailingState" type="text" value="<?php if(isset($cnt->MailingState ))echo $cnt->MailingState ?>"></td>
                              </tr>
                              <tr>
                                   <td>Country</td>
                                   <td>
                                   <input name="MailingCountry" type="text" value="<?php if(isset($cnt->MailingCountry ))echo $cnt->MailingCountry ?>"></td>
                              </tr> 
                              <tr>
                                   <td>Subscribe to receive updates?</td>
                                   <td>
                                   <input name="Email_Opt_In__c" type="checkbox" checked="<?php if(isset($cnt->Email_Opt_In__c ))echo $cnt->Email_Opt_In__c ?>"></td>
                              </tr> 
                    	</tbody>                        
                    </table>
               </div>
               <div class="one_half last">
               	<table class="profile_table">
                    	<tbody>
                         	<tr>
                              	<td class="table-title" colspan="5">Your Subjects</td>
                              </tr>
                          <tr>
                              <td>
                              <?php buildSubjects(); ?>
                              </td>
                         </tr>
                         </tbody>                    
                    </table>
               </div>
               <div class="clearfix"></div>  
               <div class="save-button"><input type="submit" name="submit" value="Save Profile"></div>
               </fieldset>
               </form>
               <?php } else { ?>
               <h2>
               	<p style='margin-top: 15px;'>Please login to get the full benefits of Clevernotes.ie. <br>               
	               Just click the 'Connect with Facebook' button onthe top right of your screen.
                    </p>
               </h2>
               <?php } ?>
		</section>
		</div>
	  </div>
	  <?php endwhile; endif; ?>		    			 
	</div>
</div>