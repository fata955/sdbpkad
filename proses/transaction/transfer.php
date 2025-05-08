<?php
include "../../lib/conn.php";
session_start();

// function to fetch data
if ($_GET["action"] === "spmaktif") {
    $sql = "SELECT a.id_spm,a.nomor_spm,a.nilai_spm,c.nama_opd as namaopd FROM tspm a, tspmsub b, skpd c where a.id_skpd=c.id_sipd AND a.id_spm=b.id_spm AND b.status='0'";
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

//cek Nomor Penguji terakhir


if ($_GET["action"] === "cekid"){
    $sql = "SELECT * FROM tbt_penguji order by id desc limit 1";
    $kode = mysqli_query($conn, $sql);
    $identitas1 = mysqli_fetch_array($kode);
    $kode1 = $identitas1['id'];
    $kode = $kode1 + 1 ;
    $kode = sprintf("%04d", $kode);
    // $identitas = mysqli_num_rows($kode);
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $kode
    ]);
}



if ($_GET["action"] === "data_spm"){

    $id = $_POST['idspm'];

    $sql = "SELECT * FROM tspm where id_spm='$id'";
    $data = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($data);
    // $data = $data['keterangan_spm'];
    $sql1= "SELECT (sum(nilai)) as nilaipotongan from potongan where id_spm='$id'";
    $data1 = mysqli_query($conn, $sql1);
    $data1 = mysqli_fetch_array($data1);
    $data1 = $data1['nilaipotongan'];

    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $data,
        "sum" => $data1
    ]);
}