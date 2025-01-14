<?php

include "../lib/conn.php";
session_start(); 

if ($_GET["action"] === "LoginData") {
    if (!empty($_POST["username"]) && !empty($_POST["password"])  != 0) {
        $namauser = mysqli_real_escape_string($conn, $_POST["username"]);
        $passworduser = $_POST["password"];
        // cek data
        $sql = mysqli_query($conn, "SELECT namalengkap as lengkap, username as nama, password as katasandi, status, level from user where username='$namauser'") or die(mysqli_error($conn));
        $rows = mysqli_num_rows($sql);

        if ($rows > 0) {
            $data = mysqli_fetch_array($sql);
            $namalengkap = $data["lengkap"];
            $user = $data["nama"];
            $pass = $data["katasandi"];
            $status = $data["status"];
            $level = $data["level"];

            $salted_password = $passworduser;

            if ($status == '0') {
                echo json_encode([
                    "statusCode" => 500,
                    "message" => "user Anda Belum di Approve, Hubungi Admin 🙏"
                ]);
            } else {
                if (password_verify($salted_password, $pass)) {
                    $_SESSION["lengkap"] = $namalengkap;
                    $_SESSION["username"] = $namauser;
                    $_SESSION["level"] = $level;
                    echo json_encode([
                        "statusCode" => 200,
                        "message" => "Anda Sukses Login 🙏"
                    ]);
                } else {
                    session_unset();
                    echo json_encode([
                        "statusCode" => 300,
                        "message" => "Password Anda Salah 🙏"
                    ]);
                }
            }

        } else {
            echo json_encode([
                "statusCode" => 600,
                "message" => "Username tidak ditemukan 🙏"
            ]);
        }
    } else {
        echo json_encode([
            "statusCode" => 400,
            "message" => "Please fill all the required fields 🙏"

        ]);
    }
}
