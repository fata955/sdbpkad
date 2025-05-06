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
    $sql = "SELECT * FROM tbt_penguji";
    

    $kode = mysqli_query($conn, $sql);
    $identitas = mysqli_num_rows($kode);

    if ($identitas == null) {
        $kode = "10101";
    }else{
        $sql1 = "SELECT * FROM tbt_penguji order by id asc limit 1";
        $kode = mysqli_query($conn, $sql1);
        $identitas = mysqli_fetch_array($kode);
        $kode =$identitas['id'];
        $kode = $kode++;
    }
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $kode
    ]);
}

if ($_GET["action"] === "dataspm"){
    
}