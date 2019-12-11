<?php 
	require("server/database.php");
?>
<!DOCTYPE html>
<html>
<head>
	<html lang="eng">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="client/css/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<title>Website - Login or Signup</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
	<div class="ghR8bCq">
		<!-- FORM CONTAINER -->
		<div class="jGyv6e1">
			<div class="gjCm3au">
			<!-- LOGIN FORM -->
				<form class="kGmu2pl" id="dR4nqt3" method="POST" onsubmit="return validate('login');">
					<div class="pJv7beW">
						<label for="email" class="mf7iQve">Email</label>
						<input id="vRu4eTd" class="vJF8Muc" type="email" name="email" autocomplete="off" required>
					</div>
					<div class="pJv7beW">
						<label for="password" class="mf7iQve">Password</label>
						<input id="mGhuC2i" class="vJF8Muc" type="password" name="password" autocomplete="off" required>
						<!-- <span class="mGkiY7C">Passwords must contain at least 6 characters</span> -->
					</div>
					<button class="jGiVx8a">Sign in</button>
					<span class="mGkiY7C gjRu98C">By signing, you agree to our Terms of Service and Privacy Policy.</span>
				</form>
			</div>
		</div>
	</div>
	<script src="client/js/account.js?v=<?php echo time();?>" type="text/javascript"></script>
</body>
</html>