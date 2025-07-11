<!-- </head>

<body>
    <div class="judul">
        <!-- <h1>Dashboard</h1> -->
</div>
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
            <thead>
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
                        <th scope="row"><?php echo $number++ ?></th>
                        <td scope="row"><?php echo $nama ?></td>
                        <td scope="row"><?php echo $harga ?></td>
                        <td scope="row"><?php echo $stok ?></td>
                        <td scope="row"><?php echo $deskripsi ?></td>
                        <td scope="row">
                            <a href="update.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="hapus.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin Mau Delete Produk Ini??')"><button type="button" class="btn btn-danger">Delete</button></a>
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