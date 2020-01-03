<?php

	require ('server/database.php');

?>

<!DOCTYPE html>
<html>
<head>
	<html lang="eng">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="/RV/version%202/client/css/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<base href="/RV/version%202/">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<title>RV - Home</title>
</head>
<body>
	<div id="mvFiGh3">
		<!-- HEADER CONTAINER -->
		<div class="vKp03cA">
			<div class="iMpr2ll iRmc8qE">
				<ul class="ivFm7Rt">
					<li class="jFm9oAv">
						<a class="cFje9e3" href="">
							<i class="fas fa-bell"></i>
						</a>
					</li>
					<li class="jFm9oAv">
						<a class="lFm06yn" href="account">
							<?php
								if ($user) {
									if ($user['icon'] != '') {
										echo "<img class='Hjg8iu3' src='client/img/icon/" . $user['icon'] . "?" . mt_rand() . "'/>";
									} else {
										echo '<img class="Hjg8iu3" src="client/img/icon/default.jpg">';
									};
								};
							?>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- SIDEBAR CONTAINER -->
		<div class="vmFu8i3 hidden">
			<nav class="iR8ve4w">
				<ul class="iR7mHw2">
					<li class="mgR8Ucw">
						<a class="vF8Jgk2 uRyM6b1" href="/RV/version%202/home">
							<i class="fas fa-home"></i>
						</a>
					</li>
					<li class="mgR8Ucw">
						<a class="vF8Jgk2" href="#">
							<i class="fas fa-envelope"></i>
						</a>
					</li>
				</ul>
			</nav>
		</div>

		<!-- POST CONTAINER -->
		<div id="uE7cQp9">
			<div class="jGm9Opw2">
				<div class="iCRq7tm">
					<div class="uTckj4o">
						<div class="pFcuE83">
							<a class="flPe9nj" href="user/1">
								<!-- profile.php?id=1 -->
								<div class="jGhm6wR">
									<img class="oCbv4wi" src="client/img/icon/default.jpg" />
								</div>
								<span class="kF2yaCx">Kamado Tanjiro</span>
								<span class="kF2yaCx muR790C">6m</span>
							</a>
						</div>
						<div class="pFcuE83 jFmc9i3">
							<p class="mVj8Pc7">No one:<br>Alarm clocks:<br><?php $string = "#bruh"; $string = hashtag_converter($string); echo $string; ?> </p>
							<div class="vkFp9i2">
								<img class="inBu72m" src="client/img/tom.gif" />
							</div>
						</div>
						<div class="pFcuE83"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>