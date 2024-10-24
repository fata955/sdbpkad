<?php
include "../../lib/conn.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
    $sql = "SELECT id,nomor_spm,keterangan_spm,nama_sub_skpd,nilai_spm,createby FROM sipd.t_spm where status='0'";
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
        
        // $content = file_get_contents($jenis);
        //mengubah standar encoding
        // $content=utf8_encode($content);

        //mengubah data json menjadi data array asosiatif
        // $result=json_decode($content,true);
        $dt = json_decode($jenis, true);
        // for ($loop = 1; $loop <= $hal; $loop++) {
            echo $dt;
            foreach ($dt as $row) {
                $id = $row['id_spm'];
                $data = mysqli_query($conn, "SELECT * FROM t_spm where id_spm=$id") or die(mysqli_error($conn));
                $cek = mysqli_num_rows($data);
                if ($cek != null) {
                    return;
                } else {
                    $tarik = "INSERT INTO t_spm (
                    id_spm,nomor_spm,nomor_spp,nilai_spm,tanggal_spm,keterangan_spm,jenis_spm,id_skpd,nama_sub_skpd,kode_sub_skpd,status,tahun,id_sumberdana,id_salur,id_user
                      )Values(
                        '" . $row["id_spm"] . "',
                        '" . $row["nomor_spm"] . "',
                        '" . $row["nomor_spp"] . "',
                        '" . $row["nilai_spm"] . "',
                        '" . $row["tanggal_spm"] . "',
                        '" . $row["keterangan_spm"] . "',
                        '" . $row["jenis_spm"] . "',
                        '" . $row["id_skpd"] . "',
                        '" . $row["nama_sub_skpd"] . "',
                        '" . $row["kode_sub_skpd"] . "',
                        '0',
                        '" . $row["tahun"] . "',
                        '0',
                        '0',
                        '0'
                      )";
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
