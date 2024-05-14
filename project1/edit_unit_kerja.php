<?php
// Panggil file header dan sidebar
require_once 'header.php';
require_once 'sidebar.php';

// Panggil file database
require './dbkoneksi.php';

// Pastikan ID yang akan diedit tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query SQL untuk mengambil data unit kerja berdasarkan ID
    $query = $dbh->prepare("SELECT * FROM unit_kerja WHERE id = ?");
    $query->execute([$id]);
    $row = $query->fetch();

    // Pastikan data ditemukan sebelum menampilkan formulir edit
    if (!$row) {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    // Jika tidak ada ID yang diberikan, tampilkan pesan error
    echo "ID tidak ditemukan.";
    exit;
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang diinput dari form
    $nama = $_POST['nama'];

    // Query SQL untuk memperbarui data unit kerja berdasarkan ID
    $updateQuery = $dbh->prepare("UPDATE unit_kerja SET nama = ? WHERE id = ?");
    $updateQuery->execute([$nama, $id]);

    // Redirect ke halaman data_unit_kerja.php setelah berhasil memperbarui
    header("Location: data_unit_kerja.php");
    exit();
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Unit Kerja</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="data_unit_kerja.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
// Panggil file footer
require_once 'footer.php';
?>
