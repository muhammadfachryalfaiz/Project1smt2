<?php
// Sertakan file koneksi database
require_once 'dbkoneksi.php';

// Periksa apakah parameter id telah disertakan dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data paramedik berdasarkan ID
    $query = $dbh->prepare('SELECT * FROM paramedik WHERE id = ?');
    $query->execute([$id]);
    $paramedik = $query->fetch(PDO::FETCH_ASSOC);

    // Periksa apakah paramedik dengan ID yang diberikan ditemukan
    if (!$paramedik) {
        echo "Paramedik tidak ditemukan.";
        exit;
    }
} else {
    echo "ID Paramedik tidak disediakan.";
    exit;
}

// Periksa apakah formulir telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirimkan melalui formulir
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $kategori = $_POST['kategori'];
    $telpon = $_POST['telpon'];
    $alamat = $_POST['alamat'];
    $unit_kerja_id = $_POST['unit_kerja_id'];

    // Query untuk mengupdate data paramedik
    $query = $dbh->prepare('UPDATE paramedik SET nama = ?, gender = ?, tmp_lahir = ?, tgl_lahir = ?, kategori = ?, telpon = ?, alamat = ?, unit_kerja_id = ? WHERE id = ?');
    $query->execute([$nama, $gender, $tmp_lahir, $tgl_lahir, $kategori, $telpon, $alamat, $unit_kerja_id, $id]);

    // Redirect ke halaman data paramedik setelah update
    header("Location: data_paramedik.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Paramedik</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h2>Update Data Paramedik</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $paramedik['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $paramedik['gender']; ?>">
            </div>
            <div class="form-group">
                <label for="tmp_lahir">Tempat Lahir:</label>
                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" value="<?php echo $paramedik['tmp_lahir']; ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $paramedik['tgl_lahir']; ?>">
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $paramedik['kategori']; ?>">
            </div>
            <div class="form-group">
                <label for="telpon">Telepon:</label>
                <input type="text" class="form-control" id="telpon" name="telpon" value="<?php echo $paramedik['telpon']; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $paramedik['alamat']; ?>">
            </div>
            <div class="form-group">
                <label for="unit_kerja_id">ID Unit Kerja:</label>
                <input type="text" class="form-control" id="unit_kerja_id" name="unit_kerja_id" value="<?php echo $paramedik['unit_kerja_id']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

</body>

</html>
