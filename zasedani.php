<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Zápisy</title>
		<link rel="stylesheet" href="css/zasedani.css">
		<link rel="shortcut icon" href="favicon.svg" type="image/svg+xml">
	</head>
	<body>
		<?php require 'include/nav.html';?>
		<div class="mainContent">			
			<div class="zasedani" id="43">		<!-- dyn: id( = id in MYSQL)-->

				<input id="checkbox43" class="checkbox" type="checkbox" onclick="fill(43)"> <!-- dyn: checkbox+id( = id in MYSQL)-->

				<label for="checkbox43">
					<div class="zasedaniTopWrap">
						<div class="zasedaniTop">
							<span>Zasedání 3.2.2020</span>				<!--dyn Zasedání +time( = time in MYSQL)-->
							<div class="dropdownButtonWrap">
								<div class="dropdownButton"></div>
							</div>
						</div>
					</div>
				</label>
				<div class="zasedaniCont">		<!--dyn from callbackf(text)-->
				</div>
			</div>
		</div>
	</body>
</html>
<script src="js/fillzapisy.js">
<script src="js/getzapis.js"></script>