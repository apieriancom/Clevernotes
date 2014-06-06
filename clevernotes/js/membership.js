// Scripts to handle height equalisation and positioning on the subscribe page
// Separated out from the rest of the js for efficiency (no need to load unless on relevant template

	//Ensure both panels on subscribe page are equal height
	jQuery(window).on('load', function() {
		var jfFreePriceHt, jfPaidPriceHt, jfFreeButtonHt, jfPaidButtonHt, jfFreeFeatHt, jfPaidFeatHt,
		jfFreePriceHtVal, jfPaidPriceHtVal, jfFreeButtonHtVal, jfPaidButtonHtVal, jfFreeFeatHValt, jfPaidFeatHtVal,
		jfNewPriceHt, jfNewButtonHt, jfNewFeatHt;
		jfFreePriceHt = jQuery("#jf-featureFree .jf-priceBoxWrapper").css('height');
		jfPaidPriceHt = jQuery("#jf-featurePaid .jf-priceBoxWrapper").css('height');
		jfFreeButtonHt = jQuery("#jf-featureFree .jf-buttonBoxWrapper").css('height');
		jfPaidButtonHt = jQuery("#jf-featurePaid .jf-buttonBoxWrapper").css('height');
		jfFreeFeatHt = jQuery("#jf-featureFree .jf-featuresBoxWrapper").css('height');
		jfPaidFeatHt = jQuery("#jf-featurePaid .jf-featuresBoxWrapper").css('height');
		jfFreePriceHtVal = parseFloat(jfFreePriceHt); jfPaidPriceHtVal = parseFloat(jfPaidPriceHt);
		jfFreeButtonHtVal = parseFloat(jfFreeButtonHt); jfPaidButtonHtVal = parseFloat(jfPaidButtonHt);
		jfFreeFeatHtVal = parseFloat(jfFreeFeatHt); jfPaidFeatHtVal = parseFloat(jfPaidFeatHt);
		if (jfFreePriceHtVal > jfPaidPriceHtVal) {
			jfNewPriceHt = jfFreePriceHtVal+'px';
			jQuery("#jf-featurePaid .jf-priceBoxWrapper").css('height',jfNewPriceHt);
		} else {
			jfNewPriceHt = jfPaidPriceHtVal+'px';
			jQuery("#jf-featureFree .jf-priceBoxWrapper").css('height',jfNewPriceHt);
		}
		if (jfFreeButtonHtVal > jfPaidButtonHtVal) {
			jfNewButtonHt = jfFreeButtonHtVal+'px';
			jQuery("#jf-featurePaid .jf-buttonBoxWrapper").css('height',jfNewButtonHt);
		} else {
			jfNewButtonHt = jfPaidButtonHtVal+'px';
			jQuery("#jf-featureFree .jf-buttonBoxWrapper").css('height',jfNewButtonHt);
		}
		if (jfFreeFeatHtVal > jfPaidFeatHtVal) {
			jfNewFeatHt = jfFreeFeatHtVal+'px';
			jQuery("#jf-featurePaid .jf-featuresBoxWrapper").css('height',jfNewFeatHt);
		} else {
			jfNewFeatHt = jfPaidFeatHtVal+'px';
			jQuery("#jf-featureFree .jf-featuresBoxWrapper").css('height',jfNewFeatHt);
		}
		
		var jfPaidPriceWt, jfPaidPriceWtVal, jfPaidPriceImgWt, jfPaidPriceImgWtVal;
		jfPaidPriceWt = jQuery("#jf-featurePaid .jf-priceBoxWrapper").css('width');
		jQuery("#jf-featurePaid #jf-image").css('width',jfPaidPriceWt);
		
		var jfBox1H3Ht, jfBox2H3Ht, jfBox3H3Ht, jfBox4H3Ht, jfBox1H3HtVal, jfBox2H3HtVal, jfBox3H3HtVal, jfBox4H3HtVal, jfBoxH3NewHt, jfBoxH3NewHtPX;
		jfBox1H3Ht = jQuery("#jf-box1 h3").css('height'); jfBox1H3HtVal = parseFloat(jfBox1H3Ht);
		jfBox2H3Ht = jQuery("#jf-box2 h3").css('height'); jfBox2H3HtVal = parseFloat(jfBox2H3Ht);
		jfBox3H3Ht = jQuery("#jf-box3 h3").css('height'); jfBox3H3HtVal = parseFloat(jfBox3H3Ht);
		jfBox4H3Ht = jQuery("#jf-box4 h3").css('height'); jfBox4H3HtVal = parseFloat(jfBox4H3Ht);
		jfBoxH3NewHt = Math.max(jfBox1H3HtVal, jfBox2H3HtVal, jfBox3H3HtVal, jfBox4H3HtVal);
		jfBoxH3NewHtPX = jfBoxH3NewHt+'px';
		jQuery("#jf-box1 h3").css('height',jfBoxH3NewHtPX);
		jQuery("#jf-box2 h3").css('height',jfBoxH3NewHtPX);
		jQuery("#jf-box3 h3").css('height',jfBoxH3NewHtPX);
		jQuery("#jf-box4 h3").css('height',jfBoxH3NewHtPX);
		
		var jfBox1Ht, jfBox2Ht, jfBox3Ht, jfBox4Ht, jfBox1HtVal, jfBox2HtVal, jfBox3HtVal, jfBox4HtVal, jfBoxNewHt, jfBoxNewHtPX;
		jfBox1Ht = jQuery("#jf-box1").css('height'); jfBox1HtVal = parseFloat(jfBox1Ht);
		jfBox2Ht = jQuery("#jf-box2").css('height'); jfBox2HtVal = parseFloat(jfBox2Ht);
		jfBox3Ht = jQuery("#jf-box3").css('height'); jfBox3HtVal = parseFloat(jfBox3Ht);
		jfBox4Ht = jQuery("#jf-box4").css('height'); jfBox4HtVal = parseFloat(jfBox4Ht);
		jfBoxNewHt = Math.max(jfBox1HtVal, jfBox2HtVal, jfBox3HtVal, jfBox4HtVal);
		jfBoxNewHtPX = jfBoxNewHt+'px';
		if (jfBoxNewHt > jfBox1HtVal) {jQuery("#jf-box1").css('height',jfBoxNewHtPX);}
		if (jfBoxNewHt > jfBox2HtVal) {jQuery("#jf-box2").css('height',jfBoxNewHtPX);}
		if (jfBoxNewHt > jfBox3HtVal) {jQuery("#jf-box3").css('height',jfBoxNewHtPX);}
		if (jfBoxNewHt > jfBox4HtVal) {jQuery("#jf-box4").css('height',jfBoxNewHtPX);}
	});