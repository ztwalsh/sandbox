<html>
	<head>
		<title>Histogram Demo</title>
		<link href="css/styles.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/behavior.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="pad">
			<div class="wrapper cf">
				<div class="span12">
					<h1>Review Snapshot</h1>
					<hr />
				</div>
				<div class="span6">
					<div class="star-on"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHkAAACACAYAAAAvZ8aYAAAGnElEQVR42u2daWxVRRiGLy3aChQlCHhdE4haTBEXxCbYgCiN8QchtajVRkokpiAkrhiLWv1hkEQFglWjESP9Y1xxww2MxK2p2w80GhcWQeNWccMFtZ/vlztNSrnc3uUsc2beN/ly0ua2PfM+PefMmW/mm1SKoiiKouyTiMynC24DPg6xV490w13IKySj5XTDTcCVvb29PyphHH/AoYKuuAe5RfbVPLriHuT3BkDupituAa6V7JpKd9yB3JmNMJ7N6+iOG4DHIv46wJWs3x9Dl5IPeZnk1o10KdmAy3FL3jkI5B36ObqVXMgNkp/m0K3kQn4tT8gb6VYyAZ8khamariUP8r0FQl5D15IFeCQ6XL8VQhif/xWHKrqXHMhLpDgtonvJADwE8WmRkD+mg8mAPEtK00y6aLnwbF1fIuQn6aLdV7FO7/m3RMj688fQTXsh3yHB6Ha6aSfgSjOtJwh9hziYrtoHeZ4Eq2a6ah/kdwOG3EVX7QJ8poSj0+muPZA7Q4L8MN21A/CYHNN7StWfiNF0OX7IbRKultLleAHr9J6vwiSM378NhzK6HR/kBolGs+l2fJA3RUEYV/PLdDsewBMlOvUiTqDr0UPukGi1mq5HC7jg6T0B6GfEcLofHeTFEo9a6X5EwlX8SUyQt9D9aK7icyVeTSeF8K/i9XESxt9/nBTCvYqPDWB6T6n6B3EUaZQOcwRivKkQMBuxQMeocRW9IhYI5/GSGTNfYM6v1pzvCJ+hDUWkEZPNlNlmxDVmTtZaxPNawwOxHbFHkq09ph3anucQD2lJKcTViEtN+ycbP4baDu4wxImIOsQFiIWIdh2k0OcWjptNL7jHjBhR2UfSeoxPm41vHcbHhcbXs3S0Tf0OAlqFeeZNQZxvSiItRdyptTX0FoX4AF/vQvxNPrFIfd+lHAyPdcrHcGox3KYYjhX94baZxV6Ua7eJDNe2PtDttMRJ3TLwdq1TWvfSFyekHC870HP5HFziv9CjREsTKTMH64DVhD2lhgrtGazcavLtaR+J+JC2JQqwvvmkC32lqsIPvkj7EqENRY+2mZGqB+mh1VfwAxLEyJkMXrqQioGvBF0yUjLjrhzpskPKoSms8eoZiN30OFb9JGFPXJBMpbvt9DqW5+82HCZGlYE6AvE+bY9Uuv56XNSpxuGIF+h9JFfwsxLXdGD84XLEfcQQqjS/XG7DBIIbhBMDwnhFus62mSIXS3iLwX2T+nihrVOC6kwXnyr++au70E2zfe5XNWIrcRWlLyUpqye1qy+Z2YpU/uqSpG1fhBMehlvPM2SXl55GHJLU+dZliHvIMKdWiQs1SfRVgK9Y++k/xFWuraKYK5m6WJTIH4gGV5fLTOvbqNrjV6Tvcah1fV3U8WjoF54y/gwxwZcFcFoq8R3PAL8lvpVw1FcGxFOe3KJ1IVulr0tay8wrhMvSBWlDUj5LMivwXFY65btgQpPjkBsJ2f0RsZWE7P5ynG7fAVdJ/NV8wpZWCxrmM+RZ4odm+Az5Vk8gL/MZ8queQN7gK+DyGMoZx6XdXg6IoNGnejZ2XeMj5CWeQW71EfKjnkHu9A4ynsc7PYO8lUkJP5T2CXKTp5AbfYLs6zTdlT5B9rVGWLcvgH1ISvidrPAoKeFvssKjpIS/yQo0cmNc7pqNSurjTIxoKUsmJcLR1zJg5T6+vsh8P2ppqeIylyGfFnVHB/9Ud2lnL0cn8G7TIYpSk5iUCOa2+Ea+ZuJzJyPeZLIiIUkJs6CspdD8rX4eMd/8PJMVliYldL2v1hQbVeI/4ijE/eb3MVlhUVJCSxKeEfD5TpVwS0umXYQcRlJCp9UsCqu3Kpm1WldKOJWBG12EHHRS4hHE2IjOfZzZTY3JioiSElsQdTG1YTpgf8RkRXZzRpaalDCDKNdKzDuV4u8fhLge5/M7kxX7GlNfoiGPiWUbU+N8jkY8UWK7znYJ8m1FmqA1Nuotb9t5iM+LbN9NPicltBTUzdJ/e1i726fbErdLgSWsnElWFJGU0F3Rxye0rRMksxGXX8mKApISOxBzHPnHbihgv8tJLjR4sKSEbgO73LVpMZLZo2OFDL5dcasLjc2VlNiEqE45LMlssfS608mKbEkJfO8bCWuHMnthNyO+dS5ZkSUpoQMiq3VwJOWh0O5DEWuyDAylk9yoS/pdvW/jcEqK6uuMdvWDPDfJjekwVXEvF9+r0u3vjU5SuALRg1iV9J71aCLN6dHhiMV0gqIoiqIoiqIoiqIoKiD9Dy4it/DABvOLAAAAAElFTkSuQmCC" /></div>
					<div class="star-on"><img src="data:image/png;base64,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" /></div>
					<div class="star-on"><img src="data:image/png;base64,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" /></div>
					<div class="star-on"><img src="data:image/png;base64,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" /></div>
					<div class="star-off"><img src="data:image/png;base64,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" /></div>
					<div class="numeric-rating">4.1</div>
					<div class="review-count">(based on 44 reviews)</div>
				</div>
				<div class="span6">
					<span class="recomendability">
						<table>
							<tr>
								<td width="50"><span>95%</span></td> 
								<td>of respondents would<br />recommend this to a friend</td>
							</tr>
						</table>
					</span>
				</div>
			</div>
			<div class="wrapper-dark">
				<section class="cf">
					<div class="tag">
						<h3>Rating Breakdown</h3>
						<table class="histogram">
							<tr id="5" class="distro-bar">
								<td class="rating">5-star</td>
								<td><div class="bar"><div style="width: 58%;"></div></div></td>
								<td class="count">25</td>
							</tr>
							<tr id="4" class="distro-bar">
								<td class="rating">4-star</td>
								<td><div class="bar"><div style="width: 14%;"></div></div></td>
								<td class="count">7</td>
							</tr>
							<tr id="3" class="distro-bar">
								<td class="rating">3-star</td>
								<td><div class="bar"><div style="width: 11%;"></div></div></td>
								<td class="count">5</td>
							</tr>
							<tr id="2" class="inactive">
								<td class="rating">2-star</td>
								<td><div class="bar"></div></td>
								<td class="count">0</td>
							</tr>
							<tr id="1" class="distro-bar">
								<td class="rating">1-star</td>
								<td><div class="bar"><div style="width: 14%;"></div></div></td>
								<td class="count">7</td>
							</tr>
						</table>
					</div>
					<div class="tag collapse">
						<h3>Pros <i class="fa fa-angle-down"></i></h3>
						<ul>
							<li>Good image quality (7)</li>
							<li>Image stabilization (6)</li>
							<li>Large clear LCD (6)</li>
							<li>Easy to use (5)</li>
							<li>Fast / accurate auto-focus (5)</li>
						</ul>
					</div>
					<div class="tag collapse">
						<h3>Cons <i class="fa fa-angle-down"></i></h3>
						<ul>
							<li class="no-tags">No cons selected</li>
						</ul>
					</div>
				</section>
			</div>
			<div class="wrapper">
				<div id="filter-feedback">
				</div>
			</div>
			<div class="wrapper">
				<div class="reviews-divider cf">
					<div class="divider-count">Reviewed by 44 customers</div>
					<div class="divider-sort">
						Sort by 
						<select>
							<option>Newest</option>
							<option>Oldest</option>
							<option>Highest Rated</option>
							<option>Lowest Rated</option>
							<option>Most Helpful</option>
						</select>
					</div>
				</div>
			</div>
			<div class="wrapper">
				<?php include('review-content.php'); ?>
			</div>
		</div>
	</body>
</html>