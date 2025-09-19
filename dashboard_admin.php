    <?php
    require_once "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
        header("Location: login.php");
        exit;
    }

    $sukses = $error = "";

    if (isset($_GET['sukses'])) {
        $sukses = $_GET['sukses'];
    }

    if (isset($_GET['error'])) {
        $error = $_GET['error'];
    }


    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <style>
            .judul {
                background-color: #6c757d;
                text-align: center;
                padding: 10px;
                color: #ffffff;
                position: relative;
            }

            .btn {
                margin-left: 5px;
            }

            .user-menu {
                position: absolute;
                top: 15px;
                right: 50px;
                display: block;
            }

            .user-menu a {
                text-decoration: none;
                color: #ffffff;
            }
        </style>
    </head>

    <body>
        <div class="judul">
            <h2>Dashboard Admin</h2>
        </div>
        <div class="user-menu">
            <a href="logout.php" class="btn">🚪Logout</a>
        </div>
        <br />
        <div class="mx-auto">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($sukses): ?>
                <div class="alert alert-success"><?= $sukses ?></div>
            <?php endif; ?>

            <a href="create.php" class="btn btn-primary mb-3">Tambah Produk</a>
            <div class="card">
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
                                <th scope="col">Stok</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM produk ORDER BY id DESC";
                            $result = mysqli_query($koneksi, $sql);
                            $number = 1;
                            while ($row = mysqli_fetch_array($result)) {
                                $id         = $row['ID'];
                                $nama       = $row['Nama_Buku'];
                                $harga      = $row['Harga'];
                                $stok       = $row['Stok'];
                                $foto       = $row['Foto'];
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
                                        <?php echo $foto ?>
                                    </td>
                                    <td scope="row">
                                        <a href="update.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                                class="btn btn-warning">Edit</button></a>
                                        <a href="delete.php?op=delete&id=<?php echo $id ?>"
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
        </div>
    </body>

    </html>