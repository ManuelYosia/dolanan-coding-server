<?php
include_once "../config.php";

header(
    'Access-Control-Allow-Origin: *'
);
header('Content-Type: application/json');

session_start();

if(!isset($_GET['accessToken'])) {
    $accessToken = "";

} else {
    $accessToken = $_GET['accessToken'];
}

$response = [];

$id = $_GET['level']; 

// Fetch the question and answer for the given ID
$sql = "SELECT * FROM soal WHERE id = {$id}";
$result = $conn->query($sql);

$response["data"] = $result->fetch_assoc();

// Return data as JSON
echo json_encode($response);
