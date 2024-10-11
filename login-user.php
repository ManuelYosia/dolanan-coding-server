<?php

include_once "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

function validateForm($email, $password, $conn) {

    $sql1 = "SELECT * FROM users WHERE email = '{$email}'";

    $result = $conn->query($sql1);

    $response = [];

    // Tell user if login has successful
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["password"] != $password) {
                $response["status"] = "failed";
                $response["massage"] = "Password not match!";
            } else {
                $response["status"] = "success";
                $response["massage"] = "User found!";
                $response["userId"] = $row["id"];
            }
        }
    } else {
        // Tell user if account doesn't exist.
        $response["status"] = "failed";
        $response["massage"] = "User doesn't exist!";
    }

    echo json_encode($response);
}

validateForm($email, $password, $conn);