<?php require("server/database.php") ?>
<!DOCTYPE html>
<html>
<head>
	<?php require("_includes/header.php"); ?>
	<title>Website - Home</title>
</head>
<body>
	<div id="mvFiGh3">
		<?php require("_includes/navigation.php"); ?>
		<div id="uE7cQp9">
			<!-- POST WRAPPER -->
			<div class="vJrp9i3">
				<form method="POST">
					<textarea class="Rtm6Wbq" placeholder="What's going on?"></textarea>
					<button class="iMn3p0c" type="submit">Post</button>
				</form>
			</div>
			<!-- FEED WRAPPER -->
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

				<div class="iCRq7tm">
					<div class="uTckj4o">
						<div class="pFcuE83">
							<a class="flPe9nj" href="#">
								<div class="jGhm6wR">
									<img class="oCbv4wi" src="client/img/icon/default.jpg" />
								</div>
								<span class="kF2yaCx">Kamado Tanjiro</span>
								<span class="kF2yaCx muR790C">12/26/2019</span>
							</a>
						</div>
						<div class="pFcuE83 jFmc9i3">
							<p class="mVj8Pc7">SKRRRT BrRRT sKRt SKKRT</p>
							<div class="vkFp9i2">
								<img class="inBu72m" src="client/img/banner.jpg" />
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