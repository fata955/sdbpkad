<?php
include "../../lib/conn.php";
date_default_timezone_set('Asia/Makassar');
session_start();
$user = $_SESSION['username'];
// echo $username;


$sql2 = "SELECT * from user where username='$user'";
$data = mysqli_query($conn, $sql2);
$nameuser = mysqli_fetch_array($data);
$id_user = $nameuser['iduser'];
$nama = $nameuser['username'];

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT a.id, a.nilai_dana,a.jenis_dana,b.namasumberdana from t_salur a, t_sumberdana b where a.jenis_dana=b.id AND a.status='AKTIF'";
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
// function to fetch data
if ($_GET["action"] === "fetchVerifikasi") {

  $sql = "SELECT a.id_spm as id ,a.nomor_spm,a.nilai_spm,a.tanggal_spm, a.keterangan_spm,b.nama_opd as nama_sub_skpd,a.tanggal_spm FROM tspm a, skpd b, tspmsub c where a.id_spm=c.id_spm AND a.id_skpd=b.id_sipd AND c.status=0";
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

// function to fetch data
if ($_GET["action"] === "fetchVerif") {

  $tanggalHariIni = date('Y-m-d');
  $tanggalHariawal = date('Y-m-01');

  //jumlah Realisasi 
  $sql = "SELECT sum(a.nilai_spm) as realisasi from tspm a, tspmsub b where Date(b.updateby) between '$tanggalHariawal' AND '$tanggalHariIni' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND status=1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $datareaslisasi = $row['realisasi'];

  //jumlah jumlah SPM
  $sql = "SELECT count(a.id_spm) as totalspm from tspm a, tspmsub b where Date(b.updateby) between '$tanggalHariawal' AND '$tanggalHariIni' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND status=1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $spm = $row['totalspm'];

  //jumlah jumlah LS
  $sql = "SELECT count(a.id_spm) as totalls from tspm a, tspmsub b where Date(b.updateby) between '$tanggalHariawal' AND '$tanggalHariIni' AND b.id_user=$id_user AND b.status=1 AND a.id_spm=b.id_spm AND jenis='LS' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $ls = $row['totalls'];

  //jumlah jumlah gu
  $sql = "SELECT count(a.id_spm) as totalgu from tspm a, tspmsub b where Date(b.updateby) between '$tanggalHariawal' AND '$tanggalHariIni' AND b.id_user=$id_user AND b.status=1 AND a.id_spm=b.id_spm AND jenis='GU'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $gu = $row['totalgu'];

  //jumlah jumlah UP
  $sql = "SELECT count(a.id_spm) as totalup from tspm a, tspmsub b where Date(b.updateby) between '$tanggalHariawal' AND '$tanggalHariIni' AND b.id_user=$id_user AND b.status=1 AND a.id_spm=b.id_spm AND jenis='UP'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $up = $row['totalup'];

  $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where Date(c.updateby) between '$tanggalHariawal' AND '$tanggalHariIni' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND c.status=1";
  $result = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($conn);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data,
    "realisasi" => $datareaslisasi,
    "spm" => $spm,
    "ls" => $ls,
    "gu" => $gu,
    "up" => $up
  ]);
}
// function to filter data
if ($_GET["action"] === "filtertanggal") {

  $start = $_POST['start'];
  $end = $_POST['end'];
  $idopd = $_POST['opdlg'];

  if ($idopd > 1) {
    $opd = $idopd;
    $sql = "SELECT sum(a.nilai_spm) as realisasi from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $datarealisasi = $row['realisasi'];

    //jumlah jumlah SPM
    $sql = "SELECT count(*) as totalspm from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $spm = $row['totalspm'];

    //jumlah jumlah LS
    $sql = "SELECT count(*) as totalls from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='LS' AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $ls = $row['totalls'];

    //jumlah jumlah gu
    $sql = "SELECT count(*) as totalgu from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='GU' AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $gu = $row['totalgu'];

    //jumlah jumlah UP
    $sql = "SELECT count(*) as totalup from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='UP' AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $up = $row['totalup'];
    $start = $conn->real_escape_string($start);
    $end = $conn->real_escape_string($end);

    // echo $start;
    // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
    $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where a.tanggal_spm BETWEEN '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND id_skpd=$opd";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
      "data" => $data,
      "realisasi" => $datarealisasi,
      "spm" => $spm,
      "ls" => $ls,
      "gu" => $gu,
      "up" => $up
    ]);

  } else {

    $sql = "SELECT sum(a.nilai_spm) as realisasi from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $datarealisasi = $row['realisasi'];
  
    //jumlah jumlah SPM
    $sql = "SELECT count(*) as totalspm from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $spm = $row['totalspm'];
  
    //jumlah jumlah LS
    $sql = "SELECT count(*) as totalls from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='LS' AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $ls = $row['totalls'];
  
    //jumlah jumlah gu
    $sql = "SELECT count(*) as totalgu from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='GU' AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $gu = $row['totalgu'];
  
    //jumlah jumlah UP
    $sql = "SELECT count(*) as totalup from tspm a, tspmsub b where Date(a.tanggal_spm) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='UP' AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $up = $row['totalup'];
    $start = $conn->real_escape_string($start);
    $end = $conn->real_escape_string($end);
  
    // echo $start;
    // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
    $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where a.tanggal_spm BETWEEN '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND c.status=1";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
      "data" => $data,
      "realisasi" => $datarealisasi,
      "spm" => $spm,
      "ls" => $ls,
      "gu" => $gu,
      "up" => $up
    ]);
  }
}

