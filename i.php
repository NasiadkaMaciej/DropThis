<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$ID = $_GET["f"];
include("config.php");
$connection = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$stmt = $connection->prepare("SELECT * FROM dropthis WHERE ID=? limit 1");
$stmt->bind_param('s', $_GET["f"]);
$stmt->execute();
$fileForUser = $stmt->get_result()->fetch_assoc()["fileName"];
$file = $ID . "-" . $fileForUser;

if ($file != null) {
    // headers to send your file
    header("Content-Type: application/octet-stream"); 
    header("Content-Length: " . filesize($STORAGE . $file));
    header('Content-Disposition: attachment; filename="' . $fileForUser . '"');

    // upload the file to the user and quit
    ob_clean();
    flush();
    readfile($STORAGE . $file);
    #header('Location: https://dropthis.ml/u/'.$url);
}
