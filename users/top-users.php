<?php

include_once "../config.php";
session_start();

header(
    'Access-Control-Allow-Origin: *'
);



function getTopUsers( $conn) {
    $response = [];
    $sql1 = "SELECT * FROM users WHERE stars > 0 ORDER BY stars DESC  LIMIT 10";

    $result = $conn->query($sql1);

    while($row = $result->fetch_assoc()) {
        array_push($response, $row);
    }

    echo json_encode($response);
}

getTopUsers( $conn);