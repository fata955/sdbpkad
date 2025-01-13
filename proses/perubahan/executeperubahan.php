<?php
include "../../lib/conn.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM t_perubahan";
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
  if (!empty($_POST["namaperubahan"]) && !empty($_POST["status"]) != 0) {
    $namaperubahan = mysqli_real_escape_string($conn, $_POST["namaperubahan"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
   
    $sql = "INSERT INTO t_perubahan (namaperubahan,status) VALUES ('$namaperubahan','$status')";

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
  $sql = "SELECT * FROM t_perubahan WHERE id=$id";
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
  if (!empty($_POST["namaperubahan"]) && !empty($_POST["status"])) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $namaperubahan= mysqli_real_escape_string($conn, $_POST["namaperubahan"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    // $idsumberdana = mysqli_real_escape_string($conn, $_POST["idsumber"]);
    
    $sql = "UPDATE t_perubahan SET namaperubahan='$namaperubahan',status='$status' WHERE id=$id";
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

  $sql = "DELETE FROM t_perubahan WHERE id=$id";

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
