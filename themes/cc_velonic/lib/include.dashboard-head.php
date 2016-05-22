<head>
	<title><?php echo $meta_title; ?></title>
	<meta name="Description" content="<?php echo $meta_description; ?>"> 
	<meta name="Keywords" content="<?php echo $meta_keywords; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link href="<?php echo $root; ?>css/dashboard-styles.css" media="all" rel="stylesheet" type="text/css" />
	<link href="<?php echo $root; ?>css/date-picker-default.css" media="all" rel="stylesheet" type="text/css" />
	<link href="<?php echo $root; ?>css/date-picker-date.css" media="all" rel="stylesheet" type="text/css" />
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $root; ?>images/favicon.ico" rel="Shortcut Icon" type="image/x-icon">
	<script src="<?php echo $root; ?>js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo $root; ?>js/behaviors.js" type="text/javascript"></script>
	<script src="<?php echo $root; ?>js/modernizr.js" type="text/javascript"></script>
	<script src="<?php echo $root; ?>js/picker.js" type="text/javascript"></script>
	<script src="<?php echo $root; ?>js/picker-date.js" type="text/javascript"></script>
	<script src="<?php echo $root; ?>js/image-upload.js" type="text/javascript"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

	<!-- BEGIN:Google Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-127877-22', 'auto');
	  ga('send', 'pageview');

	  // Only display this when user is logged in. Sends user ID info to Google Analytics.
	  ga('set', '&uid', <?php echo $_SESSION['member_id']; ?>); // Set the user ID using signed-in user_id.
	
	</script>
	<!-- END:Google Analytics -->
</head>