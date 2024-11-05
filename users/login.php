<?php

include_once "../config.php";

if(!isset($_POST['email'])) {
    $email = "";
} else {
    $email = $_POST['email'];
}

if(!isset($_POST['password'])) {
    $password = "";
} else {
    $password = $_POST['password'];
}

// LOGIN
/*
    Step:
    1. Menerima data dari form (email, username, password)
    2. Membaca data [login]
    3. Melakukan validasi data form: apakah ada data null/kosong? => Jika kosong maka memberi respon "data tidak boleh kosong" [login] > [validateForm]
    4. Melakukan validasi data : apakah ada data yang sesuai pada database? => Jika tidak sesuai maka memberi respon "akun tidak ditemukan" [login]
    5. Jika dari kedua validasi diatas kondisi tidak terpenuhi maka memberi respon "berhasil login" dan memulai sesi [login]
*/

function login($email, $password, $conn) {
    
    $response = [];

    $validateFormResult = validateForm($email, $password);

    if($validateFormResult["status"] === false) {
        $response = $validateFormResult; 
    } else {
        // Melakukan validasi data: apakah data sesuai dan tersedia di database?
        /* Step:
            1. Mengambil data dari database pada tabel users yang dimana harus memiliki email dan password yang sama
            2. Jika tidak ditemukan user dengan email dan password tersebut maka menampilkan error "Email atau password tidak sesuai"
            3. Jika ditemukan user dengan email dan password tersebut maka akan memberikan token untuk mengakses 
        */ 

        $sql1 = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'";

        $result = $conn->query($sql1);

        if($result->num_rows > 0) {
            // Memulai sesi dan memberikan token untuk akses
            $accessToken = startSession();
            $response = $validateFormResult;

            $response["accessToken"] = $accessToken; 
            $response["email"] = $email;

            //header("location: index.php");
        } else {
            $response["status"] = false;
            $response["messages"] = "Email atau password tidak sesuai";
        }
    }

    echo json_encode($response);
}

function validateForm($email, $password) {
    
    $result = [];

    if($email === "") {
        $result["status"] = false;
    } 

    if($password === "") {
        $result["status"] = false;
    }

    if($email !== "" && $password !== "") {
        $result["status"] = true;
        $result["messages"] = "Berhasil login"; 
    }

    return $result;
}

function startSession() {
    session_start();
    
    // generate new session id
    $newid = session_create_id();
    
    // Finish current session
    session_commit();
    
    // Set new custom session ID
    session_id($newid);
    
    // Start with custom session ID
    session_start();

    return $newid;
}

login($email, $password, $conn);