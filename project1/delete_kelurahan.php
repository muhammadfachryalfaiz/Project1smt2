<?php
// Sertakan file dbkoneksi.php
require 'dbkoneksi.php';

// Cek apakah ID kelurahan ada dalam request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat query untuk menghapus pasien berdasarkan ID
    $sql = "DELETE FROM kelurahan WHERE id = :id";

    // Prepare statement
    $stmt = $dbh->prepare($sql);

    // Bind parameter
    $stmt->bindParam(':id', $id);

    // Eksekusi query
    $stmt->execute();

    // Redirect kembali ke halaman datakelurahan.php
    header("Location: data_kelurahan.php");
} else {
    // Jika tidak ada ID dalam request, redirect ke halaman data_kelurahan.php
    header("Location: data_kelurahan.php");
}
?>