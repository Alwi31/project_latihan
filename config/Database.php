<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "book";
    private $connection;

    function __construct($host = null, $user = null, $pass = null, $db = null)
    {
        $this->host     = $host ?? $this->host;
        $this->user     = $user ?? $this->user;
        $this->pass     = $pass ?? $this->pass;
        $this->db       = $db ?? $this->db;

        // Check Koneksi
        $this->connection = mysqli_connect($this->host, $this->user, $this->pass,);
        if (!$this->connection) {
            die("Koneksi Gagal Dherr..!!" . mysqli_connect_error());
        }

        // Select DB
        if (!mysqli_select_db($this->connection, $this->db)) {
            die("Database Connect Gagal Dherr..!" . mysqli_error($this->connection));
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
// $host   = "localhost";
// $user   = "root";
// $pass   = "";
// $db     = "book";

// $koneksi = mysqli_connect($host, $user, $pass, $db);
// // echo "Koneksi aman derr..!!<br/>";
// if (!$koneksi) {
//     die("Koneksi Gagal Dherr..!!: " . mysqli_connect_error());
// }


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
