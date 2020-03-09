<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>SPGT-Studentský parlament Gymnázia Tišnov</title>
		<link rel="stylesheet" href="css/main_page.css">
	</head>
	<body>
		<?php require 'include/nav.html';?>
		<div class="titleBox">
			<div class="titleBoxText">
				<h1>Studenti pro studenty</h1>
				<h2>Zapojte se... bla bla bla</h2>
			</div>
		</div>
		<div class="articleBox">
			<?php require 'articles/2019-2020/2020.1.26 testovaci.html';?>
		</div>
		<div class="meetingsBox">
			<h3>Zapojte se přímo na schůzích, nebo nás kontaktujte.</h3>
		</div>

		<style>

			@media screen and (hover:none) and (max-aspect-ratio: 1/1) and (max-device-width: 600px){
				.navItem[href*="index.php"]{
					color: rgb(37, 171, 255);
				}
			
				.navItem[href*="index.php"] .navIcon{
					fill: rgb(37, 171, 255);
				}
			}

		</style>
	</body>
</html>