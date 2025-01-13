<?php

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://service.sipd.kemendagri.go.id/pengeluaran/strict/spm/index?jenis=GU&status=draft&page=1&limit=10&nomor_spm=&keterangan_spm',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJTSVBEX0FVVEhfU0VSVklDRSIsInN1YiI6IjEzNDQ0Ni4zNDIiLCJleHAiOjE3MjQwMDQ0MTYsImlhdCI6MTcyMzc4ODQxNiwidGFodW4iOjIwMjQsImlkX3VzZXIiOjEzNDQ0NiwiaWRfZGFlcmFoIjozNDIsImtvZGVfcHJvdmluc2kiOiI3MiIsImlkX3NrcGQiOjAsImlkX3JvbGUiOjExLCJpZF9wZWdhd2FpIjoxMjYyNDgsInN1Yl9kb21haW5fZGFlcmFoIjoicGFsdSJ9.PnJW9WmD1l7GNvPPg1POSQTyaYxbcOpzs2tg_mF7qo4"
    ),
));
$response = curl_exec($curl);
curl_close($curl);
$dt = json_decode($response, true);
foreach ($dt as $row) {

echo $row['id_spm'];

echo '<br>';

}

?>
