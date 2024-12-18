<?php
include_once '../config.php';
session_start();

header(
    'Access-Control-Allow-Origin: *'
);

if(!isset($_POST['email'])) {
    $email = "";
} else {
    $email = $_POST['email'];
}

if(!isset($_POST['stars'])) {
    $additionStars = "";
} else {
    $additionStars = $_POST['stars'];
}

$response = [];

function updateUser($email, $additionStars, $conn) {
    // Get user current level and stars
    $sql1 = "SELECT level, stars FROM users WHERE email = '{$email}'";
    $result = $conn->query($sql1);
    $result = $result->fetch_assoc();
    $currentLevel = $result['level'];
    $currentStars = $result['stars'];

    // Current level + 1
    $currentLevel = $currentLevel + 1;
    // Current stars + addition stars
    $currentStars = $currentStars + $additionStars;

    // Update to database
    $sql2 = "UPDATE users SET level = {$currentLevel}, stars = {$additionStars} WHERE email = '{$email}'";

    // Get level
    $sql3 = "SELECT level FROM users WHERE email = '{$email}'";

    if($conn->query($sql2) === true) {
        $result = $conn->query($sql3);
        $result = $result->fetch_assoc();

        $response["status"] = "true";
        $response["messages"] = "Level and stars updated!";
        $response["data"]["level"] = $result["level"];
    } else {
        $response["status"] = "false";
        $response["messages"] = "Failed to update level";
    }

    echo json_encode($response);
}

updateUser($email, $additionStars, $conn);