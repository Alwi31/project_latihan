<?php
require_once "koneksi.php";

$id = $nama = $harga = $currentFoto = $stok = "";
$sukses = $error = "";

if (isset($_GET['id'])) {
    $id         = $_GET['id'];
    $sql        = "SELECT * FROM produk WHERE id = '$id'";
    $result     = mysqli_query($koneksi, $sql);
    $row        = mysqli_fetch_assoc($result);

    if ($row) {
        $nama        = $row['Nama_Buku'];
        $harga       = $row['Harga'];
        $currentFoto = $row['Foto']; // Simpan path foto lama
        $stok        = $row['Stok'];
    } else {
        $error      = "Data tidak ditemukan";
    }
}

// Proses Update
if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama'];
    $harga      = $_POST['harga'];
    // $foto       = $_FILES['foto'];
    $stok       = $_POST['stok'];
    // $newFoto    = $_FILES['foto']['nama']; // Nama file baru

    // Gunakan foto lama jika tidak ada upload baru
    $foto = $currentFoto;

    // Jika ada file baru diupload
    if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "images/";

        // Buat folder jika belum ada
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fotoName = basename($_FILES['foto']['name']);
        $targetFilePath = $targetDir . $fotoName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validasi file
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFilePath)) {
                // Hapus file lama jika ada
                if (!empty($currentFoto) && file_exists($currentFoto)) {
                    unlink($currentFoto);
                }
                $foto = $targetFilePath;
            } else {
                $error = "Gagal mengupload file foto";
            }
        } else {
            $error = "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan";
        }
    }

    if ($id && $nama && $harga && $stok) {
        $sql = "UPDATE produk SET 
                Nama_Buku = '$nama', 
                Harga = '$harga', 
                Foto = '$foto', 
                Stok = '$stok' 
                WHERE id = '$id'";

        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $sukses = "Data berhasil diupdate";
            header("refresh:1.5;url=dashboard_admin.php?sukses=" . urlencode($sukses));
            exit();
        } else {
            $error = "Gagal update: " . mysqli_error($koneksi);
        }
    } else {
        $error = "Harap isi semua data wajib";
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
                Update Produk
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <?php if ($sukses): ?>
                    <div class="alert alert-success"><?= $sukses ?></div>
                <?php endif; ?>

                <form action="update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="ID" value="<?= $id ?>">
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
                            <!-- Input file (bisa kosong) -->
                            <input type="file" name="foto">
                            <?php if (!empty($currentFoto)): ?>
                                <p>Foto saat ini: <img src="<?php echo $currentFoto; ?>" height="100"></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Perubahan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>