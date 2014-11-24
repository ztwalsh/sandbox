<html>
	<head>
		<title>Histogram Demo</title>
		<link href="css/v1.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/behavior.js" type="text/javascript"></script>
	</head>
	<body>
		<?php 
			$page = 'v1';
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
					<div class="distribution cf">
						<h3>Star Distribution</h3>
						<div class="column" id="5">
							<small>25</small>
							<table><tr><td><div style="height:56%;"></div></td></tr></table>
							<span class="score">5</span>
						</div>
						<div class="column" id="4">
							<small>7</small>
							<table><tr><td><div style="height:16%;"></div></td></tr></table>
							<span class="score">4</span>
						</div>
						<div class="column" id="3">
							<small>5</small>
							<table><tr><td><div style="height:11%;"></div></td></tr></table>
							<span class="score">3</span>
						</div>
						<div class="inactive" id="2">
							<small>0</small>
							<table><tr><td></td></tr></table>
							<span class="score">2</span>
						</div>
						<div class="column" id="1">
							<small>7</small>
							<table><tr><td><div style="height:16%;"></div></td></tr></table>
							<span class="score">1</span>
						</div>
					</div>
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