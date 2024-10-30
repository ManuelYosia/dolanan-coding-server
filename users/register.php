<?php

include_once "../config.php";

if(!isset($_POST['namaDepan'])) {
    $namaDepan = "";
} else {
    $namaDepan = $_POST['namaDepan'];
}

if(!isset($_POST['namaBelakang'])) {
    $namaBelakang = "";
} else {
    $namaBelakang = $_POST['namaBelakang'];
}

if(!isset($_POST['username'])) {
    $username = "";
} else {
    $username = $_POST['username'];
}

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

$namaDepan = $_POST['namaDepan'];
$namaBelakang = $_POST['namaBelakang'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// REGISTER
/* 
    Step:
    1. Menerima data dari form
    2. Membaca data [register]
    3. Melakukan validasi data form: apakah ada data null/kosong? => jika kosong maka tampilkan error "Field tidak boleh kosong" [register] > [validateForm]
    4. Melakukan validasi data: apakah ada data yang sesuai pada database? => jika tidak ditemukan data (belum ada user dengan data tersebut) maka tambahkan user dengan data tersebut 
    => jika ditemukan data (sudah ada user dengan data tersebut: email dan username yang sama) maka tampilkan error "Gunakan email atau username yang lain" [register]
    5. Jika user berhasil ditambahkan maka beri pesan "User berhasil dibuat" [register]
*/

function register($namaDepan, $namaBelakang, $username, $email, $password, $conn) {
    $response = [];

    $validateFormResult = validateForm($namaDepan, $namaBelakang, $username, $email, $password); 
    
    if($validateFormResult["status"] === false) {
        $response = $validateFormResult;
    } else {
        // Melakukan validasi data: apakah ada data yang sesuai pada database? => jika tidak ditemukan data (belum ada user dengan data tersebut) maka tambahkan user dengan data tersebut 
        // => jika ditemukan data (sudah ada user dengan data tersebut: email dan username yang sama) maka tampilkan error "Gunakan email atau username yang lain" [register]
        /* Step:
            1. Mengambil data dari database pada tabel users yang dimana harus memiliki email atau username yang sama
            2. => Jika ditemukan email atau username yang sama dengan data maka tampilkan error "Email telah digunakan" atau "Username telah digunakan"
            3. => Jika tidak ditemukan maka buat user dengan data yang diberikan
        */
        $sql1 = "SELECT username, email FROM users WHERE username = '{$username}' OR email = '{$email}'";

        $result = $conn->query($sql1);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row['username'] === $username) {
                    $response["usernameStatus"] = "taken";
                } 
                if ($row['email'] === $email) {
                    $response["emailStatus"] = "taken";
                }
            }
        } else {
            $sql2 = "INSERT INTO users(username, email, password, nama_depan, nama_belakang, poin, level, map) VALUES ('{$username}','{$email}','{$password}','{$namaDepan}','{$namaBelakang}', 0, 1, 1)";
        
            if($conn->query($sql2) === true) {
                $response["status"] = "success";

                
            } else {
                echo "Error: ". $sql2 . "<br>" . $conn->error;
            }
        }

    }

    echo json_encode($response);
}

function validateForm($namaDepan, $namaBelakang, $username, $email, $password) {
    $result = [];

    if($namaDepan === "") {
        $result["status"] = false;
        $result["messages"]["errorNamaDepan"] = "Nama depan tidak boleh kosong";
    } 

    if($namaBelakang === "") {
        $result["status"] = false;
        $result["messages"]["errorNamaBelakang"] = "Nama belakang tidak boleh kosong";
    }

    if($username === "") {
        $result["status"] = false;
        $result["messages"]["errorUsername"] = "Username tidak boleh kosong";
    } 

    if($email === "") {
        $result["status"] = false;
        $result["messages"]["errorEmail"] = "Email tidak boleh kosong";
    } 

    if($password === "") {
        $result["status"] = false;
        $result["messages"]["errorPassword"] = "Password tidak boleh kosong";
    }

    if($namaDepan !== "" && $namaBelakang !=="" && $username !== "" && $email !== "" && $password !== "") {
        $result["status"] = true;
        $result["messages"] = "User berhasil dibuat"; 
    }

    return $result;
}

register($namaDepan, $namaBelakang, $username, $email, $password, $conn);