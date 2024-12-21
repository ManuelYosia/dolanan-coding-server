<?php

include_once "../config.php";
session_start();

header(
    'Access-Control-Allow-Origin: *'
);



function getTopUsers( $conn) {
    $response = [];
    $data = [];
    $sql1 = "SELECT username FROM users WHERE stars > 0 ORDER BY stars DESC  LIMIT 10";

    $result = $conn->query($sql1);

    if($result->num_rows > 0) {
        $response['status'] = 'true';
        $response['message'] = 'Success';
        while($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        $response['data'] = $data;
    } else {
        $response['status'] = 'false';
        $response['message'] = 'Failed';
    }
    

    echo json_encode($response);
}

getTopUsers( $conn);