<?php
include "../../lib/conn.php";



// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "call income1();";
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
  if (!empty($_POST["tanggal"]) && !empty($_POST["jenissumberdana"]) && !empty($_POST["tujuandana"]) && !empty($_POST["nilai"]) && !empty($_POST["status"]) != 0 ) {

    $tanggal = mysqli_real_escape_string($conn, $_POST["tanggal"]);
    $jenissumberdana = mysqli_real_escape_string($conn, $_POST["jenissumberdana"]);
    $tujuandana = mysqli_real_escape_string($conn, $_POST["tujuandana"]);
    $nilai = mysqli_real_escape_string($conn, $_POST["nilai"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $nilai = preg_replace("/[^0-9]/", "", $nilai);

    // echo $tanggal ;
    // $kodeopd = mysqli_real_escape_string($conn, $_POST["kodeopd"]);
  

    // // rename the image before saving to database
    // $original_name = $_FILES["image"]["name"];
    // $new_name = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
    // move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $new_name);

    $sql = "INSERT INTO t_salur (jenis_dana,tanggal_salur,tujuan_dana,nilai_dana,status) VALUES 
    ('$jenissumberdana','$tanggal','$tujuandana','$nilai','$status')";

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

// // fetch data of individual user for edit form
if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "SELECT * FROM t_salur WHERE id=$id";
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


// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];

  $sql = "DELETE FROM t_salur WHERE id=$id";
  if (mysqli_query($conn, $sql)) {
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


// function to update data
if ($_GET["action"] === "updateData") {
  if (!empty($_POST["tanggal"]) && !empty($_POST["jnsumber"]) && !empty($_POST["tujuansalur"]) && !empty($_POST["nilai"]) && !empty($_POST["statusnya"]) != 0 ) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $tanggal = mysqli_real_escape_string($conn, $_POST["tanggal"]);
    $sumberdana = mysqli_real_escape_string($conn, $_POST["jnsumber"]);
    $tujuan = mysqli_real_escape_string($conn, $_POST["tujuansalur"]);
    $nilai = mysqli_real_escape_string($conn, $_POST["nilai"]);
    $status = mysqli_real_escape_string($conn, $_POST["statusnya"]);
    $nilai = preg_replace("/[^0-9]/", "", $nilai);
    

    $sql = "UPDATE t_salur SET jenis_dana='$sumberdana', tanggal_salur='$tanggal', tujuan_dana='$tujuan', nilai_dana='$nilai', status='$status' WHERE id=$id";
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

?>