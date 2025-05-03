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
        $idspm = $_POST["idspm"];
        $dt = json_decode($dataspmdetail, true);
        $idl = $dt['jenis'];

        // mengambil nilai id opd/skpd di database
        if ($idl == "LS") {
            $nama_skpd = $dt["ls"]["header"]["nama_skpd"];

            $idskpd = mysqli_query($conn, "SELECT id_sipd FROM skpd where nama_opd='$nama_skpd'") or die(mysqli_error($conn));
            $idskpd = mysqli_fetch_array($idskpd);
            $id_skpd = $idskpd['id_sipd'];
        } elseif ($idl == "GU") {
            $nama_skpd = $dt["gu"]["nama_skpd"];

            $idskpd = mysqli_query($conn, "SELECT id_sipd FROM skpd where nama_opd='$nama_skpd'") or die(mysqli_error($conn));
            $idskpd = mysqli_fetch_array($idskpd);
            $id_skpdgu = $idskpd['id_sipd'];
        } elseif ($idl == "UP"){

        }



        // mengecek apakah ada yang sama didalam database menghindar double data
        $data = mysqli_query($conn, "SELECT * FROM tspm where id_spm=$idspm") or die(mysqli_error($conn));
        $hal = mysqli_num_rows($data);

        if ($hal != null) {
            header('Content-Type: application/json');
            echo json_encode([
                "statusCode" => 500,
                "message" => "Data Sudah Terinput"
            ]);
            return;
        } else {
            if ($idl == "LS") {
                $jenis = $dt["jenis"];
                $tahun = $dt["ls"]["header"]["tahun"];
                $nomor_spm = $dt["ls"]["header"]["nomor_spm"];
                $tanggal_spm = $dt["ls"]["header"]["tanggal_spm"];
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
                $nama_ibu_kota = $dt["ls"]["header"]["nama_ibukota"];
                $nama_pa_kpa = $dt["ls"]["header"]["nama_pa_kpa"];
                $nip_pa_kpa = $dt["ls"]["header"]["nip_pa_kpa"];
                $jabatan_pa_kpa = $dt["ls"]["header"]["jabatan_pa_kpa"];
                $dasarpembayaran = $dt["ls"]["dasar_pembayaran"];
                $detail = $dt["ls"]["detail"];
                $pajak_potongan = $dt["ls"]["pajak_potongan"];

                $angka1 = str_replace("'", "", $no_rek_pihak_ketiga);
                $keteranganspm = str_replace("'", "", $keterangan_spm);
                $namapenerima = str_replace("'", "", $nama_pihak_ketiga);
                $namarekening = str_replace("'", "",  $nama_rek_pihak_ketiga);

                $insertspm = "INSERT INTO tspm 
                        (id_spm,nomor_spm,tanggal_spm,id_skpd,keterangan_spm,nilai_spm,no_rek_pihak_ketiga,nama_rek_pihak_ketiga,bank_pihak_ketiga,
                        npwp_pihak_ketiga,nama_pa_kpa,nip_pa_kpa,jabatan_pa_kpa,nomor_spp,tanggal_spp,jenis,nama_bp_bpp,nip_bp_bpp,jabatan_bp_bpp )
                        Values(
                                '$idspm','$nomor_spm','$tanggal_spm','$id_skpd','$keteranganspm','$nilai_spm','$no_rek_pihak_ketiga','$namarekening',
                                '$bank_pihak_ketiga','$npwp_pihak_ketiga','$nama_pa_kpa','$nip_pa_kpa','$jabatan_pa_kpa','$nomor_spp','$tanggal_spp',
                                '$idl','0','0','0'
                            )";
                $insertsubspm = "INSERT INTO tspmsub (id_spm,status,id_sumber,id_user,id_dana)
                        VALUES (
                        '$idspm','0','0','0','0')";

                $spm = mysqli_query($conn, $insertspm) or die(mysqli_error($conn));
                $subspm = mysqli_query($conn, $insertsubspm) or die(mysqli_error($conn));

                foreach ($detail as $row) {
                    $insertbelanja = "INSERT INTO belanja (norekening,uraian,nilai,id_spm)
                VALUES (
                '" . $row["kode_rekening"] . "',
                '" . $row["uraian"] . "',
                '" . $row["jumlah"] . "',
                '$idspm'
                )";
                    $belanja = mysqli_query($conn, $insertbelanja) or die(mysqli_error($conn));
                }

                if ($pajak_potongan == null) {
                } else {
                    foreach ($pajak_potongan as $row1) {
                        $billing = str_replace("'", "", $row1["id_billing"]);
                        $insertpotongan = "INSERT INTO potongan (uraian,nilai,id_spm,billing)
                        VALUES (
                                    '" . $row1["nama_pajak_potongan"] . "',
                                    '" . $row1["nilai_spp_pajak_potongan"] . "',
                                    '$idspm',
                                    '$billing'
                                )";
                        $billing = str_replace("'", "", $row1["id_billing"]);
                        $spmpotongan = mysqli_query($conn, $insertpotongan) or die(mysqli_error($conn));
                    }
                }
                if ($dasarpembayaran == null) {
                } else {

                    $insertspd = "INSERT INTO spd (nomor_spd,tanggal_spd,total_spd,id_spm)
                VALUES (
                            '" . $dasarpembayaran["nomor_spd"] . "',
                            '" . $dasarpembayaran["tanggal_spd"] . "',
                            '" . $dasarpembayaran["total_spd"] . "',
                            '$idspm'
                        )";

                    $spd = mysqli_query($conn, $insertspd) or die(mysqli_error($conn));
                }

                header('Content-Type: application/json');
                echo json_encode([
                    "statusCode" => 200,
                    "message" => "Data inserted successfully 😀"
                ]);
            } elseif ($idl == "GU") {
                $jenis = $dt["jenis"];
                $tahun = $dt["gu"]["tahun"];
                $nomor_spm = $dt["gu"]["nomor_spm"];
                $tanggal_spm = $dt["gu"]["tanggal_spm"];
                $nama_skpd = $dt["gu"]["nama_skpd"];
                $nama_sub_skpd = $dt["gu"]["nama_sub_skpd"];
                $no_rek_pihak_ketiga = $dt["gu"]["no_rek_bp_bpp"];
                $nama_rek_pihak_ketiga = $dt["gu"]["nama_rek_bp_bpp"];
                $bank_pihak_ketiga = $dt["gu"]["bank_bp_bpp"];
                $npwp_pihak_ketiga = $dt["gu"]["npwp_bp_bpp"];
                $keterangan_spm = $dt["gu"]["keterangan_spm"];
                $nilai_spm = $dt["gu"]["nilai_spm"];
                $nomor_spp = $dt["gu"]["nomor_spp"];
                $tanggal_spp = $dt["gu"]["tanggal_spp"];
                $nama_ibu_kota = $dt["gu"]["nama_ibu_kota"];
                $nama_pa_kpa = $dt["gu"]["nama_pa_kpa"];
                $nip_pa_kpa = $dt["gu"]["nip_pa_kpa"];
                $jabatan_pa_kpa = $dt["gu"]["jabatan_pa_kpa"];
                $nama_bp_bpp = $dt["gu"]["nama_bp_bpp"];
                $nip_bp_bpp = $dt["gu"]["nip_bp_bpp"];
                $jabatan_bp_bpp = $dt["gu"]["jabatan_bp_bpp"];
                $detailgu = $dt["gu"]["detail"];

                $keteranganspm = str_replace("'", "", $keterangan_spm);
                $namarekening = str_replace("'", "",  $nama_rek_pihak_ketiga);
                $insertspm = "INSERT INTO tspm (id_spm,nomor_spm,tanggal_spm,id_skpd,keterangan_spm,nilai_spm,no_rek_pihak_ketiga,nama_rek_pihak_ketiga,
                    bank_pihak_ketiga,npwp_pihak_ketiga,nama_pa_kpa,nip_pa_kpa,jabatan_pa_kpa,nomor_spp,tanggal_spp,jenis,nama_bp_bpp,nip_bp_bpp,jabatan_bp_bpp )
                    Values(
                            '$idspm','$nomor_spm','$tanggal_spm','$id_skpdgu','$keteranganspm','$nilai_spm','$no_rek_pihak_ketiga','$namarekening','$bank_pihak_ketiga',
                            '$npwp_pihak_ketiga','$nama_pa_kpa','$nip_pa_kpa','$jabatan_pa_kpa','$nomor_spp','$tanggal_spp','$idl','$nama_bp_bpp',
                            '$nip_bp_bpp','$jabatan_bp_bpp'
                        )";
                $insertsubspm = "INSERT INTO tspmsub (id_spm,status,id_sumber,id_user,id_dana)
                        VALUES (
                        '$idspm','0','0','0','0')";


                $insertspm = mysqli_query($conn, $insertspm) or die(mysqli_error($conn));
                $insertsubspm = mysqli_query($conn, $insertsubspm) or die(mysqli_error($conn));
                foreach ($detailgu as $row) {
                    $insertbelanja = "INSERT INTO belanja (norekening,uraian,nilai,id_spm)
                    VALUES (
                        '" . $row["kode_rekening"] . "',
                        '" . $row["uraian"] . "',
                        '" . $row["nilai"] . "',
                        '$idspm')";
                    $belanja = mysqli_query($conn, $insertbelanja) or die(mysqli_error($conn));
                }

                header('Content-Type: application/json');
                echo json_encode([
                    "statusCode" => 200,
                    "message" => "Data inserted successfully 😀"
                ]);
            } elseif ($idl == "UP") {
                
            } elseif ($idl == "TU") {
            }
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            "statusCode" => 400,
            "message" => "Please fill all the required fields 🙏"
        ]);
    }
}
