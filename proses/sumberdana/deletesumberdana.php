<?php


include '../../lib/conn.php';

$id = $_GET['id'];

$datadelete = "DELETE FROM sdana.t_sumber where id_sumber='$id'";

$select = mysqli_query($conn,$datadelete)or die(mysqli_error($conn));

if (!$select) {
    echo 'tidak sukses';
}else{
    echo 'sukses';
    
}