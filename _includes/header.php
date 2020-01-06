<div class="vKp03cA">
	<div class="iMpr2ll iRmc8qE">
		<ul class="ivFm7Rt">
			<?php
				if ($user) {
					echo '
						<li class="jFm9oAv">
							<a class="cFje9e3" href="">
								<i class="fas fa-bell"></i>
							</a>
						</li>
					';
					if ($user['icon'] != '') {
						echo '
							<li class="jFm9oAv">
								<a class="lFm06yn">
									<img class="Hjg8iu3" src="client/img/icon/' . $user["icon"] . '?' . mt_rand()  . '" />
								</a>
							</li>
						';
					} else {
						echo '
							<li class="jFm9oAv">
								<a class="lFm06yn">
									<img class="Hjg8iu3" src="client/img/icon/default.jpg" />
								</a>
							</li>
						';
					};
				} else {
					echo "logged out";
				};
			?>
		</ul>
	</div>
</div>