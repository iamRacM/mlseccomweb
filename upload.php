<?php
//UPLOADING VIDEOS
	if (0 < $_FILES['file']['error']) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	} else {
		move_uploaded_file($_FILES['file']['tmp_name'], 'resources/uploads/videos/' . $_POST['file'][$_GET['title']]);
		echo $_GET['title'];
	}

?>