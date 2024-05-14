<?php
// Sertakan file dbkoneksi.php
require 'dbkoneksi.php';

// Cek apakah ID kelurahan ada dalam request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat query untuk menghapus pasien berdasarkan ID
    $sql = "DELETE FROM unit_kerja WHERE id = :id";

    // Prepare statement
    $stmt = $dbh->prepare($sql);

    // Bind parameter
    $stmt->bindParam(':id', $id);

    // Eksekusi query
    $stmt->execute();

    // Redirect kembali ke halaman data_unit_kerja.php
    header("Location: data_unit_kerja.php");
} else {
    // Jika tidak ada ID dalam request, redirect ke halaman data_unit_kerja.php
    header("Location: data_unit_kerja.php");
}
?>