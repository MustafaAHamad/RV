<?php
	
	require("server/database.php");

	require("_includes/header.php");
?>
<body>
	
	<div id="mvFiGh3">
		<nav class="iR8ve4w">
			<header class="iR7mHw2">
				
			</header>
		</nav>
		<div id="uE7cQp9">
			<?php
				if ($user) {
					echo '<form action="server/logout.php" method="POST">
							<button type="submit" class="text_content logout" name="logout">LOGOUT</button>
						</form>';
				}
			?>
		</div>
	</div>
</body>
</html>