<html>

<head>
	<title>Uploaded Files</title>
</head>

<body>

	<h3>Files Info</h3>
	<?php foreach ($fileInfos as $fileInfo) { ?>
		Title: <?= $fileInfo['title'] ?>
		<br>
		File Name: <?= $fileInfo['fileName'] ?>
		<br>
		Random Name: <?= $fileInfo['randomName'] ?>
		<br>
		File Type: <?= $fileInfo['fileType'] ?>
		<br>
		File Size(byte): <?= $fileInfo['fileSize'] ?>
		<br>
		----------------------------------
		<br>

		<p> Proceed to homepage <a href='https://infs3202-60a6cb75.uqcloud.net/queryS/user_home'> Home </a> </p>
	<?php } ?>

</body>
</html>