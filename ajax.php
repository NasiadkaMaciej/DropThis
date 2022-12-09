<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
session_start();
$server = "localhost";
$login = $db = "placeholder";
$password = "placeholder";
$connection = new mysqli($server, $login, $password, $db);

if (!isset($_SESSION["valid"])) {
	header("Location: /");
	exit;
}
if ($connection->connect_errno) {
	printf("Failed to connect to MySQL: ", $connection->connect_error);
	exit();
}

if (isset($_FILES['uploadFile'])) {
	//Generate random 6 letter file ID
	//Move file to storage
	//Upload ID and file name to database
	$filename = $_FILES['uploadFile']['name'];
	$filename = urldecode($filename);

	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$ID = "";
	for ($i = 0; $i < 6; $i++)
		$ID .= $characters[rand(0, strlen($characters) - 1)];

	move_uploaded_file($_FILES['uploadFile']['tmp_name'], '//placeholder//' . $ID . "-" . $filename);

	$stmt = $connection->prepare("INSERT INTO dropthis (ID, fileName) VALUES (?, ?)");
	$stmt->bind_param('ss', $ID, $filename);
	$stmt->execute();
	echo json_encode(array($_FILES['uploadFile']['name'], $ID));
} else if (isset($_POST["deleteItem"])) {
	//If file exists, proceed to remove it.
	//If not, return 500
	$stmt = $connection->prepare("SELECT * FROM dropthis WHERE ID=? limit 1");
	$stmt->bind_param('s', $_POST["deleteItem"]);
	$stmt->execute();
	$file = $stmt->get_result()->fetch_assoc()["fileName"];
	if ($file != null) {
		unlink("//placeholder//" . $_POST["deleteItem"] . "-" . $file);
		$stmt = $connection->prepare("DELETE FROM dropthis WHERE ID=?");
		$stmt->bind_param('s', $_POST["deleteItem"]);
		$stmt->execute();
	} else
		http_response_code(500);
	echo $file;
} else if (isset($_POST["getData"])) {
	//Get JSON with all files
	$query = "SELECT ID, fileName FROM dropthis ORDER BY Date";
	$result = $connection->query($query);
	$arr = [[]];
	$i = 0;
	while ($line = $result->fetch_assoc()) {
		$arr[$i] = [$line["fileName"], $line["ID"]];
		$i++;
	}
	echo json_encode($arr);
} else if (isset($_POST["logout"])) {
	unset($_SESSION["valid"]);
	unset($_POST["password"]);
} else {
	header("Location: /");
	exit;
}
