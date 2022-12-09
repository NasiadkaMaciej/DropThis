<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$server = "localhost";
$login = $db = "placeholder";
$password = "placeholder";
$ID = $_GET["f"];

$connection = new mysqli($server, $login, $password, $db);
$stmt = $connection->prepare("SELECT * FROM dropthis WHERE ID=? limit 1");
$stmt->bind_param('s', $_GET["f"]);
$stmt->execute();
$fileForUser = $stmt->get_result()->fetch_assoc()["fileName"];
$file = $ID . "-" . $fileForUser;

if ($file != null) {
    // headers to send your file
    header("Content-Type: application/jpeg");
    header("Content-Length: " . filesize("//placeholder//" . $file));
    header('Content-Disposition: filename="' . $fileForUser . '"');

    // upload the file to the user and quit
    ob_clean();
    flush();
    readfile("//placeholder//" . $file);
    #header('Location: https://dropthis.ml/u/'.$url);
}
