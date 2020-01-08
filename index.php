<?php

	// REQUIRE DATABASE
	require ('server/database.php');

?>

<!DOCTYPE html>
<html>
<head>
	<html lang="eng">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<base href="/RV/">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<title>RV - Home</title>
	<link rel="stylesheet" type="text/css" href="client/css/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
	<div id="mvFiGh3">

		<?php
			require("_includes/navigation.php");
		?>

		<div id="uE7cQp9">
			<div class="jGm9Opw2">

				<div class="iCRq7tm">
					<div class="uTckj4o">
						<div class="pFcuE83">
							<a class="flPe9nj" href="user/1">
								<div class="jGhm6wR">
									<img class="oCbv4wi" src="client/img/icon/default.jpg" />
								</div>
								<span class="kF2yaCx">Kamado Tanjiro</span>
								<!-- <span class="kF2yaCx lFhuY4c">kamado.tanjiro</span> -->
								<span class="kF2yaCx muR790C">1/6/2020</span>
							</a>
						</div>
						<div class="pFcuE83 jFmc9i3">
							<p class="mVj8Pc7">No one:<br>Alarm clocks:</p>
							<div class="vkFp9i2">
								<img class="inBu72m" src="client/img/tom.gif" />
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
</html>