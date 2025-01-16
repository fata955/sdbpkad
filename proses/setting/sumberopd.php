<?php
include "../../lib/conn.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  // $sql = "call sumberdanaopd()";
  $sql = "select a.id,a.nilai_sumber,b.nama_opd,c.namasubsumberdana,(SELECT COALESCE(sum(nilai_spm),0) from sipd.t_spm where id_skpd=(SELECT id_sipd as id from sipd.skpd where id=a.id_opd) AND id_sumberdana=c.id) as realisasi, d.namaperubahan FROM t_opdsumberdana a, skpd b, subssumber c, t_perubahan d where b.id=a.id_opd AND c.id=a.id_subsumberdana AND d.id=a.id_perubahan";
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
 
// fetch data of in dividual user for edit form
if ($_GET["action"] === "fetchSinglePagu") {
  $idopd = $_POST['id'];
  if ($idopd == 0) {
    echo json_encode([
      "statusCode" => 600,
      "message" => "PILIH DATA OPD DENGAN BENAR 😓"
    ]);
  }else{
    $perubahan = "SELECT id from t_perubahan where status='AKTIF'";
    $perubahan = mysqli_query($conn, $perubahan);
    $perubahan = mysqli_fetch_array($perubahan);
    $perubahan = $perubahan['id'];  

    $data1 = "SELECT id_sipd FROM skpd where id=$idopd";
    $data11 = mysqli_query($conn, $data1);
    $opd = mysqli_fetch_array($data11);
    $opd = $opd['id_sipd'];
    $sql = "SELECT * FROM pagu where idopd=$idopd";
    $pagu = mysqli_query($conn, $sql);
    if (mysqli_num_rows($pagu) > 0) {
      $sql = "select c.id,a.namasubsumberdana,c.nilai_sumber,(SELECT COALESCE(sum(z.nilai_spm),0) from tspm z, tspmsub y where z.id_spm=y.id_spm AND z.id_skpd=$opd AND y.id_sumber=c.id_subsumberdana) as realisasi,(SELECT COALESCE(sum(x.nilai_spm),0) from tspm x ,tspmsub w where x.id_spm=w.id_spm AND x.id_skpd=$opd AND w.id_sumber > 0 ) as totalrealisasi,b.nama_opd,d.nilai, (select sum(nilai_sumber) from t_opdsumberdana where id_opd=$idopd AND id_perubahan=$perubahan) as Total, e.namaperubahan,b.id as idopd FROM subssumber a, skpd b, t_opdsumberdana c, pagu d, t_perubahan e where c.id_opd=b.id AND c.id_subsumberdana=a.id AND c.id_opd=$idopd AND d.idopd=c.id_opd AND e.id=c.id_perubahan AND e.status='AKTIF'";
      $result = mysqli_query($conn, $sql);
      $data = [];
      if (mysqli_num_rows($result) > 0) {
        // $data = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) {
          $data[] = $row;
        }
        mysqli_close($conn);
        header("Content-Type: application/json");
        echo json_encode([
          "statusCode" => 200,
          "data" => $data,
        ]);
      } else {
        mysqli_close($conn);
        echo json_encode([
          "statusCode" => 404,
          "message" => "No data found with this id 😓"
        ]);
      }
    } else {
      mysqli_close($conn);
      echo json_encode([
        "statusCode" => 505,
        "message" => "OPD Belum Mempunnyai Pagu 😓"
      ]);
    }
  }
}

