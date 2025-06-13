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
    $sql1= "SELECT (sum(nilai)) as nilaipotongan, 
    (select nilai from potongan where id_spm='$id' AND uraian like '%PPH 21%') as PPH_21,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Iuran Wajib Pegawai 8%') as IWP8, 
    (select nilai from potongan where id_spm='$id' AND uraian like '%Iuran Jaminan Kesehatan 4%') as IJK4,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Iuran Jaminan Kecelakaan Kerja%') as JKK,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Iuran Jaminan Kematian%') as JKM,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Iuran Wajib Pegawai 1%') as IWP1,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Tamperum%') as tamperum,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Taspen%') as taspen,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Beras (BULOG)%') as beras,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Zakat%') as zakat,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Pajak Pertambahan Nilai%') as PPN,
    (select nilai from potongan where id_spm='$id' AND uraian like '%Pajak Penghasilan Ps 22%') as pph22

    from potongan where id_spm='$id'";
    $data1 = mysqli_query($conn, $sql1);
    $data1 = mysqli_fetch_array($data1);
    $sum = $data1['nilaipotongan'];
    $pph = $data1['PPH_21'];
    $iwp8 = $data1['IWP8'];
    $ijk4 = $data1['IJK4'];
    $jkk = $data1['JKK'];
    $jkm = $data1['JKM'];
    $iwp1 = $data1['IWP1'];
    $tamperum = $data1['tamperum'];
    $taspen = $data1['taspen'];
    $beras = $data1['beras'];
    $zakat = $data1['zakat'];
    $ppn = $data1['PPN'];
    $pph22 = $data1['pph22'];

    // $sql2 = "SELECT nilai from potongan where id_spm='$id' AND uraian like '%PPH 21%'";

    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $data,
        "sum" => $sum,
        "pph" => $pph,
        "iwp8" => $iwp8,
        "ijk4" => $ijk4,
        "jkk" => $jkk,
        "jkm" => $jkm,
        "iwp" => $iwp1,
        "tamperum" => $tamperum,
        "taspen" => $taspen,
        "beras" => $beras,
        "zakat" => $zakat,
        "ppn" => $ppn,
        "pph22" => $pph22,
    ]);
}

