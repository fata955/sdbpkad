<?php
include "../../lib/conn.php";

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
  $sql = "SELECT a.id_spm,a.nomor_spm,a.nilai_spm,a.tanggal_spm, a.keterangan_spm,b.nama_opd as nama_sub_skpd,a.createby FROM tspm a, skpd b, tspmsub c where a.id_spm=c.id_spm AND a.id_skpd=b.id_sipd AND c.status=0";
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
// if ($_GET["action"] === "fetchVerif") {
//   // $start = $_POST['start'];
//   // $end = $_POST['end'];
//   $tanggalHariIni = date('Y-m-d');
//   $tanggalHariawal = date('Y-m-01');
//   // $start = $conn->real_escape_string($start);
//   // $end = $conn->real_escape_string($end);

//   // echo $start;
//   // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
//   $sql = "SELECT id_spm, nomor_spm,nama_opd,jenis_spm,nilai_spm FROM tspm where Date(createby) between '$tanggalHariawal' AND '$tanggalHariIni' AND id_user=1 ";
//   $result = mysqli_query($conn, $sql);
//   $data = [];
//   while ($row = mysqli_fetch_assoc($result)) {
//     $data[] = $row;
//   }
//   mysqli_close($conn);
//   header('Content-Type: application/json');
//   echo json_encode([
//     "data" => $data
//   ]);
//   // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1";
//   // $result = mysqli_query($conn, $sql);
//   // $data = [];
//   // while ($row = mysqli_fetch_assoc($result)) {
//   //   $data[] = $row;
//   // }
//   // mysqli_close($conn);
//   // header('Content-Type: application/json');
//   // echo json_encode([
//   //   "data" => $data
//   // ]);
// }


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
  $sql = "SELECT id,nomor_spm,keterangan_spm,nilai_spm,jenis_spm,id_skpd FROM t_spm  where id=$id";
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
          "message" => "Nilai Pagu SumberDana Tidak Mencukupi"
        ]);
      } else {
        $sql = "INSERT INTO tspmsub (id_spm,status,id_sumber,id_user,id_dana) VALUES ('$idspm','1','$sumber','1','$dana')";
        $sql = "UPDATE tspmsub SET status=1,id_sumber=$sumber,id_dana=$dana,id_user=1 WHERE id=$idspm";
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
  }else{
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



// function to filter data
if ($_GET["action"] === "filtertanggal") {
  $start = $_POST['start'];
  $end = $_POST['end'];
  $start = $conn->real_escape_string($start);
  $end = $conn->real_escape_string($end);

  // echo $start;
  // $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where id_user=1 AND like tanggal_spm=$start between tanggal_spm=$end";
  $sql = "SELECT id,nomor_spm,nama_sub_skpd,jenis_spm,nilai_spm FROM sipd.t_spm where Date(createby) between '$start' AND '$end' AND id_user=1 ";
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

// function to delete data
if ($_GET["action"] === "deleteSB") {
  $id = $_POST["id"];
  // $delete_image = $_POST["delete_image"];

  $sql = "UPDATE t_spm SET id_user=0, id_sumberdana=0,id_salur=0 WHERE id=$id";

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
