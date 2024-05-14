<?php
require_once 'header.php';
require_once 'sidebar.php';

// Panggil file database
require './dbkoneksi.php';

// Ambil ID yang akan diedit
$id = $_GET['id'];

// Query SQL untuk mengambil data kelurahan berdasarkan ID
$query = $dbh->prepare("SELECT * FROM kelurahan WHERE id = ?");
$query->execute([$id]);
$row = $query->fetch();

// Pastikan data ditemukan sebelum menampilkan formulir edit
if (!$row) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Kelurahan</h1>
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
                            <form action="edit_kelurahan.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label for="nama">Nama Kelurahan</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="kec_id">Kecamatan ID</label>
                                    <input type="text" class="form-control" id="kec_id" name="kec_id" value="<?php echo $row['kec_id']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="data_kelurahan.php" class="btn btn-secondary">Cancel</a>
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
require_once 'footer.php';
?>
