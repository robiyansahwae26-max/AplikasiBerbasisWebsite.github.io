<?php
session_start();
include "database.php";
extract($_POST);

$user = htmlspecialchars($username, true);
    // $pass = htmlspecialchars(md5($password), true);
    $pass = htmlspecialchars($password, true);
    
    $qry = mysqli_query($koneksi, "SELECT * FROM user WHERE username='" . $user . "'");
    $data = mysqli_fetch_array($qry);
    if ($data) {
        if ($pass == $data['password']) {
            $_SESSION["username"] = $data["username"];
            $_SESSION["title"] = $data['title'];
          
            $output = [
                'kode' => 0,
                'pesan' => "Login Berhasil !!! <meta http-equiv='refresh' content='0; url=index.php'>",
            ];
        } else {
            $output = [
                'kode' => 0,
                'pesan' => 'Password Salah !!!',
            ];
        }
    } else {
        $output = [
            'kode' => 0,
            'pesan' => 'Username Tidak Teraftar',
        ];
    }

    echo json_encode($output);

?>