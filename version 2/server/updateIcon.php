<?php
	include_once 'database.php';

	if (isset($_POST['submit'])) {
		$id = $user['id'];

		$file = $_FILES['file'];

		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$format = array('jpg', 'jpeg', 'png', 'pdf');

		if (in_array($fileActualExt, $format)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$fileNameNew = 'profile'.$id. '.'.$fileActualExt;
					$fileDestination = '../client/img/icon/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$sql = "UPDATE user SET icon = '$fileNameNew' WHERE id = '$id'";
					$result = mysqli_query($db, $sql);
					header("Location: ../account.php?uploadsuccess");
					exit();
				}
			}
		}
	} else {
		header("Location: ../account.php?uploaderror");
		exit();
	};
?>