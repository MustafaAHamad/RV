<?php
	
	// REQUIRE DATABASE
	require("server/database.php");

?>

<!DOCTYPE html>
<html>
<head>
	<html lang="eng">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<base href="/RV/">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<title>RV - Account</title>
	<link rel="stylesheet" type="text/css" href="client/css/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
	<?php
		if ($user) {
			echo '<form action="server/logout.php" method="POST">
					<button type="submit" class="text_content logout" name="logout">LOGOUT</button>
				  </form>
				  <h4> user id: ' . $user['id'] . '</h4>
				  <h4> username: ' . $user['username'] . '</h4>
				  <h4> user icon: ' . $user['icon'] . '</h4>
				  <form action="server/updateIcon.php" method="POST" enctype="multipart/form-data">
				  	<input id="ciFp0r7" type="file" name="file" accept="image/*" data-type="image"></input>
				  	<button type="submit" name="submit">Upload</button>
				  </form>';
			if ($user['icon'] != "") {
				echo "<img src='client/img/icon/" . $user['icon'] . "?" . mt_rand() . "'/>";
			} else {
				echo '<img src="client/img/icon/default.jpg">';
			}
			echo '<script src="client/js/profile.js?v=<?php echo time();?>" type="text/javascript"></script>';
		} else {
			echo '<div class="ghR8bCq">
					<div class="jGyv6e1">
						<div class="gjCm3au">
							<!-- SIGNUP FORM -->
							<form class="kGmu2pl hidden" id="mFi48Cq" method="POST" onsubmit="return validateSignUp();">
								<div class="pJv7beW">
									<label for="username" class="mf7iQve">Username</label>
									<input id="uIrc50C" class="vJF8Muc" type="text" name="username" autocomplete="off">
								</div>
								<div class="pJv7beW">
									<label for="email" class="mf7iQve">Email</label>
									<input id="hF8uwEi" class="vJF8Muc" type="email" name="email" autocomplete="off">
								</div>
								<div class="pJv7beW">
									<label for="password" class="mf7iQve">Password</label>
									<input id="uR8cKm7" class="vJF8Muc" type="password" name="password" autocomplete="off">
									<span class="mGkiY7C">Passwords must contain at least 6 characters</span>
								</div>
								<span class="mGkiY7C Vjru7i2">By creating an account, you agree to our Terms of Service and Privacy Policy.</span>
								<button class="jGiVx8a" type="submit" name="register">Sign up</button>
							</form>
							<!-- LOGIN FORM -->
							<form class="kGmu2pl" id="dR4nqt3" method="POST" onsubmit="return validateLogIn();">
								<div class="pJv7beW">
									<label for="email" class="mf7iQve">Email</label>
									<input id="vRu4eTd" class="vJF8Muc" type="email" name="email" autocomplete="off">
								</div>
								<div class="pJv7beW">
									<label for="password" class="mf7iQve">Password</label>
									<input id="mGhuC2i" class="vJF8Muc" type="password" name="password" autocomplete="off">
								</div>
								<button class="vk9Muy3">Forgot your password?</button>
								<button class="jGiVx8a" type="submit" name="login">Sign in</button>
								<span class="mGkiY7C">By signing, you agree to our Terms of Service and Privacy Policy.</span>
							</form>
						</div>
					</div>
				</div>
				<script src="client/js/account.js?v=<?php echo time();?>" type="text/javascript"></script>';
		}
	?>
</body>
</html>