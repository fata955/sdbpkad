<?php
include "../../lib/conn.php";
session_start(); 

// function to fetch data
if ($_GET["action"] === "fetchData") {
    $sql = "SELECT a.nomor_spm,a.keterangan_spm,b.nama_opd,a.nilai_spm,a.tanggal_spm,a.createby as tanggal_masuk FROM tspm a , skpd b ,tspmsub c where b.id_sipd=a.id_skpd AND a.id_spm=c.id_spm AND c.status=0";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $data
    ]);
}

if ($_GET["action"] === "insertData") {
    if (!empty($_POST["dataspm"])) {
        $jenis = $_POST["dataspm"];
        $dt = json_decode($jenis, true);
        // for ($loop = 1; $loop <= $hal; $loop++) {
            echo $dt;
            foreach ($dt as $row) {
                $id = $row['id_spm'];
                $tanggal = $row['tanggal_spm'];
                $start_position = 0; // Mulai dari karakter ke-8 (indeks mulai dari 0) 
                $number_of_characters = 10; 
                $tgl = substr($tanggal, $start_position, $number_of_characters);

                $data = mysqli_query($conn, "SELECT * FROM tspm where id_spm=$id") or die(mysqli_error($conn));
                $cek = mysqli_num_rows($data);
                if ($cek != null) {
                    return;
                } else {
                    $tarik = "INSERT INTO tspm (
                    id_spm,nomor_spm,keterangan_spm,nilai_spm,tanggal_spm,id_skpd,jenis
                      )Values(
                        '" . $row["id_spm"] . "',
                        '" . $row["nomor_spm"] . "',
                        '" . $row["keterangan_spm"] . "',
                        '" . $row["nilai_spm"] . "',
                        '$tgl',
                        '" . $row["id_skpd"] . "',
                        '" . $row["jenis_spm"] . "'
                      )";

                        $table2 = "INSERT INTO tspmsub (id_spm,status,id_sumber,id_user,id_dana) VALUES ($id,0,0,0,0)";
                        $eksekusi = mysqli_query($conn, $table2);

                    if (mysqli_query($conn, $tarik)) {
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
                }
            // }
        }
    } else {
        echo json_encode([
            "statusCode" => 400,
            "message" => "Please fill all the required fields 🙏"
        ]);
    }
}
