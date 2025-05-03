<?php

$conn = new mysqli("localhost", "username", "password", "database");

// Start Transaction
$conn->begin_transaction();

try {
    // Perubahan Data (Contoh: Tambah Transaksi)
    $query = "INSERT INTO transaksi (id_produk, jumlah, harga_total) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $id_produk, $jumlah, $harga_total);
    $stmt->execute();

    // Perubahan Data (Contoh: Update Stok Produk)
    $query = "UPDATE produk SET stok = stok - ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $jumlah, $id_produk);
    $stmt->execute();

    // Commit Transaksi
    $conn->commit();
    echo "Transaksi berhasil!";

} catch (Exception $e) {
    // Rollback Transaksi jika terjadi kesalahan
    $conn->rollback();
    echo "Transaksi gagal: " . $e->getMessage();
}

$conn->close();

?>