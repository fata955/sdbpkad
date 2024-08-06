<?php

include '../../lib/conn.php';

$nama = $_GET['namaop'];
$kodeopd = $_GET['kodeop'];
$id = $_GET['idop'];


$saveopd = "UPDATE sipd.skpd SET nama_opd=$nama,kode_skpd=$kodeopd where id=$id";

$select = mysqli_query($conn,$saveopd)or die(mysqli_error($conn));

if (!$select) {
    echo 'tidak sukses';
}else{
    echo 'sukses';
    
}