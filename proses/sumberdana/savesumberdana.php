<?php

include '../../lib/conn.php';

$namasumber = $_GET['nama'];
$ketsumber = $_GET['keterangan'];

$savesumber = "INSERT INTO sdana.t_sumber (nm_sumber,ket) value ( '$namasumber', '$ketsumber' )";

$select = mysqli_query($conn,$savesumber)or die(mysqli_error($conn));

if (!$select) {
    echo 'tidak sukses';
}else{
    echo 'sukses';
    
}
