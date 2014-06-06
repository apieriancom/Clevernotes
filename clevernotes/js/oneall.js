	var oneall_js_protocol = (("https:" == document.location.protocol) ? "https" : "http");
	document.write(unescape("%3Cscript src='" + oneall_js_protocol + "://clevernotesie.api.oneall.com/socialize/library.js' type='text/javascript'%3E%3C/script%3E"));
	
	oneall.api.plugins.social_login.build("social_login_container", {
	'providers' :  ['facebook'], 
	'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/connect/large-v1.css',
	'grid_size_x': '1',
	'grid_size_y': '1',
	'callback_uri': 'https://www.clevernotes.org/sfdc/oa-login.php'
	});