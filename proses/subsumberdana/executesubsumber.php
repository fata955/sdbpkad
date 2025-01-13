<?php
include "../../lib/conn.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT a.id,a.namasubsumberdana,a.ket,b.namasumberdana FROM subssumber a, t_sumberdana b where a.idsumberdana=b.id  order by b.namasumberdana ";
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
  if (!empty($_POST["namasubsumberdana"]) && !empty($_POST["keterangan"]) && !empty($_POST["idsumber"]) != 0) {
    $namasubsumberdana = mysqli_real_escape_string($conn, $_POST["namasubsumberdana"]);
    $keterangan = mysqli_real_escape_string($conn, $_POST["keterangan"]);
    $idsumber = mysqli_real_escape_string($conn, $_POST["idsumber"]);
    // $kodeopd = mysqli_real_escape_string($conn, $_POST["kodeopd"]);
  

    // // rename the image before saving to database
    // $original_name = $_FILES["image"]["name"];
    // $new_name = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
    // move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $new_name);

    $sql = "INSERT INTO subssumber (namasubsumberdana,ket,idsumberdana) VALUES ('$namasubsumberdana','$keterangan','$idsumber')";

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
  $sql = "SELECT * FROM subssumber WHERE id=$id";
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
  if (!empty($_POST["namasubsumberdana"]) && !empty($_POST["keterangan"]) && !empty($_POST["idsumber"])) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $namasubsumberdana = mysqli_real_escape_string($conn, $_POST["namasubsumberdana"]);
    $keterangan = mysqli_real_escape_string($conn, $_POST["keterangan"]);
    $idsumberdana = mysqli_real_escape_string($conn, $_POST["idsumber"]);
    
    $sql = "UPDATE subssumber SET namasubsumberdana='$namasubsumberdana',ket='$keterangan',idsumberdana='$idsumberdana' WHERE id=$id";
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

  $sql = "DELETE FROM subssumber WHERE id=$id";

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
