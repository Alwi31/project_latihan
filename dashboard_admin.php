    <?php
    require_once "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
        header("Location: login.php");
        exit;
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Latihan CRUD - Book Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    </head>

    <body>
        <div class="judul">
            <!-- <h1>Dashboard</h1> -->
        </div>
        <br />
        <div class="card">
            <div class="col-md-6">
                <div class="right-element">
                    <a href="#" class="user-account for-buy"><i class="icon icon-user"></i><span>Daftar</span></a>
                    <a href="#" class=""><i class="icon-">Masuk</i></a>
                </div>
            </div>
            <div class="card-header">
                Daftar Produk
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="mb-2">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Buku</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tanggal Dibuat</th>
                            <!-- <th scope="col">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM produk ORDER BY id DESC";
                        $result = mysqli_query($koneksi, $sql);
                        $number = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $id         = $row['id'];
                            $nama       = $row['nama'];
                            $harga      = $row['harga'];
                            $stok       = $row['stok'];
                            $deskripsi  = $row['deskripsi'];
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $number++ ?>
                                </th>
                                <td scope="row">
                                    <?php echo $nama ?>
                                </td>
                                <td scope="row">
                                    <?php echo $harga ?>
                                </td>
                                <td scope="row">
                                    <?php echo $stok ?>
                                </td>
                                <td scope="row">
                                    <?php echo $deskripsi ?>
                                </td>
                                <td scope="row">
                                    <a href="update.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                            class="btn btn-warning">Edit</button></a>
                                    <a href="hapus.php?op=delete&id=<?php echo $id ?>"
                                        onclick="return confirm('Yakin Mau Delete Produk Ini??')"><button type="button"
                                            class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>