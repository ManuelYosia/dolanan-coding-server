<?php

include_once "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

function validateForm($email, $password, $conn) {

    $sql1 = "SELECT email, password FROM users WHERE email = '{$email}' AND password = '{$password}'";

    $result = $conn->query($sql1);

    // Tell user if login has successful
    if($result->num_rows > 0) {
        echo "Login successfully";
    } else {
        // Tell user if account doesn't exist.
        echo "User doesn't exist";
    }
}

validateForm($email, $password, $conn);