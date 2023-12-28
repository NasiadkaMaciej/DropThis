<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DropThis</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<script src="particles.js"></script>
	<script>
		particlesJS.load('particles-js', 'particles.json', function() {
			console.log('callback - particles.js config loaded');
		});
	</script>
</head>
<?php
session_start();
include("config.php");
if (isset($_POST["logout"])) {
    // Unset specific session variables
    unset($_SESSION["valid"]);
    unset($_POST["password"]);
    session_destroy();
    header("Location: /");
    exit;
}

if (isset($_POST["password"]) || isset($_SESSION["valid"])) {
	if ($_POST["password"] == $PASSWORD || isset($_SESSION["valid"])) {
		$_SESSION['valid'] = true;
		include("upload.php");
	} else {
		echo "<p id=error style='color: red;'>WRONG</p>";
		if ($_SESSION['errCount'] > 2) {
			header("Location: " . "403");
			exit();
		}
		$_SESSION['errCount'] += 1;
		include("login.html");
	}
} else
	include("login.html");

?>
</body>

</html>