<?php
// Panggil file database
require './dbkoneksi.php';

// Proses Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama = $_POST['nama'];
    $kec_id = $_POST['kec_id'];

    // Query SQL untuk menyimpan data baru ke dalam tabel kelurahan
    $query = $dbh->prepare("INSERT INTO kelurahan (nama, kec_id) VALUES (?, ?)");
    $query->execute([$nama, $kec_id]);

    // Redirect ke halaman index setelah data ditambahkan
    header("Location: data_kelurahan.php");
    exit;
} else {
    // Jika bukan POST request, redirect ke halaman tambah data
    header("Location: data_kelurahan.php");
    exit;
}
?>
