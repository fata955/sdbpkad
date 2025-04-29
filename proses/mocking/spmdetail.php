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
    if (!empty($_POST["dataspmdetail"])) {
        $dataspmdetail = $_POST["dataspmdetail"];
        $idsp2d = $_POST["idsp2d"];
        $dt = json_decode($dataspmdetail, true);
        $idl = $dt['jenis'];

        save($idsp2d, $idl);

        echo json_encode([
            "statusCode" => 200,
            "message" => "Data Sukses Tersimpan 🙏"
        ]);

        // }
    } else {
        echo json_encode([
            "statusCode" => 400,
            "message" => "Please fill all the required fields 🙏"
        ]);
    }
}


function save($id, $jenis)
{
    $servername = "localhost";
    $username = "root";
    $password = "nadirad3mi208";
    $database = "spm";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJTSVBEX0FVVEhfU0VSVklDRSIsInN1YiI6IjEzNDQ0Ni4zNDIiLCJleHAiOjE3MjUzNjI0NDQsImlhdCI6MTcyNTE0NjQ0NCwidGFodW4iOjIwMjQsImlkX3VzZXIiOjEzNDQ0NiwiaWRfZGFlcmFoIjozNDIsImtvZGVfcHJvdmluc2kiOiI3MiIsImlkX3NrcGQiOjAsImlkX3JvbGUiOjExLCJpZF9wZWdhd2FpIjoxMjYyNDgsInN1Yl9kb21haW5fZGFlcmFoIjoicGFsdSJ9.XyYIS3yULX63_B1bZCL0tgH-EXyZNoQ04A63WgbK8HA';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";


    $jenis1 = $jenis;


    if ($jenis1 == "LS") {
        
        $dataspmdetail = $_POST["dataspmdetail"];
        $dt = json_decode($dataspmdetail, true);

        $jenis = $dt["jenis"];
        $tahun = $dt["ls"]["header"]["tahun"];
        $nomor_spm = $dt["ls"]["header"]["nomor_spm"];
        $tanggal_spm = $dt["ls"]["header"]["tanggal_sp_2_d"];
        $nama_skpd = $dt["ls"]["header"]["nama_skpd"];
        $nama_sub_skpd = $dt["ls"]["header"]["nama_sub_skpd"];
        $nama_pihak_ketiga = $dt["ls"]["header"]["nama_pihak_ketiga"];
        $no_rek_pihak_ketiga = $dt["ls"]["header"]["no_rek_pihak_ketiga"];
        $nama_rek_pihak_ketiga = $dt["ls"]["header"]["nama_rek_pihak_ketiga"];
        $bank_pihak_ketiga = $dt["ls"]["header"]["bank_pihak_ketiga"];
        $npwp_pihak_ketiga = $dt["ls"]["header"]["npwp_pihak_ketiga"];
        $keterangan_spm = $dt["ls"]["header"]["keterangan_spm"];
        $nilai_spm = $dt["ls"]["header"]["nilai_spm"];
        $nomor_spp = $dt["ls"]["header"]["nomor_spp"];
        $tanggal_spp = $dt["ls"]["header"]["tanggal_spp"];
        $nama_ibu_kota = $dt["ls"]["header"]["nama_ibu_kota"];
        $nama_pa_kpa = $dt["ls"]["header"]["nama_pa_kpa"];
        $nip_pa_kpa = $dt["ls"]["header"]["nip_pa_kpa"];
        $jabatan_pa_kpa = $dt["ls"]["header"]["jabatan_pa_kpa"];
        // $jabatan_bud_kbud = $dt["ls"]["header"]["jabatan_bud_kbud"];
        $dasarpembayaran = $dt["ls"]["dasar_pembayaran"];
        $detail = $dt["ls"]["detail"];
        $pajak_potongan = $dt["ls"]["pajak_potongan"];

        $idskpd = mysqli_query($conn,"SELECT id_sipd FROM skpd where nama_opd='$nama_skpd'")or die(mysqli_error($conn));
        $idskpd = mysqli_fetch_array($idskpd);
        $id_skpd = $idskpd['id_sipd'];

        $data = mysqli_query($conn, "SELECT * FROM tspm where idhalaman=$id") or die(mysqli_error($conn));
        $hal = mysqli_num_rows($data);


        if ($hal != null) {
            echo "<h1>DATA SUDAH TERINPUT</h1>";
        } else {
            $angka1 = str_replace("'", "", $no_rek_pihak_ketiga);
            $keteranganspm = str_replace("'", "", $keterangan_spm);
            $namapenerima = str_replace("'", "", $nama_pihak_ketiga);
            $namarekening = str_replace("'", "",  $nama_rek_pihak_ketiga);
            // $namapihakketiga = str_replace("'", "",  $nama_pihak_ketiga);
            $spm = mysqli_query(
                $conn,
                "INSERT INTO tspm (
                    nomor_spm,
                    tanggal_spm,
                    id_skpd,
                    keterangan_spm,
                    nilai_spm,
                    no_rek_pihak_ketiga,
                    nama_rek_pihak_ketiga,
                    bank_pihak_ketiga,
                    npwp_pihak_ketiga,
                    nama_pa_kpa,
                    nip_pa_kpa,
                    jabatan_pa_kpa,
                    nomor_spp,
                    tanggal_spp,
                    jenis )Values(
                            '$nomor_spm',
                            '$tanggal_spm',
                            '$id_skpd',
                            '$keteranganspm',
                            '$nilai_spm',
                            '$no_rek_pihak_ketiga',
                            '$namarekening',
                            '$bank_pihak_ketiga',
                            '$npwp_pihak_ketiga',
                            '$nama_pa_kpa',
                            '$nip_pa_kpa',
                            '$jabatan_pa_kpa',
                            '$nomor_spp',
                            '$tanggal_spp',
                            '$jenis1'
                        )"
            ) or die(mysqli_error($conn));

            foreach ($detail as $row) {
                $belanja = "INSERT INTO belanja (
                        norekening,
                        uraian,
                        nilai,
                        id_spm
                        )VALUES (
                        '" . $row["kode_rekening"] . "',
                        '" . $row["uraian"] . "',
                        '" . $row["jumlah"] . "',
                        '$id'
                        )";
                $exbelanja = mysqli_query($conn, $belanja) or die(mysqli_error($conn));
            }

            if ($pajak_potongan == null) {
                echo json_encode([
                    "statusCode" => 500,
                    "message" => "Data tidak punya potongan 😀"
                ]);
            } else {
                foreach ($pajak_potongan as $row1) {
                    $billing = str_replace("'", "", $row1["id_billing"]);
                    $potonganpjk = "INSERT INTO potongan (
                                    uraian,
                                    nilai,
                                    id_sp2d,
                                    billing
                                )VALUES (
                                    '" . $row1["nama_pajak_potongan"] . "',
                                    '" . $row1["nilai_sp2d_pajak_potongan"] . "',
                                    '$id',
                                    '$billing'
                                )";
                    $expotongan = mysqli_query($conn, $potonganpjk) or die(mysqli_error($conn));
                }
            }
            echo json_encode([
                "statusCode" => 200,
                "message" => "Data inserted successfully 😀"
            ]);
        }
    } elseif ($jenis1 == "GU") {
        $data = mysqli_query($conn, "SELECT * FROM sp2d where idhalaman=$id") or die(mysqli_error($conn));
        $hal = mysqli_num_rows($data);
        if ($hal != null) {
            echo json_encode([
                "statusCode" => 500,
                "message" => "Data Sudah Ada 😓"
            ]);
        } else {
            $datasp2dlra = $_POST["datasp2d"];
            $dt = json_decode($datasp2dlra, true);


            $jenis = $dt["jenis"];
            $tahun = $dt["gu"]["tahun"];
            $rekening = $dt["gu"]["nomor_rekening"];
            $nama_bank = $dt["gu"]["nama_bank"];
            $nomor_sp_2_d = $dt["gu"]["nomor_sp_2_d"];
            $tanggal_sp_2_d = $dt["gu"]["tanggal_sp_2_d"];
            $nama_skpd = $dt["gu"]["nama_skpd"];
            $keterangan_sp2d = $dt["gu"]["keterangan_sp2d"];
            $nilai_sp2d = $dt["gu"]["nilai_sp2d"];
            $nomor_spm = $dt["gu"]["nomor_spm"];
            $tanggal_spm = $dt["gu"]["tanggal_spm"];
            $nama_ibu_kota = $dt["gu"]["nama_ibu_kota"];
            $nama_bud_kbud = $dt["gu"]["nama_bud_kbud"];
            $nip_bud_kbud = $dt["gu"]["nip_bud_kbud"];
            $jabatan_bud_kbud = $dt["gu"]["jabatan_bud_kbud"];
            $nama_bp_bpp = $dt["gu"]["nama_bp_bpp"];
            $nip_bp_bpp = $dt["gu"]["nip_bp_bpp"];
            $jabatan_bp_bpp = $dt["gu"]["jabatan_bp_bpp"];
            $no_rek_bp_bpp = $dt["gu"]["no_rek_bp_bpp"];
            $nama_rek_bp_bpp = $dt["gu"]["nama_rek_bp_bpp"];
            $bank_bp_bpp = $dt["gu"]["bank_bp_bpp"];
            $npwp_bp_bpp = $dt["gu"]["npwp_bp_bpp"];
            $detail_belanjagu = $dt["gu"]["detail"];

            // $kode = $detail_belanja['kode_rekening'];
            // $uraian = $detail_belanja['uraian'];
            // $jumlah = $detail_belanja['jumlah'];

            // $nm_potongan = $pajak_potongan['nama_pajak_potongan'];
            // $biling = $pajak_potongan['id_billing'];
            // $nilaipotongan = $pajak_potongan['nilai_sp2d_pajak_potongan'];

            $sp2d = mysqli_query(
                $conn,
                "INSERT INTO sp2d (
                        idhalaman,
                        jenis,
                        tahun,
                        nomor_rekening,
                        nama_bank,
                        nomor_sp2d,
                        tanggal_sp2d,
                        nama_skpd,
                        nama_sub_skpd,
                        nama_pihak_ketiga,
                        no_rek_pihak_ketiga,
                        nama_rek_pihak_ketiga,
                        bank_pihak_ketiga,
                        npwp_pihak_ketiga,
                        keterangan_sp2d,
                        nilai_sp2d,
                        nomor_spm,
                        tanggal_spm,
                        nama_ibu_kota,
                        nama_bud_kbud,
                        nip_bud_kbud,
                        jabatan_bud_kbud,
                        nama_bp_bpp,
                        nip_bp_bpp,
                        jabatan_bp_bpp,
                        no_rek_bp_bpp,
                        nama_rek_bp_bpp,
                        bank_bp_bpp,
                        npwp_bp_bpp,
                        id_sumber_sub,
                        id_opd,
                        status
                        )Values(
                            '$id',
                            '$jenis',
                            '$tahun',
                            '$rekening',
                            '$nama_bank',
                            '$nomor_sp_2_d',
                            '$tanggal_sp_2_d',
                            '$nama_skpd',
                            '0',
                            '0',
                            '0',
                            '0',
                            '0',
                            '0',
                            '$keterangan_sp2d',
                            '$nilai_sp2d',
                            '$nomor_spm',
                            '$tanggal_spm',
                            '$nama_ibu_kota',
                            '$nama_bud_kbud',
                            '$nip_bud_kbud',
                            '$jabatan_bud_kbud',
                            '$nama_bp_bpp',
                            '$nip_bp_bpp',
                            '$jabatan_bp_bpp',
                            '$no_rek_bp_bpp',
                            '$nama_rek_bp_bpp',
                            '$bank_bp_bpp',
                            '$npwp_bp_bpp',
                            '0',
                            '0',
                            '0'
                        )"
            ) or die(mysqli_error($conn));

            foreach ($detail_belanjagu as $row) {
                $belanja = "INSERT INTO belanja (
                            norekening,
                            uraian,
                            nilai,
                            id_sp2d
                            )VALUES (
                            '" . $row["kode_rekening"] . "',
                            '" . $row["uraian"] . "',
                            '" . $row["nilai"] . "',
                            '$id'
                            )";
                $exbelanja = mysqli_query($conn, $belanja) or die(mysqli_error($conn));
            }

            echo json_encode([
                "statusCode" => 200,
                "message" => "Data inserted successfully 😀"
            ]);
        }
    } elseif ($jenis1 == "UP") {
        $data = mysqli_query($conn, "SELECT * FROM sp2d where idhalaman=$id") or die(mysqli_error($conn));
        $hal = mysqli_num_rows($data);
        if ($hal != null) {
            echo json_encode([
                "statusCode" => 500,
                "message" => "Data sudah Terinput 😀"
            ]);
        } else {
            $datasp2dlra = $_POST["datasp2d"];
            $dt = json_decode($datasp2dlra, true);

            $jenis = $dt["jenis"];
            $tahun = $dt["up"]["tahun"];
            $rekening = $dt["up"]["nomor_rekening"];
            $nama_bank = $dt["up"]["nama_bank"];
            $nomor_sp_2_d = $dt["up"]["nomor_sp_2_d"];
            $tanggal_sp_2_d = $dt["up"]["tanggal_sp_2_d"];
            $nama_skpd = $dt["up"]["nama_skpd"];
            $keterangan_sp2d = $dt["up"]["keterangan_sp2d"];
            $nilai_sp2d = $dt["up"]["nilai_sp2d"];
            $nomor_spm = $dt["up"]["nomor_spm"];
            $tanggal_spm = $dt["up"]["tanggal_spm"];
            $nama_ibu_kota = $dt["up"]["nama_ibu_kota"];
            $nama_bud_kbud = $dt["up"]["nama_bud_kbud"];
            $nip_bud_kbud = $dt["up"]["nip_bud_kbud"];
            $jabatan_bud_kbud = $dt["up"]["jabatan_bud_kbud"];
            $nama_bp_bpp = $dt["up"]["nama_bp_bpp"];
            $nip_bp_bpp = $dt["up"]["nip_bp_bpp"];
            $jabatan_bp_bpp = $dt["up"]["jabatan_bp_bpp"];
            $no_rek_bp_bpp = $dt["up"]["no_rek_bp_bpp"];
            $nama_rek_bp_bpp = $dt["up"]["nama_rek_bp_bpp"];
            $bank_bp_bpp = $dt["up"]["bank_bp_bpp"];
            $npwp_bp_bpp = $dt["up"]["npwp_bp_bpp"];

            // $kode = $detail_belanja['kode_rekening'];
            // $uraian = $detail_belanja['uraian'];
            // $jumlah = $detail_belanja['jumlah'];

            // $nm_potongan = $pajak_potongan['nama_pajak_potongan'];
            // $biling = $pajak_potongan['id_billing'];
            // $nilaipotongan = $pajak_potongan['nilai_sp2d_pajak_potongan'];

            $sp2d = mysqli_query(
                $conn,
                "INSERT INTO sp2d (
                            idhalaman,
                            jenis,
                            tahun,
                            nomor_rekening,
                            nama_bank,
                            nomor_sp2d,
                            tanggal_sp2d,
                            nama_skpd,
                            nama_sub_skpd,
                            nama_pihak_ketiga,
                            no_rek_pihak_ketiga,
                            nama_rek_pihak_ketiga,
                            bank_pihak_ketiga,
                            npwp_pihak_ketiga,
                            keterangan_sp2d,
                            nilai_sp2d,
                            nomor_spm,
                            tanggal_spm,
                            nama_ibu_kota,
                            nama_bud_kbud,
                            nip_bud_kbud,
                            jabatan_bud_kbud,
                            nama_bp_bpp,
                            nip_bp_bpp,
                            jabatan_bp_bpp,
                            no_rek_bp_bpp,
                            nama_rek_bp_bpp,
                            bank_bp_bpp,
                            npwp_bp_bpp,
                            id_sumber_sub,
                            id_opd,
                            status
                            )Values(
                                '$id',
                                '$jenis',
                                '$tahun',
                                '$rekening',
                                '$nama_bank',
                                '$nomor_sp_2_d',
                                '$tanggal_sp_2_d',
                                '$nama_skpd',
                                '0',
                                '0',
                                '0',
                                '0',
                                '0',
                                '0',
                                '$keterangan_sp2d',
                                '$nilai_sp2d',
                                '$nomor_spm',
                                '$tanggal_spm',
                                '$nama_ibu_kota',
                                '$nama_bud_kbud',
                                '$nip_bud_kbud',
                                '$jabatan_bud_kbud',
                                '$nama_bp_bpp',
                                '$nip_bp_bpp',
                                '$jabatan_bp_bpp',
                                '$no_rek_bp_bpp',
                                '$nama_rek_bp_bpp',
                                '$bank_bp_bpp',
                                '$npwp_bp_bpp',
                                '0',
                                '0',
                                '0'
                            )"
            ) or die(mysqli_error($conn));
            echo json_encode([
                "statusCode" => 200,
                "message" => "Data inserted successfully 😀"
            ]);
        }
    } else {
        echo "data tidak ditemukan";
    }
}
