<?php
include_once "../config.php";

session_start();

if(!isset($_GET['accessToken'])) {
    $accessToken = "";

    echo "Tidak ditemukan data token akses\n";
} else {
    $accessToken = $_GET['accessToken'];
}

if(!isset($_GET['email'])) {
    $email = "";

    echo "Tidak ditemukan data email\n";
} else {
    $email = $_GET['email'];
}

$response = [];

if($accessToken === session_id()) {
    $getUserResult = getUser($email, $conn);
    $response["status"] = true;
    $response["data"] = $getUserResult;
    
    echo json_encode($response);
} else {
    $response["code"] = "401";
    $response["status"] = false;
    $response["messages"] = "Silahkan login";

    echo json_encode($response);
}


// MENGAMBIL DATA USER
/*
    Step:
    1. Cek apakah request berasal dari client yang memiliki akses token
    2. => Jika tidak maka berikan respon redirect dan "Silahkan login"
    3. => Jika memiliki akses token maka berikan respon data user dari database
*/

function getUser($email ,$conn) {
    /*
        Step:
        1. Deklarasikan query untuk mengambil data
        2. Lakukan request ke database menggunakan query
        3. => Jika ditemukan data yang sesuai maka berikan data sebagai respon
        4. => Jika tidak ditemukan data yang sesuai maka berikan respon error
    */ 

    $sql1 = "SELECT * FROM users WHERE email = '{$email}'";

    $result = $conn->query($sql1);

    if($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan";
        return;
    }
}

