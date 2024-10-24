<?php
include "../../lib/conn.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT a.nama_opd,b.nilai,b.id FROM skpd a,pagu b where a.id=b.idopd";
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

// insert data to database
if ($_GET["action"] === "insertData") {
  if (!empty($_POST["idopd"]) && !empty($_POST["nilai"]) != 0) {
    $idopd = mysqli_real_escape_string($conn, $_POST["idopd"]);
    $nilai = mysqli_real_escape_string($conn, $_POST["nilai"]);
    
    $result = preg_replace("/[^0-9]/", "", $nilai);
    $cek = mysqli_query($conn, "SELECT * FROM pagu where idopd='$idopd'");
    $double = mysqli_num_rows($cek);
    if ($double == null) {
      $sql = "INSERT INTO pagu (idopd,nilai) VALUES ('$idopd','$result')";

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
        "statusCode" => 800,
        "message" => "DATA SUDAH ADA BRO 😓"
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
  $sql = "SELECT a.nama_opd,a.id as idopd1,b.nilai,b.id FROM skpd a,pagu b where a.id=b.idopd AND b.id=$id";
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
  if (!empty($_POST["idopd"]) && !empty($_POST["nilai"])) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $idopd = mysqli_real_escape_string($conn, $_POST["idopd"]);
    $nilai = mysqli_real_escape_string($conn, $_POST["nilai"]);
    // $idsumberdana = mysqli_real_escape_string($conn, $_POST["idsumber"]);
    $result = preg_replace("/[^0-9]/", "", $nilai);
    $sql = "UPDATE pagu SET idopd='$idopd',nilai='$result' WHERE id=$id";
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

  $sql = "DELETE FROM pagu WHERE id=$id";

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