if ($_GET["action"] === "fetchperubahan") {
  $idopd = $_POST['id'];
  $perubahan = "SELECT id from t_perubahan where status='AKTIF'";
  $result2 = mysqli_query($conn, $perubahan);
  $perubahan = mysqli_fetch_array($result2);
  $perubahan = $perubahan['id'];

  if ($idopd == 0) {
    echo json_encode([
      "statusCode" => 505,
      "message" => "PILIH DATA OPD DENGAN BENAR 😓"
    ]);
  } else {

    $sql = "SELECT count(a.id) as jumlah FROM t_opdsumberdana a, t_perubahan b where a.id_opd=$idopd AND a.id_perubahan=b.id AND b.status='AKTIF'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $count = $data['jumlah'];
    // $data = [];
    if ($count > 0) {
      mysqli_close($conn);
      echo json_encode([
        "statusCode" => 404,
        "message" => "DATA SUDAH DI SIKRONISASI DENGAN ITEM PERUBAHAN 😓"
      ]);
    } else {
      $sql1 = "INSERT INTO t_opdsumberdana (id_perubahan,id_opd,id_subsumberdana,nilai_sumber)VALUE($perubahan,$idopd,'2','0')";
      $result = mysqli_query($conn, $sql1);
      while ($row = mysqli_fetch_array($result)) {
        // $data[] = $row;
      }
      mysqli_close($conn);
      header("Content-Type: application/json");
      echo json_encode([
        "statusCode" => 200,
        "data" => $data
      ]);
    }
  }
}


// insert data to database
if ($_GET["action"] === "insertData") {
  if (!empty($_POST["idopd"]) && !empty($_POST["nilaisumber1"]) && !empty($_POST["sumber"]) && !empty($_POST["perubahan"]) != 0) {
    $idopd = mysqli_real_escape_string($conn, $_POST["idopd"]);
    $nilai = mysqli_real_escape_string($conn, $_POST["nilaisumber1"]);
    $sumber = mysqli_real_escape_string($conn, $_POST["sumber"]);
    $perubahan = mysqli_real_escape_string($conn, $_POST["perubahan"]);
    $nilai = preg_replace("/[^0-9]/", "", $nilai);

    $sql = "INSERT INTO t_opdsumberdana (id_perubahan,id_opd,id_subsumberdana,nilai_sumber) VALUES ('$perubahan','$idopd','$sumber','$nilai')";

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
  } else {
    echo json_encode([
      "statusCode" => 400,
  
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
}

// fetch data of individual user for edit form
if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  // $sql = "SELECT a.id as idopd, a.nama_opd, b.id as idsumber, c.id as idperubahan, d.id, d.nilai_sumber FROM skpd a, subssumber b, t_perubahan c, t_opdsumberdana d  WHERE  a.id=d.id_opd AND b.id=d.id_subsumberdana AND c.id=d.id_perubahan AND d.id=$id";
  $sql = "SELECT a.id,a.id_perubahan,a.id_opd,a.id_subsumberdana, a.nilai_sumber, b.nama_opd FROM t_opdsumberdana a, skpd b where a.id=$id AND a.id_opd=b.id";
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



// function to update data
if ($_GET["action"] === "updateData") {
  if (!empty($_POST["idopd"]) && !empty($_POST["nilaisumber"]) && !empty($_POST["sumber"]) && !empty($_POST["perubahan"]) && !empty($_POST["idsumberdana"])) {
    $id = mysqli_real_escape_string($conn, $_POST["idsumberdana"]);
    $id_perubahan = mysqli_real_escape_string($conn, $_POST["perubahan"]);
    $id_opd = mysqli_real_escape_string($conn, $_POST["idopd"]);
    $id_sumber = mysqli_real_escape_string($conn, $_POST["sumber"]);
    $nilai = mysqli_real_escape_string($conn, $_POST["nilaisumber"]);

    $nilai = preg_replace("/[^0-9]/", "", $nilai);
    $sql = "UPDATE t_opdsumberdana SET id_subsumberdana= $id_sumber,nilai_sumber=$nilai WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
      echo json_encode([
        "statusCode" => 200,
        "message" => "Data updated successfully 😀"
      ]);
    } else {
      echo json_encode([
        "statusCode" => 500,
        "message" => "Failed to update data 😓"
      ]);
    }
    mysqli_close($conn);
  } else {
    echo json_encode([
      "statusCode" => 400,
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
}



// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];
  // $delete_image = $_POST["delete_image"];

  $sql = "DELETE FROM t_opdsumberdana WHERE id=$id";

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
