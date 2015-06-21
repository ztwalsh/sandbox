<html>
	<head>
		<title>Image Upload</title>
		<link href="croppic.css" media="screen" rel="stylesheet" type="text/css" />
		<script src="jquery.js" type="text/javascript"></script>
		<script src="croppic.js" type="text/javascript"></script>
		<script src="main.js" type="text/javascript"></script>
		<script src="bootstrap.js" type="text/javascript"></script>
		<script type="text/javascript">
			var croppicHeaderOptions = {
				uploadUrl:'img_save_to_file.php',
				cropUrl:'img_crop_to_file.php',
				customUploadButtonId:'cropContainerHeaderButton',
				modal:false
			}

			var imageSelect = new Crop('imageSelect', croppicHeaderOptions);
		</script>
	</head>
	<body>
	<div id="imageSelect"></div>
	<span class="btn" id="cropContainerHeaderButton">click here to try it</span>
	</body>
</html>