if ($_GET["action"] === "filtertglverif") {

  $start = $_POST['start'];
  $end = $_POST['end'];
  $idopd = $_POST['opdlg'];

  if ($idopd > 1) {
    $opd = $idopd;
    $sql = "SELECT sum(a.nilai_spm) as realisasi from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $datarealisasi = $row['realisasi'];

    //jumlah jumlah SPM
    $sql = "SELECT count(*) as totalspm from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $spm = $row['totalspm'];

    //jumlah jumlah LS
    $sql = "SELECT count(*) as totalls from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='LS' AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $ls = $row['totalls'];

    //jumlah jumlah gu
    $sql = "SELECT count(*) as totalgu from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='GU' AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $gu = $row['totalgu'];

    //jumlah jumlah UP
    $sql = "SELECT count(*) as totalup from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='UP' AND id_skpd=$opd AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $up = $row['totalup'];
    $start = $conn->real_escape_string($start);
    $end = $conn->real_escape_string($end);

    // echo $start;
    // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
    // $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where Date(c.updateby) between '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND status>0";
    $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where Date(c.updateby) BETWEEN '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND a.id_skpd=$opd AND c.status=1";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
      "data" => $data,
      "realisasi" => $datarealisasi,
      "spm" => $spm,
      "ls" => $ls,
      "gu" => $gu,
      "up" => $up
    ]);
    
  } else {

    $sql = "SELECT sum(a.nilai_spm) as realisasi from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $datarealisasi = $row['realisasi'];
  
    //jumlah jumlah SPM
    $sql = "SELECT count(*) as totalspm from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $spm = $row['totalspm'];
  
    //jumlah jumlah LS
    $sql = "SELECT count(*) as totalls from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='LS' AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $ls = $row['totalls'];
  
    //jumlah jumlah gu
    $sql = "SELECT count(*) as totalgu from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='GU' AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $gu = $row['totalgu'];
  
    //jumlah jumlah UP
    $sql = "SELECT count(*) as totalup from tspm a, tspmsub b where Date(b.updateby) between '$start' AND '$end' AND b.id_user=$id_user AND a.id_spm=b.id_spm AND jenis='UP' AND b.status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $up = $row['totalup'];
    $start = $conn->real_escape_string($start);
    $end = $conn->real_escape_string($end);
  
    // echo $start;
    // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
    $sql = "SELECT a.id_spm as id,a.nomor_spm,b.nama_opd as skpd,a.jenis,a.nilai_spm FROM tspm a, skpd b, tspmsub c where Date(c.updateby) BETWEEN '$start' AND '$end' AND a.id_skpd=b.id_sipd AND a.id_spm=c.id_spm AND c.id_user=$id_user AND c.status=1";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode([
      "data" => $data,
      "realisasi" => $datarealisasi,
      "spm" => $spm,
      "ls" => $ls,
      "gu" => $gu,
      "up" => $up
    ]);
  }
}

