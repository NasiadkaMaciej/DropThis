<?php
if (!isset($_SESSION["valid"])) {
	header("Location: /");
	exit;
}
?>

<body id="particles-js" ondrop="upload_file(event)" onload="loadFiles()" ondragover="return false">
	<script src="upload.js"></script>
	<div id="wrapper">
		<p onclick="logout()" style='color: red; cursor: pointer;'>LOG OUT</p>
		<p>Drop file anywhere</p>
		<p>or</p>
		<p><input type="button" value="Select Files" onclick="file_explorer();"></p>
		<input type="file" multiple id="selectfile"><br>
		<label for="onetime">One-time download?</label>
		<input type="checkbox" name="onetime" id="onetime">
		<p id="response">
		</p>