<?php
/*-------------------------*/
/* Get theme Options
/*-------------------------*/
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
}
?>
<?php
if (((get_page_link($page->ID)) == get_option('siteurl') . "/contact-us/") || ((get_page_link($page->ID)) == get_option('siteurl') . "/contact/")) :
	echo "<div id='contact_page'>";
		if ($opts_business_address) : 
			echo "<div class='business_address'>".nl2br($opts_business_address)."</div>";
		endif ;
		if ($opts_phone_number) : 
			echo "<div class='phone_number bits'><strong>Tel</strong>".$opts_phone_number."</div>";
		endif ;
		if ($opts_fax_number) : 
			echo "<div class='fax_number bits'><strong>Fax</strong>".$opts_fax_number."</div>";
		endif ;
		if ($opts_business_email) : 
			echo "<div class='business_email bits'><strong>Email</strong> <a href='mailto:$opts_business_email'>".$opts_business_email."</a></div>";
		endif ;
		if ($opts_vat) : 
			echo "<div class='vat bits'><strong>VAT</strong> ".$opts_vat."</div>";
		endif ;
		if ($opts_company_reg) : 
			echo "<div class='company_reg bits'><strong>Registration Number</strong> ".$opts_company_reg."</div>";
		endif ;
	echo "</div>"; 
endif ;
?>  