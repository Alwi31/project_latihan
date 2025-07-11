<?php
require_once "koneksi.php";

$id = $nama = $harga = $stok = $deskripsi = "";
$sukses = $error = "";

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama'];
    $harga      = $_POST['harga'];
    $stok       = $_POST['stok'];
    $deskripsi  = $_POST['deskripsi'];

    if ($nama && $harga && $stok && $deskripsi) {
        $sql    = "INSERT INTO produk(nama, harga, stok, deskprsi) VALUES ('$nama', '$harga', '$stok', '$deskripsi')";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $sukses = "Berhasil Menambah Produk Baru";
            header("refresh:2;url=view.php");
        } else {
            $error = "Gagal Menambah Produk";
        }
    } else {
        $error = "Silahkan Masukkan Semua Data";
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
    <link rel="stylesheet" href="css/create.css">
</head>

<body>
    <div class="judul">
        <h1>Kelola Produk</h1>
    </div>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / Edit Produk
            </div>
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($sukses): ?>
                <div class="alert alert-success"><?= $sukses ?></div>
            <?php endif; ?>

            <form action="create.php" method="POST">
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
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
                        <label for="deskripsi" class="col-sm-2">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" name="simpan" value="Simpan Perubahan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</body>

</html>