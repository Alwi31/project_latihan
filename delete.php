<?php
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id     = $_GET['id'];
    $sql    = "DELETE FROM produk WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $sukses     = "Berhasil Menghapus Produk";
        header("Location: dashboard_admin.php?sukses=" . urlencode($sukses));
    } else {
        $error      = "Gagal Menghapus Produk";
    }
}
