<?php
	require("server/database.php");

	require("_includes/header.php");

	if (!isset($_GET['id'])) {
		echo "ERROR 404:";
		echo "User is invalid";
	} else {
		$userId = $_GET['id'];
		extract(get_user_from_username($userId));
		echo $userId;
	};
?>
<body>
	<div id="mvFiGh3">
		<?php
			// if ($user['id'] == $userId) {};
		?>

		<?php require("_includes/navigation.php"); ?>

		<div id="uE7cQp9">
			<div class="jGm9Opw2">
				<div class="iCRq7tm">
					<div class="uTckj4o">
						<div class="pFcuE83">
							<a class="flPe9nj" href="profile.php?id=1">
								<div class="jGhm6wR">
									<img class="oCbv4wi" src="client/img/icon/default.jpg" />
								</div>
								<span class="kF2yaCx">Kamado Tanjiro</span>
								<span class="kF2yaCx muR790C">6m</span>
							</a>
						</div>
						<div class="pFcuE83 jFmc9i3">
							<p class="mVj8Pc7">No one:<br>Alarm clocks:</p>
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