<html>
	<head>
		<title>Histogram Demo</title>
		<link href="css/v2.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/behavior.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			$page = 'v3';
			include('menu.php');
		?>
		<div class="pad">
			<div class="wrapper cf">
				<div class="span12">
					<h1>Review Snapshot</h1>
					<hr />
				</div>
				<div class="span12">
					<div class="score">
						<div class="star-on"><i class="fa fa-star"></i></div>
						<div class="star-on"><i class="fa fa-star"></i></div>
						<div class="star-on"><i class="fa fa-star"></i></div>
						<div class="star-on"><i class="fa fa-star"></i></div>
						<div class="star-off"><i class="fa fa-star"></i></div>
						<div class="numeric-rating">4.1</div>
					</div>
					<div class="review-count">
						Based on 44 reviews
					</div>
					<div class="recomendability">
						<table>
							<tr>
								<td width="50"><span>95%</span></td> 
								<td>of respondents would<br />recommend this to a friend</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="wrapper-dark">
				<section class="cf">
					<div>
						<h3>Pros</h3>
						<ul>
							<li>Good image quality (7)</li>
							<li>Image stabilization (6)</li>
							<li>Large clear LCD (6)</li>
							<li>Easy to use (5)</li>
							<li>Fast / accurate auto-focus (5)</li>
						</ul>
					</div>
					<div>
						<h3>Cons</h3>
					</div>
					<div>
						<h3>Best for</h3>
						<ul>
							<li>Family photos (6)</li>
							<li>Sports/action (6)</li>
							<li>Landscape/scenery (5)</li>
							<li>Low light (3)</li>
							<li>Travel (3)</li>
						</ul>
					</div>
				</section>
			</div>
			<div class="wrapper cf">
				<div class="span6">
					<h3>Rating Breakdown</h3>
					<table class="histogram">
						<tr id="5" class="distro-bar">
							<td class="rating">5 <i class="fa fa-star"></i></td>
							<td class="bar"><div style="width: 58%;"></div></td>
							<td class="count">25</td>
						</tr>
						<tr id="4" class="distro-bar">
							<td class="rating">4 <i class="fa fa-star"></i></td>
							<td class="bar"><div style="width: 14%;"></div></td>
							<td class="count">7</td>
						</tr>
						<tr id="3" class="distro-bar">
							<td class="rating">3 <i class="fa fa-star"></i></td>
							<td class="bar"><div style="width: 11%;"></div></td>
							<td class="count">5</td>
						</tr>
						<tr id="2" class="inactive">
							<td class="rating">2 <i class="fa fa-star"></i></td>
							<td class="bar"></td>
							<td class="count">0</td>
						</tr>
						<tr id="1" class="distro-bar">
							<td class="rating">1 <i class="fa fa-star"></i></td>
							<td class="bar"><div style="width: 14%;"></div></td>
							<td class="count">7</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="wrapper">
				<div id="filter-feedback">
				</div>
			</div>
			<div class="wrapper">
				<?php include('review-content.php'); ?>
			</div>
		</div>
	</body>
</html>