<html>
	<head>
		<title>Custom Form Field</title>
		<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/behavior.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			$page = '';
			include('menu.php');
		?>
		<div class="wrapper cf">
			<h1 style="text-align: center;">Click below</h1>
			<form>
				<label>Selet Box</label><br />
				<select>
					<option value="1">First option</option>
					<option value="1">Second option</option>
					<option value="1">Third option</option>
				</select>
				<p>Bacon ipsum dolor amet chicken pork rump, biltong picanha leberkas beef pancetta sirloin. Ham hock meatball prosciutto, boudin kevin spare ribs meatloaf tri-tip sirloin alcatra. Spare ribs venison shoulder tri-tip prosciutto, fatback pastrami swine chuck jowl turducken. Pork chop pastrami meatball, tongue turducken rump jowl t-bone bresaola short loin cupim. Turkey ribeye short loin prosciutto cow salami boudin shankle pork ground round fatback porchetta tri-tip alcatra pastrami.</p>
			</form>
		</div>
	</body>
</html>