<?php


include '../../lib/conn.php';

$id = $_GET['id'];

$datadelete = "DELETE FROM sipd.skpd where id='$id'";

$select = mysqli_query($conn,$datadelete)or die(mysqli_error($conn));

if (!$select) {
    echo 'tidak sukses';
}else{
    echo 'sukses';
    
}