if ($_GET["action"] === "fetchSalur") {
  $id = $_POST["idsalur"];
  

  $sql = "SELECT id,namasubsumberdana as name,idsumberdana from subssumber where idsumberdana=$id";
  // $sql = "SELECT * from subssumber where idsumberdana=$id";
  $result = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($conn);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data,
    "sum" => $id
  ]);
}

// fetch data of individual user for edit form
if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  // $sql = "SELECT a.id as idopd, a.nama_opd, b.id as idsumber, c.id as idperubahan, d.id, d.nilai_sumber FROM skpd a, subssumber b, t_perubahan c, t_opdsumberdana d  WHERE  a.id=d.id_opd AND b.id=d.id_subsumberdana AND c.id=d.id_perubahan AND d.id=$id";
  $sql = "SELECT id_spm as id,nomor_spm,keterangan_spm,nilai_spm,jenis,id_skpd FROM tspm  where id_spm=$id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($conn);
}
// insert data to database
if ($_GET["action"] === "insertData") {
  if (!empty($_POST["idspm"]) && !empty($_POST["nospm"]) && !empty($_POST["ketspm"]) && !empty($_POST["nilaispm"]) && !empty($_POST["dokumen"]) && !empty($_POST["opd"]) && !empty($_POST["dana"]) && !empty($_POST["namasumber"])  != 0) {
    $idspm = mysqli_real_escape_string($conn, $_POST["idspm"]);
    $nospm = mysqli_real_escape_string($conn, $_POST["nospm"]);
    $ketspm = mysqli_real_escape_string($conn, $_POST["ketspm"]);
    $nilaispm = mysqli_real_escape_string($conn, $_POST["nilaispm"]);
    $dokumen = mysqli_real_escape_string($conn, $_POST["dokumen"]);
    $opd = mysqli_real_escape_string($conn, $_POST["opd"]);
    $dana = mysqli_real_escape_string($conn, $_POST["dana"]);
    $sumber = mysqli_real_escape_string($conn, $_POST["namasumber"]);

    // Menampilkan id skpd
    $data6 = "SELECT id from skpd where id_sipd=$opd";
    $data66 = mysqli_query($conn, $data6);
    $idskpd = mysqli_fetch_array($data66);
    $idskpd = $idskpd['id'];

    //mengambil nilai perubahan
    $data3 = "SELECT id from t_perubahan where status='AKTIF'";
    $data33 = mysqli_query($conn, $data3);
    $perubahan = mysqli_fetch_array($data33);
    $perubahan = $perubahan['id'];

    $data = "SELECT * from pagu where idopd=$idskpd";
    $pagu = mysqli_query($conn, $data);
    $conterpagu = mysqli_num_rows($pagu);

    $data4 = "SELECT id from t_opdsumberdana where id_perubahan=$perubahan AND id_opd=$idskpd AND id_subsumberdana=$sumber";
    $data44 = mysqli_query($conn, $data4);
    $aktifpagu = mysqli_num_rows($data44);


    // $realisasisp2d = $realisasisp2d['nilaisp2d'];
    if ($conterpagu < 1) {
      echo json_encode([
        "statusCode" => 400,
        "message" => "Nilai Alokasi dana Belum terinput"
      ]);
    } else if ($aktifpagu == null) {
      echo json_encode([
        "statusCode" => 402,
        "message" => "Nilai Alokasi sumberdana Belum terinput"
      ]);
    } else {
      //menampilkan nilai realisasi sp2d
      // $data1 = "SELECT sum(nilai_sp2d) as nilaisp2d from sp2d where id_sumber_sub=$sumber AND id_opd=$opd ";
      // $data11 = mysqli_query($conn, $data1);
      // $realisasisp2d = mysqli_fetch_array($data11);
      // $realisasisp2d = $realisasisp2d['nilaisp2d'];

      //Mengambil Nilai realisasispm
      // $data2 = "SELECT sum(nilai_spm) as nilaispm from t_spm where id_sumberdana=$sumber AND id_skpd=$opd";
      // $data22 = mysqli_query($conn, $data2);
      // $realisasispm = mysqli_fetch_array($data22);
      // $realisasispm = $realisasispm['nilaispm'];

      $data = "SELECT sum(a.nilai_spm) as nilaispm from tspm a, tspmsub b where a.id_spm=b.id_spm AND b.id_sumber=$sumber ";
      $data22 = mysqli_query($conn, $data);
      $realisasispm = mysqli_fetch_array($data22);
      $realisasispm = $realisasispm['nilaispm'];
      // echo $realisasispm;

      // mengambil nilai pagu sumberdana
      $data5 = "SELECT a.nilai_sumber as nilaisumber from t_opdsumberdana a, t_perubahan b where a.id_perubahan=$perubahan AND a.id_opd=$idskpd AND a.id_subsumberdana=$sumber";
      $data55 = mysqli_query($conn, $data5);
      $sumberdana = mysqli_fetch_array($data55);
      $sumberdana = $sumberdana['nilaisumber'];
      $sisa = $sumberdana - $realisasispm;
      $valuespm = preg_replace("/[^0-9]/", "", $nilaispm);

      if ($sisa < $valuespm) {
        echo json_encode([
          "statusCode" => 600,
          "message" => "Nilai Alokasi SumberDana Tidak Mencukupi"
        ]);
      } else {
        // $sql = "INSERT INTO tspmsub (id_spm,status,id_sumber,id_user,id_dana) VALUES ('$idspm','1','$sumber','1','$dana')";
        $sql = "UPDATE tspmsub SET status=1,id_sumber=$sumber,id_dana=$dana,id_user=$id_user WHERE id_spm=$idspm";
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
      }
    }
  } else {
    echo json_encode([
      "statusCode" => 503,
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
} else {
  // echo json_encode([
  //   "statusCode" => 504,
  //   "message" => "Please fill all the required fields 🙏"
  // ]);
}




// function to delete data
if ($_GET["action"] === "deleteSB") {
  $id = $_POST["id"];
  // $delete_image = $_POST["delete_image"];

  $sql = "UPDATE tspmsub SET status=3 WHERE id_spm=$id";

  if (mysqli_query($conn, $sql)) {
    // remove the image
    // unlink("uploads/" . $delete_image);
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data deleted successfully 😀"
    ]);
  } else {
    echo json_encode([
      "statusCode" => 500,
      "message" => "Failed to delete data 😓"
    ]);
  }
}

// fetch data of individual user for edit form
if ($_GET["action"] === "Single") {
  $id = $_POST["id"];
  // $sql = "SELECT a.id as idopd, a.nama_opd, b.id as idsumber, c.id as idperubahan, d.id, d.nilai_sumber FROM skpd a, subssumber b, t_perubahan c, t_opdsumberdana d  WHERE  a.id=d.id_opd AND b.id=d.id_subsumberdana AND c.id=d.id_perubahan AND d.id=$id";
  $sql = "SELECT id,nomor_spm,keterangan_spm,nilai_spm as nilai,jenis_spm,id_skpd,id_sumberdana FROM t_spm  where id=$id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($conn);
}


// function to filter data
if ($_GET["action"] === "printData") {
  $start = $_POST['start'];
  $end = $_POST['end'];
  $start = $conn->real_escape_string($start);
  $end = $conn->real_escape_string($end);

  // echo $start;
  // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
  // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where Date(createby) between '$start' AND '$end' AND id_user=1 ";
  // $result = mysqli_query($conn, $sql);
  // $data = [];
  // while ($row = mysqli_fetch_assoc($result)) {
  //   $data[] = $row;
  // }
  // mysqli_close($conn);
  // header('Content-Type: application/json');
  // echo json_encode([
  //   "data" => $data
  // ]);
  $htmlContent = "<html><head><title>Print</title></head><body>";
  $htmlContent .= "<h1>Laporan Tagihan Pertanggal</h1>";
  $htmlContent .= "<p>$start sampai $end</p>";
  // $htmlContent .= "<p>$start</p>";
  $htmlContent .= "</body></html>";
  $htmlContent .= "<script>window.print();</script>";

  echo $htmlContent;
}
