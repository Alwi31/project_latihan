<?php

$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "book";

$koneksi = mysqli_connect($host, $user, $pass, $db);
// echo "Koneksi aman derr..!!<br/>";
if (!$koneksi) {
    die("Koneksi Gagal Dherr..!!: " . mysqli_connect_error());
}


// if ($host) {
//     echo "Connect sudah dherr..!!<br/>";
// } else {
//     echo "Connect gagal braderr..!!<br/>";
// }

// $db = mysqli_select_db($host, "ecommerce");
// if ($db) {
//     echo "Connect sudah derr sama database nye nihh..<br/>";
// } else {
//     echo "Connect gagal dherr, coba lagi..!!<br/>";
// }
