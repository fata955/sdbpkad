    <?php

    include "../lib/conn.php";
    // insert data to database
    session_start();
    if ($_GET["action"] === "insertData") {
        if (!empty($_POST["nm_pengguna"]) && !empty($_POST["username"]) && !empty($_POST["pwd_password"])  != 0) {
            $nama = mysqli_real_escape_string($conn, $_POST["nm_pengguna"]);
            $namauser = mysqli_real_escape_string($conn, $_POST["username"]);
            $passworduser = mysqli_real_escape_string($conn, $_POST["pwd_password"]);

            $sql = "SELECT username as nama from user where username='$namauser'";
            $koneksi = mysqli_query($conn, $sql);
            
            $cek = mysqli_num_rows($koneksi);
            if ($cek > 0) {
                $data = mysqli_fetch_array($koneksi);
                $us = $data['nama'];
            } else {
                $us = 'MARQIA';
            }

            if ($passworduser == $currentuser) {
                if ($us != $namauser) {
                    $salted_password = $passworduser . $tanggal;
                    $hashpassword = password_hash($salted_password, PASSWORD_BCRYPT);
                    $token = password_hash("BPKAD", PASSWORD_BCRYPT);

                    $sql = "INSERT INTO user (namalengkap,username,password,token,status,tanggal) VALUES ('$nama','$namauser','$hashpassword','$token','0','$tanggal')";
                    
                    if (mysqli_query($conn, $sql)) {
                        echo json_encode([
                            "statusCode" => 200,
                            "message" => "Data inserted successfully 😀"
                        ]);
                    } else {
                        echo json_encode([
                            "statusCode" => 500,
                            "message" => "Failed to insert data 😓"
                        ]);
                    }
                } else {
                    echo json_encode([
                        "statusCode" => 600,
                        "message" => "Nama Username sudah terdaftar 🙏"
                    ]);
                }
            } else {
                echo json_encode([
                    "statusCode" => 300,
                    "message" => "pengisian password tidak Sama 🙏"
                ]);
            }
        } else {
            echo json_encode([
                "statusCode" => 400,
                "message" => "Please fill all the required fields 🙏"

            ]);
        }
    }
