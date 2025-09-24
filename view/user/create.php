<?php
require_once "koneksi.php";

$id = $nama = $harga = $foto = $stok = "";
$sukses = $error = "";

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama'];
    $harga      = $_POST['harga'];
    $stok       = $_POST['stok'];

    // File upload processing
    $targetDir = "images/";
    $fotoName = basename($_FILES["foto"]["name"]);
    $targetFilePath = $targetDir . $fotoName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow certain file formats
    $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array($fileType, $allowedTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
            if ($nama && $harga && $stok) {
                $sql = "INSERT INTO produk(Nama_Buku, Harga, Stok, Foto) VALUES ('$nama', '$harga', '$stok', '$targetFilePath')";
                $result = mysqli_query($koneksi, $sql);

                if ($result) {
                    $sukses = "Berhasil Menambah Produk Baru";
                    header("refresh:1.5;url=dashboard_admin.php?sukses=" . urlencode($sukses));
                } else {
                    $error = "Gagal Menambah Produk: " . mysqli_error($koneksi);
                }
            } else {
                $error = "Silahkan Masukkan Semua Data";
            }
        } else {
            $error = "Gagal Upload File Foto";
        }
    } else {
        $error = "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/create.css">
</head>

<body>
    <div class="judul">
        <h3>Kelola Produk</h3>
    </div>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / Edit Produk
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <?php if ($sukses): ?>
                    <div class="alert alert-success"><?= $sukses ?></div>
                <?php endif; ?>

                <form action="create.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stok" class="col-sm-2">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stok" class="col-sm-2">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="foto" name="foto" value="<?php echo $foto; ?>">
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
                        <label for="deskripsi" class="col-sm-2">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="">
                        </div>
                    </div> -->
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Perubahan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>