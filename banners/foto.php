<!DOCTYPE html>
<html>
<head>

	<title>
		Foto upload
	</title>
	
</head>
<body>
<form enctype="multipart/form-data" action="fotoupload.php" method="post">
    <input name="file" type="file" required><br>
	<input name="url" type="url" required placeholder="URL"><br>
    <input type="submit" value="Upload">
</form>
</body>
</html>