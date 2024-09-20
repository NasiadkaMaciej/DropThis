<?php
session_start();
$ID = $_GET["f"];
include("config.php");
$connection = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$stmt = $connection->prepare("SELECT * FROM dropthis WHERE ID=? limit 1");
$stmt->bind_param('s', $_GET["f"]);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$fileForUser = $result["fileName"];
$oneTime = $result["oneTime"];
$file = $ID . "-" . $fileForUser;

if (!$fileForUser ) {
//  echo "File not found";
    header('Location: https://drop.nasiadka.pl/404');
    die();
}

if ($file != null) {
    if (!file_exists($STORAGE . $file)){
//      echo "File not found";
	header('Location: https://drop.nasiadka.pl/404');
        die();
    }
    // headers to send your file
    header("Content-Type: application/octet-stream"); 
    header("Content-Length: " . filesize($STORAGE . $file));
    header('Content-Disposition: attachment; filename="' . $fileForUser . '"');

    // upload the file to the user and quit
    ob_clean();
    readfile($STORAGE . $file);
    flush();
    //header('Location: https://dropthis.ml/u/'.$url);
}

if($oneTime == 1){
	if (!preg_match('/^[a-zA-Z0-9]{6}$/', $ID)) {
		// Handle invalid input
		http_response_code(400); // Bad Request
		exit;
	}
	$stmt = $connection->prepare("SELECT * FROM dropthis WHERE ID=? limit 1");
	$stmt->bind_param('s', $ID);
	$stmt->execute();
	$file = $stmt->get_result()->fetch_assoc()["fileName"];
	if ($file != null) {
		unlink($STORAGE . $ID . "-" . $file);
		$stmt = $connection->prepare("DELETE FROM dropthis WHERE ID=?");
		$stmt->bind_param('s', $ID);
		$stmt->execute();
	} else
		http_response_code(500);
	echo $file;
}