<?php
// Sertakan koneksi database
require 'dbkoneksi.php';

// Periksa apakah parameter id telah disertakan dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data pemeriksaan berdasarkan ID
    $query = $dbh->prepare('SELECT * FROM periksa WHERE id = ?');
    $query->execute([$id]);
    $periksa = $query->fetch(PDO::FETCH_ASSOC);

    // Periksa apakah pemeriksaan dengan ID yang diberikan ditemukan
    if (!$periksa) {
        echo "Pemeriksaan tidak ditemukan.";
        exit;
    }
} else {
    echo "ID Pemeriksaan tidak disediakan.";
    exit;
}

// Periksa apakah formulir telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirimkan melalui formulir
    $tanggal = $_POST['tanggal'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi = $_POST['tensi'];
    $keterangan = $_POST['keterangan'];
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];

    // Query untuk mengupdate data pemeriksaan
    $query = $dbh->prepare('UPDATE periksa SET tanggal = ?, berat = ?, tinggi = ?, tensi = ?, keterangan = ?, pasien_id = ?, dokter_id = ? WHERE id = ?');
    $result = $query->execute([$tanggal, $berat, $tinggi, $tensi, $keterangan, $pasien_id, $dokter_id, $id]);

    // Periksa apakah pembaruan berhasil
    if ($result) {
        // Redirect ke halaman data pemeriksaan setelah update
        header("Location: data_periksa.php");
        exit;
    } else {
        echo "Gagal memperbarui data pemeriksaan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pemeriksaan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h2>Update Data Pemeriksaan</h2>
        <form method="POST">
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $periksa['tanggal']; ?>">
            </div>
            <div class="form-group">
                <label for="berat">Berat Badan:</label>
                <input type="text" class="form-control" id="berat" name="berat" value="<?php echo $periksa['berat']; ?>">
            </div>
            <div class="form-group">
                <label for="tinggi">Tinggi Badan:</label>
                <input type="text" class="form-control" id="tinggi" name="tinggi" value="<?php echo $periksa['tinggi']; ?>">
            </div>
            <div class="form-group">
                <label for="tensi">Tensi:</label>
                <input type="text" class="form-control" id="tensi" name="tensi" value="<?php echo $periksa['tensi']; ?>">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $periksa['keterangan']; ?>">
            </div>
            <div class="form-group">
                <label for="pasien_id">ID Pasien:</label>
                <input type="text" class="form-control" id="pasien_id" name="pasien_id" value="<?php echo $periksa['pasien_id']; ?>">
            </div>
            <div class="form-group">
                <label for="dokter_id">ID Dokter:</label>
                <input type="text" class="form-control" id="dokter_id" name="dokter_id" value="<?php echo $periksa['dokter_id']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

</body>

</html>
