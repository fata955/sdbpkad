<?php
include "../../lib/conn.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
    $sql = "SELECT id,id_sp_2_d,jenis_sp_2_d,nomor_sp_2_d,keterangan_sp_2_d,nama_sub_skpd,nilai_sp_2_d FROM sipd.registersp2d where status='0'";
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
    if (!empty($_POST["datasp2d"])) {
        $json = $_POST["datasp2d"];
        
        // $content = file_get_contents($jenis);
        //mengubah standar encoding
        // $content=utf8_encode($content);

        //mengubah data json menjadi data array asosiatif
        // $result=json_decode($content,true);
        $dt = json_decode($json, true);
        // for ($loop = 1; $loop <= $hal; $loop++) {
            // echo $dt;
            foreach ($dt as $row) {
                $id = $row['id_sp_2_d'];
                // echo $id;
                $data = mysqli_query($conn, "SELECT * FROM registersp2d where id_sp_2_d=$id") or die(mysqli_error($conn));
                $cek = mysqli_num_rows($data);
                if ($cek != null) {
                    return;
                } else {
                    $tarik = "INSERT INTO registersp2d (
                    id_sp_2_d,nomor_sp_2_d,id_spm,nomor_spm,tanggal_spm,tahun,id_skpd,nama_sub_skpd,nilai_sp_2_d,tanggal_sp_2_d,keterangan_sp_2_d,jenis_sp_2_d,jenis_ls_sp_2_d,keterangan_transfer_sp_2_d,status,id_user
                      )Values(
                        '" . $row["id_sp_2_d"] . "',
                        '" . $row["nomor_sp_2_d"] . "',
                        '" . $row["id_spm"] . "',
                        '" . $row["nomor_spm"] . "',
                        '" . $row["tanggal_spm"] . "',
                        '" . $row["tahun"] . "',
                        '" . $row["id_skpd"] . "',
                        '" . $row["nama_sub_skpd"] . "',
                        '" . $row["nilai_sp_2_d"] . "',
                        '" . $row["tanggal_sp_2_d"] . "',
                        '" . $row["keterangan_sp_2_d"] . "',
                        '" . $row["jenis_sp_2_d"] . "',
                        '" . $row["jenis_ls_sp_2_d"] . "',
                        '" . $row["keterangan_transfer_sp_2_d"] . "',
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
