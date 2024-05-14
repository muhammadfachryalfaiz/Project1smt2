<?php
// Panggil file koneksi database
require './dbkoneksi.php';

// Pastikan form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $nama = $_POST['nama'];

    // Query untuk menyimpan data ke database
    $query = $dbh->prepare("INSERT INTO unit_kerja (nama) VALUES (:nama)");
    
    // Bind parameter nama
    $query->bindParam(':nama', $nama);

    // Eksekusi query
    if ($query->execute()) {
        // Jika query berhasil dijalankan, redirect ke halaman utama dengan pesan sukses
        header("Location: data_unit_kerjaphp");
        exit();
    } else {
        // Jika query gagal dijalankan, tampilkan pesan error
        echo "Terjadi kesalahan saat memproses data.";
    }
}
?>
