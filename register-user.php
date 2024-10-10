<?php

include_once "config.php";

$namaDepan = $_POST['namaDepan'];
$namaBelakang = $_POST['namaBelakang'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

function validateForm($namaDepan, $namaBelakang, $username, $email, $password, $conn) {

    $sql1 = "SELECT username, email FROM users WHERE username = '{$username}' OR email = '{$email}'";

    $result = $conn->query($sql1);

    // Tell user if username or email already taken.
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['username'] === $username) {
                echo "Username sudah digunakan.";
            } 
            if ($row['email'] === $email) {
                echo "Email sudah digunakan.";
            }
        }
    } else {
        //Insert data 
        $sql2 = "INSERT INTO users(username, email, password, nama_depan, nama_belakang, poin, level, map) VALUES ('{$username}','{$email}','{$password}','{$namaDepan}','{$namaBelakang}', 0, 1, 1)";
        
        if($conn->query($sql2) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: ". $sql2 . "<br>" . $conn->error;
        }
    }

    
}

validateForm($namaDepan, $namaBelakang, $username, $email, $password, $conn);