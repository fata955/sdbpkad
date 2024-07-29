<?php

include '../../lib/conn.php';

$nama = $_GET['nama'];
$kodeopd = $_GET['kodeopd'];

$saveopd = "INSERT INTO skpd (nama_opd,kode_skpd) value ( '$nama', '$kodeopd' )";

$select = mysqli_query($conn,$saveopd)or die(mysqli_error($conn));

if (!$select) {
    echo 'tidak sukses';
}else{
    echo 'sukses';
    
}

